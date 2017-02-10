<?php
class AddquestionsController extends AdminAppController {
    public $helpers = array('Html', 'Form','Session','Paginator','Js'=> array('Jquery'));
    public $components = array('Session','Paginator','search-master.Prg');
    public $presetVars = true;
    var $paginate = array('joins'=>array(
                                         array('table'=>'question_groups','type'=>'INNER','alias'=>'QuestionGroup','conditions'=>array('Addquestion.id=QuestionGroup.question_id')),
                                         array('table'=>'exam_groups','type'=>'INNER','alias'=>'ExamGroup','conditions'=>array('ExamGroup.group_id=QuestionGroup.group_id'))),                                         
                          'page'=>1,'order'=>array('Addquestion.id'=>'desc'),'group'=>array('Addquestion.id'));
    public function index($id = null)
    {
        try{
        if (!$id)
        {
            $this->Session->setFlash(__('Invalid Post'),'flash',array('alert'=>'danger'));
            return $this->redirect(array('controller'=>'Exams','action' => 'index'));
        }
        $this->loadModel('Exam');
        $post = $this->Exam->findById($id);
        if (!$post)
        {
            $this->Session->setFlash(__('Invalid Post'),'flash',array('alert'=>'danger'));
        }
        
        $this->Prg->commonProcess();
        $this->Paginator->settings = $this->paginate;
        $this->Paginator->settings['limit']=$this->pageLimit;
        $this->Paginator->settings['maxLimit']=$this->maxLimit;
        
        
        $cond="";
        $cond=" 1=1 AND ExamGroup.exam_id=$id AND ExamGroup.group_id IN($this->userGroupWiseId)";
        $this->Paginator->settings['conditions'] = array($this->Addquestion->parseCriteria($this->Prg->parsedParams()),$cond);
        
        $this->set('Addquestion', $this->Paginator->paginate());       
        $this->loadModel('ExamQuestion');
        $this->loadModel('Subject');
        $this->loadModel('Qtype');
        $this->loadModel('Diff');
        $ExamQuestion=$this->ExamQuestion->findAllByExamId($id,array(),array('ExamQuestion.question_id' => 'desc'));
        
        if($this->request->data['Addquestion'])
        $selectedSubject=$this->request->data['Addquestion']['subject_id'];
        else
        $selectedSubject=null;
        $this->set('subjectId', $this->Subject->find('list',array('fields'=>array('id','subject_name'),
                                                                   'joins'=>array(array('table'=>'subject_groups','type'=>'INNER','alias'=>'SubjectGroup','conditions'=>array('Subject.id=SubjectGroup.subject_id'))),
                                                                   'conditions'=>array("SubjectGroup.group_id IN($this->userGroupWiseId)"))));
        $this->set('qtypeId', $this->Qtype->find('list',array('fields'=>array('id','question_type'))));
        $this->set('diffId', $this->Diff->find('list',array('fields'=>array('id','diff_level'))));
        
        $this->set('ExamQuestion',$ExamQuestion);
        $this->set('exam_id',$id);
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
    public function adddelete()
    {
        try{
        if ($this->request->is('post'))
        {
            $exam_id=$this->request->data['Addquestion']['exam_id'];
            if ($this->data['action']=="add")        
            {
                if ($this->request->is('post'))
                {
                    $this->loadModel('ExamQuestion');
                    foreach($this->data['Addquestion']['id'] as $key => $value)
                    {
                        if($value>0)
                        {
                            $this->ExamQuestion->create();
                            $this->request->data['ExamQuestion']['exam_id']=$exam_id;
                            $this->request->data['ExamQuestion']['question_id']=$value;
                            $eq=$this->ExamQuestion->findByQuestionIdAndExamId($value,$exam_id);
                            if($eq)
                            {
                                $eq_id=$eq['ExamQuestion']['id'];
                                $this->ExamQuestion->delete($eq_id);
                            }
                            $this->ExamQuestion->save($this->request->data['ExamQuestion']);
                        }
                    }
                    $this->Session->setFlash(__('Your Question has been added for exam'),'flash',array('alert'=>'success'));
                }            
            }        
            if ($this->data['action']=="delete")      
            {
                if ($this->request->is('post'))
                {
                    $this->loadModel('ExamQuestion');
                    foreach($this->data['Addquestion']['id'] as $key => $value)
                    {
                        if($value>0)
                        {
                            $eq=$this->ExamQuestion->findByQuestionIdAndExamId($value,$exam_id);                            
                            if($eq)
                            {
                                $eq_id=$eq['ExamQuestion']['id'];
                                $this->ExamQuestion->delete($eq_id);
                            }
                        }
                    }
                    $this->Session->setFlash(__('Your Question has been deleted for exam'),'flash',array('alert'=>'danger'));
                }                    
            }
        }
        $url_var=$exam_id;
        if(isset($this->request->data['Addquestion']['limit']))
        $url_var.="/limit:".$this->request->data['Addquestion']['limit'];
        if(isset($this->request->data['Addquestion']['page']))
        $url_var.="/page:".$this->request->data['Addquestion']['page'];
        if(isset($this->request->data['Addquestion']['keyword']))
        $url_var.="/keyword:".$this->request->data['Addquestion']['keyword'];
        return $this->redirect(array('action' =>"index/$url_var"));
        }
        catch (Exception $e)
        {
            $this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
            return $this->redirect(array('action' => 'index'));
        }
    }
    
}
