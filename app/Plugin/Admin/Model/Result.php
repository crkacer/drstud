<?php
class Result extends AppModel
{
  public $validationDomain = 'validation';
  //public $name="Result";
  public $useTable="exam_results";
  public $belongsTo=array('Student'=>
                          array('className'=>'students'),
                          'Exam'=>
                          array('className'=>'exams'),
                          );
  public function examOptions($serGroupWiseId)
  {
    $Exam=ClassRegistry::init('Exam');
    $examOptions=$Exam->find('list',array('joins'=>array(array('table'=>'exam_groups','type'=>'INNER','alias'=>'ExamGroup','conditions'=>array('Exam.id=ExamGroup.exam_id')))
                                          ,'fields'=>array('id','name'),
                             'conditions'=>array('Exam.status'=>'Closed',"ExamGroup.group_id IN($serGroupWiseId)"),
                             'order'=>array('Exam.name asc')));
    return$examOptions;
  }
  public function difficultyWiseQuestion($id,$type)
  {
    $ExamStat=ClassRegistry::init('ExamStat');
    $quesCount=$ExamStat->find('count',array(
                                  'joins'=>array(array('table'=>'questions','alias'=>'Question','type'=>'Inner',
                                                       'conditions'=>array('ExamStat.question_id=Question.id')),
                                                 array('table'=>'diffs','alias'=>'Diff','type'=>'Inner',
                                                       'conditions'=>array('Question.diff_id=Diff.id'))),
                                  'conditions'=>array('ExamStat.exam_result_id'=>$id,'Diff.type'=>$type,'ExamStat.answered'=>1)));
    return$quesCount;
  }
  public function studentDetail($id)
  {
    $ExamResult=ClassRegistry::init('ExamResult');
    $studentDetail=$ExamResult->find('first',array('fields'=>array('Student.id','Student.name'),
                                    'joins'=>array(array('table'=>'students','alias'=>'Student','type'=>'Inner',
                                                         'conditions'=>array('ExamResult.student_id=Student.id'))),
                                    'conditions'=>array('ExamResult.id'=>$id)));
    return$studentDetail;
  }
  public function performanceCount($studentId,$month)
  {
    $ExamResult=ClassRegistry::init('ExamResult');
    $conditions=array('ExamResult.student_id'=>$studentId,'MONTH(ExamResult.start_time)'=>$month,'ExamResult.user_id >'=>0);
    $examCount=$ExamResult->find('count',array('conditions'=>array($conditions)));
    $ExamResult->virtualFields= array('total'=>'SUM(ExamResult.percent)');
    $exampercent=$ExamResult->find('first',array('field'=>array('total'),
                                                 'conditions'=>array($conditions)));
    $percent=$exampercent['ExamResult']['total'];
    if($examCount>0)
    $averagePercent=CakeNumber::precision($percent/$examCount,2);
    else
    $averagePercent=0;
    return$averagePercent;
  }
  public function studentWise($name=null,$studentGroup=null,$userGroupWiseId)
  {
    $Student=ClassRegistry::init('Student');
    $conditions=array();
    $Student->bindModel(array('hasAndBelongsToMany'=>array('Group'=>array('className'=>'Group',
                                                     'joinTable' => 'student_groups',
                                                     'foreignKey' => 'student_id',
                                                     'associationForeignKey' => 'group_id',
                                                     'conditions'=>"StudentGroup.group_id IN($userGroupWiseId)"))));
    if($name!=null)
    $conditions[]=("Student.name LIKE '%$name%' OR Student.enroll LIKE '%$name%' ");
    if($studentGroup!=null)
    $conditions[]=array('StudentGroup.group_id'=>$studentGroup);
    $studentDetail=$Student->find('all',array('fields'=>array('DISTINCT(Student.id)','Student.name','Student.enroll','Student.email'),
                                              'joins'=>array(array('table'=>'student_groups','alias'=>'StudentGroup','type'=>'inner',
                                                                   'conditions'=>array('Student.id=StudentGroup.student_id'))),
                                              'conditions'=>array($conditions)));
    return$studentDetail;
  }
  public function examWise($name=null,$examGroup=null,$userGroupWiseId,$status=null)
  {
    $Exam=ClassRegistry::init('Exam');
    $Exam->bindModel(array('hasAndBelongsToMany'=>array('Group'=>array('className'=>'Group',
                                                     'joinTable' => 'exam_groups',
                                                     'foreignKey' => 'exam_id',
                                                     'associationForeignKey' => 'group_id',
                                                     'conditions'=>"ExamGroup.group_id IN($userGroupWiseId)"))));
    $conditions=array();
    if($name!=null)
    $conditions[]=array('Exam.id'=>$name);
    if($examGroup!=null)
    $conditions[]=array('ExamGroup.group_id'=>$examGroup);
    if($status!=null)
    $conditions[]=array('ExamResult.result'=>$status);
    $examDetail=$Exam->find('all',array('fields'=>array('Student.*','Exam.*','ExamResult.*','ExamResult.*'),
                                        'joins'=>array(array('table'=>'exam_groups','alias'=>'ExamGroup','type'=>'inner',
                                                                   'conditions'=>array('Exam.id=ExamGroup.exam_id')),
                                                             array('table'=>'exam_results','alias'=>'ExamResult','type'=>'inner',
                                                                   'conditions'=>array('Exam.id=ExamResult.exam_id')),
                                                             array('table'=>'students','alias'=>'Student','type'=>'inner',
                                                                   'conditions'=>array('Student.id=ExamResult.student_id'))),
                                        'conditions'=>array('ExamResult.user_id >'=>0,$conditions),
                                        'order'=>array('ExamResult.percent desc'),
                                        'group'=>array('ExamResult.id')));
    return$examDetail;
  }
  public function studentExamWise($name=null,$examGroup=null,$userGroupWiseId)
  {
    $Exam=ClassRegistry::init('Exam');
    $Exam->bindModel(array('hasAndBelongsToMany'=>array('Group'=>array('className'=>'Group',
                                                     'joinTable' => 'exam_groups',
                                                     'foreignKey' => 'exam_id',
                                                     'associationForeignKey' => 'group_id',
                                                     'conditions'=>"ExamGroup.group_id IN($userGroupWiseId)"))));
    $conditions=array();
    if($name!=null)
    $conditions[]=array('Student.id'=>$name);
    if($examGroup!=null)
    $conditions[]=array('ExamGroup.group_id'=>$examGroup);
    $examDetail=$Exam->find('all',array('fields'=>array('Student.*','Exam.*','ExamResult.*','ExamResult.*'),
                                        'joins'=>array(array('table'=>'exam_groups','alias'=>'ExamGroup','type'=>'inner',
                                                                   'conditions'=>array('Exam.id=ExamGroup.exam_id')),
                                                             array('table'=>'exam_results','alias'=>'ExamResult','type'=>'inner',
                                                                   'conditions'=>array('Exam.id=ExamResult.exam_id')),
                                                             array('table'=>'students','alias'=>'Student','type'=>'inner',
                                                                   'conditions'=>array('Student.id=ExamResult.student_id'))),
                                        'conditions'=>array('ExamResult.user_id >'=>0,$conditions),
                                        'order'=>array('ExamResult.percent desc'),
                                        'group'=>array('ExamResult.id')));
    return$examDetail;
  }
  public function userSubject($id)
  {
    $ExamStat=ClassRegistry::init('ExamStat');
    $userSubject=$ExamStat->find('all',array('fields'=>array('DISTINCT(Subject.id)','Subject.subject_name'),
                                'joins'=>array(array('table'=>'questions','alias'=>'Question','type'=>'Inner',
                                                     'conditions'=>array('ExamStat.question_id=Question.id')),
                                               array('table'=>'subjects','alias'=>'Subject','type'=>'Inner',
                                                     'conditions'=>array('Question.subject_id=Subject.id'))),
                                'conditions'=>array('ExamStat.exam_result_id'=>$id)));
    return$userSubject;
  }
  public function userSubjectMarks($id,$subjectId,$sumField)
  {
    $ExamStat=ClassRegistry::init('ExamStat');
    $ExamStat->virtualFields=array('total_marks'=>"SUM(ExamStat.$sumField)");
    $userSubject=$ExamStat->find('first',array('fields'=>array('total_marks'),
                                'joins'=>array(array('table'=>'questions','alias'=>'Question','type'=>'Inner',
                                                     'conditions'=>array('ExamStat.question_id=Question.id')),
                                               array('table'=>'subjects','alias'=>'Subject','type'=>'Inner',
                                                     'conditions'=>array('Question.subject_id=Subject.id'))),
                                'conditions'=>array('ExamStat.exam_result_id'=>$id,'Subject.id'=>$subjectId)));
    $userSubjectMarks=$userSubject['ExamStat']['total_marks'];
    return$userSubjectMarks;
  }
  public function userSubjectQuestion($id,$subjectId)
  {
    $ExamStat=ClassRegistry::init('ExamStat');
    $userSubjectQuestion=$ExamStat->find('count',array('joins'=>array(array('table'=>'questions','alias'=>'Question','type'=>'Inner',
                                                     'conditions'=>array('ExamStat.question_id=Question.id')),
                                               array('table'=>'subjects','alias'=>'Subject','type'=>'Inner',
                                                     'conditions'=>array('Question.subject_id=Subject.id'))),
                                'conditions'=>array('ExamStat.exam_result_id'=>$id,'Subject.id'=>$subjectId)));
    return$userSubjectQuestion;
  }
  public function userMarks($id)
  {
    $ExamStat=ClassRegistry::init('ExamStat');
    $ExamStat->virtualFields=array('total_marks'=>"SUM(ExamStat.marks)");
    $userSubject=$ExamStat->find('first',array('fields'=>array('total_marks'),
                                'conditions'=>array('ExamStat.exam_result_id'=>$id)));
    $userSubjectMarks=$userSubject['ExamStat']['total_marks'];
    return$userSubjectMarks;
  }
  public function userSubjectTime($id,$subjectId)
  {
    $ExamStat=ClassRegistry::init('ExamStat');
    $userSubject=$ExamStat->find('first',array('fields'=>array('SUM(TIMESTAMPDIFF(SECOND,`ExamStat`.`attempt_time`,`ExamStat`.`modified`)) as time_taken'),
                                'joins'=>array(array('table'=>'questions','alias'=>'Question','type'=>'Inner',
                                                     'conditions'=>array('ExamStat.question_id=Question.id')),
                                               array('table'=>'subjects','alias'=>'Subject','type'=>'Inner',
                                                     'conditions'=>array('Question.subject_id=Subject.id'))),
                                'conditions'=>array('ExamStat.exam_result_id'=>$id,'Subject.id'=>$subjectId,'ExamStat.answered'=>1)));
    $userSubjectTime=$userSubject[0]['time_taken'];
    return$userSubjectTime;
  }
  public function userMarksheet($id)
  {
    $userSubject=$this->userSubject($id);
    $userMarksheet=array();
    $grandTotalMarks=0;$grandObtainedMarks=0;$grandTotalQuestion=0;$grandTimeTaken=0;
    foreach($userSubject as $k=>$subjectValue)
    {
        $totalMarks=$this->userSubjectMarks($id,$subjectValue['Subject']['id'],'marks');
        $obtainedMarks=$this->userSubjectMarks($id,$subjectValue['Subject']['id'],'marks_obtained');
        $totalQuestion=$this->userSubjectQuestion($id,$subjectValue['Subject']['id']);
        $allMarks=$this->userMarks($id);
        $timeTaken=$this->userSubjectTime($id,$subjectValue['Subject']['id']);
        $marksWeightage=CakeNumber::precision(($totalMarks*100)/$allMarks,2);
        $grandTotalMarks=CakeNumber::precision($grandTotalMarks+$totalMarks,2);
        $grandObtainedMarks=CakeNumber::precision($grandObtainedMarks+$obtainedMarks,2);
        $grandTotalQuestion=$grandTotalQuestion+$totalQuestion;
        $grandTimeTaken=$grandTimeTaken+$timeTaken;
        $percent=CakeNumber::precision(($obtainedMarks*100)/$totalMarks,2);
        $userMarksheet[$k]['Subject']['name']=$subjectValue['Subject']['subject_name'];
        $userMarksheet[$k]['Subject']['total_marks']=$totalMarks;
        $userMarksheet[$k]['Subject']['obtained_marks']=$obtainedMarks;
        $userMarksheet[$k]['Subject']['percent']=$percent;
        $userMarksheet[$k]['Subject']['total_question']=$totalQuestion;
        $userMarksheet[$k]['Subject']['marks_weightage']=$marksWeightage;
        $userMarksheet[$k]['Subject']['time_taken']=$timeTaken;
    }
    if($grandTotalMarks==0)
    $grandPercent=0;
    else
    $grandPercent=$percent=CakeNumber::precision(($grandObtainedMarks*100)/$grandTotalMarks,2);
    $userMarksheet['total']['Subject']=array('name'=>__('Grand Total'),'total_marks'=>$grandTotalMarks,'obtained_marks'=>$grandObtainedMarks,
                                             'percent'=>$grandPercent,'total_question'=>$grandTotalQuestion,'marks_weightage'=>100,'time_taken'=>$grandTimeTaken);
    return$userMarksheet;
  }  
}
?>