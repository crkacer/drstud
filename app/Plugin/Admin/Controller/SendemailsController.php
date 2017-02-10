<?php
App::uses('CakeEmail', 'Network/Email');
ini_set('max_execution_time', 900);
class SendemailsController extends AdminAppController
{
    public $helpers = array('Html', 'Form','Session');
    public $components = array('Session');
    public function index()
    {
        $this->loadModel('Emailtemplate');
        $this->loadModel('Student');
        $this->loadModel('User');
        $this->set('emailTemplate',$this->Emailtemplate->find('list',array('fields'=>array('description','name'),'conditions'=>array('status'=>'Published','type'=>NULL),'order'=>array('name'=>'asc'))));
        if($this->request->is('post'))
        {
            try
            {
                $type=$this->request->data['Sendemail']['type'];
                $emailTemplate=$this->request->data['Sendemail']['email_template'];
                $studentId=$this->request->data['Sendemail']['student_id'];
                $teacherId=$this->request->data['Sendemail']['teacher_id'];
                $anyEmail=$this->request->data['Sendemail']['any_email'];
                $subject=$this->request->data['Sendemail']['subject'];
                $message=$this->request->data['Sendemail']['message'];
                if($type==null)
                {
                    $this->Session->setFlash(__('Please select any type in the list'),'flash',array('alert'=>'danger'));
                }
                elseif($type=='Any' && $anyEmail==null)
                {
                    $this->Session->setFlash(__('Please type any email'),'flash',array('alert'=>'danger'));
                }
                else
                {
                    $toEmailArr=null;
                    if($type=="Student" && $studentId!=null)
                    {
                        $toEmailArr=explode(",",$studentId);
                    }
                    if($type=="Student" && $studentId==null)
                    {
                        $typeArr=$this->Student->find('all',array('fields'=>array('Student.email'),'conditions'=>array('Student.status'=>'Active')));
                        foreach($typeArr as $value)
                        $toEmailArr[]=$value['Student']['email'];
                        unset($value);
                    }
                    if($type=="Teacher" && $teacherId!=null)
                    {
                        $toEmailArr=explode(",",$teacherId);
                        
                    }
                    if($type=="Teacher" && $teacherId==null)
                    {
                        $typeArr=$this->User->find('all',array('fields'=>array('User.email'),'conditions'=>array('User.status'=>'Active')));
                        foreach($typeArr as $value)
                        $toEmailArr[]=$value['User']['email'];
                        unset($value);                   
                    }
                    if($type=="Any")
                    {
                        $toEmailArr=explode(",",$anyEmail);
                        
                    }
                    if($toEmailArr)
                    {
                        foreach($toEmailArr as $toEmail)
                        {
                            if($toEmail)
                            {
                                $Email = new CakeEmail();
                                $Email->transport($this->emailSettype);
                                if($this->emailSettype=="Smtp")
                                $Email->config(array('host' => $this->emailHost,'port' =>  $this->emailPort,'username' => $this->emailUsername,'password' => $this->emailPassword,'timeout'=>90));
                                $Email->from(array($this->siteEmail =>$this->siteName));
                                $Email->to($toEmail);
                                $Email->template('default');
                                $Email->emailFormat('html');
                                $Email->subject($subject);
                                $Email->send($message);
                            }
                        }
                        $this->Session->setFlash(__('Email has been sent'),'flash',array('alert'=>'success'));
                        return $this->redirect(array('action' => 'index'));
                    }
                    else
                    {
                        $this->Session->setFlash(__('No email to send'),'flash',array('alert'=>'danger'));
                        return $this->redirect(array('action' => 'index'));
                    }
                }
            }
            catch (Exception $e)
            {
                $this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
            }
        }
    }
    public function studentssearch()
    {
        $this->autoRender = false;
        $this->request->onlyAllow('ajax');
        // get the search term from URL
        $this->loadModel('Student');
        $term = $this->request->query['q'];
        $users = $this->Student->find('all',array('joins'=>array(array('table'=>'student_groups','alias'=>'StudentGroup','conditions'=>array('Student.id=StudentGroup.student_id'))),
                                                  'conditions' => array('Student.email LIKE' => '%'.$term.'%','StudentGroup.group_id'=>array($this->userGroupWiseId))));
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