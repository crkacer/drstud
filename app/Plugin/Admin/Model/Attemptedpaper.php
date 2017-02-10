<?php
class Attemptedpaper extends AppModel
{
  public $validationDomain = 'validation';
  public $name = 'Attemptedpaper';
  public $useTable = 'exam_results';
  public $primaryKey = 'id';
  public $actsAs = array('search-master.Searchable');
  public $filterArgs = array('keyword' => array('type' => 'like','field'=>'Exam.name'));
  public $belongsTo=array('Student','User','Exam');
  public $hasAndBelongsToMany = array('Question'=>array('className'=>'Question',
                                                     'joinTable' => 'exam_stats',
                                                     'foreignKey' => 'exam_result_id',
                                                     'associationForeignKey' => 'question_id',
                                                     'fields'=>array('Question.qtype_id','Question.question','Question.option1','Question.option2','Question.option3','Question.option4','Question.option5','Question.option6',
                                                                     'Question.negative_marks','Question.answer','Question.true_false','Question.fill_blank','(ExamStat.modified-ExamStat.attempt_time) AS time_taken'),
                                                     'order' => 'ExamStat.ques_no asc'));
  public function examCount($id=null)
  {
    $ExamResult=ClassRegistry::init('ExamResult');
    $examCount=$ExamResult->find('count',array('conditions'=>array('exam_id'=>$id)));
    return$examCount;
  }
  public function examCountById($id=null)
  {
    $ExamResult=ClassRegistry::init('ExamResult');
    $examCount=$ExamResult->find('count',array('conditions'=>array('id'=>$id)));
    return$examCount;
  }
  public function obtainedMarks($id=null)
  {
    $ExamStat=ClassRegistry::init('ExamStat');
    $ExamStat->virtualFields= array('total_marks'=>'SUM(marks_obtained)');
    $ExamStatArr=$ExamStat->find('first',array('fields'=>array('total_marks'),
                                            'conditions'=>array('exam_result_id'=>$id)));
    $obtainedMarks=$ExamStatArr['ExamStat']['total_marks'];
    return$obtainedMarks;
  }
}
?>