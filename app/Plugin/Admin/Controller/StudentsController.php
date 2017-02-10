<?php
App::uses('CakeTime', 'Utility');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('CakeEmail', 'Network/Email');
class StudentsController extends AdminAppController {
    public $helpers = array('Html', 'Form','Session','Paginator','Paginator','Js'=> array('Jquery'));
    public $components = array('Session','Paginator','search-master.Prg','CustomFunction');
    public $presetVars = true;
    var $paginate = array('joins'=>array(
                                         array('table'=>'student_groups','type'=>'LEFT','alias'=>'StudentGroup','conditions'=>array('Student.id=StudentGroup.student_id')),
                                         array('table'=>'user_groups','type'=>'LEFT','alias'=>'UserGroup','conditions'=>array('StudentGroup.group_id=UserGroup.group_id'))),
                          'page'=>1,'order'=>array('Student.id'=>'desc'),'group'=>array('Student.id'));
    var $paginate1 = array('page'=>1,'order'=>array('Wallet.id'=>'desc'));
    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->adminId=$this->adminValue['User']['id'];        
    }
    public function index()
    {
        try
        {
            $this->Student->UserWiseGroup($this->userGroupWiseId);
            $this->Prg->commonProcess();
            $this->Paginator->settings = $this->paginate;
            $this->Paginator->settings['limit']=$this->pageLimit;
            $this->Paginator->settings['maxLimit']=$this->maxLimit;
            $cond=array();
            if($this->adminId!=1)
            $cond=array('UserGroup.user_id'=>$this->luserId);
            $this->Paginator->settings['conditions'] = array($this->Student->parseCriteria($this->Prg->parsedParams()),$cond);
            $this->set('Student', $this->Paginator->paginate());
            $this->set('frontExamPaid',$this->frontExamPaid);
            if ($this->request->is('ajax'))
            {
                $this->render('index','ajax'); // View, Layout
            }
        }
        catch (Exception $e)
        {
            $this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
        }
    }
    public function add()
    {
        $this->loadModel('Group');
        $this->set('group_id', $this->Group->find('list',array('fields'=>array('id','group_name'),'conditions'=>array("Group.id IN($this->userGroupWiseId)"))));
        if ($this->request->is('post'))
        {
            try
            {
                $password = $this->request->data['Student']['password'];
                $this->request->data['Student']['reg_status'] = "Done";
                $this->request->data['Student']['renewal_date'] = $this->currentDate;
                if(is_array($this->request->data['StudentGroup']['group_name']))
                {
                    $this->Student->create();
                    $this->Student->unbindValidation('remove', array('amount','action','remarks'), true);
                    if ($this->Student->save($this->request->data))
                    {
                        $this->loadModel('StudentGroup');
                        $studentId=$this->Student->id;
                        foreach($this->request->data['StudentGroup']['group_name'] as $groupId)
                        {
                            $studentGroup[]=array('student_id'=>$studentId,'group_id'=>$groupId);                       
                        }
                        $this->StudentGroup->create();
                        $this->StudentGroup->saveAll($studentGroup);
                        $email=$this->request->data['Student']['email'];$studentName=$this->request->data['Student']['name'];
                        $mobileNo=$this->request->data['Student']['phone'];
                        $siteName=$this->siteName;$siteEmailContact=$this->siteEmailContact;$url=$this->siteDomain;
                        if($email)
                        {
                            if($this->emailNotification)
                            {                          
                                /* Send Email */
                                $this->loadModel('Emailtemplate');
                                $emailSettingArr=$this->Emailtemplate->findByType('SLC');
                                if($emailSettingArr['Emailtemplate']['status']=="Published")
                                {
                                    $message=eval('return "' . addslashes($emailSettingArr['Emailtemplate']['description']) . '";');
                                    $Email = new CakeEmail();
                                    $Email->transport($this->emailSettype);
                                    if($this->emailSettype=="Smtp")
                                    $Email->config(array('host' => $this->emailHost,'port' =>  $this->emailPort,'username' => $this->emailUsername,'password' => $this->emailPassword,'timeout'=>90));
                                    $Email->from(array($this->siteEmail =>$this->siteName));
                                    $Email->to($email);
                                    $Email->template('default');
                                    $Email->emailFormat('html');
                                    $Email->subject($emailSettingArr['Emailtemplate']['name']);
                                    $Email->send($message);
                                    /* End Email */
                                }
                            }
                        }
                        if($this->smsNotification)
                        {
                            /* Send Sms */
                            $this->loadModel('Smstemplate');
                            $smsTemplateArr=$this->Smstemplate->findByType('SLC');
                            if($smsTemplateArr['Smstemplate']['status']=="Published")
                            {
                                $url="$this->siteDomain";
                                $message=eval('return "' . addslashes($smsTemplateArr['Smstemplate']['description']) . '";');
                                $this->CustomFunction->sendSms($mobileNo,$message,$this->smsSettingArr);
                            }
                            /* End Sms */
                        }
                        $this->Session->setFlash(__('Student added Successfully'),'flash',array('alert'=>'success'));
                        return $this->redirect(array('action' => 'add'));
                    }
                }
                else
                {
                    $this->Session->setFlash(__('Please Select atleast one group'),'flash',array('alert'=>'danger'));
                }
            }
            catch (Exception $e)
            {
                $this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
            }
        }
    }
    public function edit($id = null)
    {
        $this->Student->UserWiseGroup($this->userGroupWiseId);
        $this->loadModel('Group');
        $this->set('group_id', $this->Group->find('list',array('fields'=>array('id','group_name'),'conditions'=>array("Group.id IN($this->userGroupWiseId)"))));
        if (!$id)
        {
            throw new NotFoundException(__('Invalid post'));
        }
        $ids=explode(",",$id);
        $post=array();
        $group_select=array();
        foreach($ids as $id)
        {
            $this->Student->UserWiseGroup($this->userGroupWiseId);
            $post[]=$this->Student->findByid($id);            
        }
        $this->set('Student',$post);
        if (!$post)
        {
            throw new NotFoundException(__('Invalid post'));
        }
        if ($this->request->is(array('post', 'put')))
        {
            $isSave=true;
            try
            {
                foreach($this->request->data as $k=> $value)
                {
                    if(!is_array($value['StudentGroup']['group_name']))
                    {
                        $this->Session->setFlash(__('Please Select any group'),'flash',array('alert'=>'danger'));
                        $isSave=false;
                        break;
                    }
                    if($value['Student']['status']=="Active")
                    {
                        $this->request->data[$k]['Student']['reg_status']="Done";
                        $this->request->data[$k]['Student']['reg_code']="";
                    }                    
                }
                if($isSave==true)
                {
                    $this->Student->unbindValidation('remove', array('amount','action','remarks','password','photo'), true);
                    if($this->Student->saveAll($this->request->data))
                    {
                        
                        $this->loadModel('StudentGroup');
                        foreach($this->request->data as $k=> $value)
                        {
                            $studentId=$value['Student']['id'];
                            $this->StudentGroup->deleteAll(array('StudentGroup.student_id'=>$studentId,"StudentGroup.group_id IN($this->userGroupWiseId)"));
                            foreach($value['StudentGroup']['group_name'] as $groupId)
                            {
                                $studentGroup[]=array('student_id'=>$studentId,'group_id'=>$groupId);
                            }
                        }
                        $this->StudentGroup->create();
                        $this->StudentGroup->saveAll($studentGroup);
                        $this->Session->setFlash(__('Student has been updated'),'flash',array('alert'=>'success'));
                        return $this->redirect(array('action' => 'index'));
                    }
                }                
            }
            catch (Exception $e)
            {
                $this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
            }
            $this->set('isError',true);
        }
        else
        {
            $this->layout = 'ajax';
            $this->set('isError',false);
        }
        if (!$this->request->data)
        {
            $this->request->data = $post;
        }
    }    
    public function deleteall()
    {
        try
        {
            if ($this->request->is('post'))
            {
                $this->loadModel('StudentGroup');
                foreach($this->data['Student']['id'] as $key => $value)
                {
                    $this->StudentGroup->deleteAll(array('StudentGroup.student_id'=>$value,"StudentGroup.group_id IN($this->userGroupWiseId)"));
                }
                $this->Student->query("DELETE `Student` FROM `students` AS `Student` LEFT JOIN `student_groups` AS `StudentGroup` ON `Student`.`id` = `StudentGroup`.`student_id` WHERE `StudentGroup`.`id` IS NULL");
                $this->Session->setFlash(__('Student has been deleted'),'flash',array('alert'=>'success'));
            }        
            $this->redirect(array('action' => 'index'));
        }
        catch (Exception $e)
        {
            $this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
            return $this->redirect(array('action' => 'index'));
        }
    }
    public function view($id = null)
    {
        try
        {
            $this->layout = null;
            if (!$id)
            {
                $this->Session->setFlash(__('Invalid Post'),'flash',array('alert'=>'danger'));
                $this->redirect(array('action' => 'index'));
            }
            $this->Student->bindModel(array('hasAndBelongsToMany'=>array('Group'=>array('className'=>'Group',
                                                         'joinTable' => 'student_groups',
                                                         'foreignKey' => 'student_id',
                                                         'associationForeignKey' => 'group_id',
                                                         'conditions'=>"StudentGroup.group_id IN($this->userGroupWiseId)"))));
            $post = $this->Student->findById($id);
            if (!$post)
            {
                $this->Session->setFlash(__('Invalid Post'),'flash',array('alert'=>'danger'));
                $this->redirect(array('action' => 'index'));
            }
            if(strlen($post['Student']['photo'])>0)
            $std_img='student_thumb/'.$post['Student']['photo'];
            else
            $std_img='User.png';
            $this->set('post', $post);
            $this->set('std_img', $std_img);
            $this->set('id', $id);
        }
        catch (Exception $e)
        {
            $this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
            return $this->redirect(array('action' => 'index'));
        }
    }
    public function changepass($id = null)
    {
        if (!$id)
        {
            $this->Session->setFlash(__('Invalid Post'),'flash',array('alert'=>'danger'));
            $this->redirect(array('action' => 'index'));
        }
        $post = $this->Student->findById($id);
        if (!$post)
        {
            $this->Session->setFlash(__('Invalid Post'),'flash',array('alert'=>'danger'));
            $this->redirect(array('action' => 'index'));
        }
        if ($this->request->is(array('post', 'put')))
        {
            try
            {
                $this->Student->id = $id;
                $this->Student->unbindValidation('keep', array('password'), true);
                if ($this->Student->save($this->request->data))
                {
                    $this->Session->setFlash(__('Password Changed Successfully'),'flash',array('alert'=>'success'));
                    $this->redirect(array('action' => 'index'));
                }                
            }
            catch (Exception $e)
            {
                $this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
                return $this->redirect(array('action' => 'index'));
             }
            $this->set('isError',true);
        }
        else
        {
            $this->layout = null;
            $this->set('isError',false);
        }
        if (!$this->request->data)
        {
            $this->request->data = $post;
        }
    }
    public function changephoto($id = null)
    {
        if (!$id)
        {
            $this->Session->setFlash(__('Invalid Post'),'flash',array('alert'=>'danger'));
            $this->redirect(array('action' => 'index'));
        }
        $post = $this->Student->findById($id);
        if (!$post)
        {
            $this->Session->setFlash(__('Invalid Post'),'flash',array('alert'=>'danger'));
            $this->redirect(array('action' => 'index'));
        }
        if ($this->request->is(array('post', 'put')))
        {
            try
            {
                $this->Student->id = $id;
                $this->Student->unbindValidation('keep', array('photo'), true);
                if ($this->Student->save($this->request->data))
                {
                    $this->Session->setFlash(__('Photo Changed Successfully'),'flash',array('alert'=>'success'));
                    $this->redirect(array('action' => 'index'));
                }
            }
            catch (Exception $e)
            {
            $this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
            return $this->redirect(array('action' => 'index'));
            }
            $this->set('isError',true);
        }
        else
        {
            $this->layout = null;
            $this->set('isError',false);
        }
        if (!$this->request->data)
        {
            $this->request->data = $post;
        }
    }
        
    
    public function wallet($id = null)
    {
        $this->layout = null;
        $this->loadModel('Wallet');
        $ids=explode(",",$id);
        $post=array();
        foreach($ids as $id)
        {
            $post[]=$this->Student->find('first',array('joins' =>array(array('table'=>'wallets','alias'=>'Wallet','type'=>'Left','conditions'=>array('Student.id=Wallet.student_id'))),
                                                     'conditions'=>array('Student.id'=>$id),
                                                     'fields'=>array("id","email","name","phone","Wallet.balance"),
                                                     'order'=>array('Student.id ASC','Wallet.id DESC')));   
        }
        $this->set('Student',$post);
        if (!$post)
        {
            throw new NotFoundException(__('Invalid post'));
        }
        if ($this->request->is(array('post', 'put')))
        {
            $this->Student->id = $id;
            try
            {
                $this->Student->unbindValidation('keep', array('amount','action','remarks'), true);
                foreach($this->request->data as $value)
                {
                    if($this->CustomFunction->WalletInsert($value['Student']['id'],$value['Student']['amount'],$value['Student']['action'],$this->currentDateTime,"AD",$value['Student']['remarks'],$this->adminId))
                    {
                        $this->Session->setFlash(__('Student Wallet has been updated'),'flash',array('alert'=>'success'));
                    }
                    else
                    {
                        $this->Session->setFlash(__('Invalid Amount'),'flash',array('alert'=>'danger'));
                    }
                }                
                return $this->redirect(array('action' => 'index'));
            }
            catch (Exception $e)
            {
                $this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->set('isError',true);
        }
        else
        {
            $this->layout = null;
            $this->set('isError',false);
        }
        if (!$this->request->data)
        {
            $this->request->data = $post;
        }
    }
    public function trnhistory()
    {
        try
        {
            $this->Prg->commonProcess();
            $this->Paginator->settings = $this->paginate1;
            $this->Paginator->settings['limit']=$this->pageLimit;
            $this->Paginator->settings['maxLimit']=$this->maxLimit;
            $cond="";
            $cond=" 1=1 AND `UserGroup`.`user_id`=$this->luserId ";
            $this->Paginator->settings['conditions'] = array($this->Student->parseCriteria($this->Prg->parsedParams()),$cond);
            $this->Paginator->settings['joins'] = array(array('table'=>'wallets','alias'=>'Wallet','type'=>'Inner','conditions'=>array('Student.id=Wallet.student_id')),
                                                        array('table'=>'student_groups','type'=>'INNER','alias'=>'StudentGroup','conditions'=>array('Student.id=StudentGroup.student_id')),
                                                        array('table'=>'user_groups','type'=>'INNER','alias'=>'UserGroup','conditions'=>array('StudentGroup.group_id=UserGroup.group_id')));
            $this->Student->virtualFields = array('id' => 'Wallet.id','in_amount' => 'Wallet.in_amount','out_amount' => 'Wallet.out_amount','balance' => 'Wallet.balance',
                                                  'date' => 'Wallet.date','type' => 'Wallet.type','remarks' => 'Wallet.remarks');
            $this->Paginator->settings['fields'] = array("email","Wallet.in_amount","Wallet.out_amount","Wallet.balance","Wallet.date","Wallet.type","Wallet.remarks");
            $this->Paginator->settings['order'] = array('id'=>'desc');
            $this->Paginator->settings['group'] = array('Wallet.id');
            $payment_type_arr=array("AD"=>__('Administrator'),"PG"=>__('Payment Gateway'),"EM"=>__('Pay Exam'));
            $this->set('payment_type_arr',$payment_type_arr);
            $this->set('Transactionhistory', $this->Paginator->paginate());
        }
        catch (Exception $e)
        {
            $this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
            return $this->redirect(array('action' => 'index'));
        }
    }
}