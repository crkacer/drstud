<?php
class Progression extends AppModel
{
  public $validationDomain = 'validation';
  public $useTable="exam_results";
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
  public function userTotalAbsent($studentId)
  {
    $Exam=ClassRegistry::init('Exam');
    $ExamResult=ClassRegistry::init('ExamResult');
    $userTotalExam=$Exam->find('count',array(
                            'joins'=>array(array('table'=>'exam_groups','alias'=>'ExamGroup','type'=>'Inner',
                                                 'conditions'=>array('Exam.id=ExamGroup.exam_id','')),
                                           array('table'=>'exam_results','alias'=>'ExamResult','type'=>'Left',
                                                 'conditions'=>array('ExamResult.exam_id=Exam.id')),
                                           array('table'=>'student_groups','alias'=>'StudentGroup','type'=>'Inner',
                                                 'conditions'=>array('StudentGroup.group_id=ExamGroup.group_id'))),
                            'conditions'=>array('Exam.status'=>'Closed',"StudentGroup.student_id=$studentId"),
                            'order'=>array('Exam.start_date'=>'asc'),
                            'group'=>array('Exam.id')));
    $userAttemptExam=$ExamResult->find('count',array('conditions'=>array('ExamResult.student_id'=>$studentId),
                                                     'group'=>array('ExamResult.exam_id')));
    $userTotalAbsent=$userTotalExam-$userAttemptExam;
    return$userTotalAbsent;
  }
  public function userBestExam($studentId)
  {
    $ExamResult=ClassRegistry::init('ExamResult');
    $bestExam=array();
    $bestExam=$ExamResult->find('first',array('fields'=>array('Exam.name','ExamResult.start_time'),
                                              'joins'=>array(array('table'=>'exams','alias'=>'Exam','type'=>'Inner',
                                                                   'conditions'=>array('ExamResult.exam_id=Exam.id'))),
                                              'conditions'=>array('ExamResult.student_id'=>$studentId),
                                              'order'=>array('ExamResult.percent'=>'desc')));
    return$bestExam;
  }
}
?>