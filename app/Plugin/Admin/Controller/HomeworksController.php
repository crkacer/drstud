<?php
class HomeworksController extends AdminAppController {
    public $helpers = array('Html', 'Form','Session','Paginator','Tinymce','Js'=> array('Jquery'));
    public $components = array('Session','Paginator','search-master.Prg');
    public $presetVars = true;
    var $paginate = array('joins'=>array(
                                         array('table'=>'question_groups','type'=>'INNER','alias'=>'QuestionGroup','conditions'=>array('Question.id=QuestionGroup.question_id')),
                                         array('table'=>'user_groups','type'=>'INNER','alias'=>'UserGroup','conditions'=>array('QuestionGroup.group_id=UserGroup.group_id'))),                                         
                          'page'=>1,'order'=>array('Question.id'=>'desc'),'group'=>array('Question.id'));
    public function index()
    {
        try
        {
            $this->loadModel('Subject');
            $this->loadModel('Qtype');
            $this->loadModel('Diff');
            $this->set('subjectId', $this->Subject->find('list',array('fields'=>array('id','subject_name'),
                                                                   'joins'=>array(array('table'=>'subject_groups','type'=>'INNER','alias'=>'SubjectGroup','conditions'=>array('Subject.id=SubjectGroup.subject_id'))),
                                                                   'conditions'=>array("SubjectGroup.group_id IN($this->userGroupWiseId)"))));
            $this->set('qtypeId', $this->Qtype->find('list',array('fields'=>array('id','question_type'))));
            $this->set('diffId', $this->Diff->find('list',array('fields'=>array('id','diff_level'))));
            $this->Question->UserWiseGroup($this->userGroupWiseId);
            $this->Prg->commonProcess();
            $this->Paginator->settings = $this->paginate;
            $this->Paginator->settings['limit']=$this->pageLimit;
            $this->Paginator->settings['maxLimit']=$this->maxLimit;        
            $cond="";
            $cond=" 1=1 AND `UserGroup`.`user_id`=$this->luserId ";
            $this->Paginator->settings['conditions'] = array($this->Question->parseCriteria($this->Prg->parsedParams()),$cond);
            $this->set('Question', $this->Paginator->paginate());
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
    
    
    public function viewquestion($id = null)
    {
        try
        {
            $this->layout=null;
            if (!$id)
            {
                $this->Session->setFlash(__('Invalid Post'),'flash',array('alert'=>'danger'));
                $this->redirect(array('action' => 'index'));
            }
            $this->set('id',$id);
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
            $this->layout='script';
            if (!$id)
            {
                $this->Session->setFlash(__('Invalid Post'),'flash',array('alert'=>'danger'));
                $this->redirect(array('action' => 'index'));
            }
            $post = $this->Question->findById($id);
            $this->set('post',$post);
        }
        catch (Exception $e)
        {
            $this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
            return $this->redirect(array('action' => 'index'));
        }
    }
}
