<?php
class Exam extends AppModel
{
  public $validationDomain = 'validation';
  public $belongsTo=array('Subject','Lesson');
  public $actsAs = array('search-master.Searchable');
  public $filterArgs = array('keyword' => array('type' => 'like','field'=>'Exam.name'));
  public $validate =array('name' => array('alphaNumeric'=>array('rule' =>'alphaNumericCustom','required'=>true,'allowEmpty'=>false,'message'=>'Only Alphabets')),
 'passing_percent' => array('numeric' => array('rule' => 'numeric','required' => true,'allowEmpty'=>false,'message' => 'Only numbers allowed')),
 'duration' => array('numeric' => array('rule' => 'numeric','required' => true,'allowEmpty'=>false,'message' => 'Only numbers allowed')),
 'attempt_count' => array('numeric' => array('rule' => 'numeric','required' => true,'allowEmpty'=>false,'message' => 'Only numbers allowed')),
 'subject_id' => array('numeric' => array('rule' => 'numeric','required' => true,'allowEmpty'=>false,'message' => 'Please select an item in the list.')),
 'lesson_id' => array('numeric' => array('rule' => 'numeric','required' => true,'allowEmpty'=>false,'message' => 'Please select an item in the list.')),
 'start_date' => array('datetime' => array('rule' => 'datetime','required' => true,'allowEmpty'=>false,'message' => 'Only Date/time format')),
 'end_date' => array('datetime' => array('rule' => 'datetime','required' => true,'allowEmpty'=>false,'message' => 'Only Date/time format'))
 );
  public function UserWiseGroup($userGroupWiseId)
  {
    $Exam=ClassRegistry::init('Exam');
    $Exam->bindModel(array('hasAndBelongsToMany'=>array('Group'=>array('className'=>'Group',
                                                     'joinTable' => 'exam_groups',
                                                     'foreignKey' => 'exam_id',
                                                     'associationForeignKey' => 'group_id',
                                                     'conditions'=>"ExamGroup.group_id IN($userGroupWiseId)"))));
  }
  public function beforeValidate($options = array())
  {
      if (!empty($this->data['Exam']['start_date'])) {
      $this->data['Exam']['start_date'] = $this->dateTimeFormatBeforeSave($this->data['Exam']['start_date']);
      }
      if (!empty($this->data['Exam']['end_date'])) {
      $this->data['Exam']['end_date'] = $this->dateTimeFormatBeforeSave($this->data['Exam']['end_date']);
      }
      return true;
  }  
  public function examStats($id)
  {
    $Exam=ClassRegistry::init('Exam');
    $examvalue=$Exam->find('first',array('fields'=>array('id','name','start_date','end_date','passing_percent'),
                                      'joins'=>array(array('table'=>'exam_groups','type'=>'INNER','alias'=>'ExamGroup','conditions'=>array('Exam.id=ExamGroup.exam_id'))),
                         'conditions'=>array('Exam.status'=>'Closed','Exam.id'=>$id)
                         ));
    $examStats=array();
    $examStats['Exam']['id']=$examvalue['Exam']['id'];
    $examStats['Exam']['name']=$examvalue['Exam']['name'];
    $examStats['Exam']['start_date']=$examvalue['Exam']['start_date'];
    $examStats['Exam']['end_date']=$examvalue['Exam']['end_date'];
    $examStats['OverallResult']['passing']=(float) $examvalue['Exam']['passing_percent'];
    $examStats['OverallResult']['average']=(float) $this->studentAverageResult($examvalue['Exam']['id']);
    $examStats['StudentStat']['pass']=$this->studentStat($examvalue['Exam']['id'],'Pass');
    $examStats['StudentStat']['fail']=$this->studentStat($examvalue['Exam']['id'],'Fail');
    $examStats['StudentStat']['absent']=(float) $this->examTotalAbsent($examvalue['Exam']['id']);
    return$examStats;
  }
  public function examAttendance($id,$type)
  {
    $examStats=array();
    $examStats=$this->studentStat($id,$type,'all');
    return$examStats;
  }
  public function examAbsent($id)
  {
    $examStats=array();
    $examStats=$this->examTotalAbsent($id,'all');
    return$examStats;
  }
  public function totalMarks($id)
  {
    $limit=0;
    $ExamQuestion=ClassRegistry::init('ExamQuestion');
    $ExamMaxquestion=ClassRegistry::init('ExamMaxquestion');
    $examMaxQuestionArr=$ExamMaxquestion->find('all',array('fields'=>array('ExamMaxquestion.subject_id','ExamMaxquestion.max_question'),'conditions'=>array('ExamMaxquestion.exam_id'=>$id)));
    $totalMarks=0;
    if($examMaxQuestionArr)
    {
      foreach($examMaxQuestionArr as $value)
      {
        $quesNo=$value['ExamMaxquestion']['max_question'];
        $subjectId=$value['ExamMaxquestion']['subject_id'];
        if($quesNo==0)
        $limit=" ";
        else
        $limit=' LIMIT '.$quesNo;
        $ExamQuestion->virtualFields= array('total_marks'=>'SELECT SUM(`marks`) FROM (SELECT `Question`.`marks` FROM `exam_questions` AS `ExamQuestion` Inner JOIN `questions` AS `Question` ON (`ExamQuestion`.`question_id`=`Question`.`id`) WHERE `ExamQuestion`.`exam_id`='.$id.' AND `Question`.`subject_id`='.$subjectId.$limit.') subquery');
        $totalMarksArr=$ExamQuestion->find('first',array('fields'=>array('total_marks')));
        if($totalMarksArr)
        $totalMarks=$totalMarks+$totalMarksArr['ExamQuestion']['total_marks'];
      }
    }
    else
    {
      $ExamQuestion->virtualFields= array('total_marks'=>'SUM(Question.marks)');
      $totalMarksArr=$ExamQuestion->find('first',array(
                                                   'fields'=>array('total_marks'),
                                                   'joins'=>array(array('table'=>'questions','alias'=>'Question','type'=>'Inner',
                                                                        'conditions'=>array('ExamQuestion.question_id=Question.id'))),
                                                   'conditions'=>array("ExamQuestion.exam_id=$id")));
      if($totalMarksArr)
      $totalMarks=$totalMarksArr['ExamQuestion']['total_marks'];
    }    
    return$totalMarks;
  }
}
?>