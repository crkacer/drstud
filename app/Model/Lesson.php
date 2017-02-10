<?php
class Lesson extends AppModel
{
  public $validationDomain = 'validation';
  public function getUserExam($type,$studentId,$currentDateTime,$lessonId,$limit=0)
  {
    $Exam=ClassRegistry::init('Exam');    
    $start_date="";
    $end_date="";
    $examLimit="";
    if($type=="today")
    {
      $start_date=array('Exam.start_date <='=>$currentDateTime);
      $end_date=array('Exam.end_date >'=>$currentDateTime);
    }
    if($type=="upcoming")
    {
      $start_date=array('Exam.start_date >'=>$currentDateTime);
    }    
    if($limit>0)
    $examLimit=$limit;
    $Exam->virtualFields= array('attempt'=>'SELECT COUNT(ExamResult.id) FROM `exam_results` AS `ExamResult` WHERE `ExamResult`.`exam_id`=`Exam.id` AND `ExamResult`.`student_id`='.$studentId,
                                'attempt_order'=>'SELECT COUNT(ExamOrder.id) FROM `exam_orders` AS `ExamOrder` WHERE `ExamOrder`.`exam_id`=`Exam.id` AND `ExamOrder`.`student_id`='.$studentId
                               );
    $examList=$Exam->find('all',array(
                                                'fields'=>array('Exam.id','Exam.type','Exam.name','Exam.start_date','Exam.end_date','Exam.paid_exam','Exam.amount','Exam.attempt','Exam.attempt_count','Exam.attempt_order','Exam.expiry','ExamOrder.expiry_date'),
                                                 'joins'=>array(array('table'=>'exam_questions','alias'=>'ExamQuestion','type'=>'LEFT',
                                                                      'conditions'=>array('Exam.id=ExamQuestion.Exam_id')),
                                                                array('table'=>'exam_groups','alias'=>'ExamGroup','type'=>'Inner',
                                                                      'conditions'=>array('Exam.id=ExamGroup.exam_id','')),
                                                                array('table'=>'student_groups','alias'=>'StudentGroup','type'=>'Inner',
                                                                      'conditions'=>array('StudentGroup.group_id=ExamGroup.group_id')),
                                                                array('table'=>'questions','alias'=>'Question','type'=>'LEFT',
                                                                      'conditions'=>array('ExamQuestion.question_id=Question.id')),
                                                                array('table'=>'exam_preps','alias'=>'ExamPrep','type'=>'LEFT',
                                                                      'conditions'=>array('Exam.id=ExamPrep.exam_id')),
                                                                array('table'=>'exam_orders','alias'=>'ExamOrder','type'=>'LEFT',
                                                                      'conditions'=>array('Exam.id=ExamOrder.exam_id','StudentGroup.student_id=ExamOrder.student_id'))),
                                                 'conditions'=>array($start_date,$end_date,"StudentGroup.student_id=$studentId",'Exam.status'=>'Active','Exam.user_id'=>0,'Exam.lesson_id'=>$lessonId),
                                                 'order'=>array('Exam.start_date'=>'asc'),
                                                 'group'=>array("Exam.id"),
                                                 'limit'=>$examLimit));
    return $examList;
  }
}
?>