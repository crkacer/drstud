<?php
class Groupperformance extends AppModel
{
  public $validationDomain = 'validation';
  public $useTable="exam_results";
  public function userGroupTestName($studentId)
  {
    $Exam=ClassRegistry::init('Exam');
    $testName=$Exam->find('all',array('fields'=>array('Exam.id','Exam.name'),
                            'joins'=>array(array('table'=>'exam_groups','alias'=>'ExamGroup','type'=>'Inner',
                                                 'conditions'=>array('Exam.id=ExamGroup.exam_id','')),
                                           array('table'=>'student_groups','alias'=>'StudentGroup','type'=>'Inner',
                                                 'conditions'=>array('StudentGroup.group_id=ExamGroup.group_id'))),
                            'conditions'=>array('Exam.status'=>'Closed',"StudentGroup.student_id=$studentId"),
                            'order'=>array('Exam.start_date'=>'asc'),
                            'group'=>array('Exam.id')));
    return$testName;
  }
  public function userAveragePerformance($examId,$studentId)
  {
    $totalAttempt=$this->find('count',array('conditions'=>array('Groupperformance.exam_id'=>$examId,'Groupperformance.student_id'=>$studentId)));
    $this->virtualFields=array('total_percent'=>'SUM(Groupperformance.percent)');
    $totalPercentArr=$this->find('first',array('fields'=>array('total_percent'),
                                               'conditions'=>array('Groupperformance.exam_id'=>$examId,'Groupperformance.student_id'=>$studentId)));
    $totalPercent=$totalPercentArr['Groupperformance']['total_percent'];
    if($totalAttempt>0)
    {
      $averagePercent=CakeNumber::precision($totalPercent/$totalAttempt,2);
    }
    else
    $averagePercent=0;
    return (float) $averagePercent;
  }
  public function userGroupAveragePerformance($examId)
  {
    $totalAttempt=$this->find('count',array('conditions'=>array('Groupperformance.exam_id'=>$examId)));
    $this->virtualFields=array('total_percent'=>'SUM(Groupperformance.percent)');
    $totalPercentArr=$this->find('first',array('fields'=>array('total_percent'),
                                                  'conditions'=>array('Groupperformance.exam_id'=>$examId)));
    $totalPercent=$totalPercentArr['Groupperformance']['total_percent'];
    if($totalAttempt>0)
    {
      $averagePercent=CakeNumber::precision($totalPercent/$totalAttempt,2);
    }
    else
    $averagePercent=0;
    return (float) $averagePercent;
  }
  public function userPerformance($studentId)
  {
    $testName=$this->userGroupTestName($studentId);
    $userPerformance=array();$userGroupPerformance=array();
    foreach($testName as $testValue)
    {
      $userPerformance[]=$this->userAveragePerformance($testValue['Exam']['id'],$studentId);
      $userGroupPerformance[]=$this->userGroupAveragePerformance($testValue['Exam']['id']);
    }
    return array($userPerformance,$userGroupPerformance);    
  }
}
?>