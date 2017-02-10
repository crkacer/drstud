<?php
App::uses('CakeTime', 'Utility');
App::uses('CakeNumber', 'Utility');
class ResultsController extends AdminAppController
{
    public $components = array('HighCharts.HighCharts','RequestHandler' => array('viewClassMap' => array('pdf' => 'CakePdf.Pdf')));
    public function index($studentId=null)
    {
        try
        {
            $this->loadModel('Group');
            $this->set('group_id', $this->Group->find('list',array('fields'=>array('id','group_name'),'conditions'=>array("Group.id IN($this->userGroupWiseId)"))));
            $this->set('examOptions',$this->Result->examOptions($this->userGroupWiseId));
            $name=null;$studentGroup=null;$status=null;
            $this->set('isExam',false);
            $this->set('isStudent',false);
            if(isset($this->request->data['Result']['id']) || isset($this->request->data['id']))
            {
                $name=$this->request->data['Result']['id'];
                $isExamSearch=true;
                
            }
            if(isset($this->request->data['Result']['name']) && strlen($this->request->data['Result']['name'])>0)
            {
                $name=$this->request->data['Result']['name'];
                $isStudentSearch=true;
            }
            if(isset($this->request->data['StudentGroup']['group_name']) && is_array($this->request->data['StudentGroup']['group_name']))
            {
                $isSearch=true;
                foreach($this->request->data['StudentGroup']['group_name'] as $value)
                {
                    $studentGroup[]=$value;
                }           
            }
            if(isset($this->request->data['Result']['status']) && strlen($this->request->data['Result']['status'])>0)
            {
                $status=$this->request->data['Result']['status'];
                $isExamSearch=true;
            }
            if(isset($this->request->data['Result']['examWise']))
            {
                $examDetails=$this->Result->examWise($name,$studentGroup,$this->userGroupWiseId,$status);
                $this->set('examResult',$examDetails);
                $this->set('isExam',true);
            }
            if(isset($this->request->data['Result']['studentWise']))
            {
                $studentDetails=$this->Result->studentWise($name,$studentGroup,$this->userGroupWiseId);
                $this->set('studentDetails',$studentDetails);
                $this->set('isStudent',true);
            }
            if($studentId!=null)
            {
                $examDetails=$this->Result->studentExamWise($studentId,$studentGroup,$this->userGroupWiseId);
                $this->set('examResult',$examDetails);
                $this->set('studentId',$studentId);
            }
    }
    catch (Exception $e)
    {
            $this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
    }
    }
    public function view($id=null)
    {
      try
      {
        $this->layout=null;
        $this->loadModel('ExamResult');
        $this->loadModel('Diff');
        $diffValue=$this->Diff->find('all');
        $totalExam=$this->ExamResult->find('count',array('conditions'=>array('id'=>$id)));
        if($totalExam==0)
        {
          $this->Session->setFlash(__('Invalid Post'),'flash',array('alert'=>'danger'));
          return $this->redirect(array('action' => 'index'));
        }
        $easy=$this->Result->difficultyWiseQuestion($id,'E');
        $normal=$this->Result->difficultyWiseQuestion($id,'M');
        $difficult=$this->Result->difficultyWiseQuestion($id,'D');
        
        $chartData=array(array($diffValue[0]['Diff']['diff_level'],$easy),array($diffValue[1]['Diff']['diff_level'],$normal),array($diffValue[2]['Diff']['diff_level'],$difficult));
        $chartName = "Pie Chartqc";
        $pieChart = $this->HighCharts->create($chartName,'pie');
        $this->HighCharts->setChartParams(
                                          $chartName,
                                          array(
                                                'renderTo'=> "piewrapperqc",  // div to display chart inside
                                                'title'=> __('Question Difficulty Level'),
                                                'titleAlign'=> 'center',
                                                'creditsEnabled'=> FALSE,
                                                'legendEnabled'=>TRUE,
                                                'legendLayout'=> 'vertical',
                                                'legendVerticalAlign'=> 'middle',
                                                'legendAlign'=> 'right',
                                                'plotOptionsPieShowInLegend'=> TRUE,
                                                'plotOptionsPieDataLabelsEnabled'=> TRUE,
                                                'plotOptionsPieDataLabelsFormat'=>'<b>{point.name}</b>: {point.y}',
                                                )
                                          );
        $series = $this->HighCharts->addChartSeries();
        $series->addName('Total Question')->addData($chartData);
        $pieChart->addSeries($series);
        
        $studentDetail=$this->Result->studentDetail($id);
        $studentName=$studentDetail['Student']['name']." ".__('Performance');
        $studentId=$studentDetail['Student']['id'];
        $performanceChartData=array();
        $currentMonth=CakeTime::format('m',CakeTime::convert(time(),$this->siteTimezone));
        for($i=1;$i<=12;$i++)
        {
          if($i>$currentMonth)
          break;
          $examData=$this->Result->performanceCount($studentId,$i);
          $performanceChartData[]=(float) $examData;
        }
        $tooltipFormatFunction ="function() { return '<b>'+ this.series.name +'</b><br/>'+ this.x +': '+ this.y +'% Marks';}";
        $chartName = "My Chartdl";
        $mychart = $this->HighCharts->create($chartName,'line');
        $this->HighCharts->setChartParams(
                                          $chartName,
                                          array(
                                                'renderTo'=> "mywrapperdl",  // div to display chart inside
                                                'title'=> $studentName,
                                                'titleAlign'=> 'center',
                                                'creditsEnabled'=> FALSE,
                                                'xAxisLabelsEnabled'=> TRUE,
                                                'xAxisCategories'=> array(__('Jan'),__('Feb'),__('Mar'),__('Apr'),__('May'),__('Jun'),__('Jul'),__('Aug'),__('Sep'),__('Oct'),__('Nov'),__('Dec')),
                                                'yAxisTitleText'=> __('Percentage'),
                                                'tooltipEnabled'=> TRUE,
                                                'tooltipFormatter'=> $tooltipFormatFunction,
                                                'enableAutoStep'=> FALSE,
                                                'plotOptionsShowInLegend'=> TRUE,                                              
                                                )
                                          );
        $series = $this->HighCharts->addChartSeries();
        $series->addName('Exam')->addData($performanceChartData);      
        $mychart->addSeries($series);
      }
      catch (Exception $e)
      {
            $this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
            return $this->redirect(array('action' => 'index'));
      }
    }
    public function result($id=null)
    {
        try
        {
            $studentCount=$this->Result->find('count',array('conditions'=>array('Result.id'=>$id,'Result.user_id >'=>0)));
            if($id==null || $studentCount==0)
            {
                $this->Session->setFlash(__('Invalid Post'),'flash',array('alert'=>'danger'));
                $this->redirect(array('action' => 'index'));
            }
            $this->loadModel('ExamResult');
            $this->loadModel('ExamWarn');
            $examDetails=$this->ExamResult->find('first',array('fields'=>array('Exam.name','Student.id','Student.email','ExamResult.percent','ExamResult.obtained_marks','ExamResult.total_marks','Exam.passing_percent','Exam.duration',
                                                                               'ExamResult.result','ExamResult.start_time','ExamResult.end_time','Exam.declare_result','ExamFeedback.comments'),
                                                               'joins'=>array(array('table'=>'students','alias'=>'Student','type'=>'inner','conditions'=>array('Student.id=ExamResult.student_id')),
                                                                              array('table'=>'student_groups','alias'=>'StudentGroup','type'=>'inner','conditions'=>array('Student.id=StudentGroup.student_id')),
                                                                              array('table'=>'exams','alias'=>'Exam','type'=>'inner','conditions'=>array('Exam.id=ExamResult.exam_id')),
                                                                              array('table'=>'exam_feedbacks','alias'=>'ExamFeedback','type'=>'LEFT','conditions'=>array('ExamResult.id=ExamFeedback.exam_result_id'))),
                                                               'conditions'=>array('ExamResult.id'=>$id,"StudentGroup.group_id IN($this->userGroupWiseId)",'ExamResult.user_id >'=>0)));
            $userSubject=$this->Result->userSubject($id);
            $userMarksheet=$this->Result->userMarksheet($id);
            $this->set('examDetails',$examDetails);
            $this->set('userMarksheet',$userMarksheet);
            $this->set('id',$id);
            $this->set('examWarning',$this->ExamWarn->find('count',array('conditions'=>array('exam_result_id'=>$id))));
            
            foreach($userSubject as $subjectValue)
            {
                $xAxisCategories[]=$subjectValue['Subject']['subject_name'];
            }
            foreach($userMarksheet as $k=>$userMarkValue)
            {
                if(strlen($k)!=5)
                {
                    if($userMarkValue['Subject']['percent']<=33)
                    $color='rgb(235, 29, 29)';
                    elseif($userMarkValue['Subject']['percent']>=34 && $userMarkValue['Subject']['percent']<=59)
                    $color='rgb(247, 147, 39)';
                    else
                    $color='rgb(57, 174, 57)';
                    $chartData[]=array('y'=>(float) $userMarkValue['Subject']['obtained_marks'],'color'=>$color);
                    $chartData1[]=(float) $userMarkValue['Subject']['total_marks'];
                }
            }
            $chartRerData=array();$chartRerData1=array();
            $chartRerData=array(array((int)$examDetails['ExamResult']['obtained_marks'],$this->CustomFunction->secondsToHourMinute(CakeTime::fromString($examDetails['ExamResult']['end_time'])-CakeTime::fromString($examDetails['ExamResult']['start_time']))));
            $chartRerData1=array(array((int)$examDetails['ExamResult']['total_marks'],$this->CustomFunction->secondsToHourMinute($examDetails['Exam']['duration']*60)));
            $tooltipFormatFunction ="function() { return '<b>'+ this.series.name +'</b><br/>Score:'+ this.x +' Frequency:'+ this.y;}";
            $chartName = "My Chartor";
            $mychart = $this->HighCharts->create($chartName,'scatter');
            $this->HighCharts->setChartParams(
                                              $chartName,
                                              array(
                                                    'renderTo'=> "mywrapperor",  // div to display chart inside                                                
                                                    'creditsEnabled'=> FALSE,
                                                    'chartHeight'=> 200,
                                                    'legendEnabled'=> FALSE,
                                                    'xAxisTitleEnabled'=>TRUE,
                                                    'xAxisTitleText'=>__('Score'),
                                                    'tooltipEnabled'=> TRUE,
                                                    'tooltipFormatter'=> $tooltipFormatFunction,
                                                    )
                                              );
            
            $series = $this->HighCharts->addChartSeries();
            $series->addName(__('Candidate Marks Distribution'))->addData($chartRerData);
            $mychart->addSeries($series);
            
            $series1 = $this->HighCharts->addChartSeries();
            $series1->addName(__('Max Marks Distribution'))->addData($chartRerData1);
            $mychart->addSeries($series1);
            
            
            $chartName = "My Chartdl";
            $mychart = $this->HighCharts->create($chartName,'column');
            $this->HighCharts->setChartParams(
                                              $chartName,
                                              array(
                                                    'renderTo'=> "mywrapperdl",  // div to display chart inside
                                                    'xAxisCategories'=> $xAxisCategories,
                                                    'chartWidth'=> 500,
                                                    'yAxisTitleText'=> __('Score'),
                                                    'plotOptionsColumnDataLabelsEnabled'=> TRUE,                                                
                                                    'legendEnabled'=> FALSE,
                                                    'enableAutoStep'=> FALSE,
                                                    'creditsEnabled'=> FALSE,                                                
                                                    )
                                              );
            $series = $this->HighCharts->addChartSeries();
            $series1 = $this->HighCharts->addChartSeries();
            $series->addName(__('Marks Scored'))->addData($chartData);
            $series1->addName(__('Max Marks'))->addData($chartData1);
            
            $mychart->addSeries($series);
            $mychart->addSeries($series1);
            
            $this->loadModel('Question');
            $post=$this->Question->find('all',array('joins'=>array(array('table'=>'exam_stats','alias'=>'ExamStat','type'=>'Inner','conditions'=>array('Question.id=ExamStat.question_id')),
                                                                 array('table'=>'qtypes','alias'=>'Qtype','type'=>'Inner','conditions'=>array('Qtype.id=Question.qtype_id')),
                                                                 array('table'=>'diffs','alias'=>'Diff','type'=>'Inner','conditions'=>array('Diff.id=Question.diff_id')),
                                                                 array('table'=>'subjects','alias'=>'Subject','type'=>'Inner','conditions'=>array('Subject.id=Question.subject_id'))),
                                                    'fields'=>array('ExamStat.*','Question.*','Subject.*','Qtype.*','Diff.*'),
                                                    'conditions'=>array('ExamStat.exam_result_id'=>$id,'ExamStat.student_id'=>$examDetails['Student']['id']),
                                                    'order'=>array('ExamStat.ques_no'=>'asc')));
            $this->set('post',$post);
            
            $this->loadModel('ExamWarn');
            $this->set('examWarnArr',$this->ExamWarn->findByExamResultId($id));
        }
        catch (Exception $e)
        {
            $this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
            return $this->redirect(array('action' => 'index'));
        }
    }
    public function stdexamresult($id)
    {
        try
        {
             $this->layout='pdf';
             $this->result($id);
        }
        catch (Exception $e)
        {
            $this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
            return $this->redirect(array('action' => 'index'));
        }
    }
    public function downloadresult()
    {
        try
        {
            $this->layout='pdf';
            $name=null;$studentGroup=null;$status=null;
            if(strlen($this->params['named']['examId'])>0)
            {
                $name=$this->params['named']['examId'];
            }
            if(strlen($this->params['named']['status'])>0)
            {
                $status=$this->params['named']['status'];
            }
            if(strlen($this->params['named']['stuentGroup'])>0)
            {
                $studentGroupArr=explode(",",$this->params['named']['stuentGroup']);
                foreach($studentGroupArr as $value)
                {
                    $studentGroup[]=$value;
                }           
            }
            $examDetails=$this->Result->examWise($name,$studentGroup,$this->userGroupWiseId,$status);
            $this->pdfConfig = array('filename' =>'Result-' . rand().'.pdf');
            $this->set('examResult',$examDetails);
        }
        catch (Exception $e)
        {
            $this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
            return $this->redirect(array('action' => 'index'));
        }
    }
    public function dwstdresult($studentId)
    {
        try
        {
        $this->layout='pdf';
        $examDetails=$this->Result->studentExamWise($studentId,null,$this->userGroupWiseId);
        $this->pdfConfig = array('filename' => 'Student-Wise-Result-' . rand().'.pdf');
        $this->set('examResult',$examDetails);
        $this->set('studentId',$studentId);
        }
        catch (Exception $e)
        {
            $this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
            return $this->redirect(array('action' => 'index'));
        }
    }
    public function delete($id=null)
    {
        try
        {
            $studentCount=$this->Result->find('count',array('conditions'=>array('Result.id'=>$id)));
            if($id==null || $studentCount==0)
            {
                $this->Session->setFlash(__('Invalid Post'),'flash',array('alert'=>'danger'));
                $this->redirect(array('action' => 'index'));
            }
            $this->Result->delete($id);
            $this->Session->setFlash(__('Result has been deleted'),'flash',array('alert'=>'success'));
            return $this->redirect(array('action' => 'index'));
        }
        catch (Exception $e)
        {
            $this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
            return $this->redirect(array('action' => 'index'));
        }
    }
}