<?php
class GroupsController extends AdminAppController {
    public $helpers = array('Html', 'Form','Session','Paginator','Js'=> array('Jquery'));
    public $components = array('Session','Paginator','search-master.Prg');
    public $presetVars = true;
     var $paginate = array('joins'=>array(array('table'=>'user_groups','type'=>'LEFT','alias'=>'UserGroup','conditions'=>array('Group.id=UserGroup.group_id'))),
                           'page'=>1,'order'=>array('Group.group_name'=>'asc'),'group'=>array('Group.id'));
    public function index()
    {
        try
        {
            $this->Prg->commonProcess();
            $this->Paginator->settings = $this->paginate;
            if($this->adminId!=1)
            $cond=array('UserGroup.user_id'=>$this->luserId);
            $this->Paginator->settings['conditions'] = array($this->Group->parseCriteria($this->Prg->parsedParams()),$cond);
            $this->Paginator->settings['limit']=$this->pageLimit;
            $this->Paginator->settings['maxLimit']=$this->maxLimit;
            $this->set('Group', $this->Paginator->paginate());
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
        if ($this->request->is('post'))
        {
            $this->Group->create();
            try
            {
                if ($this->Group->save($this->request->data))
                {
                    $this->loadModel('UserGroup');
                    $this->request->data['UserGroup']['group_id']=$this->Group->id;
                    $this->request->data['UserGroup']['user_id']=1;
                    $this->UserGroup->save($this->request->data);
                    $this->Session->setFlash(__('Group Added Successfully'),'flash',array('alert'=>'success'));
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
        if (!$id)
        {
            throw new NotFoundException(__('Invalid post'));
        }
        $ids=explode(",",$id);
        $post=array();
        foreach($ids as $k=>$id)
        {
            $k++;
            $post[$k]=$this->Group->findById($id);
        }
        $this->set('Group',$post);
        if (!$post)
        {
            throw new NotFoundException(__('Invalid post'));
        }
        if ($this->request->is(array('post', 'put')))
        {
            try
            {
                if ($this->Group->saveAll($this->request->data))
                {
                    $this->Session->setFlash(__('Group has been saved'),'flash',array('alert'=>'success'));
                    return $this->redirect(array('action' => 'index'));
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
    public function deleteall()
    {
        try
        {
            if ($this->request->is('post'))
            {
                foreach($this->data['Group']['id'] as $key => $value)
                {
                    $this->Group->delete($value);
                }
                $this->Session->setFlash(__('Group has been deleted'),'flash',array('alert'=>'success'));
            }        
            $this->redirect(array('action' => 'index'));
        }
        catch (Exception $e)
        {
            $this->Session->setFlash(__('Delete subject first'),'flash',array('alert'=>'danger'));
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
            $post = $this->Group->findById($id);
            if (!$post)
            {
                $this->Session->setFlash(__('Invalid Post'),'flash',array('alert'=>'danger'));
                $this->redirect(array('action' => 'index'));
            }
            if(strlen($post['Group']['photo'])>0)
            $std_img='group_thumb/'.$post['Group']['photo'];
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
}
