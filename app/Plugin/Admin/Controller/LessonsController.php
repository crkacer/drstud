<?php
class LessonsController extends AdminAppController {
    public $helpers = array('Html', 'Form','Session','Paginator','Js'=> array('Jquery'));
    public $components = array('Session','Paginator','search-master.Prg');
    public $presetVars = true;
    var $paginate = array('fields'=>array('Lesson.*','Subject.subject_name'),
                          'joins'=>array(array('table'=>'subjects','type'=>'LEFT','alias'=>'Subject','conditions'=>array('Subject.id=Lesson.subject_id')),
                                         array('table'=>'subject_groups','type'=>'LEFT','alias'=>'SubjectGroup','conditions'=>array('Subject.id=SubjectGroup.subject_id')),
                                         array('table'=>'user_groups','type'=>'LEFT','alias'=>'UserGroup','conditions'=>array('SubjectGroup.group_id=UserGroup.group_id'))),
                          'page'=>1,'order'=>array('Subject.subject_name'=>'asc'),'group'=>array('Lesson.id'));
    public function index()
    {
        try
        {
            $this->Prg->commonProcess();
            $this->Paginator->settings = $this->paginate;
            if($this->adminId!=1)
            $cond=array('UserGroup.user_id'=>$this->luserId);
            $this->Paginator->settings['conditions'] = array($this->Lesson->parseCriteria($this->Prg->parsedParams()),$cond);
            $this->Paginator->settings['limit']=$this->pageLimit;
            $this->Paginator->settings['maxLimit']=$this->maxLimit;
            $this->set('Lesson', $this->Paginator->paginate());
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
        $this->loadModel('Subject');
        $this->set('subject_id', $this->Subject->find('list',array('fields'=>array('id','subject_name'),
                                                                   'joins'=>array(array('table'=>'subject_groups','type'=>'INNER','alias'=>'SubjectGroup','conditions'=>array('Subject.id=SubjectGroup.subject_id'))),
                                                                   'conditions'=>array("SubjectGroup.group_id IN($this->userGroupWiseId)"))));
        if ($this->request->is('post'))
        {pr($this->request->data);
            $this->Lesson->create();
            try
            {
                if ($this->Lesson->save($this->request->data))
                {
                    $this->Session->setFlash(__('Lesson has been saved'),'flash',array('alert'=>'success'));
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
        $this->loadModel('Subject');
        $this->set('subject_id', $this->Subject->find('list',array('fields'=>array('id','subject_name'),
                                                                   'joins'=>array(array('table'=>'subject_groups','type'=>'INNER','alias'=>'SubjectGroup','conditions'=>array('Subject.id=SubjectGroup.subject_id'))),
                                                                   'conditions'=>array("SubjectGroup.group_id IN($this->userGroupWiseId)"))));
        foreach($ids as $id)
        {
            $post[]=$this->Lesson->findByid($id);
        }
        $this->set('Lesson',$post);
        if (!$post)
        {
            throw new NotFoundException(__('Invalid post'));
        }
       if ($this->request->is(array('post', 'put')))
       {
             $this->Lesson->id = $id;
            try
            {
                
                if ($this->Lesson->saveAll($this->request->data))
                {
                    $this->Session->setFlash(__('Lesson has been saved'),'flash',array('alert'=>'success'));
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
            $this->layout = 'tinymce';
            $this->set('isError',false);
        }        
        if (!$this->request->data)
        {
            $this->request->data = $post;
        }
    }
    public function view($id = null)
    {
        $this->layout = null;
        if (!$id)
        {
            $this->Session->setFlash(__('Invalid Post'),'flash',array('alert'=>'danger'));
            $this->redirect(array('action' => 'index'));
        }
        $post = $this->Lesson->findById($id);
        $this->set('post',$post);
    }
    public function deleteall()
    {
        try
        {
            if ($this->request->is('post'))
            {
                foreach($this->data['Lesson']['id'] as $key => $value)
                {
                    $this->Lesson->delete($value);
                }
                $this->Session->setFlash(__('Lesson has been deleted'),'flash',array('alert'=>'success'));
            }        
            $this->redirect(array('action' => 'index'));
        }
        catch (Exception $e)
        {
            $this->Session->setFlash(__('Delete exam first'),'flash',array('alert'=>'danger'));
            return $this->redirect(array('action' => 'index'));
        }
    }    
}
