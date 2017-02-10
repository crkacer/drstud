<?php
class LessonsController extends AppController
{
    public $helpers = array('Paginator','Js'=> array('Jquery'));
    public $components = array('Paginator');
    public $currentDateTime,$studentId;
    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->authenticate();
        $this->studentId=$this->userValue['Student']['id'];
    }
    public function index($id)
    {
        if (!$id)
        {
            $this->Session->setFlash(__('Invalid Post'),'flash',array('alert'=>'danger'));
            $this->redirect(array('controller'=>'Dashboards','action' => 'index'));
        }
        $lesson=$this->Lesson->find('first',array('joins'=>array(array('table'=>'subjects','type'=>'INNER','alias'=>'Subject','conditions'=>array('Subject.id=Lesson.subject_id')),
                                                                 array('table'=>'subject_groups','type'=>'INNER','alias'=>'SubjectGroup','conditions'=>array('Subject.id=SubjectGroup.subject_id')),
                                                                 array('table'=>'student_groups','type'=>'INNER','alias'=>'StudentGroup','conditions'=>array('SubjectGroup.group_id=StudentGroup.group_id'))),
                                                  'conditions'=>array('StudentGroup.student_id'=>$this->studentId,'Lesson.id'=>$id,'OR'=>array(array('StudentGroup.expiry_date'=>NULL),array('StudentGroup.expiry_date >='=>$this->currentDate))),
                                                  ));
        if (!$lesson)
        {
            $this->Session->setFlash(__('Invalid Post'),'flash',array('alert'=>'danger'));
            $this->redirect(array('controller'=>'Dashboards','action' => 'index'));
        }
        $this->loadModel('StudentsLesson');
        $condition=$this->StudentsLesson->find('first',array('conditions'=>array('StudentsLesson.student_id'=>$this->studentId,'StudentsLesson.status'=>'Pending')));
        if($condition && $condition['StudentsLesson']['lesson_id']==$id){}
        elseif($condition && $condition['StudentsLesson']['lesson_id']!=$id)
        {
            $this->Session->setFlash(__('You have pending Lesson/Quiz.<br/>Finish it first.'),'flash',array('alert'=>'danger'));
            $this->redirect(array('action' => 'index',$condition['StudentsLesson']['lesson_id']));
        }
        else
        {
            $this->StudentsLesson->create();
            $conditionArr=array('StudentsLesson'=>array('student_id'=>$this->studentId,'lesson_id'=>$id));
            $this->StudentsLesson->save($conditionArr);
        }
        $this->set('Lesson',$lesson);
        if ($this->request->is('ajax'))
        {
            $this->render('index','ajax'); // View, Layout
        }
    }
    public function quiz($id = null)
    {
        $this->layout = null;
        if (!$id)
        {
            $this->Session->setFlash(__('Invalid Post'),'flash',array('alert'=>'danger'));
            $this->redirect(array('action' => 'index'));
        }
        $post=$this->Lesson->getUserExam("today",$this->studentId,$this->currentDateTime,$id);        
        $this->set('post',$post);
        $this->set('lessonId',$id);
    }
    public function view($id,$lessonId)
    {
        $this->layout=null;
        $this->loadModel('Exam');
        $this->loadModel('ExamQuestion');
        $this->loadModel('ExamGroup');
        if (!$id)
        {
            $this->Session->setFlash(__('Invalid Post'),'flash',array('alert'=>'danger'));
            $this->redirect(array('action' => 'index'));
        }
        $checkPost=$this->Exam->checkPost($id,$this->studentId);
        if($checkPost==0)
        {
            $this->Session->setFlash(__('Invalid Post'),'flash',array('alert'=>'danger'));
            $this->redirect(array('action' => 'error'));
        }
        $post = $this->Exam->findByIdAndStatus($id,'Active');
        if (!$post)
        {
            $this->Session->setFlash(__('Invalid Post'),'flash',array('alert'=>'danger'));
            $this->redirect(array('action' => 'error'));
        }
        $examCount=$this->Exam->find('count',array('joins'=>array(array('table'=>'exam_maxquestions','type'=>'INNER','alias'=>'ExamMaxquestion','conditions'=>array('Exam.id=ExamMaxquestion.exam_id'))),
                                                   'conditions'=>array('Exam.id'=>$id)));
        if($post['Exam']['type']=="Exam")
        {
            $subjectDetailArr=$this->Exam->getSubject($id);
            foreach($subjectDetailArr as $value)
            {
                $subjectId=$value['Subject']['id'];
                $subjectName=$value['Subject']['subject_name'];
                $totalQuestionArr=$this->Exam->subjectWiseQuestion($id,$subjectId,'Exam');
                $subjectDetail[$subjectName]=$totalQuestionArr;
            }
            $totalMarks=$this->Exam->totalMarks($id);
        }
        else
        {
            $subjectDetailArr=$this->Exam->getPrepSubject($id);
            foreach($subjectDetailArr as $value)
            {
                $subjectId=$value['Subject']['id'];
                $subjectName=$value['Subject']['subject_name'];
                $totalQuestionArr=$this->Exam->subjectWiseQuestion($id,$subjectId);
                $subjectDetail[$subjectName]=$totalQuestionArr;
            }
            $totalMarks=0;
        }
        $this->set('post',$post);
        $this->set('subjectDetail',$subjectDetail);
        $this->set('totalMarks', $totalMarks);
        $this->set('examCount',$examCount);
        $this->set('id',$id);$this->set('lessonId',$lessonId);
    }
}