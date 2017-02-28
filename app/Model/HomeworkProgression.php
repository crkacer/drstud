<?php
class HomeworkProgression extends AppModel
{
  public $validationDomain = 'validation';
  public $useTable="homework_results";
  public function performanceCount($studentId,$month)
  {
    $HomeworkResult=ClassRegistry::init('HomeworkResult');
    $conditions=array('HomeworkResult.student_id'=>$studentId,'MONTH(HomeworkResult.start_time)'=>$month,'HomeworkResult.user_id >'=>0);
    $homeworkCount=$HomeworkResult->find('count',array('conditions'=>array($conditions)));
    $HomeworkResult->virtualFields= array('total'=>'SUM(HomeworkResult.percent)');
    $homeworkpercent=$HomeworkResult->find('first',array('field'=>array('total'),
                                                 'conditions'=>array($conditions)));
    $percent=$homeworkpercent['HomeworkResult']['total'];
    if($homeworkCount>0)
    $averagePercent=CakeNumber::precision($percent/$homeworkCount,2);
    else
    $averagePercent=0;
    return$averagePercent;
  }
  public function userTotalAbsent($studentId)
  {
    $Homework=ClassRegistry::init('Homework');
    $HomeworkResult=ClassRegistry::init('HomeworkResult');
    $userTotalHomework=$Homework->find('count',array(
                            'joins'=>array(array('table'=>'homework_groups','alias'=>'HomeworkGroup','type'=>'Inner',
                                                 'conditions'=>array('Homework.id=HomeworkGroup.homework_id','')),
                                           array('table'=>'homework_results','alias'=>'HomeworkResult','type'=>'Left',
                                                 'conditions'=>array('HomeworkResult.homework_id=Homework.id')),
                                           array('table'=>'student_groups','alias'=>'StudentGroup','type'=>'Inner',
                                                 'conditions'=>array('StudentGroup.group_id=HomeworkGroup.group_id'))),
                            'conditions'=>array('Homework.status'=>'Closed',"StudentGroup.student_id=$studentId"),
                            'order'=>array('Homework.start_date'=>'asc'),
                            'group'=>array('Homework.id')));
    $userAttemptHomework=$HomeworkResult->find('count',array('conditions'=>array('HomeworkResult.student_id'=>$studentId),
                                                     'group'=>array('HomeworkResult.homework_id')));
    $userTotalAbsent=$userTotalHomework-$userAttemptHomework;
    return$userTotalAbsent;
  }
  public function userBestHomework($studentId)
  {
    $HomeworkResult=ClassRegistry::init('HomeworkResult');
    $bestHomework=array();
    $bestHomework=$HomeworkResult->find('first',array('fields'=>array('Homework.name','HomeworkResult.start_time'),
                                              'joins'=>array(array('table'=>'homeworks','alias'=>'Homework','type'=>'Inner',
                                                                   'conditions'=>array('HomeworkResult.homework_id=Homework.id'))),
                                              'conditions'=>array('HomeworkResult.student_id'=>$studentId),
                                              'order'=>array('HomeworkResult.percent'=>'desc')));
    return$bestHomework;
  }
  public function userWorstHomework($studentId)
  {
    $HomeworkResult=ClassRegistry::init('HomeworkResult');
    $bestHomework=array();
    $bestHomework=$HomeworkResult->find('first',array('fields'=>array('Homework.name','HomeworkResult.start_time'),
                                              'joins'=>array(array('table'=>'homeworks','alias'=>'Homework','type'=>'Inner',
                                                                   'conditions'=>array('HomeworkResult.homework_id=Homework.id'))),
                                              'conditions'=>array('HomeworkResult.student_id'=>$studentId),
                                              'order'=>array('HomeworkResult.percent'=>'asc')));
    return$bestHomework;
  }
  public function userMissedHomework($studentId)
  {
    $Homework=ClassRegistry::init('Homework');
    $HomeworkResult=ClassRegistry::init('HomeworkResult');
    $missedHomework=$HomeworkResult->find('count',array(
                            'joins'=>array(array('table'=>'homework_results','alias'=>'HomeworkResult','type'=>'Left',
                                                 'conditions'=>array('HomeworkResult.homework_id=Homework.id')),
                                           array('table'=>'student_groups','alias'=>'StudentGroup','type'=>'Inner',
                                                 'conditions'=>array('StudentGroup.group_id=HomeworkGroup.group_id'))),
                            'conditions'=>array('HomeworkResult.total_answered'=>0,"StudentGroup.student_id=$studentId")));

    return $missedHomework;
  }
}
?>