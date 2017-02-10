<?php
App::uses('CakeTime', 'Utility');
ini_set('max_execution_time', 900);
class MailsController extends AdminAppController {
    public $helpers = array('Html', 'Form','Session','Paginator','Js'=> array('Jquery'));
    public $components = array('Session','Paginator','search-master.Prg');
    public $presetVars = true;
    var $paginate = array('page'=>1,'order'=>array('Mail.date'=>'desc'));
    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->authenticate();
        $this->mailType="Administrator";
    }
    public function index()
    {
        try
        {
            $this->Prg->commonProcess();
            $this->Paginator->settings = $this->paginate;
            $this->Paginator->settings['conditions'] = array('email'=>$this->mailType,'mail_type'=>'To','status <>'=>'Trash',$this->Mail->parseCriteria($this->Prg->parsedParams()));
            $this->Paginator->settings['limit']=$this->pageLimit;
            $this->Paginator->settings['maxLimit']=$this->maxLimit;
            $this->set('Mail', $this->Paginator->paginate());
            $this->set('mailType',$this->mailType);
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
    public function sent()
    {
        try
        {
            $this->Prg->commonProcess();
            $this->Paginator->settings = $this->paginate;
            $this->Paginator->settings['conditions'] = array('email'=>$this->mailType,'mail_type'=>'From','status <>'=>'Trash',$this->Mail->parseCriteria($this->Prg->parsedParams()));
            $this->set('Mail', $this->Paginator->paginate());
            $this->set('mailType',$this->mailType);
            $this->render('index');
        }
        catch (Exception $e)
        {
            $this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
            return $this->redirect(array('action' => 'index'));
        }
    }
    public function trash()
    {
        try
        {
            $this->Prg->commonProcess();
            $this->Paginator->settings = $this->paginate;
            $this->Paginator->settings['conditions'] = array('email'=>$this->mailType,'status'=>'Trash',$this->Mail->parseCriteria($this->Prg->parsedParams()));
            $this->set('Mail', $this->Paginator->paginate());
            $this->set('mailType',$this->mailType);
            $this->render('index');
        }
        catch (Exception $e)
        {
            $this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
            return $this->redirect(array('action' => 'index'));
        }
    }
    public function compose($type=null,$id=null)
    {
        $this->loadModel('Student');
        $this->set('studentId',$this->Student->find('list',array('fields'=>array('id','name','email'))));        
        if ($this->request->is('post'))
        {
            try
            {
               $post=$this->request->data['Mail']['to_email'];
                if($post)
                {
                    $toEmailArr=explode(",",$this->request->data['Mail']['to_email']);
                    foreach($toEmailArr as $toEmail)
                    {
                        $this->Mail->create();
                        $currentDateTime=CakeTime::format('Y-m-d H:i:s',CakeTime::convert(time(),$this->siteTimezone));
                        $this->request->data['Mail']['date']=$currentDateTime;
                        $this->request->data['Mail']['from_email']=$this->mailType;
                        $this->request->data['Mail']['email']=$toEmail;
                        $this->request->data['Mail']['to_email']=$toEmail;
                        $this->request->data['Mail']['mail_type']="To";
                        $this->request->data['Mail']['type']="Unread";
                        if ($this->Mail->save($this->request->data))
                        {
                            $this->Mail->create();
                            $this->request->data['Mail']['to_email']=$toEmail;
                            $this->request->data['Mail']['from_email']=$this->mailType;
                            $this->request->data['Mail']['email']=$this->mailType;
                            $this->request->data['Mail']['type']="Read";
                            $this->request->data['Mail']['mail_type']="From";
                            $this->Mail->save($this->request->data);                            
                        }                        
                    }
                    $this->Session->setFlash(__('Your Mail has been sent'),'flash',array('alert'=>'success'));
                    return $this->redirect(array('action' => 'index'));
                }
                else
                {
                    $this->Session->setFlash(__('Student Email not found'),'flash',array('alert'=>'danger'));
                }
            }
            catch (Exception $e)
            {
            $this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
            return $this->redirect(array('action' => 'index'));
            }
            
        }
        $post = $this->Mail->findById($id);
        if($post)
        {
            if($post['Mail']['to_email']==$this->mailType)
            $this->request->data['Mail']['to_email']=$post['Mail']['from_email'];
            else
            $this->request->data['Mail']['to_email']=$post['Mail']['to_email'];
            $this->request->data['Mail']['subject']=$post['Mail']['subject'];
            if($type=="forward")
            {
                $message="<p>----------".__('Forwarded message')."----------</p>\n<p>".__('From').": ".$this->request->data['Mail']['to_email']."</p>\n<p>".CakeTime::format('D, M d, Y',$post['Mail']['date']).".__('at').".CakeTime::format('h:i A',$post['Mail']['date']).
                "</p>\n<p>".__('Subject').":".$this->request->data['Mail']['subject']."</p>\n";
                $this->request->data['Mail']['message']=$message.$post['Mail']['message'];
            }
            
        }
        if (!$this->request->data)
        {
            $this->request->data = $post;
        }
        $this->set('type',$type);
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
            $post = $this->Mail->findById($id);
            $this->Mail->unbindValidation('remove', array('to_email','subject'), true);
            if($post)
            $this->Mail->save(array('id'=>$id,'type'=>'Read'));
            $this->set('post',$post);
        }
        catch (Exception $e)
        {
            $this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
            return $this->redirect(array('action' => 'index'));
        }
    }
    public function trashall()
    {
        try
        {
            if($this->data['type']=="read")
            {
                $this->moveMark($this->data,"Read");
            }
            elseif($this->data['type']=="unread")
            {
                $this->moveMark($this->data,"Unread");
            }
            else
            {
                if ($this->request->is('post'))
                {
                    $this->Mail->unbindValidation('remove', array('to_email','subject'), true);
                    foreach($this->data['Mail']['id'] as $key => $value)
                    {
                        if($value>0)
                        $this->Mail->save(array('id'=>$value,'status'=>'Trash'));
                    }
                    $this->Session->setFlash(__('The mail has been moved to the Trash'),'flash',array('alert'=>'success'));
                }        
                $this->redirect(array('action' => 'index'));
            }
        }
        catch (Exception $e)
        {
            $this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
            return $this->redirect(array('action' => 'index'));
        }
    } 
    public function deleteall()
    {
        try
        {
            if($this->data['type']=="inbox")
            {
                $this->moveInbox($this->data,"Inbox");
            }
            else
            {
                if ($this->request->is('post'))
                {
                    foreach($this->data['Mail']['id'] as $key => $value)
                    {
                        $this->Mail->delete($value);
                    }
                    $this->Session->setFlash(__('Your Mail has been deleted'),'flash',array('alert'=>'success'));
                }        
                $this->redirect(array('action' => 'index'));
            }
        }
        catch (Exception $e)
        {
            $this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
            return $this->redirect(array('action' => 'index'));
        }
    }
    public function moveInbox($record)
    {
        try
        {
            if ($record)
            {
                 $this->Mail->unbindValidation('remove', array('to_email','subject'), true);
                foreach($record['Mail']['id'] as $key => $value)
                {
                    if($value>0)
                    $this->Mail->save(array('id'=>$value,'status'=>'Live'));
                }
                $this->Session->setFlash(__('The mail has been moved to the Inbox'),'flash',array('alert'=>'success'));
            }        
            $this->redirect(array('action' => 'trash'));
        }
        catch (Exception $e)
        {
            $this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
            return $this->redirect(array('action' => 'index'));
        }
    }
    public function moveMark($record,$type)
    {
        try
        {
            if ($record)
            {
                $this->Mail->unbindValidation('remove', array('to_email','subject'), true);
                foreach($record['Mail']['id'] as $key => $value)
                {
                    if($value>0)
                    $this->Mail->save(array('id'=>$value,'type'=>$type));
                }
                if($type=="Read")
                {
                    $this->Session->setFlash(__("The mail has been marked as Read"),'flash',array('alert'=>'success'));
                }
                else
                {
                   $this->Session->setFlash(__("The mail has been marked as Unread"),'flash',array('alert'=>'success')); 
                }
            }        
            $this->redirect(array('action' => 'index'));
        }
        catch (Exception $e)
        {
            $this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
            return $this->redirect(array('action' => 'index'));
        }
    }
    public function studentsearch()
    {
        $this->autoRender = false;
        $this->request->onlyAllow('ajax');
        // get the search term from URL
        $this->loadModel('Student');
        $term = $this->request->query['q'];
        $users = $this->Student->find('all',array('conditions' => array('Student.email LIKE' => '%'.$term.'%')));
        // Format the result for select2
        $result = array();
        foreach($users as $key => $user)
        {
            $result[$key]['id'] = $user['Student']['email'];
            $result[$key]['text'] = $user['Student']['email'];
        }
        $users = $result;        
        echo json_encode($users);
    }
}
