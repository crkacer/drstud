<?php
class Result extends AppModel
{
  public $validationDomain = 'validation';
  public $useTable="exam_results";  
  public $belongsTo=array('Exam'=>array('className'=>'exams',
                                        'order'=>array('Result.start_time'=>'desc')));
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
  public function userSubjectMarks($id,$subjectId,$sumField,$examId)
  {
    $limit=0;
    $ExamQuestion=ClassRegistry::init('ExamQuestion');
    $ExamStat=ClassRegistry::init('ExamStat');
    $ExamMaxquestion=ClassRegistry::init('ExamMaxquestion');
    $ExamStat->virtualFields=array('total_marks'=>"SUM(ExamStat.$sumField)");
    $examMaxQuestionArr=$ExamMaxquestion->find('first',array('fields'=>array('ExamMaxquestion.subject_id','ExamMaxquestion.max_question'),'conditions'=>array('ExamMaxquestion.exam_id'=>$examId,'ExamMaxquestion.subject_id'=>$subjectId)));
    if($examMaxQuestionArr && $examMaxQuestionArr['ExamMaxquestion']['max_question']!=0 && $sumField=="marks")
    {
        $quesNo=$examMaxQuestionArr['ExamMaxquestion']['max_question'];
        $subjectId=$examMaxQuestionArr['ExamMaxquestion']['subject_id'];
        $limit=' LIMIT '.$quesNo;
        $ExamStat->virtualFields= array();
        $ExamStat->virtualFields= array('total_marks'=>'SELECT SUM(`marks`) FROM (SELECT `Question`.`marks` FROM `exam_stats` AS `ExamStat` Inner JOIN `questions` AS `Question` ON (`ExamStat`.`question_id`=`Question`.`id`) WHERE `ExamStat`.`exam_result_id`='.$id.' AND `Question`.`subject_id`='.$subjectId.$limit.') subquery');
        $totalMarksArr=$ExamStat->find('first',array('fields'=>array('total_marks')));
        $userSubjectMarks=$totalMarksArr['ExamStat']['total_marks'];
        $ExamStat->virtualFields= array();
    }
    else
    {
      $userSubject=$ExamStat->find('first',array('fields'=>array('total_marks'),
                                  'joins'=>array(array('table'=>'questions','alias'=>'Question','type'=>'Inner',
                                                       'conditions'=>array('ExamStat.question_id=Question.id')),
                                                 array('table'=>'subjects','alias'=>'Subject','type'=>'Inner',
                                                       'conditions'=>array('Question.subject_id=Subject.id'))),
                                  'conditions'=>array('ExamStat.exam_result_id'=>$id,'Subject.id'=>$subjectId)));
      $userSubjectMarks=$userSubject['ExamStat']['total_marks'];
    }
    return$userSubjectMarks;
  }
  public function userSubjectQuestion($id,$subjectId,$examId)
  {
    $ExamStat=ClassRegistry::init('ExamStat');
    $ExamMaxquestion=ClassRegistry::init('ExamMaxquestion');
    $examMaxQuestionArr=$ExamMaxquestion->find('first',array('fields'=>array('ExamMaxquestion.subject_id','ExamMaxquestion.max_question'),'conditions'=>array('ExamMaxquestion.exam_id'=>$examId,'ExamMaxquestion.subject_id'=>$subjectId)));
    if($examMaxQuestionArr && $examMaxQuestionArr['ExamMaxquestion']['max_question']!=0)
    {
      $userSubjectQuestion=$examMaxQuestionArr['ExamMaxquestion']['max_question'];
    }
    else
    {
      $userSubjectQuestion=$ExamStat->find('count',array('joins'=>array(array('table'=>'questions','alias'=>'Question','type'=>'Inner','conditions'=>array('ExamStat.question_id=Question.id'))),
                                                         'conditions'=>array('ExamStat.exam_result_id'=>$id,'Question.subject_id'=>$subjectId)));
    }
    return$userSubjectQuestion;
  }
  public function userSubjectStatusQuestion($id,$subjectId,$quesStatus)
  {
    $ExamStat=ClassRegistry::init('ExamStat');
    $userSubjectQuestion=$ExamStat->find('count',array('joins'=>array(array('table'=>'questions','alias'=>'Question','type'=>'Inner','conditions'=>array('ExamStat.question_id=Question.id'))),
                                                         'conditions'=>array('ExamStat.exam_result_id'=>$id,'Question.subject_id'=>$subjectId,'ques_status'=>$quesStatus)));
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
  public function userSubjectScore($id,$subjectId,$quesStatus)
  {
    $ExamStat=ClassRegistry::init('ExamStat');
    $ExamStat->virtualFields=array('total_marks'=>"SUM(ExamStat.marks_obtained)");
    $userSubject=$ExamStat->find('first',array('fields'=>array('total_marks'),'joins'=>array(array('table'=>'questions','alias'=>'Question','type'=>'Inner','conditions'=>array('ExamStat.question_id=Question.id'))),
                                               'conditions'=>array('ExamStat.exam_result_id'=>$id,'Question.subject_id'=>$subjectId,'ques_status'=>$quesStatus)));
    $userSubjectMarks=$userSubject['ExamStat']['total_marks'];
    return$userSubjectMarks;
  }
  public function userSubjectUnattemptedQuestions($id,$subjectId)
  {
    $ExamStat=ClassRegistry::init('ExamStat');
    $userSubjectQuestion=$ExamStat->find('count',array('joins'=>array(array('table'=>'questions','alias'=>'Question','type'=>'Inner','conditions'=>array('ExamStat.question_id=Question.id'))),
                                                         'conditions'=>array('ExamStat.exam_result_id'=>$id,'Question.subject_id'=>$subjectId,'answered'=>0)));
    return$userSubjectQuestion;
  }
  public function userSubjectUnattemptedMarks($id,$subjectId)
  {
    $ExamStat=ClassRegistry::init('ExamStat');
    $ExamStat->virtualFields=array('left_marks'=>'SUM(ExamStat.marks)');
    $leftQuestionArr=$ExamStat->find('first',array('joins'=>array(array('table'=>'questions','alias'=>'Question','type'=>'Inner','conditions'=>array('ExamStat.question_id=Question.id'))),
                                                         'conditions'=>array('ExamStat.exam_result_id'=>$id,'Question.subject_id'=>$subjectId,'answered'=>0)));
    $ExamStat->virtualFields=array('');
    $unattemptedMarks=$leftQuestionArr['ExamStat']['left_marks'];
    if($unattemptedMarks==NULL)
    $unattemptedMarks="0";
    return$unattemptedMarks;
  }
  public function userSubjectTime($id,$subjectId)
  {
    $ExamStat=ClassRegistry::init('ExamStat');
    $ExamStat->virtualFields=array('total_time_taken'=>'SUM(ExamStat.time_taken)');
    $userSubject=$ExamStat->find('first',array('fields'=>array('total_time_taken'),
                                               'joins'=>array(array('table'=>'questions','alias'=>'Question','type'=>'Inner','conditions'=>array('ExamStat.question_id=Question.id'))),
                                               'conditions'=>array('ExamStat.exam_result_id'=>$id,'Question.subject_id'=>$subjectId)));
    $ExamStat->virtualFields=array();
    if($userSubject){
      $userSubjectTime=$userSubject['ExamStat']['total_time_taken'];
    }
    else{
      $userSubjectTime=null;
    }    
    return$userSubjectTime;
  }
  public function userMarksheet($id)
  {
    $ExamResult=ClassRegistry::init('ExamResult');
    $examResultArr=$ExamResult->find('first',array('fields'=>array('ExamResult.exam_id'),'conditions'=>array('ExamResult.id'=>$id)));
    $examId=$examResultArr['ExamResult']['exam_id'];
    $userSubject=$this->userSubject($id);
    $userMarksheet=array();
    $grandTotalMarks=0;$grandObtainedMarks=0;$grandTotalQuestion=0;$grandTimeTaken=0;$totalCorrectQuestion=0;$totalIncorrectQuestion=0;$totalMarksScored=0;
    $totalNegativeMarks=0;$totalUnattemptedQuestion=0;$totalUnattemptedQuestionMarks=0;
    foreach($userSubject as $k=>$subjectValue)
    {
        $totalMarks=$this->userSubjectMarks($id,$subjectValue['Subject']['id'],'marks',$examId);
        $obtainedMarks=$this->userSubjectMarks($id,$subjectValue['Subject']['id'],'marks_obtained',$examId);
        $totalQuestion=$this->userSubjectQuestion($id,$subjectValue['Subject']['id'],$examId);
        $allMarks=$this->userMarks($id);
        $marksScored=$this->userSubjectScore($id,$subjectValue['Subject']['id'],'R');
        if($marksScored=="")
        $marksScored=0;
        $negativeMarks=str_replace("-","",$this->userSubjectScore($id,$subjectValue['Subject']['id'],'W'));
        if($negativeMarks=="")
        $negativeMarks=0;
        $correctQuestion=$this->userSubjectStatusQuestion($id,$subjectValue['Subject']['id'],'R');
        $incorrectQuestion=$this->userSubjectStatusQuestion($id,$subjectValue['Subject']['id'],'W');
        $unattemptedQuestion=$this->userSubjectUnattemptedQuestions($id,$subjectValue['Subject']['id']);
        $unattemptedQuestionMarks=$this->userSubjectUnattemptedMarks($id,$subjectValue['Subject']['id']);
        if($unattemptedQuestionMarks=="")
        $unattemptedQuestionMarks=0;
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
        $userMarksheet[$k]['Subject']['marks_scored']=$marksScored;
        $userMarksheet[$k]['Subject']['negative_marks']=$negativeMarks;
        $userMarksheet[$k]['Subject']['percent']=$percent;
        $userMarksheet[$k]['Subject']['total_question']=$totalQuestion;
        $userMarksheet[$k]['Subject']['marks_weightage']=$marksWeightage;
        $userMarksheet[$k]['Subject']['time_taken']=$timeTaken;
        $userMarksheet[$k]['Subject']['correct_question']=$correctQuestion;
        $userMarksheet[$k]['Subject']['incorrect_question']=$incorrectQuestion;        
        $userMarksheet[$k]['Subject']['unattempted_question']=$unattemptedQuestion;
        $userMarksheet[$k]['Subject']['unattempted_question_marks']=$unattemptedQuestionMarks;
        $totalUnattemptedQuestionMarks=CakeNumber::precision($totalUnattemptedQuestionMarks+$unattemptedQuestionMarks,2);
        $totalCorrectQuestion=$totalCorrectQuestion+$correctQuestion;
        $totalIncorrectQuestion=$totalIncorrectQuestion+$incorrectQuestion;
        $totalMarksScored=CakeNumber::precision($totalMarksScored+$marksScored,2);
        $totalNegativeMarks=CakeNumber::precision($totalNegativeMarks+$negativeMarks,2);
        $totalUnattemptedQuestion=$totalUnattemptedQuestion+$unattemptedQuestion;
        
    }
    if($grandTotalMarks==0)
    $grandPercent=0;
    else
    $grandPercent=$percent=CakeNumber::precision(($grandObtainedMarks*100)/$grandTotalMarks,2);
    $userMarksheet['total']['Subject']=array('name'=>__('Grand Total'),'total_marks'=>$grandTotalMarks,'obtained_marks'=>$grandObtainedMarks,
                                             'percent'=>$grandPercent,'total_question'=>$grandTotalQuestion,'marks_weightage'=>100,'time_taken'=>$grandTimeTaken,
                                             'correct_question'=>$totalCorrectQuestion,'incorrect_question'=>$totalIncorrectQuestion,'marks_scored'=>$totalMarksScored,
                                             'negative_marks'=>$totalNegativeMarks,'unattempted_question'=>$totalUnattemptedQuestion,'unattempted_question_marks'=>$totalUnattemptedQuestionMarks);
    return$userMarksheet;
  }
  public function userSectionQuestion($id,$exam_id,$type,$studentId)
  {
    $ExamStat=ClassRegistry::init('ExamStat');
    if($type=="Exam")
    $subjectName=$this->getSubject($exam_id);
    else
    $subjectName=$this->getPrepSubject($exam_id);
    foreach($subjectName as $value)
    {    
      $userSectionQuestion[$value['Subject']['subject_name']]=$ExamStat->find('all',array('fields'=>array('ExamStat.ques_no','ExamStat.opened','ExamStat.answered','ExamStat.review','ExamStat.bookmark'),
                                                    'joins'=>array(array('table'=>'questions','alias'=>'Question','type'=>'Inner',
                                                                         'conditions'=>array('ExamStat.question_id=Question.id'))),
                                                    'conditions'=>array('ExamStat.exam_result_id'=>$id,'ExamStat.student_id'=>$studentId,'Question.subject_id'=>$value['Subject']['id'],'closed'=>1),
                                                    'order'=>array('ExamStat.ques_no asc')));
    }
    return $userSectionQuestion;
  }
  public function getSubject($id)
  {
    $ExamQuestion=ClassRegistry::init('ExamQuestion');
    $subjectDetail=$ExamQuestion->find('all',array(
                                                             'fields'=>array('DISTINCT(Subject.id)','Subject.subject_name'),
                                                             'joins'=>array(array('table'=>'questions','type'=>'Inner','alias'=>'Question',
                                                                                  'conditions'=>array('Question.id=ExamQuestion.question_id')),
                                                                            array('table'=>'subjects','type'=>'Inner','alias'=>'Subject',
                                                                                  'conditions'=>array('Subject.id=Question.subject_id'))),
                                                             'conditions'=>array('ExamQuestion.exam_id'=>$id),
                                                             'order'=>'Subject.subject_name asc'));
     return$subjectDetail;
  }
  public function getPrepSubject($id)
  {
    $ExamPrep=ClassRegistry::init('ExamPrep');
    $subjectDetail=$ExamPrep->find('all',array(
                                                             'fields'=>array('Subject.id','Subject.subject_name','ExamPrep.subject_id','ExamPrep.ques_no','ExamPrep.type','ExamPrep.level'),
                                                             'joins'=>array(array('table'=>'subjects','type'=>'Inner','alias'=>'Subject',
                                                                                  'conditions'=>array('Subject.id=ExamPrep.subject_id'))),
                                                             'conditions'=>array('ExamPrep.exam_id'=>$id),
                                                             'order'=>'Subject.subject_name asc'));
     return$subjectDetail;
  }
}
?>