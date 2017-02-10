<?php
App::uses('CakeTime', 'Utility');
App::uses('CakeEmail', 'Network/Email');
App::uses('Paypal', 'Paypal.Lib');
class CheckoutsController extends AppController
{
    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->authenticate();
        $this->currentDateTime=CakeTime::format('Y-m-d H:i:s',CakeTime::convert(time(),$this->siteTimezone));
        $this->currentDate=CakeTime::format('Y-m-d',CakeTime::convert(time(),$this->siteTimezone));
        $this->currentEmailDate=CakeTime::format('d-m-Y',CakeTime::convert(time(),$this->siteTimezone));
        $this->studentId=$this->userValue['Student']['id'];
        $payPal=false;
        $this->loadModel('PaypalConfig');
        $paySetting=$this->PaypalConfig->findById('1');
        if(strlen($paySetting['PaypalConfig']['username'])>0 && strlen($paySetting['PaypalConfig']['password'])>0 && strlen($paySetting['PaypalConfig']['signature'])>0)
        {
            if($paySetting['PaypalConfig']['sandbox_mode']==1)
            $sandboxMode=true;
            else
            $sandboxMode=false;        
            $this->Paypal = new Paypal(array(
                                             'sandboxMode' => $sandboxMode,
                                             'nvpUsername' => $paySetting['PaypalConfig']['username'],
                                             'nvpPassword' => $paySetting['PaypalConfig']['password'],
                                             'nvpSignature' => $paySetting['PaypalConfig']['signature']
                                             ));
            
            $payPal=true;
        }
        $this->set('payPal',$payPal);
    }
    public function index()
    {
        $this->loadModel('Cart');
        $this->set('UserArr',$this->userValue);
        $carts = $this->Cart->readPackage();
        $products = array();
        if (null!=$carts)
        {
            $this->loadModel('Package');
            foreach ($carts as $productId => $count)
            {
                $product = $this->Package->findById($productId);
                $product['Package']['count'] = $count;
                $products[]=$product;
            }
        }
        $this->set(compact('products'));
        if(isset($_REQUEST['token']))
        {
            $this->Session->setFlash(__('Payment Cancel'),'flash',array('alert'=>'danger'));
        }
    }
    public function getTotalAmount()
    {
        $this->loadModel('Cart');
        $carts = $this->Cart->readPackage();
        $products = array();
        if (null!=$carts)
        {
            $this->loadModel('Package');
            $totalAmount=0;
            foreach ($carts as $productId => $count)
            {
                $product = $this->Package->findById($productId);
                $totalAmount=($product['Package']['price']*$count)+$totalAmount;
            }
        }
        return $totalAmount;
    }
    public function payment()
    {
        $totalAmount=$this->getTotalAmount();
        $this->redirect(array('controller'=>'Checkouts','action' => 'paymentgateway',$totalAmount));
    }
    public function paymentgateway($totalAmount=null)
    {
        if ($totalAmount==0)
        {
            $transactionId=rand();
            $this->redirect(array('controller'=>'Checkouts','action' => 'postpayment',$transactionId,$totalAmount,"Free"));
        }
        $transactionId=rand();
        $this->redirect(array('controller'=>'Checkouts','action' => 'paypalpayment',$transactionId,$totalAmount));
    }
    public function postpayment($id=null,$totalAmount=null,$status=null)
    {
        if($status=="Free")
        $paymentDetails['PAYMENTINFO_0_ACK']="Success";
        else
        $paymentDetails['PAYMENTINFO_0_ACK']="Success";
        $transactionId=$id;
        $amount=$totalAmount;
        $description="ok";
        if($paymentDetails['PAYMENTINFO_0_ACK']=="Success")
        {
            $this->loadModel('Payment');
            $paymentArr=array('student_id'=>$this->studentId,'transaction_id'=>$transactionId,'amount'=>$amount,'status'=>'Approved','date'=>$this->currentDateTime,'remarks'=>$description,'type'=>'Free','payment_type'=>'Onetime');
            $this->Payment->create();
            $this->Payment->save($paymentArr);
            $orderArr=array('id'=>$this->Payment->id,'student_id'=>$this->studentId,'transactionId'=>$transactionId,'amount'=>$amount);
            $this->orderComplete($orderArr);
            $this->Session->setFlash(__('Package Order successfully done'),'flash',array('alert'=>'success'));
            $this->redirect(array('controller'=>'Orderhistories','action' => 'index'));
        }
        $this->Session->setFlash(__('Payment not done'),'flash',array('alert'=>'danger'));
        return $this->redirect(array('action' => 'index'));
    }
    public function paypalpayment()
    {
        $this->loadModel('Cart');
        $carts = $this->Cart->readPackage();
        $record_arr=$this->Checkout->cartProduct($carts);
        if($record_arr)
        {
            $description="Accept Group Recurring Payment";
            $returnUrl=$this->siteDomain.'/Checkouts/paypalpostpayment/';
            $cancelUrl=$this->siteDomain.'/Checkouts/index/';
            $order = array(
            'description' => $description,
            'currency' => $this->currencyType,
            'return' => $returnUrl,
            'cancel' => $cancelUrl,
            'items' => $record_arr
            );
            try
            {
                $this->loadModel('Student');
                $studentArr=$this->Student->findById($this->studentId);
                if($studentArr['Student']['auto_renewal'])
                {
                    $token=$this->Paypal->setExpressCheckoutRecurringPayment($order);
                }
                else
                {
                    $token=$this->Paypal->setExpressCheckout($order);
                }
                $tokenArr=explode("&",$token);
                $tokenId=substr($tokenArr[1],6);
                $this->loadModel('Payment');
                $this->Payment->create();
                $amount=$this->getTotalAmount();
                $paymentArr=array('student_id'=>$this->studentId,'token'=>$tokenId,'amount'=>$amount,'status'=>'Pending','date'=>$this->currentDateTime,'remarks'=>$description,'type'=>'Pay Pal');
                $this->Payment->save($paymentArr);
                $this->redirect($token);            
            }
            catch (PaypalRedirectException $e)
            {
                $this->redirect($e->getMessage());
            }
            catch (Exception $e)
            {
                $this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
            }
            $this->redirect(array('action' => 'index'));
        }
        else
        {
            $this->Session->setFlash(__('Invalid Amount'),'flash',array('alert'=>'danger'));
            $this->redirect(array('action' => 'index'));
        }
    }
    public function paypalpostpayment($id=null)
    {
        if(isset($_REQUEST['token']) && isset($_REQUEST['PayerID']))
        {
            $token=$_REQUEST['token'];
            try
            {
                $detailsArr=$this->Paypal->getExpressCheckoutDetails($token);
                if(is_array($detailsArr))
                {
                    $this->loadModel('Cart');
                    $carts = $this->Cart->readPackage();
                    $record_arr=$this->Checkout->cartProduct($carts);
                    $amount=$detailsArr['AMT'];
                    $description=$detailsArr['DESC'];
                    $payerId=$_REQUEST['PayerID'];
                    if($detailsArr['ACK']=="Success")
                    {
                        $order = array(
                        'description' => $description,
                        'currency' => $this->currencyType,
                        'return' => $this->siteDomain.'/Checkouts/paypalpostpayment/',
                        'cancel' => $this->siteDomain.'/Checkouts/index/',
                        'items' => $record_arr
                        );
                        try
                        {
                            $billingFrequency=$record_arr[0]['billingFrequency'];
                            $profileStartDate=$detailsArr['TIMESTAMP'];
                            $email=$detailsArr['EMAIL'];
                            $this->loadModel('Student');
                            $studentArr=$this->Student->findById($this->studentId);
                            if($studentArr['Student']['auto_renewal'])
                            {
                                $paymentDetails=$this->Paypal->doExpressCheckoutRecurringPayment($order,$token,$payerId,$billingFrequency,$profileStartDate,$description,$email);
                                if(is_array($paymentDetails))
                                {
                                    if($paymentDetails['ACK']=="Success" && $paymentDetails['PROFILESTATUS']=="ActiveProfile")
                                    {
                                        $this->orderProcess($paymentDetails,$amount,$token,'Recurring');
                                    }
                                }
                            }                            
                            else
                            {
                                $paymentDetails=$this->Paypal->doExpressCheckoutPayment($order,$token,$payerId);
                                if($paymentDetails['PAYMENTINFO_0_PAYMENTSTATUS']=="Completed" && $paymentDetails['PAYMENTINFO_0_ACK']=="Success")
                                {
                                    $this->orderProcess($paymentDetails,$amount,$token,'Onetime');
                                }
                            }
                            $this->Session->setFlash(__('Payment not done'),'flash',array('alert'=>'danger'));
                            return $this->redirect(array('action' => 'index'));
                        }
                        catch (PaypalRedirectException $e)
                        {
                            $this->redirect($e->getMessage());
                        }
                        catch (Exception $e)
                        {
                            $this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
                        }                        
                    }
                    else
                    {
                        $this->Session->setFlash(__('Payment not done'),'flash',array('alert'=>'danger'));
                    }
                }                
            }
            catch (Exception $e)
            {
                $this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
            }
            $this->redirect(array('action' => 'index'));
        }
    }
    public function orderProcess($paymentDetails,$amount,$token,$paymentType)
    {
        $this->loadModel('Payment');
        if($paymentType=="Onetime")
        {
            $transactionId=$paymentDetails['PAYMENTINFO_0_TRANSACTIONID'];
            $token=$paymentDetails['TOKEN'];
            $timestamp=$paymentDetails['PAYMENTINFO_0_ORDERTIME'];
            $correlationId=$paymentDetails['CORRELATIONID'];
            $lastPaymentDate=NULL;
        }
        if($paymentType=="Recurring")
        {
            $transactionId=$paymentDetails['PROFILEID'];
            $timestamp=$paymentDetails['TIMESTAMP'];
            $correlationId=$paymentDetails['CORRELATIONID'];
            $lastPaymentDate=$paymentDetails['TIMESTAMP'];
        }
        $paymentArr=$this->Payment->findByToken($token);
        $paymentId=$paymentArr['Payment']['id'];
        $this->Payment->save(array('id'=>$paymentId,'status'=>'Approved','transaction_id'=>$transactionId,'token'=>$token,'correlation_id'=>$correlationId,'timestamp'=>$timestamp,'payment_type'=>$paymentType));
        $orderArr=array('id'=>$paymentId,'student_id'=>$this->studentId,'transactionId'=>$transactionId,'amount'=>$amount,'last_payment_date'=>$lastPaymentDate);
        $this->orderComplete($orderArr);
        if($paymentType=="Onetime")
        {
            $this->Session->setFlash(__('Order successfully done'),'flash',array('alert'=>'success'));
        }
        if($paymentType=="Recurring")
        {
            $this->Session->setFlash(__('Order successfully placed but waiting for payment confirmation'),'flash',array('alert'=>'success'));
        }
        $this->redirect(array('controller'=>'Orderhistories','action' => 'index'));
    }
    public function orderComplete($orderArr=array())
    {
        $packageDetail=null;$recordeo_arr=array();
        $this->loadModel('Cart');
        $this->loadModel('Payment');
        $this->loadModel('GroupsPayment');
        $this->loadModel('StudentGroup');
        $this->loadModel('Student');
        $studentArr=$this->Student->findById($this->studentId);
        $paymentArr=$this->Payment->find('first',array('conditions'=>array('Payment.transaction_id'=>$orderArr['transactionId'],'status'=>'Approved')));
        if($paymentArr)
        {
            $paymentId=$orderArr['id'];
            $carts = $this->Cart->readPackage();
            $products = array();
            if (null!=$carts)
            {
                $this->loadModel('Package');
                foreach ($carts as $productId => $count)
                {
                    $product = $this->Package->findById($productId);
                    $expiryDays=$product['Package']['day'];
                    if($product['Package']['day']==0)
                    {
                        $expiryDays="Unlimited";
                        $expiryDate=null;
                    }
                    else
                    {
                        $this->loadModel('StudentGroup');
                        $studentExpiryDateStr=0;
                        $studentExpiryArr=$this->StudentGroup->find('first',array('conditions'=>array('StudentGroup.student_id'=>$orderArr['student_id'],'group_id'=>$product['Package']['id']),
                                                                'order'=>array('StudentGroup.expiry_date'=>'desc')));
                        if($studentExpiryArr)
                        {
                            $studentExpiryDate=$studentExpiryArr['StudentGroup']['expiry_date'];
                            $studentExpiryDateStr=0;
                            if($studentExpiryDate!=NULL && strtotime($studentExpiryDate)>strtotime($this->currentDate))
                            $studentExpiryDateStr=strtotime($studentExpiryDate)-strtotime($this->currentDate);
                        }
                        $expiryDays=$product['Package']['day'];
                        $expiryDate=date('Y-m-d',strtotime($this->currentDate."+$expiryDays days")+$studentExpiryDateStr);
                        $status="Approved";
                        if($studentArr['Student']['auto_renewal'])
                        {
                            $expiryDate=$this->currentDate;
                            $status="Pending";
                        }
                    }
                    $recordeo_arr[]=array('GroupsPayment'=>array('payment_id'=>$paymentId,'group_id'=>$product['Package']['id'],'student_id'=>$orderArr['student_id'],'price'=>$product['Package']['price'],
                                                              'qty'=>$count,'amount'=>$count*$product['Package']['price'],'expiry_days'=>$expiryDays,'date'=>$this->currentDate,'expiry_date'=>$expiryDate,'last_payment_date'=>$orderArr['last_payment_date'],'status'=>$status));
                    $studentGroupArr=$this->StudentGroup->findByGroupIdAndStudentId($product['Package']['id'],$orderArr['student_id']);
                    if($studentGroupArr)
                    $studentGroup[]=array('StudentGroup'=>array('id'=>$studentGroupArr['StudentGroup']['id'],'group_id'=>$product['Package']['id'],'student_id'=>$orderArr['student_id'],'date'=>$this->currentDate,'expiry_date'=>$expiryDate));
                    else
                    $studentGroup[]=array('StudentGroup'=>array('group_id'=>$product['Package']['id'],'student_id'=>$orderArr['student_id'],'date'=>$this->currentDate,'expiry_date'=>$expiryDate));
                    $packageDetail.="<strong>Group:  ".$product['Package']['group_name']."</strong><br><br>
                    Cost:  ".$product['Package']['price']."<br><br>
                    Details of Payment Transaction:  ".$orderArr['transactionId']."<br><br>
                    Group Purchase Date:  ".$this->currentEmailDate."<br><br>
                    Group Valid Upto:  ".$expiryDays." Days<br><br>";
                }
            }
            if(!$studentArr['Student']['auto_renewal'])
            {
                $this->StudentGroup->saveAll($studentGroup);
            }
            $this->GroupsPayment->saveAll($recordeo_arr);
            $this->orderEmail($packageDetail,$orderArr['amount']);
            $this->Cart->savePackage(null);
        }
        else
        {
            $this->Session->setFlash(__('Invalid Payment!'),'flash',array('alert'=>'danger'));
            $this->redirect(array('controller'=>'Orderhistories','action' => 'index'));
        }
    }
    public function orderEmail($packageDetail,$totalAmount)
    {
        if($packageDetail==null)
        {
            $this->Session->setFlash(__('Invalid Post'),'flash',array('alert'=>'danger'));
            $this->redirect(array('controller'=>'Packages','action' => 'index'));
        }
        try
        {
            $siteName=$this->siteName;
            $siteEmailContact=$this->siteEmailContact;
            $studentName=$this->userValue['Student']['name'];
            $email=$this->userValue['Student']['email'];
            $mobileNo=$this->userValue['Student']['phone'];
            /* Send Email */
            if($this->emailNotification)
            {
                $this->loadModel('Emailtemplate');
                $emailTemplateArr=$this->Emailtemplate->findByType('PPD');
                if($emailTemplateArr['Emailtemplate']['status']=="Published")
                {
                    $message=eval('return "' . addslashes($emailTemplateArr['Emailtemplate']['description']) . '";');
                    $Email = new CakeEmail();
                    $Email->transport($this->emailSettype);
                    if($this->emailSettype=="Smtp")
                    $Email->config(array('host' => $this->emailHost,'port' =>  $this->emailPort,'username' => $this->emailUsername,'password' => $this->emailPassword,'timeout'=>90));
                    $Email->from(array($this->siteEmail =>$this->siteName));
                    $Email->to($email);
                    $Email->template('default');
                    $Email->emailFormat('html');
                    $Email->subject($emailTemplateArr['Emailtemplate']['name']);
                    $Email->send($message);
                }
                /* End Email */
            }
            if($this->smsNotification)
            {
                /* Send Sms */
                $this->loadModel('Smstemplate');
                $smsTemplateArr=$this->Smstemplate->findByType('PPD');
                if($smsTemplateArr['Smstemplate']['status']=="Published")
                {
                    $packageDetail=strip_tags($packageDetail);
                    $message=eval('return "' . addslashes($smsTemplateArr['Smstemplate']['description']) . '";');
                    $this->CustomFunction->sendSms($mobileNo,$message,$this->smsSettingArr);
                }
                /* End Sms */
            }
        }
        catch (Exception $e)
        {
            $this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
        }
    }
}