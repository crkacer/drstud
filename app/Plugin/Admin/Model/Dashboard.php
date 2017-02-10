<?php
class Dashboard extends AppModel
{
    public $validationDomain = 'validation';
    public $useTable = false;
    public function viewdifftype($subject_id,$type,$userGroupWiseId)
    {
        $Question=ClassRegistry::init('Question');        
        $quesCount=$Question->find('count',array('joins'=>array(array('table'=>'diffs','type'=>'Inner','alias'=>'Diff','conditions'=>array('Diff.id=Question.diff_id')),
                                                            array('table'=>'question_groups','type'=>'LEFT','alias'=>'QuestionGroup','conditions'=>array('Question.id=QuestionGroup.question_id'))),
                                            'conditions'=>array('Question.subject_id'=>$subject_id,'Diff.type'=>$type,"QuestionGroup.group_id IN($userGroupWiseId)"),
                                            'group'=>'Question.id'));
        if($quesCount==NULL)
        $quesCount=0;
        return $quesCount;
    }
    public function studentGroups($userGroupWiseId)
    {
        $StudentGroup=ClassRegistry::init('Group');
        return$StudentGroup->find('all',array('fields'=>array('id','group_name'),'conditions'=>array("Group.id IN($userGroupWiseId)")));
    }
    public function studentGroupCount($groupId,$status=null)
    {
        $Student=ClassRegistry::init('Student');
        if($status==null)
        $statusCond=null;
        else
        $statusCond=array('Student.status'=>$status);
        return$Student->find('count',array('joins'=>array(array('table'=>'student_groups','alias'=>'StudentGroup','type'=>'Inner',
                                                          'conditions'=>array('Student.id=StudentGroup.student_id'))),
                                     'conditions'=>array('StudentGroup.group_id'=>$groupId,$statusCond)));
    }
    public function studentStatitics($userGroupWiseId)
    {
        $studentGroup=$this->studentGroups($userGroupWiseId);
        $studentStatitics=array();
        foreach($studentGroup as $k=>$groupValue)
        {
            $studentStatitics[$k]['GroupName']['name']=$groupValue['Group']['group_name'];
            $studentStatitics[$k]['GroupName']['total_student']=$this->studentGroupCount($groupValue['Group']['id']);
            $studentStatitics[$k]['GroupName']['active']=$this->studentGroupCount($groupValue['Group']['id'],'Active');
            $studentStatitics[$k]['GroupName']['pending']=$this->studentGroupCount($groupValue['Group']['id'],'Pending');
            $studentStatitics[$k]['GroupName']['suspend']=$this->studentGroupCount($groupValue['Group']['id'],'Suspend');
        }
        return$studentStatitics;
    }    
    
    public function recentExamResult($userGroupWiseId)
    {
        $Exam=ClassRegistry::init('Exam');
        $examList=$Exam->find('all',array('fields'=>array('id','name','start_date','end_date','passing_percent'),
                                          'joins'=>array(array('table'=>'exam_groups','type'=>'INNER','alias'=>'ExamGroup','conditions'=>array('Exam.id=ExamGroup.exam_id'))),
                             'conditions'=>array('Exam.status'=>'Closed',"ExamGroup.group_id IN($userGroupWiseId)"),
                             'order'=>array('Exam.end_date'=>'desc'),
                             'group'=>array('Exam.id'),
                             'limit'=>3));
        $recentExamResult=array();
        foreach($examList as $k=>$examvalue)
        {
            $recentExamResult[$k]['RecentExam']['Exam']['id']=$examvalue['Exam']['id'];
            $recentExamResult[$k]['RecentExam']['Exam']['name']=$examvalue['Exam']['name'];
            $recentExamResult[$k]['RecentExam']['Exam']['start_date']=$examvalue['Exam']['start_date'];
            $recentExamResult[$k]['RecentExam']['Exam']['end_date']=$examvalue['Exam']['end_date'];
            $recentExamResult[$k]['RecentExam']['OverallResult']['passing']=(float) $examvalue['Exam']['passing_percent'];
            $recentExamResult[$k]['RecentExam']['OverallResult']['average']=(float) $this->studentAverageResult($examvalue['Exam']['id']);
            $recentExamResult[$k]['RecentExam']['StudentStat']['pass']=$this->studentStat($examvalue['Exam']['id'],'Pass');
            $recentExamResult[$k]['RecentExam']['StudentStat']['fail']=$this->studentStat($examvalue['Exam']['id'],'Fail');
            $recentExamResult[$k]['RecentExam']['StudentStat']['absent']=(float) $this->examTotalAbsent($examvalue['Exam']['id']);
        }
        return$recentExamResult;
    }
}
