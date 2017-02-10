<?php
App::uses('CakeTime', 'Utility');
App::uses('CakeNumber', 'Utility');
class DashboardsController extends AdminAppController
{
    public $components = array('HighCharts.HighCharts');
    public function index()
    {
        try{
        // Upcoming Exam Statistic
        $this->loadModel('Exam');
        $this->loadModel('Student');
        $this->Exam->bindModel(array('hasAndBelongsToMany'=>array('Group'=>array('className'=>'Group',
                                                     'joinTable' => 'exam_groups',
                                                     'foreignKey' => 'exam_id',
                                                     'associationForeignKey' => 'group_id',
                                                     'conditions'=>"ExamGroup.group_id IN($this->userGroupWiseId)"))));        
        $this->Exam->virtualFields= array('total_marks' => 'SUM(Question.marks)');
        $UpcomingExam=$this->Exam->find('all',array(
                                                 'fields'=>array('Exam.id','name','start_date','duration','total_marks'),
                                                 'joins'=>array(array('table'=>'exam_groups','alias'=>'ExamGroup','type'=>'Inner',
                                                                      'conditions'=>array('Exam.id=ExamGroup.exam_id')),
                                                                array('table'=>'exam_questions','alias'=>'ExamQuestion','type'=>'LEFT',
                                                                      'conditions'=>array('Exam.id=ExamQuestion.Exam_id')),
                                                                array('table'=>'questions','alias'=>'Question','type'=>'LEFT',
                                                                      'conditions'=>array('ExamQuestion.question_id=Question.id'))),
                                                 'conditions'=>array('Exam.status'=>'Active',"ExamGroup.group_id IN($this->userGroupWiseId)"),
                                                 'order'=>array('Exam.start_date'=>'asc'),
                                                 'group'=>array('Exam.id'),
                                                 'limit'=>7));
        $totalInprogressExam=$this->Exam->find('count',array('joins'=>array(array('table'=>'exam_groups','alias'=>'ExamGroup','type'=>'Inner','conditions'=>array('Exam.id=ExamGroup.exam_id'))),
                                                               'conditions'=>array('Exam.start_date <='=>$this->currentDateTime,'Exam.end_date >'=>$this->currentDateTime,'Exam.status'=>'Active',"ExamGroup.group_id IN($this->userGroupWiseId)"),
                                                               'group'=>array('Exam.id')));
        $totalUpcomingExam=$this->Exam->find('count',array('joins'=>array(array('table'=>'exam_groups','alias'=>'ExamGroup','type'=>'Inner','conditions'=>array('Exam.id=ExamGroup.exam_id'))),
                                                               'conditions'=>array('Exam.start_date >'=>$this->currentDateTime,'Exam.status'=>'Active',"ExamGroup.group_id IN($this->userGroupWiseId)"),
                                                               'group'=>array('Exam.id')));
        $totalCompletedExam=$this->Exam->find('count',array('joins'=>array(array('table'=>'exam_groups','alias'=>'ExamGroup','type'=>'Inner','conditions'=>array('Exam.id=ExamGroup.exam_id'))),
                                                               'conditions'=>array('Exam.status'=>'Closed',"ExamGroup.group_id IN($this->userGroupWiseId)"),
                                                               'group'=>array('Exam.id')));
        if($totalInprogressExam==NULL)
        $totalInprogressExam="0";
        if($totalUpcomingExam==NULL)
        $totalUpcomingExam="0";
        if($totalCompletedExam==NULL)
        $totalCompletedExam="0";
        $this->set('totalInprogressExam',$totalInprogressExam);
        $this->set('totalUpcomingExam',$totalUpcomingExam);
        $this->set('totalCompletedExam',$totalCompletedExam);
        $this->set('UpcomingExam',$UpcomingExam);
        $this->set('totalStudents',$this->Student->find('count',array('joins'=>array(array('table'=>'student_groups','alias'=>'StudentGroup','type'=>'Left','conditions'=>array('StudentGroup.student_id=Student.id'))),
                                                                      'conditions'=>array("StudentGroup.group_id IN($this->userGroupWiseId)"),
                                                                      'group'=>array('Student.id'))));
        // End Exam Statistic
        
        // Start Student Statistic
        $studentStatitics=$this->Dashboard->studentStatitics($this->userGroupWiseId);
        $totalStudentSort=array();
        foreach($studentStatitics as $key => $row)
        {
            $totalStudentSort[$key] = $row['GroupName']['total_student'];
        }
        unset($key,$row);
        array_multisort($totalStudentSort,SORT_DESC,$studentStatitics);
        unset($totalStudentSort);
        $groupxAxis=array();
        $activeData=array();$pendingData=array();$suspendData=array();
        $temp=0;
        foreach($studentStatitics as $studentValue)
        {
            $temp++;
            $groupxAxis[]=$studentValue['GroupName']['name'];
            $activeData[]=$studentValue['GroupName']['active'];
            $pendingData[]=$studentValue['GroupName']['pending'];
            $suspendData[]=$studentValue['GroupName']['suspend'];
            if($temp==10)
            break;
        }
        unset($temp);
        $this->set('studentStatitics',$studentStatitics);
        $chartName = "My Chartd2";
        $mychart = $this->HighCharts->create($chartName,'column');
        $this->HighCharts->setChartParams(
                                          $chartName,
                                          array(
                                                'renderTo'=> "mywrapperd2",  // div to display chart inside
                                                'title'=>__('Student Details'),
                                                'xAxisLabelsEnabled'=> TRUE,
                                                'xAxisCategories'=> $groupxAxis,
                                                'yAxisTitleText'=> '',
                                                'creditsEnabled'=> FALSE,
                                                'tooltipEnabled' =>TRUE,
                                                'tooltipShared'=>TRUE,
                                                'tooltipUseHTML'=> TRUE,
                                                'plotOptionsColumnPointPadding'=>0.4,
                                                'legendEnabled'=> TRUE,                                                
                                                )
                                          );
        $activeSeries = $this->HighCharts->addChartSeries();
        $pendingSeries = $this->HighCharts->addChartSeries();
        $suspendSeries  = $this->HighCharts->addChartSeries();        
        $activeSeries->addName(__('Active'))->addData($activeData);
        $pendingSeries->addName(__('Pending'))->addData($pendingData);
        $suspendSeries->addName(__('Suspend'))->addData($suspendData);        
        $mychart->addSeries($activeSeries);
        $mychart->addSeries($pendingSeries);
        $mychart->addSeries($suspendSeries);
        // End Student Statistic
        
        // Start Recent Exam Result Result
        $recentExamResult=$this->Dashboard->recentExamResult($this->userGroupWiseId);
        foreach($recentExamResult as $recentValue)
        {
            $chartRerData=array();
            $chartRerData[]=array(__('Pass'),$recentValue['RecentExam']['StudentStat']['pass']);
            $chartRerData[]=array(__('Fail'),$recentValue['RecentExam']['StudentStat']['fail']);
            $chartRerData[]=array(__('Absent'),$recentValue['RecentExam']['StudentStat']['absent']);
            $id=$recentValue['RecentExam']['Exam']['id'];
            $chartName = "My Chartss$id";
            $mychart = $this->HighCharts->create($chartName,'pie');
            $this->HighCharts->setChartParams(
                                              $chartName,
                                              array(
                                                    'renderTo'=> "mywrapperss$id",  // div to display chart inside                                                
                                                    'creditsEnabled'=> FALSE,
                                                    'chartWidth'=> 300,
                                                    'chartHeight'=> 200,
                                                    'plotOptionsPieShowInLegend'=> TRUE,
                                                    'plotOptionsPieDataLabelsEnabled'=> TRUE,
                                                    'plotOptionsPieDataLabelsFormat'=>'{point.name}:<b>{point.percentage:.1f}%</b>',
                                                    )
                                              );
            
            $series = $this->HighCharts->addChartSeries();
            $series->addName(__('Student'))->addData($chartRerData);
            $mychart->addSeries($series);
            
            $chartRerData=array();$chartRerData1=array();
            $chartRerData=array($recentValue['RecentExam']['OverallResult']['passing']);
            $chartRerData1=array($recentValue['RecentExam']['OverallResult']['average']);
            $id=$recentValue['RecentExam']['Exam']['id'];
            $chartName = "My Chartor$id";
            $mychart = $this->HighCharts->create($chartName,'bar');
            $this->HighCharts->setChartParams(
                                              $chartName,
                                              array(
                                                    'renderTo'=> "mywrapperor$id",  // div to display chart inside                                                
                                                    'creditsEnabled'=> FALSE,
                                                    'chartWidth'=> 350,
                                                    'chartHeight'=> 200,
                                                    'legendEnabled'=> TRUE,                                                    
                                                    'plotOptionsBarDataLabelsEnabled'=> TRUE,                                                    
                                                    )
                                              );
            
            $series = $this->HighCharts->addChartSeries();
            $series1 = $this->HighCharts->addChartSeries();
            $series->addName(__('Passing %age'))->addData($chartRerData);
            $series1->addName(__('Average %age'))->addData($chartRerData1);
            $mychart->addSeries($series);
            $mychart->addSeries($series1);
        }        
        $this->set('recentExamResult',$recentExamResult);
        // End Recent Exam Result Result
        
        // Start Question Bank
        $this->loadModel('Subject');
        $this->loadModel('Diff');
        $this->Subject->virtualFields= array('qbank_count' => 'Count(DISTINCT(Question.id))');
        $Subject=$this->Subject->find('all',array('fields'=>array('id','subject_name'),
                                                                   'joins'=>array(array('table'=>'subject_groups','type'=>'INNER','alias'=>'SubjectGroup','conditions'=>array('Subject.id=SubjectGroup.subject_id')),
                                                                                  array('table'=>'questions','type'=>'LEFT','alias'=>'Question','conditions'=>array('Subject.id=Question.subject_id'))),
                                                                   'conditions'=>array("SubjectGroup.group_id IN($this->userGroupWiseId)"),
                                                                   'group'=>'Subject.id',
                                                                   'order'=>array('qbank_count'=>'desc')));
        $DiffLevel=$this->Diff->find('all');
        $chartData=array();$subjectxAxis=array();
        $easyData=array();$mediumData=array();$difficultData=array();
        $DifficultyDetail=array();
        foreach($Subject as $value)
        {
            $subjectId=$value['Subject']['id'];
            $subjectName=$value['Subject']['subject_name'];
            $easy=$this->Dashboard->viewdifftype($subjectId,'E',$this->userGroupWiseId);
            $medium=$this->Dashboard->viewdifftype($subjectId,'M',$this->userGroupWiseId);
            $difficult=$this->Dashboard->viewdifftype($subjectId,'D',$this->userGroupWiseId);
            $DifficultyDetail[$subjectName][]=$easy;
            $DifficultyDetail[$subjectName][]=$medium;
            $DifficultyDetail[$subjectName][]=$difficult;
            $totalQuestion=$easy+$medium+$difficult;
            $DifficultyDetail[$subjectName]['total_question']=$totalQuestion;
            $chartData[]=array($subjectName,$totalQuestion,$subjectId);
            $subjectxAxis[]=$subjectName;
            $totalQuestionArr[]=$totalQuestion;            
        }
        array_multisort($totalQuestionArr,SORT_DESC,$chartData);
        $chartData=array_slice($chartData,0,10);
        foreach($chartData as $value)
        {
            $subjectId=$value[2];
            $easy=$this->Dashboard->viewdifftype($subjectId,'E',$this->userGroupWiseId);
            $medium=$this->Dashboard->viewdifftype($subjectId,'M',$this->userGroupWiseId);
            $difficult=$this->Dashboard->viewdifftype($subjectId,'D',$this->userGroupWiseId);
            $easyData[]=$easy;
            $mediumData[]=$medium;
            $difficultData[]=$difficult;
        }
        $chartName = "Pie Chartqc";
        $pieChart = $this->HighCharts->create($chartName,'pie');
        $this->HighCharts->setChartParams(
                                          $chartName,
                                          array(
                                                'renderTo'=> "piewrapperqc",  // div to display chart inside
                                                
                                                'title'=>__('Question Count'),
                                                'titleAlign'=> 'center',
                                                'creditsEnabled'=> FALSE,
                                                'plotOptionsShowInLegend'=> TRUE,
                                                'plotOptionsPieShowInLegend'=> TRUE,
                                                'plotOptionsPieDataLabelsEnabled'=> TRUE,
                                                'plotOptionsPieDataLabelsFormat'=>'{point.name}:<b>{point.y}</b>',
                                                )
                                          );
        
        $series = $this->HighCharts->addChartSeries();
        $series->addName(__('Total Question'))->addData($chartData);
        $pieChart->addSeries($series);
        
        $chartName = "My Chartdl";
        $mychart = $this->HighCharts->create($chartName,'areaspline');
        $this->HighCharts->setChartParams(
                                          $chartName,
                                          array(
                                                'renderTo'=> "mywrapperdl",  // div to display chart inside                                                
                                                'title'=>__('Question Bank Difficulty Wise'),
                                                'xAxisLabelsEnabled'=> TRUE,
                                                'xAxisCategories'=> $subjectxAxis,
                                                'yAxisTitleText'=> '',
                                                'enableAutoStep'=> FALSE,
                                                'creditsEnabled'=> FALSE,
                                                'legendEnabled'=> TRUE,
                                                'tooltipEnabled' =>TRUE,
                                                'tooltipShared'=>TRUE,
                                                'tooltipUseHTML'=> TRUE
                                                )
                                          );
        $easySeries = $this->HighCharts->addChartSeries();
        $mediumSeries = $this->HighCharts->addChartSeries();
        $difficultSeries  = $this->HighCharts->addChartSeries();
        
        $easySeries->addName(__('Easy'))->addData($easyData);
        $mediumSeries->addName(__('Medium'))->addData($mediumData);
        $difficultSeries->addName(__('Hard'))->addData($difficultData);
        
        $mychart->addSeries($easySeries);
        $mychart->addSeries($mediumSeries);
        $mychart->addSeries($difficultSeries);
        $this->set('Subject',$Subject);
        $this->set('DifficultyDetail',$DifficultyDetail);
        $this->set('DiffLevel',$DiffLevel);
        // End Question Bank
        }
        catch (Exception $e)
        {
            $this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
        }   
    }    
}