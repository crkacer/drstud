<?php
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
class ProfilesController extends AppController
{
    public $helpers = array('Html', 'Form','Session');
    public $components = array('Session');
    public $presetVars = true;
    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->authenticate();
    }
    public function index()
    {
        $this->loadModel('Student');
        $id=$this->userValue['Student']['id'];
        $post = $this->Student->findById($id);
        $this->loadModel('StudentGroup');
        $groupSelect=$this->StudentGroup->find('all',array('fields'=>array('Groups.group_name'),
                                                           'joins'=>array(array('table'=>'groups','type'=>'Inner','alias'=>'Groups',
                                                                                'conditions'=>array('StudentGroup.group_id=Groups.id',"student_id=$id")))));
        if(strlen($post['Student']['photo'])>0)
        $std_img='student_thumb/'.$post['Student']['photo'];
        else
        $std_img='User.png';
        $this->set('post', $post);
        $this->set('std_img', $std_img);
        $this->set('groupSelect',$groupSelect);
    }    
    public function editProfile()
    {
        $id=$this->userValue['Student']['id'];
        $post = $this->Profile->findById($id);
        $this->loadModel('StudentGroup');
        if (!$post)
        {
            $this->Session->setFlash(__('Invalid Post'),'flash',array('alert'=>'danger'));
            $this->redirect(array('action' => 'index'));
        }
        if ($this->request->is(array('post', 'put')))
        {
            $this->Profile->id = $id;
            $recordArr=array('id'=>$id,'enroll'=>$this->request->data['Profile']['enroll'],'phone'=>$this->request->data['Profile']['phone'],
                             'guardian_phone'=>$this->request->data['Profile']['guardian_phone'],'auto_renewal'=>$this->request->data['Profile']['auto_renewal']);
            if ($this->Profile->save($this->request->data))
            {
                $this->Session->setFlash(__('Profile Updated Successfully'),'flash',array('alert'=>'success'));
                $this->redirect(array('action' => 'editProfile'));
            }
        }
        if (!$this->request->data)
        {
            $this->request->data = $post;
        }        
    }
    public function changePhoto()
    {
        $id=$this->userValue['Student']['id'];
        $post = $this->Profile->findById($id);
        if (!$post)
        {
            $this->Session->setFlash(__('Invalid Post'),'flash',array('alert'=>'danger'));
            $this->redirect(array('action' => 'index'));
        }
        if ($this->request->is(array('post', 'put')))
        {
            $this->Profile->id = $id;
            if ($this->Profile->save($this->request->data))
            {
                $this->Session->setFlash(__('Photo Updated Successfully'),'flash',array('alert'=>'success'));
                $this->redirect(array('action' => 'index'));
            }
        }        
    }
    public function changePass()
    {
        if ($this->request->is(array('post', 'put')))
        {
            $passwordHasher = new SimplePasswordHasher(array('hashType' => 'sha256'));
            $id=$this->userValue['Student']['id'];
            $post = $this->Profile->findById($id);
            if($post['Profile']['password']==$passwordHasher->hash($this->request->data['Profile']['oldPassword']))
            {
                $this->Profile->id = $id;
                $this->request->data['Profile']['password']=$passwordHasher->hash($this->request->data['Profile']['password']);
                $this->Profile->unbindValidation('remove', array('photo'), true);
                    
                if ($this->Profile->save($this->request->data))
                {
                    $this->Session->setFlash(__('Password Changed Successfully'),'flash',array('alert'=>'success'));
                }                
            }
            else
            {
                $this->Session->setFlash(__('Invalid Password'),'flash',array('alert'=>'danger'));
            }
            $this->redirect(array('action' => 'changePass'));
        }
    }
}
