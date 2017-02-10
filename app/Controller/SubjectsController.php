<?php
class SubjectsController extends AppController
{
    public $helpers = array('Html','Paginator','Js'=> array('Jquery'));
    public $components = array('Paginator');
    public $currentDateTime,$studentId;
    var $paginate = array('page'=>1,'group'=>array('Subject.id'),'order'=>array('Subject.id'=>'desc'),
                          'joins'=>array(array('table'=>'subject_groups','type'=>'INNER','alias'=>'SubjectGroup','conditions'=>array('Subject.id=SubjectGroup.subject_id')),
                                        array('table'=>'student_groups','type'=>'INNER','alias'=>'StudentGroup','conditions'=>array('SubjectGroup.group_id=StudentGroup.group_id')),
                                         ));
    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->authenticate();
        $this->studentId=$this->userValue['Student']['id'];
    }
    public function index($id)
    {
        $this->Paginator->settings = $this->paginate;
        $this->Paginator->settings['conditions'] = array('StudentGroup.student_id'=>$this->studentId,'StudentGroup.group_id'=>$id,'OR'=>array(array('StudentGroup.expiry_date'=>NULL),array('StudentGroup.expiry_date >='=>$this->currentDate)));
        $this->Paginator->settings['limit']=$this->pageLimit;
        $this->Paginator->settings['maxLimit']=$this->maxLimit;
        $this->set('Subject', $this->Paginator->paginate());
        if (!$this->Paginator->paginate())
        {
            $this->Session->setFlash(__('No Subject'),'flash',array('alert'=>'danger'));
            $this->redirect(array('controller'=>'Mygroups','action' => 'index'));
        }
        if ($this->request->is('ajax'))
        {
            $this->render('index','ajax'); // View, Layout
        }
    }
    public function lesson($id = null)
    {
        $this->layout = null;
        if (!$id)
        {
            $this->Session->setFlash(__('Invalid Post'),'flash',array('alert'=>'danger'));
            $this->redirect(array('action' => 'index'));
        }
        $this->loadModel('Lesson');
        $this->set('lesson',$this->Lesson->findAllBySubjectId($id, array(), array('Lesson.ordering' => 'asc')));
    }
}