<?php
class StudentHomework extends AppModel {
  public $validationDomain = 'validation';

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
}
?>