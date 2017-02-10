<?php
App::uses('AdminAppController', 'Admin.Controller');
App::uses('AppController', 'Controller');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('CakeEmail', 'Network/Email');
class UsersController extends AdminAppController {
    public $helpers = array('Html', 'Form','Session','Paginator','Js'=> array('Jquery'));
    public $components = array('Session','Paginator','search-master.Prg');
    public $presetVars = true;
    var $paginate = array('page'=>1,'order'=>array('User.name'=>'asc'));
    public function index()
    {
	try
	{
	    $this->Prg->commonProcess();
	    $this->Paginator->settings = $this->paginate;
	    $this->Paginator->settings['conditions'] = array('deleted IS NULL',$this->User->parseCriteria($this->Prg->parsedParams()));
	    $this->Paginator->settings['limit']=$this->pageLimit;
	    $this->Paginator->settings['maxLimit']=$this->maxLimit;
	    $this->set('User', $this->Paginator->paginate());
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
        $this->set('group_id', $this->Group->find('list',array('fields'=>array('id','group_name'))));
        $this->loadModel('Ugroup');
        $this->set('ugroup',$this->Ugroup->find('list'));
        if ($this->request->is('post'))
        {
            $this->User->create();
            try
            {
                $password=$this->request->data['User']['password'];
		if ($this->User->save($this->request->data))
                {
                    $this->loadModel('UserGroup');
                    $this->request->data['UserGroup']['user_id'] = $this->User->id;
                    if(is_array($this->request->data['UserGroup']['group_name']))
                    {
                        foreach($this->request->data['UserGroup']['group_name'] as $key => $value)
                        {
                            $this->UserGroup->create();
                            $this->request->data['UserGroup']['group_id']=$value;
                            $this->UserGroup->save($this->request->data);                        
                        }
                    }		    
		    $email=$this->request->data['User']['email'];$name=$this->request->data['User']['name'];$mobileNo=$this->request->data['User']['mobile'];
		    $userName=$this->request->data['User']['username'];
		    $siteName=$this->siteName;$siteEmailContact=$this->siteEmailContact;$url=$this->siteDomain.'/admin';
		    if($email)
		    {
			if($this->emailNotification)
			{
			    /* Send Email */
			    $this->loadModel('Emailtemplate');
			    $emailSettingArr=$this->Emailtemplate->findByType('ULC');
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
			$smsTemplateArr=$this->Smstemplate->findByType('ULC');
			if($smsTemplateArr['Smstemplate']['status']=="Published")
			{
			    $url="$this->siteDomain";
			    $message=eval('return "' . addslashes($smsTemplateArr['Smstemplate']['description']) . '";');
			    $this->CustomFunction->sendSms($mobileNo,$message,$this->smsSettingArr);
			}
			/* End Sms */
		    }
                    $this->Session->setFlash(__('User Added Successfully'),'flash',array('alert'=>'success'));
                    return $this->redirect(array('action' => 'add'));
                }
            }
            catch (Exception $e)
	    {
		$this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
		return $this->redirect(array('action' => 'index'));
	    }
        }
    }
    public function edit($id = null)
    {
        $this->loadModel('Ugroup');
        $this->loadModel('Group');
        $this->set('ugroup',$this->Ugroup->find('list'));
        $this->set('group_id', $this->Group->find('list',array('fields'=>array('id','group_name'))));
        if (!$id)
        {
            throw new NotFoundException(__('Invalid post'));
        }
        $ids=explode(",",$id);
        $post=array();
        foreach($ids as $id)
        {
            $post[]=$this->User->findByid($id);
        }
        $this->set('User',$post);
        if (!$post)
        {
            throw new NotFoundException(__('Invalid post'));
        }
	$this->User->unbindValidation('remove', array('password'), true);
        if ($this->request->is(array('post', 'put')))
        {
	    $isSave=true;
            $this->User->id = $id;
            try
            {
		foreach($this->request->data as $k=> $value)
                {
		    if($value['User']['id']!=1)
		    {
			if(!is_array($value['UserGroup']['group_name']))
			{
			    $this->Session->setFlash(__('Please Select any group'),'flash',array('alert'=>'danger'));
			    $isSave=false;
			    break;
			}
		    }
                }
		if($isSave==true)
                {
		    if($this->User->saveAll($this->request->data))
                    {
                        $UserGroup=array();
                        $this->loadModel('UserGroup');
                        foreach($this->request->data as $k=> $value)
                        {
                            if($value['User']['id']!=1)
			    {
				$userId=$value['User']['id'];
				$this->UserGroup->deleteAll(array('UserGroup.user_id'=>$userId,"UserGroup.group_id IN($this->userGroupWiseId)"));
				foreach($value['UserGroup']['group_name'] as $groupId)
				{
				    $UserGroup[]=array('user_id'=>$userId,'group_id'=>$groupId);
				}
			    }
                        }
                        $this->UserGroup->create();
                        $this->UserGroup->saveAll($UserGroup);
                        $this->Session->setFlash(__('User has been updated'),'flash',array('alert'=>'success'));
                        return $this->redirect(array('action' => 'index'));
                    }
                }
            }
            catch (Exception $e)
            {
                $this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
            }
	    $this->set('isError',True);
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
		foreach($this->data['User']['id'] as $key => $value)
		{
		    if($value!=1)
		    $this->User->delete($value);
		}
		$this->Session->setFlash(__('User has been deleted'),'flash',array('alert'=>'success'));
	    }        
	    $this->redirect(array('action' => 'index'));
	}
	catch (Exception $e)
        {
            $this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
            return $this->redirect(array('action' => 'index'));
        }
    }
    public function myProfile()
    {
	try
	{
	    $userValue=$this->Session->read('User');
	    $post = $this->User->findById($userValue['User']['id']);
	    $this->set('post',$post);
	}
	catch (Exception $e)
        {
            $this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
            return $this->redirect(array('action' => 'index'));
        }
    }
    public function assignrights()
    {
	try
	{
	    $this->loadModel('Ugroup');
	    $Ugroup=$this->Ugroup->find('all',array('conditions'=>array('id >'=>1),'order'=>'name asc'));
	    $this->set('Ugroup',$Ugroup);
	}
	catch (Exception $e)
        {
            $this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
            return $this->redirect(array('action' => 'index'));
        }
    }
    public function assignrightsedit($id=null)
    {
        $this->layout = null;
        $this->loadModel('Ugroup');
        $this->loadModel('PageRight');
        if (!$id)
        {
            throw new NotFoundException(__('Invalid post'));
        }
        $isPost=$this->Ugroup->find('count',array('conditions'=>array('id'=>$id)));
        if($isPost==0)
        {
            throw new NotFoundException(__('Invalid post'));
        }
        $post=$this->User->assingPages($id);
        $this->set('PageRight',$post);
        if ($this->request->is(array('post', 'put')))
        {
            try
            {
                $this->PageRight->deleteAll(array('ugroup_id'=>$id));
                foreach($this->request->data as $value)
                {
                    //if($value>0)
                    //{
                    //    $this->PageRight->create();
                    //    $this->PageRight->save(array('page_id'=>$value,'ugroup_id'=>$id,'view_right'=>1));
                    //}
		    if(isset($value['User']['id']) && $value['User']['id']!=0)
                    {
                        $this->PageRight->create();
                        $this->PageRight->save(array('page_id'=>$value['User']['id'],'ugroup_id'=>$id,'view_right'=>$value['User']['view_right'],'update_right'=>$value['User']['update_right'],'save_right'=>$value['User']['save_right'],'delete_right'=>$value['User']['delete_right'],'search_right'=>$value['User']['search_right']));
                    } 
                }
                $this->Session->setFlash(__('Permission update successfully'),'flash',array('alert'=>'success'));
                return $this->redirect(array('action' => 'assignrights'));
            }
            catch (Exception $e)
	    {
		$this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
		return $this->redirect(array('action' => 'index'));
	    }
        }
        $this->set('id',$id);
        if (!$this->request->data)
        {
            $this->request->data = $post;
        }
    }
    function login_form()
    {
	try
	{
        if (empty($this->data['User']['username']) == false)
        {
            $passwordHasher = new SimplePasswordHasher(array('hashType' => 'sha256'));
            $password=$passwordHasher->hash($this->request->data['User']['password']);
            $user = $this->User->find('first', array('conditions' => array('User.username' => $this->data['User']['username'],
                                                                           'User.password' =>$password,
                                                                           'User.status'=>'Active',
                                                                           'User.deleted IS NULL')));            
            if($user != false)
            {   
                $this->Session->setFlash(__('You have been logged in Successfully'),'flash', array('alert'=> 'success'));
                $this->Session->write('User', $user);                
                $this->Redirect(array('controller' => 'Dashboards', 'action' => 'index'));
                exit();
            }
            else
            {
                $this -> Session -> setFlash(__('Incorrect username/password'),'flash', array('alert'=> 'danger'));
                $this -> Redirect(array('action' => 'login_form'));
                exit();
            }
        }
	}
	catch (Exception $e)
        {
            $this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
            return $this->redirect(array('action' => 'index'));
        }
    }
    function logout()
    {
	try
    	{
	    $this -> Session -> destroy();
	    $this -> Session -> setFlash(__('You have been logged out'),'flash', array('alert'=> 'success'));
	    $this -> Redirect(array('action' => 'login_form'));
	    exit();
	}
	    catch (Exception $e)
        {
            $this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
            return $this->redirect(array('action' => 'index'));
        }
    }
    public function changePass()
    {
	try
	{
	    if ($this->request->is(array('post', 'put')))
	    {
		$passwordHasher = new SimplePasswordHasher(array('hashType' => 'sha256'));
		$post = $this->User->findById($this->adminValue['User']['id']);
		$this->User->unbindValidation('keep', array('oldPassword'), true);
		if($post['User']['password']==$passwordHasher->hash($this->request->data['User']['oldPassword']))
		{
		    $this->User->id = $this->adminValue['User']['id'];
		    if ($this->User->save($this->request->data))
		    {
			$this->Session->setFlash(__('Password Changed Successfully'),'flash',array('alert'=>'success'));
		    }                
		}
		else
		{
		    $this->Session->setFlash(__('Invalid Password'),'flash',array('alert'=>'danger'));
		}
	    }
	}
	catch (Exception $e)
        {
            $this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
            return $this->redirect(array('action' => 'index'));
        }
    }
    public function leveladd()
    {
        $this->loadModel('Ugroup');
        if ($this->request->is('post'))
        {
            $this->Ugroup->create();
            try
            {
                $this->request->data['Ugroup']['name']=$this->request->data['User']['name'];
		$this->Ugroup->unbindValidation('keep', array('name'), true);
                if ($this->Ugroup->save($this->request->data))
                {
                    $this->Session->setFlash(__('Level User has been saved'),'flash',array('alert'=>'success'));
                    return $this->redirect(array('action' => 'leveladd'));
                }
            }
            catch (Exception $e)
	    {
		$this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
		return $this->redirect(array('action' => 'index'));
	    }
        }
    }
    public function deletelevel()
    {
        $this->loadModel('Ugroup');
        if ($this->request->is('post'))
        {
            try
            {
                foreach($this->data['Ugroup']['id'] as $key => $value)
                {
                    $this->Ugroup->delete($value);
                }
                $this->Session->setFlash(__('Level user has been deleted'),'flash',array('alert'=>'success'));
            }
            catch (Exception $e)
	    {
		$this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
		return $this->redirect(array('action' => 'index'));
	    }
        }        
        $this->redirect(array('action' => 'assignrights'));
    }

}
