<?php
App::uses('CakeTime', 'Utility');
App::uses('Paypal', 'Paypal.Lib');
class DashboardsController extends AppController
{
    public $components = array('HighCharts.HighCharts');
    public $currentDateTime,$studentId;
    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->authenticate();
        $this->studentId=$this->userValue['Student']['id'];
        $this->limit=5;
    }
    public function index()
    {
        $this->loadModel('Payment');
        $this->loadModel('PaypalConfig');
        $this->loadModel('StudentGroup');
        $this->loadModel('GroupsPayment');
        $this->Payment->virtualFields= array('fexpiry_date'=>'SELECT `GroupsPayment`.`expiry_date` FROM `groups_payments` AS `GroupsPayment` WHERE `GroupsPayment`.`payment_id`=`Payment`.`id` ORDER BY `GroupsPayment`.`id` DESC LIMIT 1',
                                             'flast_payment_date'=>'SELECT `GroupsPayment`.`expiry_date` FROM `groups_payments` AS `GroupsPayment` WHERE `GroupsPayment`.`payment_id`=`Payment`.`id` ORDER BY `GroupsPayment`.`id` DESC LIMIT 1');
        $paymentArr=$this->Payment->find('all',array('fields'=>array('Payment.*','Payment.fexpiry_date','Payment.flast_payment_date','GroupsPayment.*'),
                                                     'joins'=>array(array('table'=>'groups_payments','alias'=>'GroupsPayment','type'=>'INNER','conditions'=>array('Payment.id=GroupsPayment.payment_id'))),
                                                     'conditions'=>array('Payment.student_id'=>$this->studentId,'Payment.status'=>'Approved','Payment.payment_type'=>'Recurring'),
                                                     'group'=>array("Payment.id HAVING Max(Payment__fexpiry_date) <='$this->currentDate'")));
        if($paymentArr)
        {
            $paySetting=$this->PaypalConfig->findById('1');
            if(strlen($paySetting['PaypalConfig']['username'])>0 && strlen($paySetting['PaypalConfig']['password'])>0 && strlen($paySetting['PaypalConfig']['signature'])>0)
            {
                if($paySetting['PaypalConfig']['sandbox_mode']==1)
                $sandboxMode=true;
                else
                $sandboxMode=false;        
                $this->Paypal = new Paypal(array(
                                                 'sandboxMode' => $sandboxMode,
                                                 'nvpUsername' => $paySetting['PaypalConfig']['username'],
                                                 'nvpPassword' => $paySetting['PaypalConfig']['password'],
                                                 'nvpSignature' => $paySetting['PaypalConfig']['signature']
                                                 ));
                
                $payPal=true;
            }
            foreach($paymentArr as $value)
            {
                $profileId=$value['Payment']['transaction_id'];
                $lastPaymentDate=$value['Payment']['flast_payment_date'];
                $expiryDays=$value['GroupsPayment']['expiry_days'];
                $profileDetails=$this->Paypal->GetRecurringPaymentsProfileDetails($profileId);
                if(isset($profileDetails['LASTPAYMENTDATE']))
                {
                    if($profileDetails['STATUS']=="Active" && $profileDetails['LASTPAYMENTDATE']!=$lastPaymentDate)
                    {
                        $studentExpiryDate=$value['GroupsPayment']['expiry_date'];
                        $studentExpiryDateStr=0;
                        if($studentExpiryDate!=NULL && strtotime($studentExpiryDate)>strtotime($this->currentDate))
                        $studentExpiryDateStr=strtotime($studentExpiryDate)-strtotime($this->currentDate);
                        $expiryDate=date('Y-m-d',strtotime($this->currentDate."+$expiryDays days")+$studentExpiryDateStr);
                        if($value['GroupsPayment']['group_id']=="Approved")
                        {
                            $recordeoArr=array('GroupsPayment'=>array('payment_id'=>$value['Payment']['id'],'group_id'=>$value['GroupsPayment']['group_id'],'price'=>$value['GroupsPayment']['price'],
                                                                  'qty'=>$value['GroupsPayment']['qty'],'amount'=>$value['GroupsPayment']['amount'],'date'=>$this->currentDate,'expiry_days'=>$expiryDays,'expiry_date'=>$expiryDate,'last_payment_date'=>$profileDetails['LASTPAYMENTDATE']));
                        }
                        else
                        {
                            $recordeoArr=array('GroupsPayment'=>array('id'=>$value['GroupsPayment']['id'],'expiry_date'=>$expiryDate,'last_payment_date'=>$profileDetails['LASTPAYMENTDATE'],'status'=>'Approved'));
                        }
                        $studentGroupArr=$this->StudentGroup->findByGroupIdAndStudentId($value['GroupsPayment']['group_id'],$this->studentId);
                        if($studentGroupArr)
                        {
                            $studentGroup=array('id'=>$studentGroupArr['StudentGroup']['id'],'expiry_date'=>$expiryDate);
                        }
                        else
                        {
                            $studentGroup=array('student_id'=>$this->studentId,'group_id'=>$value['GroupsPayment']['group_id'],'date'=>$this->currentDate,'expiry_date'=>$expiryDate);
                        }
                        $this->GroupsPayment->save($recordeoArr);
                        $this->StudentGroup->save($studentGroup);
                    }
                    else
                    {
                        $this->Session->setFlash(__('Waiting for payment confirmation'),'flash',array('alert'=>'success'));
                    }
                }
                else
                {
                    $this->Session->setFlash(__('Waiting for payment confirmation'),'flash',array('alert'=>'warning'));
                }
                if($profileDetails['STATUS']!="Active")
                {
                    $this->Payment->save(array('id'=>$value['Payment']['id'],'payment_type'=>'Cancelled'));
                }
            }
        }
        
        
        //$this->loadModel('Exam');
        //$todayExam=$this->Exam->getUserExam("today",$this->studentId,$this->currentDateTime,$this->limit);
        //$upcomingExam=$this->Exam->getUserExam("upcoming",$this->studentId,$this->currentDateTime,$this->limit);
        //$this->set('upcomingExam',$upcomingExam);
        //$this->set('todayExam',$todayExam);
        
        $totalExamGiven=$this->Dashboard->find('count',array('conditions'=>array('Dashboard.student_id'=>$this->studentId)));
        $failedExam=$this->Dashboard->find('count',array('conditions'=>array('Dashboard.student_id'=>$this->studentId,'Dashboard.result'=>'Fail')));
        $userTotalAbsent=$this->Dashboard->userTotalAbsent($this->studentId);
        if($userTotalAbsent<0)
        $userTotalAbsent=0;
        $bestScoreArr=$this->Dashboard->userBestExam($this->studentId);
        $bestScore="";
        $bestScoreDate="";
        if(isset($bestScoreArr['Exam']['name']))
        {
            $bestScore=$bestScoreArr['Exam']['name'];
            $bestScoreDate=CakeTime::format($this->sysDay.$this->dateSep.$this->sysMonth.$this->dateSep.$this->sysYear.$this->dateGap.$this->sysHour.$this->timeSep.$this->sysMin.$this->dateGap.$this->sysMer,$bestScoreArr['ExamResult']['start_time']);
        }
        $this->set('limit',$this->limit);
        $this->set('totalExamGiven',$totalExamGiven);
        $this->set('failedExam',$failedExam);
        $this->set('userTotalAbsent',$userTotalAbsent);
        $this->set('bestScore',$bestScore);
        $this->set('bestScoreDate',$bestScoreDate);
        
        $performanceChartData=array();
        $currentMonth=CakeTime::format('m',time());
        for($i=1;$i<=12;$i++)
        {
          if($i>$currentMonth)
          break;
          $examData=$this->Dashboard->performanceCount($this->studentId,$i);
          $performanceChartData[]=(float) $examData;
        }
        $tooltipFormatFunction ="function() { return '<b>'+ this.series.name +'</b><br/>'+ this.x +': '+ this.y +'%';}";
        $chartName = "My Chartdl";
        $mychart = $this->HighCharts->create($chartName,'spline');
        $this->HighCharts->setChartParams(
                                          $chartName,
                                          array(
                                                'renderTo'=> "mywrapperdl",  // div to display chart inside
                                                'titleAlign'=> 'center',
                                                'creditsEnabled'=> FALSE,
                                                'xAxisLabelsEnabled'=> TRUE,
                                                'xAxisCategories'=> array(__('Jan'),__('Feb'),__('Mar'),__('Apr'),__('May'),__('Jun'),__('Jul'),__('Aug'),__('Sep'),__('Oct'),__('Nov'),__('Dec')),
                                                'yAxisTitleText'=>__('Percentage'),
                                                'tooltipEnabled'=> TRUE,
                                                'tooltipFormatter'=> $tooltipFormatFunction,
                                                'enableAutoStep'=> FALSE,
                                                'plotOptionsShowInLegend'=> TRUE,
                                                'yAxisMax'=> 100,
                                                )
                                          );
        $series = $this->HighCharts->addChartSeries();
        $series->addName(__('Month'))->addData($performanceChartData);      
        $mychart->addSeries($series);
        
        $this->loadModel('ExamResult');
        $examResultArr=$this->ExamResult->find('all',array('fields'=>array('Exam.name','ExamResult.percent'),
                                                           'joins'=>array(array('table'=>'exams','alias'=>'Exam','type'=>'INNER','conditions'=>array('ExamResult.exam_id=Exam.id'))),
                                                           'conditions'=>array('ExamResult.student_id'=>$this->studentId),
                                                           'order'=>array('ExamResult.id'=>'desc'),
                                                           'limit'=>10));
        $this->ExamResult->virtualFields=array('total_percent'=>'SUM(ExamResult.percent)');
        $totalPercentArr=$this->ExamResult->find('first',array('fields'=>array('total_percent'),'conditions'=>array('ExamResult.student_id'=>$this->studentId)));
        $this->ExamResult->virtualFields=array();
        $totalExamAttempt=$this->ExamResult->find('count',array('conditions'=>array('ExamResult.student_id'=>$this->studentId)));
        $totalPercent=$totalPercentArr['ExamResult']['total_percent'];
        if($totalExamAttempt>0)
        $averagePercent=round($totalPercent/$totalExamAttempt,2);
        else
        $averagePercent=0;
        $performanceChartData=array();$xAxisCategories=array();
        foreach($examResultArr as $post)
        {
           $xAxisCategories[]=array($post['Exam']['name']);
           $performanceChartData[]=array((float) $post['ExamResult']['percent']);
        }
        $tooltipFormatFunction ="function() { return ''+ this.x +': '+ this.y +'%';}";
        $chartName = "My Chartd2";
        $mychart = $this->HighCharts->create($chartName,'column');
        $this->HighCharts->setChartParams(
                                          $chartName,
                                          array(
                                                'renderTo'=> "mywrapperd2",  // div to display chart inside
                                                'titleAlign'=> 'center',
                                                'creditsEnabled'=> FALSE,
                                                'xAxisLabelsEnabled'=> TRUE,
                                                'xAxisCategories'=> $xAxisCategories,
                                                'yAxisTitleText'=>__('Percentage'),
                                                'tooltipEnabled'=> TRUE,
                                                'tooltipFormatter'=> $tooltipFormatFunction,
                                                'enableAutoStep'=> FALSE,
                                                'plotOptionsShowInLegend'=> TRUE,
                                                'yAxisMax'=> 100,
                                                )
                                          );
        $series = $this->HighCharts->addChartSeries();
        $series->addName(__('Quiz'))->addData($performanceChartData);      
        $mychart->addSeries($series);
        
        $rank=0;
        $rankPost=$this->ExamResult->query("SELECT `percent`,`student_id`, FIND_IN_SET(`percent`,(SELECT GROUP_CONCAT(`percent` ORDER BY `percent` DESC) FROM `exam_results`)) AS `rank` FROM `exam_results`  WHERE `student_id`=$this->studentId HAVING `rank` IS NOT NULL ORDER BY `percent` DESC LIMIT 1");
        if($rankPost)
        $rank=$rankPost[0][0]['rank'];
        $this->set('averagePercent',$averagePercent);
        $this->set('rank',$rank);
    }
}
