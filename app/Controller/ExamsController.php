<?php
App::uses('CakeTime', 'Utility');
App::uses('CakeEmail', 'Network/Email');
class ExamsController extends AppController
{
    public $helpers = array('Html');
    public $components = array('CustomFunction');
    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->authenticate();
        $this->studentId=$this->userValue['Student']['id'];        
    }
    public function index()
    {
        $todayExam=$this->Exam->getUserExam("today",$this->studentId,$this->currentDateTime);
        $this->set('todayExam',$todayExam);
    }
    public function purchased()
    {
        $purchasedExam=$this->Exam->getPurchasedExam("today",$this->studentId,$this->currentDateTime);
        $this->set('purchasedExam',$purchasedExam);
    }
    public function upcoming()
    {
        $upcomingExam=$this->Exam->getUserExam("upcoming",$this->studentId,$this->currentDateTime);
        $this->set('upcomingExam',$upcomingExam);
    }
    public function expired()
    {
        $expiredExam=$this->Exam->getPurchasedExam("expired",$this->studentId,$this->currentDateTime);
        $this->set('expiredExam',$expiredExam);
    }
    public function view($id,$showType)
    {
        $this->layout=null;
        $this->loadModel('ExamQuestion');
        $this->loadModel('ExamGroup');
        if (!$id)
        {
            $this->Session->setFlash(__('Invalid Post'),'flash',array('alert'=>'danger'));
            $this->redirect(array('action' => 'index'));
        }
        $checkPost=$this->Exam->checkPost($id,$this->studentId);
        if($checkPost==0)
        {
            $this->Session->setFlash(__('Invalid Post'),'flash',array('alert'=>'danger'));
            $this->redirect(array('action' => 'error'));
        }
        $post = $this->Exam->findByIdAndStatus($id,'Active');
        if (!$post)
        {
            $this->Session->setFlash(__('Invalid Post'),'flash',array('alert'=>'danger'));
            $this->redirect(array('action' => 'error'));
        }
        $examCount=$this->Exam->find('count',array('joins'=>array(array('table'=>'exam_maxquestions','type'=>'INNER','alias'=>'ExamMaxquestion','conditions'=>array('Exam.id=ExamMaxquestion.exam_id'))),
                                                   'conditions'=>array('Exam.id'=>$id)));
        if($post['Exam']['type']=="Exam")
        {
            $subjectDetailArr=$this->Exam->getSubject($id);
            foreach($subjectDetailArr as $value)
            {
                $subjectId=$value['Subject']['id'];
                $subjectName=$value['Subject']['subject_name'];
                $totalQuestionArr=$this->Exam->subjectWiseQuestion($id,$subjectId,'Exam');
                $subjectDetail[$subjectName]=$totalQuestionArr;
            }
            $totalMarks=$this->Exam->totalMarks($id);
        }
        else
        {
            $subjectDetailArr=$this->Exam->getPrepSubject($id);
            foreach($subjectDetailArr as $value)
            {
                $subjectId=$value['Subject']['id'];
                $subjectName=$value['Subject']['subject_name'];
                $totalQuestionArr=$this->Exam->subjectWiseQuestion($id,$subjectId);
                $subjectDetail[$subjectName]=$totalQuestionArr;
            }
            $totalMarks=0;
        }
        $this->set('post',$post);
        $this->set('subjectDetail',$subjectDetail);
        $this->set('totalMarks', $totalMarks);
        $this->set('examCount',$examCount);
        $this->set('showType',$showType);
        $this->set('id',$id);
    }
    public function instruction($id)
    {
        $this->layout='exam';
        $this->loadModel('ExamQuestion');
        if (!$id)
        {
            $this->Session->setFlash(__('Invalid Post'),'flash',array('alert'=>'danger'));
            $this->redirect(array('action' => 'index'));
        }
        $checkPost=$this->Exam->checkPost($id,$this->studentId);
        if($checkPost==0)
        {
            $this->Session->setFlash(__('Invalid Post'),'flash',array('alert'=>'danger'));
            $this->redirect(array('action' => 'error'));
        }
        $this->loadModel('Exam');
        $post = $this->Exam->findByIdAndStatus($id,'Active');
        $ispaid=$this->checkPaidStatus($id,$this->studentId);
        $this->set('post', $post);
        $this->set('ispaid', $ispaid);
    }
    public function error()
    {
        $this->layout=null;
    }
    public function start($id=null,$quesNo=null,$currQuesNo=1)
    {
        $this->layout='exam';
        if($id==null)
        $id=0;        
        $checkPost=$this->Exam->checkPost($id,$this->studentId);
        if($checkPost==0)
        {
            $this->Session->setFlash(__('Invalid Post'),'flash',array('alert'=>'danger'));
            $this->redirect(array('action' => 'index'));
        }
        $this->loadModel('ExamResult');
        $this->loadModel('ExamOrder');
        $post = $this->Exam->findById($id);
        $currentExamResult=$this->ExamResult->find('count',array('conditions'=>array('student_id'=>$this->studentId,'end_time'=>null)));
        if($currentExamResult==0)
        {
            $paidexam=$post['Exam']['paid_exam'];
            $totalExam=$this->ExamResult->find('count',array('conditions'=>array('exam_id'=>$id,'student_id'=>$this->studentId)));
            $attempt_count=$post['Exam']['attempt_count'];
            if($paidexam==1)
            {
                if(!$this->checkPaidStatus($id,$this->studentId))
                {
                    $this->redirect(array('action' => 'paid',$id,'P'));
                }
            }
            else
            {
                if($attempt_count<=$totalExam && $attempt_count>0)
                {
                    $this->Session->setFlash(__('You have attempted maximum exam.'),'flash',array('alert'=>'danger'));
                    $this->redirect(array('action' => 'index'));
                }
            }
            $this->Exam->userExamInsert($id,$post['Exam']['ques_random'],$post['Exam']['type'],$post['Exam']['option_shuffle'],$this->studentId,$this->currentDateTime);
        }
        $examWise=$this->ExamResult->find('first',array('conditions'=>array('student_id'=>$this->studentId,'end_time'=>null)));
        if($quesNo==null)
        {
            if($currentExamResult==1)
            {
                $this->loadModel('ExamStat');
                $examStat=$this->ExamStat->find('first',array('fields'=>array('ques_no'),'conditions'=>array('exam_result_id'=>$examWise['ExamResult']['id'],'attempt_time'=>NULL)));
                if($examStat && $examStat['ExamStat']['ques_no']!=1)
                $quesNo=$examStat['ExamStat']['ques_no']-1;
                else
                $quesNo=1;
            }
            else
            $quesNo=1;
        }
        if($currentExamResult==1)
        {
            $examWiseId=$examWise['ExamResult']['exam_id'];
            $endTime=CakeTime::format('Y-m-d H:i:s',CakeTime::fromString($examWise['ExamResult']['start_time'])+($post['Exam']['duration']*60));
            if($this->currentDateTime>=$endTime && $post['Exam']['duration']>0)
            $this->redirect(array('action' =>'finish',$examWiseId));
            if($examWiseId!=$id)
            $this->redirect(array('action' =>'start',$examWiseId,$quesNo,$currQuesNo));
        }
        $this->loadModel('ExamQuestion');
        $userExamQuestion=$this->Exam->userExamQuestion($id,$this->studentId,$quesNo);
        $examResult = $this->ExamResult->find('first',array('conditions'=>array('exam_id'=>$id,'student_id'=>$this->studentId,'end_time'=>null)));
        $userSectionQuestion=$this->Exam->userSectionQuestion($id,$post['Exam']['type'],$this->studentId);
        if($post['Exam']['type']=="Exam")
        $totalQuestion=$this->ExamQuestion->find('count',array('conditions'=>array('exam_id'=>$id)));
        else
        $totalQuestion=$this->Exam->totalPrepQuestions($id,$this->studentId);
        $nquesNo=$quesNo;
        $pquesNo=$quesNo;
        
        if($totalQuestion<$quesNo)
        $quesNo=1;
        $currSubjectName=$this->Exam->userSubject($id,$quesNo,$this->studentId);
        $this->Exam->userQuestionRead($id,$quesNo,$this->studentId,$this->currentDateTime);
        $oquesNo=$quesNo;
        if($totalQuestion==$quesNo)
        $quesNo=0;
        if($totalQuestion<$quesNo)
        $pquesNo=2;
        if($quesNo==1)
        $pquesNo=2;        
        $this->set('userExamQuestion',$userExamQuestion);
        $this->set('userSectionQuestion',$userSectionQuestion);
        $this->set('currSubjectName',$currSubjectName);
        $this->set('post',$post);
        $this->set('examResult',$examResult);
        $this->set('siteTimezone',$this->siteTimezone);
        $this->set('examId',$id);
        $this->set('nquesNo',$quesNo+1);
        $this->set('pquesNo',$pquesNo-1);
        $this->set('oquesNo',$oquesNo);
        $this->set('totalQuestion',$totalQuestion);
        $this->set('examResultId',$userExamQuestion['ExamStat']['exam_result_id']);
        $this->set('currQuesNo',$currQuesNo);
        $this->set('ajaxView',false);
    }
    public function ajaxcontentview($id,$quesNo,$currQuesNo)
    {
        $this->layout=null;
        $this->loadModel('ExamQuestion');
        $this->loadModel('ExamResult');
        $post = $this->Exam->findById($id);
        $userExamQuestion=$this->Exam->userExamQuestion($id,$this->studentId,$quesNo);
        $examResult = $this->ExamResult->find('first',array('conditions'=>array('exam_id'=>$id,'student_id'=>$this->studentId,'end_time'=>null)));
        $userSectionQuestion=$this->Exam->userSectionQuestion($id,$post['Exam']['type'],$this->studentId);
        if($post['Exam']['type']=="Exam")
        $totalQuestion=$this->ExamQuestion->find('count',array('conditions'=>array('exam_id'=>$id)));
        else
        $totalQuestion=$this->Exam->totalPrepQuestions($id,$this->studentId);
        $nquesNo=$quesNo;
        $pquesNo=$quesNo;
        
        if($totalQuestion<$quesNo)
        $quesNo=1;
        $currSubjectName=$this->Exam->userSubject($id,$quesNo,$this->studentId);
        $this->Exam->userQuestionUpdate($id,$currQuesNo,$this->studentId,$this->currentDateTime);
        $this->Exam->userQuestionRead($id,$quesNo,$this->studentId,$this->currentDateTime);
        $oquesNo=$quesNo;
        if($totalQuestion==$quesNo)
        $quesNo=0;
        if($totalQuestion<$quesNo)
        $pquesNo=2;
        if($quesNo==1)
        $pquesNo=2;
        $this->set('userExamQuestion',$userExamQuestion);
        $this->set('userSectionQuestion',$userSectionQuestion);
        $this->set('currSubjectName',$currSubjectName);
        $this->set('post',$post);
        $this->set('examResult',$examResult);
        $this->set('siteTimezone',$this->siteTimezone);
        $this->set('examId',$id);
        $this->set('nquesNo',$quesNo+1);
        $this->set('pquesNo',$pquesNo-1);
        $this->set('oquesNo',$oquesNo);
        $this->set('totalQuestion',$totalQuestion);
        $this->set('examResultId',$userExamQuestion['ExamStat']['exam_result_id']);
        $this->set('currQuesNo',$currQuesNo);
        $this->set('ajaxView',true);
        $this->render('start');
    }
    function save($id=null,$quesNo=null,$currQuesNo=null)
    {
        $dataArr=$_REQUEST['data'];
        if($this->Exam->userSaveAnswer($id,$quesNo,$this->studentId,$this->currentDateTime,$dataArr))
        {
            if($_REQUEST['saveNext']=="Yes")
            $quesNo++;
        }
        else
        {
            $this->Session->setFlash(__('You have attempted maximum number of questions in this subject'),'flash',array('alert'=>'danger'));
        }
        $this->redirect(array('action' =>'ajaxcontentview',$id,$quesNo,$currQuesNo));
    }
    function resetAnswer($id=null,$quesNo=null,$currQuesNo=null)
    {
        $this->Exam->userResetAnswer($id,$quesNo,$this->studentId);
        $this->redirect(array('action' => 'ajaxcontentview',$id,$quesNo,$currQuesNo));
    }
    function reviewAnswer($id=null,$quesNo=null,$currQuesNo=null)
    {
        $this->Exam->userReviewAnswer($id,$quesNo,$this->studentId,1);
        $quesNo++;
        $this->redirect(array('action' => 'ajaxcontentview',$id,$quesNo,$currQuesNo));
    }
    function unreviewAnswer($id=null,$quesNo=null,$currQuesNo=null)
    {
        $this->Exam->userReviewAnswer($id,$quesNo,$this->studentId,0);
        $quesNo++;
        $this->redirect(array('action' => 'ajaxcontentview',$id,$quesNo,$currQuesNo));
    }
    function finish($id=null,$warn=null,$origQuesNo=null)
    {
        if($id==null)
        {
            $this->Session->setFlash(__('Invalid Post'),'flash',array('alert'=>'danger'));
            $this->redirect(array('action' => 'index'));
        }
        $this->loadModel('ExamResult');
        $currentExamResult=$this->ExamResult->find('first',array('conditions'=>array('exam_id'=>$id,'student_id'=>$this->studentId,'end_time'=>null)));
        if($currentExamResult)
        {
            $this->Exam->userQuestionUpdate($id,$currQuesNo,$this->studentId,$this->currentDateTime);
            $this->Exam->userExamFinish($id,$this->studentId,$this->currentDateTime);
            if($warn==null || $warn=='null')
            {
                $this->loadModel('Exam');
                $examArr=$this->Exam->findById($id);
                if($this->examFeedback)
                {
                    if($examArr['Exam']['finish_result'])
                    $this->resultEmailSms($currentExamResult,$examArr);
                    $this->redirect(array('controller'=>'Exams','action' => 'feedbacks',$currentExamResult['ExamResult']['id']));
                    exit(0);
                }
                else
                {                   
                    if($examArr['Exam']['finish_result'])
                    {
                        $this->resultEmailSms($currentExamResult,$examArr);                        
                        $this->Session->setFlash(__('You can find your result here'),'flash',array('alert'=>'success'));
                        $this->redirect(array('controller'=>'Results','action' => 'view',$currentExamResult['ExamResult']['id']));
                    }
                    else
                    {
                        $this->Session->setFlash(__('Thanks for given the exam.'),'flash',array('alert'=>'success'));
                        $this->redirect(array('controller'=>'Exams','action' => 'index'));
                    }
                }
            }
            else
            {
                $this->redirect(array('controller'=>'Ajaxcontents','action' => 'examclose',$currentExamResult['ExamResult']['id']));
                exit(0);
            }
        }
        else
        {
            $this->Session->setFlash(__('Invalid Post'),'flash',array('alert'=>'danger'));
            $this->redirect(array('action' => 'index'));
        }
    }
    public function resultEmailSms($currentExamResult,$examArr)
    {
        try
        {
            if($this->emailNotification || $this->smsNotification)
            {
                $valueArr=$this->ExamResult->findById($currentExamResult['ExamResult']['id']);
                $siteName=$this->siteName;$siteEmailContact=$this->siteEmailContact;$url=$this->siteDomain;
                $email=$this->userValue['Student']['email'];$studentName=$this->userValue['Student']['name'];$mobileNo=$this->userValue['Student']['phone'];
                $examName=$examArr['Exam']['name'];$result=$valueArr['ExamResult']['result'];$obtainedMarks=$valueArr['ExamResult']['obtained_marks'];
                $questionAttempt=$valueArr['ExamResult']['total_answered'];$timeTaken=$this->CustomFunction->secondsToWords(CakeTime::fromString($valueArr['ExamResult']['end_time'])-CakeTime::fromString($valueArr['ExamResult']['start_time']));
                $percent=$valueArr['ExamResult']['percent'];
                if($this->emailNotification==1)
                {
                    /* Send Email */
                    $this->loadModel('Emailtemplate');
                    $emailSettingArr=$this->Emailtemplate->findByType('ERT');
                    if($emailSettingArr['Emailtemplate']['status']=="Published")
                    {
                        $message=eval('return "' . addslashes($emailSettingArr['Emailtemplate']['description']) . '";');
                        $Email = new CakeEmail();
                        $Email->transport($this->emailSettype);
                        if($this->emailSettype=="Smtp")
                        $Email->config(array('host' => $this->emailHost,'port' =>  $this->emailPort,'username' => $this->emailUsername,'password' => $this->emailPassword,'timeout'=>90));
                        $Email->from(array($this->siteEmail =>$this->siteName));
                        $Email->to($email);
                        $Email->template('default');
                        $Email->emailFormat('html');
                        $Email->subject($emailSettingArr['Emailtemplate']['name']);
                        $Email->send($message);
                        /* End Email */
                    }
                }
                if($this->smsNotification)
                {
                    /* Send Sms */
                    $this->loadModel('Smstemplate');
                    $smsTemplateArr=$this->Smstemplate->findByType('ERT');
                    if($smsTemplateArr['Smstemplate']['status']=="Published")
                    {
                        $url="$this->siteDomain";
                        $message=eval('return "' . addslashes($smsTemplateArr['Smstemplate']['description']) . '";');
                        $this->CustomFunction->sendSms($mobileNo,$message,$this->smsSettingArr);
                    }
                    /* End Sms */
                }
            }
        }
        catch (Exception $e)
        {
            $this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
        }            
    }
    function paid($id=null,$type=null)
    {
        
        if($id==null)
        {
            $this->Session->setFlash(__('Invalid Post'),'flash',array('alert'=>'danger'));
            $this->redirect(array('action' => 'index'));
        }
        $this->loadModel('Exam');
        $post = $this->Exam->findByIdAndStatus($id,'Active');
        if(!$post)
        {
            $this->Session->setFlash(__('Invalid Post'),'flash',array('alert'=>'danger'));
            $this->redirect(array('action' => 'error'));
        }
        else
        {
            if($this->checkPaidStatus($id,$this->studentId))
            {
                $this->redirect(array('action' => 'start',$id));
            }
            else
            {
                if($this->paidAmount($id))
                {
                    $this->redirect(array('action' => 'start',$id));
                }
            }
        }
        $this->redirect(array('action' => 'index'));
    }
    function paidAmount($id)
    {
        $exampost=$this->Exam->findByIdAndPaidExam($id,'1');
        $amount=$exampost['Exam']['amount'];
        $balance=$this->CustomFunction->WalletBalance($this->studentId);
        if($balance>=$amount)
        {
            if($this->CustomFunction->WalletInsert($this->studentId,$amount,"Deducted",$this->currentDateTime,"EM",__d('default',$amount,"%s Deducted for paying exam")))
            {
                $this->loadModel('ExamOrder');
                $this->ExamOrder->create();
                $expiryDays=$exampost['Exam']['expiry'];
                $expiryDate=date('Y-m-d',strtotime($this->currentDate."+$expiryDays days"));
                $this->ExamOrder->save(array("student_id"=>$this->studentId,"exam_id"=>$id,'date'=>$this->currentDate,'expiry_date'=>$expiryDate));
                return true;
            }
        }
        else
        {
            $this->Session->setFlash(__('Insufficient Amount.'),'flash',array('alert'=>'danger'));
            $this->redirect(array('action' => 'index'));
        }
        return false;
    }
    function renewexam($id)
    {
        if($this->paidAmount($id))
        {
            $this->redirect(array('action' => 'index'));
        }
    }
    public function submit($examId=null,$examResultId=null)
    {
        $this->layout=null;
        $this->loadModel('ExamStat');
        $this->set('examId',$examId);
        $this->set('post',$this->Exam->findById($examId));
        $this->set('attempted',$this->ExamStat->find('count',array('conditions'=>array('ExamStat.exam_result_id'=>$examResultId,'opened'=>1))));
        $this->set('notAttempted',$this->ExamStat->find('count',array('conditions'=>array('ExamStat.exam_result_id'=>$examResultId,'opened'=>0))));
        $this->set('answered',$this->ExamStat->find('count',array('conditions'=>array('ExamStat.exam_result_id'=>$examResultId,'answered'=>1))));
        $this->set('notAnswered',$this->ExamStat->find('count',array('conditions'=>array('ExamStat.exam_result_id'=>$examResultId,'answered'=>0))));
        $this->set('review',$this->ExamStat->find('count',array('conditions'=>array('ExamStat.exam_result_id'=>$examResultId,'review'=>1))));
    }
    public function guidelines($id=null)
    {
        $this->layout='exam';
        if (!$id)
        {
            $this->Session->setFlash(__('Invalid Post'),'flash',array('alert'=>'danger'));
            $this->redirect(array('action' => 'index'));
        }
        $checkPost=$this->Exam->checkPost($id,$this->studentId);
        if($checkPost==0)
        {
            $this->Session->setFlash(__('Invalid Post'),'flash',array('alert'=>'danger'));
            $this->redirect(array('action' => 'error'));
        }
        $post = $this->Exam->findByIdAndStatus($id,'Active');
        if (!$post)
        {
            $this->Session->setFlash(__('Invalid Post'),'flash',array('alert'=>'danger'));
            $this->redirect(array('action' => 'error'));
        }
        $this->set('post',$post);
    }
    public function feedbacks($id)
    {
        $this->layout='exam';
        if (!$id)
        {
            $this->Session->setFlash(__('Invalid Post'),'flash',array('alert'=>'danger'));
            $this->redirect(array('action' => 'index'));
        }
        $this->loadModel('ExamResult');
        $examArr=$this->ExamResult->findByIdAndStudentId($id,$this->studentId);
        if (!$examArr)
        {
            $this->Session->setFlash(__('Invalid Post'),'flash',array('alert'=>'danger'));
            $this->redirect(array('action' => 'error'));
        }
        $this->set('id',$id);
        $this->set('isClose','No');
        if ($this->request->is('post'))
        {
            try
            {
                $this->loadModel('ExamFeedback');
                $this->ExamFeedback->create();
                $comments=__("1. The test instructions were ").$this->request->data['Exam']['test_instruction']."<br><br>".
                __("2. Language of question was ").$this->request->data['Exam']['question_language']."<br><br>".
                __("3. Overall test experience was ").$this->request->data['Exam']['test_experience']."<br><br>".
                __("Any other feedback suggestion: ").$this->request->data['Exam']['comments'];
                $recordArr=array('ExamFeedback'=>array('exam_result_id'=>$id,'comments'=>$comments));
                $this->ExamFeedback->save($recordArr);
                $this->Session->setFlash(__('Feedback has submitted successfully!'),'flash',array('alert'=>'success'));
                $this->set('isClose','Yes');
            }
            catch (Exception $e)
            {
                $this->Session->setFlash(__('Feedback already submitted.'),'flash',array('alert'=>'danger'));
                $this->set('isClose','Yes');
            }            
        }       
    }
    function checkPaidStatus($examId,$studentId)
    {
        $this->loadModel('Exam');
        $this->loadModel('ExamResult');
        $this->loadModel('ExamOrder');
        $post = $this->Exam->findByIdAndStatus($examId,'Active');
        $attemptCount=$post['Exam']['attempt_count'];
        $paidexam=$post['Exam']['paid_exam'];
        $expiry=$post['Exam']['expiry'];
        $totalExam=$this->ExamResult->find('count',array('conditions'=>array('exam_id'=>$examId,'student_id'=>$studentId)));        
        $countExamOrder=$this->ExamOrder->find('count',array('conditions'=>array('exam_id'=>$examId,'student_id'=>$studentId)));
        $ispaid=false;
        if($paidexam==1)
        {
            if($countExamOrder>0 && $attemptCount==0)
            {
                $ispaid=true;
            }
            else
            {
                if($countExamOrder*$attemptCount>$totalExam)
                {
                    $ispaid=true;
                }
            }
        }
        else
        {
            $ispaid=true;  
        }
        if($expiry>0)
        {
            $examOrder=$this->ExamOrder->find('first',array('conditions'=>array('exam_id'=>$examId,'student_id'=>$studentId),'order'=>array('id'=>'desc')));
            if($this->currentDate>$examOrder['ExamOrder']['expiry_date'])
            {
                $ispaid=false;
            }
        }
        return$ispaid;
    }
}
