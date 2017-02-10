<?php
App::uses('CakeTime', 'Utility');
App::uses('Paypal', 'Paypal.Lib');
class PaymentsController extends AppController {
    public $currencyType;
    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->authenticate();        
        $this->studentId=$this->userValue['Student']['id'];
        $this->loadModel('PaypalConfig');
        $paySetting=$this->PaypalConfig->findById('1');
        if(strlen($paySetting['PaypalConfig']['username'])==0 || strlen($paySetting['PaypalConfig']['password'])==0 || strlen($paySetting['PaypalConfig']['signature'])==0)
        {
            $this->Session->setFlash(__('Paypal Payment not set'),'flash',array('alert'=>'danger'));
            $this->redirect(array('controller'=>'Dashboards','action' => 'index'));
        }
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
    }
    public function index($id=null)
    {
        if(isset($_REQUEST['token']))
        {
            $this->Session->setFlash(__('Payment Cancel'),'flash',array('alert'=>'danger'));
        }
    }
    public function checkout()
    {
        $description=$this->request->data['Payment']['remarks'];
        $amount=$this->request->data['Payment']['amount'];
        if($amount>0)
        {
            $returnUrl=$this->siteDomain.'/Payments/postpayment/';
            $cancelUrl=$this->siteDomain.'/Payments/index/';
            $order = array(
            'description' => $description,
            'currency' => $this->currencyType,
            'return' => $returnUrl,
            'cancel' => $cancelUrl,
            'items' => array(
                0 => array(
                    'name' =>__('Wallet Payment'),
                    'tax' => 0.00,
                    'shipping' => 0.00,
                    'description' => $description,
                    'subtotal' => $amount,
                ),
                )
            );
            try
            {
                $token=$this->Paypal->setExpressCheckout($order);
                $this->redirect($token);            
            }
            catch (PaypalRedirectException $e)
            {
                $this->redirect($e->getMessage());
            }
            catch (Exception $e)
            {
                $this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
                $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('Try again! Can not connect to paypal'),'flash',array('alert'=>'danger'));
            $this->redirect(array('action' => 'index'));
        }
        else
        {
            $this->Session->setFlash(__('Invalid Amount'),'flash',array('alert'=>'danger'));
            $this->redirect(array('action' => 'index'));
        }
    }
    public function postpayment($id=null)
    {
        if(isset($_REQUEST['token']) && isset($_REQUEST['PayerID']))
        {
            $token=$_REQUEST['token'];
            try
            {
                $detailsArr=$this->Paypal->getExpressCheckoutDetails($token);
                if(is_array($detailsArr))
                {
                    $amount=$detailsArr['AMT'];
                    $description=$detailsArr['DESC'];
                    $payerId=$_REQUEST['PayerID'];
                    if($detailsArr['ACK']=="Success")
                    {
                        $order = array(
                        'description' => $description,
                        'currency' => $this->currencyType,
                        'return' => $this->siteDomain.'/Payments/postpayment/',
                        'cancel' => $this->siteDomain.'/Payments/index/',
                        'items' => array(
                            0 => array(
                                'name' =>__('Wallet Payment'),
                                'tax' => 0.00,
                                'shipping' => 0.00,
                                'description' => $description,
                                'subtotal' => $amount,
                            ),
                            )
                        );
                        try
                        {
                            $paymentDetails=$this->Paypal->doExpressCheckoutPayment($order,$token,$payerId);
                            if(is_array($paymentDetails))
                            {
                                if($paymentDetails['PAYMENTINFO_0_PAYMENTSTATUS']=="Completed" && $paymentDetails['PAYMENTINFO_0_ACK']=="Success")
                                {
                                    $transactionId=$paymentDetails['PAYMENTINFO_0_TRANSACTIONID'];
                                    $total=$this->Payment->find('count',array('conditions'=>array('Payment.transaction_id'=>$transactionId)));
                                    if($total==0)
                                    {
                                        $record_arr=array('student_id'=>$this->studentId,'transaction_id'=>$transactionId,'amount'=>$amount,'remarks'=>$description);
                                        $this->Payment->save($record_arr);
                                        $this->CustomFunction->WalletInsert($this->studentId,$amount,"Added",$this->currentDateTime,"PG",$description);
                                        $this->Session->setFlash(__d('default',"Payment successfully! Amount %s added in your wallet ",$amount),'flash',array('alert'=>'success'));
                                    }
                                    else
                                    {
                                        $this->Session->setFlash(__('Payment already done'),'flash',array('alert'=>'danger'));
                                    }
                                }
                            }
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
        }
        $this->redirect(array('action' => 'index'));
    }
}