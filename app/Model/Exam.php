<?php
class Exam extends AppModel
{
  public $validationDomain = 'validation';
  public function getUserExam($type,$studentId,$currentDateTime,$limit=0)
  {
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
    $this->virtualFields= array('attempt'=>'SELECT COUNT(ExamResult.id) FROM `exam_results` AS `ExamResult` WHERE `ExamResult`.`exam_id`=`Exam.id` AND `ExamResult`.`student_id`='.$studentId,
                                'attempt_order'=>'SELECT COUNT(ExamOrder.id) FROM `exam_orders` AS `ExamOrder` WHERE `ExamOrder`.`exam_id`=`Exam.id` AND `ExamOrder`.`student_id`='.$studentId
                               );
    $examList=$this->find('all',array(
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
                                                 'conditions'=>array($start_date,$end_date,"StudentGroup.student_id=$studentId",'Exam.status'=>'Active','Exam.user_id'=>0),
                                                 'order'=>array('Exam.start_date'=>'asc'),
                                                 'group'=>array("Exam.id"),
                                                 'limit'=>$examLimit));
    return $examList;
  }
  public function getPurchasedExam($type,$studentId,$currentDateTime,$limit=0)
  {
    $start_date="";$end_date="";$examLimit="";$expiredDate="";
    if($type=="today")
    {
      $start_date=array('Exam.start_date <='=>$currentDateTime);
      $end_date=array('Exam.end_date >'=>$currentDateTime);
    }
    if($type=="upcoming")
    {
      $start_date=array('Exam.start_date >'=>$currentDateTime);
    }
    if($type=="expired")
    {
      $start_date=array('Exam.start_date <='=>$currentDateTime);
      $end_date=array('Exam.end_date >'=>$currentDateTime);
      $expiredDate="HAVING Max(ExamOrder.expiry_date) <'$currentDateTime'";
    }
    if($limit>0)
    $examLimit=$limit;
    $this->virtualFields=array();
    $this->virtualFields= array('attempt'=>'SELECT COUNT(ExamResult.id) FROM `exam_results` AS `ExamResult` WHERE `ExamResult`.`exam_id`=`Exam.id` AND `ExamResult`.`student_id`='.$studentId,
                                'attempt_order'=>'SELECT COUNT(ExamOrder.id) FROM `exam_orders` AS `ExamOrder` WHERE `ExamOrder`.`exam_id`=`Exam.id` AND `ExamOrder`.`student_id`='.$studentId,
                                'fexpiry_date'=>'Max(ExamOrder.expiry_date)');
    $examList=$this->find('all',array(
                                                'fields'=>array('Exam.id','Exam.fexpiry_date','Exam.name','Exam.start_date','Exam.end_date','Exam.paid_exam','Exam.amount','Exam.type','ExamOrder.expiry_date','Exam.attempt','Exam.attempt_count','Exam.attempt_order','Exam.expiry'),
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
                                                 'conditions'=>array($start_date,$end_date,"StudentGroup.student_id=$studentId",'Exam.status'=>'Active','Exam.user_id'=>0,'ExamOrder.student_id'=>$studentId),
                                                 'order'=>array('Exam.start_date'=>'asc'),
                                                 'group'=>array("Exam.id $expiredDate"),
                                                 'limit'=>$examLimit));
    return $examList;
  }
  public function getSubject($id)
  {
    $ExamQuestion=ClassRegistry::init('ExamQuestion');
    $subjectDetail=$ExamQuestion->find('all',array(
                                                             'fields'=>array('Subject.id','Subject.subject_name','ExamMaxquestion.max_question'),
                                                             'joins'=>array(array('table'=>'questions','type'=>'Inner','alias'=>'Question',
                                                                                  'conditions'=>array('Question.id=ExamQuestion.question_id')),
                                                                            array('table'=>'subjects','type'=>'Inner','alias'=>'Subject',
                                                                                  'conditions'=>array('Subject.id=Question.subject_id')),
                                                                            array('table'=>'exam_maxquestions','type'=>'left','alias'=>'ExamMaxquestion',
                                                                                  'conditions'=>array('ExamQuestion.exam_id=ExamMaxquestion.exam_id','Subject.id=ExamMaxquestion.subject_id')),
                                                                            ),
                                                             'conditions'=>array('ExamQuestion.exam_id'=>$id),
                                                             'group'=>array('Subject.id'),
                                                             'order'=>'Subject.subject_name asc'));
     return$subjectDetail;
  }
  public function getPrepSubject($id)
  {
    $ExamPrep=ClassRegistry::init('ExamPrep');
    $subjectDetail=$ExamPrep->find('all',array(
                                                             'fields'=>array('Subject.id','Subject.subject_name','ExamPrep.subject_id','ExamPrep.ques_no','ExamPrep.type','ExamPrep.level','ExamMaxquestion.max_question'),
                                                             'joins'=>array(array('table'=>'subjects','type'=>'Inner','alias'=>'Subject',
                                                                                  'conditions'=>array('Subject.id=ExamPrep.subject_id')),
                                                                            array('table'=>'exam_maxquestions','type'=>'Left','alias'=>'ExamMaxquestion','conditions'=>array('ExamPrep.exam_id=ExamMaxquestion.exam_id','ExamPrep.subject_id=ExamMaxquestion.subject_id')),                                               ),
                                                             'conditions'=>array('ExamPrep.exam_id'=>$id),
                                                             'order'=>'Subject.subject_name asc'));
     return$subjectDetail;
  }
  public function totalPrepQuestions($id,$studentId=null)
  {
    if($studentId==null)
    {
      $ExamPrep=ClassRegistry::init('ExamPrep');
      $ExamPrep->virtualFields= array('total_question'=>'SUM(ExamPrep.ques_no)');
      $totalQuestionArr=$ExamPrep->find('first',array(
                                                 'fields'=>array('total_question'),
                                                 'conditions'=>array('ExamPrep.exam_id'=>$id)));
       $totalQuestion=$totalQuestionArr['ExamPrep']['total_question'];
       return$totalQuestion;
    }
    else
    {
      $ExamResult=ClassRegistry::init('ExamResult');
      $ExamResultArr=$ExamResult->findByExamIdAndStudentIdAndEndTime($id,$studentId,NULL);
      $ExamPrep=ClassRegistry::init('ExamStat');
      $totalQuestion=$ExamPrep->find('count',array('conditions'=>array('ExamStat.exam_id'=>$id,'ExamStat.exam_result_id'=>$ExamResultArr['ExamResult']['id'],'student_id'=>$studentId)));
      return$totalQuestion;
    }
  }
  public function checkPost($id,$studentId)
  {
    $ExamGroup=ClassRegistry::init('ExamGroup');
    $checkPost=$ExamGroup->find('count',array(
                                                         'joins'=>array(array('table'=>'student_groups','alias'=>'StudentGroup',
                                                                              'conditions'=>array('ExamGroup.group_id=StudentGroup.group_id')),
                                                                        array('table'=>'exams','alias'=>'Exam',
                                                                              'conditions'=>array('ExamGroup.exam_id=Exam.id'))),
                                                         'conditions'=>array('ExamGroup.exam_id'=>$id,'StudentGroup.student_id'=>$studentId,'Exam.status'=>'Active','Exam.user_id'=>0)));
    return$checkPost;
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
      $totalMarks=$totalMarksArr['ExamQuestion']['total_marks'];
    }    
    return$totalMarks;
  }
  public function totalQuestion($id)
  {
    $ExamQuestion=ClassRegistry::init('ExamQuestion');
    $ExamMaxquestion=ClassRegistry::init('ExamMaxquestion');
    $examMaxQuestionArr=$ExamMaxquestion->find('all',array('fields'=>array('ExamMaxquestion.subject_id','ExamMaxquestion.max_question'),'conditions'=>array('ExamMaxquestion.exam_id'=>$id)));
    $totalQuestion=0;
    if($examMaxQuestionArr)
    {
      foreach($examMaxQuestionArr as $value)
      {
        $quesNo=$value['ExamMaxquestion']['max_question'];
        $subjectId=$value['ExamMaxquestion']['subject_id'];
        if($quesNo==0)
        $totalQuestionCount=$ExamQuestion->find('count',array('joins'=>array(array('table'=>'questions','alias'=>'Question','type'=>'Left','conditions'=>array('Question.id=ExamQuestion.question_id'))),'conditions'=>array('ExamQuestion.exam_id'=>$id,'Question.subject_id'=>$subjectId)));
        else
        $totalQuestionCount=$quesNo;        
        $totalQuestion=$totalQuestion+$totalQuestionCount;
      }
    }
    else
    {
      $totalQuestion=$ExamQuestion->find('count',array('joins'=>array(array('table'=>'questions','alias'=>'Question','type'=>'Left','conditions'=>array('Question.id=ExamQuestion.question_id'))),'conditions'=>array('ExamQuestion.exam_id'=>$id)));
    }    
    return$totalQuestion;
  }
  public function totalPrepAttemptQuestion($id)
  {
    $ExamMaxquestion=ClassRegistry::init('ExamMaxquestion');
    $ExamPrep=ClassRegistry::init('ExamPrep');
    $examMaxQuestionArr=$ExamMaxquestion->find('all',array('fields'=>array('ExamMaxquestion.subject_id','ExamMaxquestion.max_question'),'conditions'=>array('ExamMaxquestion.exam_id'=>$id)));
    $totalQuestion=0;
    if($examMaxQuestionArr)
    {
      foreach($examMaxQuestionArr as $value)
      {
        $quesNo=$value['ExamMaxquestion']['max_question'];
        $subjectId=$value['ExamMaxquestion']['subject_id'];
        if($quesNo==0)
        {
          $totalQuestionCountArr=$ExamPrep->find('first',array('conditions'=>array('ExamPrep.exam_id'=>$id,'ExamPrep.subject_id'=>$subjectId)));
          $totalQuestionCount=$totalQuestionCountArr['ExamPrep']['ques_no'];
        }
        else
        $totalQuestionCount=$quesNo;        
        $totalQuestion=$totalQuestion+$totalQuestionCount;
      }
    }
    else
    {
      $totalQuestion=0;
    }    
    return$totalQuestion;
  }
  public function subjectWiseQuestion($examId,$subjectId,$type='Prep')
  {
    if($type=="Exam")
    {
      $ExamQuestion=ClassRegistry::init('ExamQuestion');
      $ExamMaxquestion=ClassRegistry::init('ExamMaxquestion');
      $totalQuestion=$ExamQuestion->find('count',array('joins'=>array(array('table'=>'questions','alias'=>'Question','type'=>'Inner','conditions'=>array('ExamQuestion.question_id=Question.id'))),
                                                           'conditions'=>array('ExamQuestion.exam_Id'=>$examId,'Question.subject_id'=>$subjectId)));
      $examMaxQuestionArr=$ExamMaxquestion->find('first',array('fields'=>array('ExamMaxquestion.subject_id','ExamMaxquestion.max_question'),'conditions'=>array('ExamMaxquestion.exam_id'=>$examId,'ExamMaxquestion.subject_id'=>$subjectId)));
      if($examMaxQuestionArr && $examMaxQuestionArr['ExamMaxquestion']['max_question']!=0)
      $totalAttemptQuestion=$examMaxQuestionArr['ExamMaxquestion']['max_question'];
      else
      $totalAttemptQuestion=$totalQuestion;
    }
    else
    {
      $ExamPrep=ClassRegistry::init('ExamPrep');
      $ExamMaxquestion=ClassRegistry::init('ExamMaxquestion');
      $ExamPrepArr=$ExamPrep->find('first',array('conditions'=>array('ExamPrep.exam_id'=>$examId,'ExamPrep.subject_id'=>$subjectId)));
      $totalQuestion=$ExamPrepArr['ExamPrep']['ques_no'];
      $examMaxQuestionArr=$ExamMaxquestion->find('first',array('fields'=>array('ExamMaxquestion.subject_id','ExamMaxquestion.max_question'),'conditions'=>array('ExamMaxquestion.exam_id'=>$examId,'ExamMaxquestion.subject_id'=>$subjectId)));
      if($examMaxQuestionArr && $examMaxQuestionArr['ExamMaxquestion']['max_question']!=0)
      $totalAttemptQuestion=$examMaxQuestionArr['ExamMaxquestion']['max_question'];
      else
      $totalAttemptQuestion=$totalQuestion;
    }
    $questionArr=array('total_question'=>$totalQuestion,'total_attempt_question'=>$totalAttemptQuestion);
    return$questionArr;
  }
  public function userQuestion($id,$ques_random,$type)
  {
    $totalMarks=0;
    if($type=="Exam")
    {
      $ExamQuestion=ClassRegistry::init('ExamQuestion');
      $ExamQuestion->virtualFields= array();
      if($ques_random==1)
      {
        $userQuestion=$ExamQuestion->find('all',array('fields'=>array('exam_id','question_id','Question.marks','Question.answer','Question.true_false','Question.fill_blank','Qtype.type'),
                                                    'joins'=>array(array('table'=>'questions','alias'=>'Question','type'=>'Inner','conditions'=>array('ExamQuestion.question_id=Question.id')),
                                                                    array('table'=>'qtypes','alias'=>'Qtype','type'=>'Inner','conditions'=>array('Qtype.id=Question.qtype_id')),
                                                                   array('table'=>'subjects','alias'=>'Subject','type'=>'Inner','conditions'=>array('Question.subject_id=Subject.id'))),
                                                    'conditions'=>array('exam_id'=>$id),
                                                    'order'=>array('Subject.subject_name asc','rand()')));
      }
      else
      {
        $userQuestion=$ExamQuestion->find('all',array('fields'=>array('exam_id','question_id','Question.marks','Question.answer','Question.true_false','Question.fill_blank','Qtype.type'),
                                                    'joins'=>array(array('table'=>'questions','alias'=>'Question','type'=>'Inner','conditions'=>array('ExamQuestion.question_id=Question.id')),
                                                                    array('table'=>'qtypes','alias'=>'Qtype','type'=>'Inner','conditions'=>array('Qtype.id=Question.qtype_id')),
                                                                   array('table'=>'subjects','alias'=>'Subject','type'=>'Inner','conditions'=>array('Question.subject_id=Subject.id'))),
                                                    'conditions'=>array('exam_id'=>$id),
                                                    'order'=>array('Subject.subject_name asc','Question.id asc')));        
      }
    }
    else
    {
      $Question=ClassRegistry::init('Question');
      $ExamPrepArr=$this->getPrepSubject($id);
      if($ExamPrepArr)
      {
        foreach($ExamPrepArr as $value)
        {
          $type=$value['ExamPrep']['type'];
          $level=$value['ExamPrep']['level'];
          $userQuestionArr[]=$Question->find('all',array('fields'=>array('id','Question.marks','Question.answer','Question.true_false','Question.fill_blank','Qtype.type'),
                                                         'joins'=>array(array('table'=>'qtypes','alias'=>'Qtype','type'=>'Inner','conditions'=>array('Qtype.id=Question.qtype_id'))),
                                                         'conditions'=>array('subject_id'=>$value['ExamPrep']['subject_id'],"qtype_id IN($type)","diff_id IN($level)"),
                                                         'order'=>array('rand()'),
                                                         'limit'=>$value['ExamPrep']['ques_no']));
        }
      }
      unset($value);
      $totalMarks=0;
      $userQuestion=array();
      foreach($userQuestionArr as $value)
      {
        foreach($value as $value1)
        {
          $totalMarks=$totalMarks+$value1['Question']['marks'];
          $userQuestion[]=array('Question'=>array('marks'=>$value1['Question']['marks'],'question_id'=>$value1['Question']['id'],'answer'=>$value1['Question']['answer'],'true_false'=>$value1['Question']['true_false'],
                                                  'fill_blank'=>$value1['Question']['fill_blank']),
                                'Qtype'=>array('type'=>$value1['Qtype']['type']));
        }
      }
    }
    return array($userQuestion,$totalMarks);
  }
  function shuffleAssoc($isShuffle)
  {
    $array=array('1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6');
    if($isShuffle==1)
    {
        $keys = array_keys($array);
        shuffle($keys);
        foreach($keys as $key)
        {
            $new[$key] = $array[$key];
        }
        $array = $new;
    }
    return $array;
  }
  public function getOptionsStat($isShuffle)
  {
    $option=$this->shuffleAssoc($isShuffle);
    return implode(",",$option);
  }
  public function userExamInsert($id,$ques_random,$type,$optionShuffle,$studentId,$currentDateTime)
  {
    $userQuestionArr=$this->userQuestion($id,$ques_random,$type);
    $userQuestion=$userQuestionArr[0];
    if($type=="Exam")
    {
      $ExamQuestion=ClassRegistry::init('ExamQuestion');
      $totalQuestion=$ExamQuestion->find('count',array('conditions'=>array("exam_id=$id")));
      $totalAttemptQuestion=$this->totalQuestion($id);
      $totalMarks=$this->totalMarks($id);
    }
    else
    {
      $totalQuestion=$this->totalPrepQuestions($id);
      $totalAttemptQuestion=$this->totalPrepAttemptQuestion($id);
      $totalMarks=$userQuestionArr[1];
    }
    $ExamResult=ClassRegistry::init('ExamResult');
    $ExamStat=ClassRegistry::init('ExamStat');
    $ExamResultArr=array("ExamResult"=>array("exam_id"=>$id,"student_id"=>$studentId,"start_time"=>$currentDateTime,"total_question"=>$totalQuestion,'total_attempt'=>$totalAttemptQuestion,"total_marks"=>$totalMarks));
    $ExamResult->create();
    if($ExamResult->save($ExamResultArr))
    {
      $lastId=$ExamResult->getInsertID();
      if($type=="Exam")
      {
        foreach($userQuestion as $ques_no=>$examQuestionArr)
        {
          $ques_no++;
          if($examQuestionArr['Qtype']['type']=="M")
          $correct_answer=$examQuestionArr['Question']['answer'];
          elseif($examQuestionArr['Qtype']['type']=="T")
          $correct_answer=$examQuestionArr['Question']['true_false'];
          elseif($examQuestionArr['Qtype']['type']=="F")
          $correct_answer=$examQuestionArr['Question']['fill_blank'];
          else
          $correct_answer=null;
          $options=$this->getOptionsStat($optionShuffle);
          $recordArr[]=array('ExamStat'=>array("exam_result_id"=>$lastId,"exam_id"=>$examQuestionArr['ExamQuestion']['exam_id'],"student_id"=>$studentId,"ques_no"=>$ques_no,
                                "question_id"=>$examQuestionArr['ExamQuestion']['question_id'],'marks'=>$examQuestionArr['Question']['marks'],"correct_answer"=>$correct_answer,'options'=>$options));
        }
        $ExamStat->create();
        $ExamStat->saveAll($recordArr);
      }
      else
      {
        foreach($userQuestion as $ques_no=>$examQuestionArr)
        {
          $ques_no++;
          if($examQuestionArr['Qtype']['type']=="M")
          $correct_answer=$examQuestionArr['Question']['answer'];
          elseif($examQuestionArr['Qtype']['type']=="T")
          $correct_answer=$examQuestionArr['Question']['true_false'];
          elseif($examQuestionArr['Qtype']['type']=="F")
          $correct_answer=$examQuestionArr['Question']['fill_blank'];
          else
          $correct_answer=null;
          $options=$this->getOptionsStat($examQuestionArr['Question']['option_shuffle']);
          $recordArr[]=array('ExamStat'=>array("exam_result_id"=>$lastId,"exam_id"=>$id,"student_id"=>$studentId,"ques_no"=>$ques_no,
                                "question_id"=>$examQuestionArr['Question']['question_id'],'marks'=>$examQuestionArr['Question']['marks'],"correct_answer"=>$correct_answer,'options'=>$options));
        }
        $ExamStat->create();
        $ExamStat->saveAll();
      }
    }
  }
  public function userExamQuestion($exam_id,$studentId,$quesNo=0)
  {
    $ExamStat=ClassRegistry::init('ExamStat');
    $examQuestionCount=$ExamStat->find('count',array('conditions'=>array('exam_id'=>$exam_id,'student_id'=>$studentId,'ques_no'=>$quesNo,'closed'=>0)));
    if($examQuestionCount==0)
    $quesNo=1;
    $userExamQuestion=$ExamStat->find('first',array('fields'=>array('ExamStat.id','ExamStat.correct_answer','ExamStat.exam_result_id','ExamStat.answered','ExamStat.ques_no','ExamStat.option_selected','ExamStat.true_false','ExamStat.fill_blank',
                                                                    'ExamStat.marks','ExamStat.review','ExamStat.options',
                                                                    'Exam.negative_marking','ExamStat.answer','Subject.subject_name','Question.id',
                                                                    'Question.question','Question.option1','Question.option1','Question.option2','Question.option3','Question.option4','Question.option5','Question.option6','Question.negative_marks',
                                                                    'Question.answer','Question.true_false','Question.fill_blank','Question.hint','Qtype.type'),
                                                    'joins'=>array(array('table'=>'questions','alias'=>'Question','type'=>'Inner',
                                                                         'conditions'=>array('ExamStat.question_id=Question.id')),
                                                                   array('table'=>'subjects','alias'=>'Subject','type'=>'Inner',
                                                                         'conditions'=>array('Question.subject_id=Subject.id')),
                                                                   array('table'=>'qtypes','alias'=>'Qtype','type'=>'Inner',
                                                                         'conditions'=>array('Qtype.id=Question.qtype_id')),
                                                                   array('table'=>'exams','alias'=>'Exam','type'=>'Inner',
                                                                         'conditions'=>array('Exam.id=ExamStat.exam_id'))),
                                                    'conditions'=>array('exam_id'=>$exam_id,'student_id'=>$studentId,'ques_no'=>$quesNo,'closed'=>0),
                                                    'order'=>array('question_id asc')));
    return $userExamQuestion;
  }  
  public function userSectionQuestion($exam_id,$type,$studentId)
  {
    $ExamStat=ClassRegistry::init('ExamStat');
    if($type=="Exam")
    $subjectName=$this->getSubject($exam_id);
    else
    $subjectName=$this->getPrepSubject($exam_id);
    foreach($subjectName as $value)
    {    
      $userSectionQuestion[$value['Subject']['subject_name']]=$ExamStat->find('all',array('fields'=>array('ExamStat.ques_no','ExamStat.opened','ExamStat.answered','ExamStat.review'),
                                                    'joins'=>array(array('table'=>'questions','alias'=>'Question','type'=>'Inner',
                                                                         'conditions'=>array('ExamStat.question_id=Question.id'))),
                                                    'conditions'=>array('exam_id'=>$exam_id,'student_id'=>$studentId,'Question.subject_id'=>$value['Subject']['id'],'closed'=>0),
                                                    'order'=>array('ExamStat.ques_no asc')));
    }
    return $userSectionQuestion;
  }
  public function userSubject($exam_id,$quesNo,$studentId)
  {
    if($quesNo==0)
    $quesNo=1;
    $ExamStat=ClassRegistry::init('ExamStat');
    $subjectName=$ExamStat->find('first',array('fields'=>array('Subject.subject_name'),
                                                  'joins'=>array(array('table'=>'questions','alias'=>'Question','type'=>'Inner',
                                                                       'conditions'=>array('ExamStat.question_id=Question.id')),
                                                                 array('table'=>'subjects','alias'=>'Subject','type'=>'Inner',
                                                                         'conditions'=>array('Question.subject_id=Subject.id'))),
                                                  'conditions'=>array('exam_id'=>$exam_id,'student_id'=>$studentId,'ques_no'=>$quesNo,'closed'=>0)
                                                  ));
    return$subjectName['Subject']['subject_name'];
  }
  public function userQuestionRead($exam_id,$quesNo,$studentId,$currentDateTime)
  {
    if($quesNo==0)
    $quesNo=1;
    $usrQues=array('opened'=>1,'attempt_time'=>"'$currentDateTime'");
    $ExamStat=ClassRegistry::init('ExamStat');
    $ExamStat->updateAll($usrQues,array('exam_id'=>$exam_id,'student_id'=>$studentId,'ques_no'=>$quesNo,'closed'=>0));
  }
  public function userQuestionUpdate($exam_id,$quesNo,$studentId,$currentDateTime)
  {
    $ExamStat=ClassRegistry::init('ExamStat');
    if($quesNo==0)
    $quesNo=1;
    $currQuesArr=$ExamStat->find('first',array('fields'=>array('id','time_taken','attempt_time'),'conditions'=>array('exam_id'=>$exam_id,'student_id'=>$studentId,'ques_no'=>$quesNo,'closed'=>0,'opened'=>1)));
    if($currQuesArr){
      $timeTaken=$currQuesArr['ExamStat']['time_taken']+(strtotime($currentDateTime)-strtotime($currQuesArr['ExamStat']['attempt_time']));
      $ExamStat->save(array('id'=>$currQuesArr['ExamStat']['id'],'time_taken'=>$timeTaken));
    }
  }
  public function userSaveAnswer($exam_id,$quesNo,$studentId,$currentDateTime,$valueArr)
  {
    $ExamStat=ClassRegistry::init('ExamStat');
    $subjectArr=$ExamStat->find('first',array('joins'=>array(array('table'=>'questions','alias'=>'Question','type'=>'LEFT','conditions'=>array('Question.id=ExamStat.question_id')),
                                                             array('table'=>'exams','alias'=>'Exam','type'=>'LEFT','conditions'=>array('Exam.id=ExamStat.exam_id'))),
                                              'conditions'=>array('ExamStat.ques_no'=>$quesNo,'ExamStat.exam_id'=>$exam_id),
                                              'fields'=>array('Question.subject_id')));    
    $subjectId=$subjectArr['Question']['subject_id'];
    $ExamMaxquestion=ClassRegistry::init('ExamMaxquestion');
    $maxQuestionArr=$ExamMaxquestion->find('first',array('conditions'=>array('ExamMaxquestion.exam_id'=>$exam_id,'ExamMaxquestion.subject_id'=>$subjectId)));
    if($maxQuestionArr)
    $maxQuestion=$maxQuestionArr['ExamMaxquestion']['max_question'];
    else
    $maxQuestion=0;
    $maxAnswer=$ExamStat->find('count',array('joins'=>array(array('table'=>'questions','alias'=>'Question','type'=>'LEFT','conditions'=>array('Question.id=ExamStat.question_id'))),
                                          'conditions'=>array('ExamStat.exam_id'=>$exam_id,'ExamStat.student_id'=>$studentId,'ExamStat.closed'=>0,'ExamStat.answered'=>1,'Question.subject_id'=>$subjectId),
                                          ));
    if($maxAnswer>=$maxQuestion && $maxQuestion!=0)
    {
      return false;
    }
    else
    {
      $userExamQuestion=$this->userExamQuestion($exam_id,$studentId,$quesNo);
      $id=$userExamQuestion['ExamStat']['id'];    
      $usrQues=array("ExamStat"=>array('id'=>$id));
      $marksObtained=0;$isAnswer=false;$isAnswered=false;
      if(isset($valueArr['Exam']['option_selected']))
      {
        if(is_array($valueArr['Exam']['option_selected']))
        {
          $mainAnswerArr=explode(",",$userExamQuestion['Question']['answer']);
          $tempArr=$valueArr['Exam']['option_selected'];
          foreach($tempArr as $tempValue)
          {            
            if(in_array($tempValue,$mainAnswerArr))
            $isAnswer=true;
            else
            {
              $isAnswer=false;
              break;
            }
          }
          unset($mainAnswerArr,$tempArr,$tempValue);
          $usrQues['ExamStat']['option_selected']=implode(",",$valueArr['Exam']['option_selected']);
        }
        else
        {
          $usrQues['ExamStat']['option_selected']=$valueArr['Exam']['option_selected'];
          if($usrQues['ExamStat']['option_selected']==$userExamQuestion['Question']['answer'])
          $isAnswer=true;
        }        
        if($valueArr['Exam']['option_selected']!=NULL)
        $isAnswered=true;
      }
      if(isset($valueArr['Exam']['true_false']))
      {
          $usrQues['ExamStat']['true_false']=$valueArr['Exam']['true_false'];
          if(strtolower($usrQues['ExamStat']['true_false'])==strtolower($userExamQuestion['Question']['true_false']))
          $isAnswer=true;
          if($valueArr['Exam']['true_false']!=NULL)
          $isAnswered=true;
      }
      if(isset($valueArr['Exam']['fill_blank']))
      {
          $usrQues['ExamStat']['fill_blank']=$valueArr['Exam']['fill_blank'];
          if(str_replace(" ","",strtolower($usrQues['ExamStat']['fill_blank']))==str_replace(" ","",strtolower($userExamQuestion['Question']['fill_blank'])))
          $isAnswer=true;
          if($valueArr['Exam']['fill_blank']!=NULL)
          $isAnswered=true;
      }
      if(isset($valueArr['Exam']['answer']))
      {
        if($valueArr['Exam']['answer']!=NULL)
        $isAnswered=true;
      }
      $usrQues['ExamStat']['ques_status']=null;
      $marksObtained=null;
      if($isAnswered==true)
      {
        $usrQues['ExamStat']['answered']='1';
        $usrQues['ExamStat']['review']='0';
        if($isAnswer==true)
        {
          $marksObtained=$userExamQuestion['ExamStat']['marks'];
          $usrQues['ExamStat']['ques_status']='R'; 
        }
        else
        {
          if($userExamQuestion['Exam']['negative_marking']=="Yes" && !isset($valueArr['Exam']['answer']))
          {
              if($userExamQuestion['Question']['negative_marks']==0)
              $marksObtained=0;
              else
              $marksObtained=-($userExamQuestion['Question']['negative_marks']);
              
          }
          if(!isset($valueArr['Exam']['answer']))
          $usrQues['ExamStat']['ques_status']='W';
        }
      }
      $usrQues['ExamStat']['marks_obtained']=$marksObtained;
      if(isset($valueArr['Exam']['answer']))
      {
          $usrQues['ExamStat']['answer']=$valueArr['Exam']['answer'];        
      }    
      $ExamStat->save($usrQues);
      return true;
    }    
  }
  public function userResetAnswer($exam_id,$quesNo,$studentId)
  {
    $ExamStat=ClassRegistry::init('ExamStat');
    $currRecord=$ExamStat->find('first',array('fields'=>'id',
                                              'conditions'=>array('exam_id'=>$exam_id,'student_id'=>$studentId,'ques_no'=>$quesNo,'closed'=>0)));
    
    $id=$currRecord['ExamStat']['id'];    
    $usrQues=array("ExamStat"=>array('id'=>$id,'attempt_time'=>null,'answered'=>0,'option_selected'=>null,'answer'=>null,'true_false'=>null,
                                     'fill_blank'=>null,'marks_obtained'=>null,'ques_status'=>null));
    $ExamStat->save($usrQues);
  }
  public function userReviewAnswer($exam_id,$quesNo,$studentId,$review)
  {
    $ExamStat=ClassRegistry::init('ExamStat');
    $currRecord=$ExamStat->find('first',array('fields'=>'id',
                                              'conditions'=>array('exam_id'=>$exam_id,'student_id'=>$studentId,'ques_no'=>$quesNo,'closed'=>0)));
    
    $id=$currRecord['ExamStat']['id'];
    $usrQues=array("ExamStat"=>array('id'=>$id,'review'=>$review));
    $ExamStat->save($usrQues);
  }
  public function userExamFinish($exam_id,$studentId,$currentDateTime)
  {
    $ExamResult=ClassRegistry::init('ExamResult');
    $ExamStat=ClassRegistry::init('ExamStat');
    $Exam=ClassRegistry::init('Exam');
    $ExamResultRecord=$ExamResult->find('first',array('fields'=>array('id'),'conditions'=>array('exam_id'=>$exam_id,'student_id'=>$studentId,'end_time'=>null)));
    $id=$ExamResultRecord['ExamResult']['id'];
    $total_answered=$ExamStat->find('count',array('conditions'=>array('exam_result_id'=>$id,'answered'=>1)));
    $userResult=array('id'=>$id,'end_time'=>$currentDateTime,'total_answered'=>$total_answered);
    $ExamResult->save($userResult);
    $ExamStat->updateAll(array('ExamStat.closed'=>1),
                         array('ExamStat.exam_result_id'=>$id));
    
    $ExamRecord=$Exam->find('first',array('fields'=>array('finish_result'),'conditions'=>array('id'=>$exam_id)));
    $finish_result=$ExamRecord['Exam']['finish_result'];
    if($finish_result==1)
    {
      $examResultId=$id;
      $UserAdmin=ClassRegistry::init('User');
      $UserAdminRecord=$UserAdmin->find('first',array('fields'=>array('id')));
      $adminId=$UserAdminRecord['User']['id'];
      $post=$ExamResult->find('first',array('joins'=>array(array('table'=>'exams','alias'=>'Exam','type'=>'left',
                                                                         'conditions'=>array('ExamResult.exam_id=Exam.id'))),
                                                    'conditions'=>array('ExamResult.id'=>$examResultId),
                                                    'fields'=>array('ExamResult.total_marks','Exam.passing_percent')));
        $obtainedMarks=$this->obtainedMarks($examResultId);
        $percent=CakeNumber::precision(($obtainedMarks*100)/$post['ExamResult']['total_marks'],2);
        if($percent>=$post['Exam']['passing_percent'])
        $result="Pass";
        else
        $result="Fail";
        $examResultArr=array('id'=>$examResultId,'user_id'=>$adminId,'finalized_time'=>$currentDateTime,'obtained_marks'=>$obtainedMarks,'percent'=>$percent,'result'=>$result);
        $ExamResult->save($examResultArr);
    }
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