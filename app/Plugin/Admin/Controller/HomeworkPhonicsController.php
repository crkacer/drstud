<?php
class HomeworkPhonicsController extends AdminAppController {
    public $helpers = array('Html', 'Form','Session','Paginator','Js'=> array('Jquery'));
    public $components = array('Session','Paginator','search-master.Prg');
    public $presetVars = true;
    // var $paginate = array('fields'=>array('HomeworkPhonic.*','Subject.subject_name'),
    //                       'joins'=>array(array('table'=>'subjects','type'=>'LEFT','alias'=>'Subject','conditions'=>array('Subject.id=Lesson.subject_id')),
    //                                      array('table'=>'subject_groups','type'=>'LEFT','alias'=>'SubjectGroup','conditions'=>array('Subject.id=SubjectGroup.subject_id')),
    //                                      array('table'=>'user_groups','type'=>'LEFT','alias'=>'UserGroup','conditions'=>array('SubjectGroup.group_id=UserGroup.group_id'))),
    //                       'page'=>1,'order'=>array('Subject.subject_name'=>'asc'),'group'=>array('Lesson.id'));
    var $paginate = array('fields'=>array('HomeworkPhonic.*'));
    public function index()
    {
        try
        {
            $this->Prg->commonProcess();
            $this->Paginator->settings = $this->paginate;
            if($this->adminId!=1)
            // $cond=array('UserGroup.user_id'=>$this->luserId);
            // $this->Paginator->settings['conditions'] = array($this->HomeworkPhonic->parseCriteria($this->Prg->parsedParams()),$cond);
            $this->Paginator->settings['limit']=$this->pageLimit;
            $this->Paginator->settings['maxLimit']=$this->maxLimit;
            $this->set('HomeworkPhonic', $this->Paginator->paginate());
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
    
    public function view($id = null)
    {
        $this->layout = null;
        if (!$id)
        {
            $this->Session->setFlash(__('Invalid Post'),'flash',array('alert'=>'danger'));
            $this->redirect(array('action' => 'index'));
        }
        $post = $this->HomeworkPhonic->findById($id);
        $this->set('post',$post);
    }
   
}
