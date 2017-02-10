<?php
App::uses('CakeTime', 'Utility');
App::uses('CakeNumber', 'Utility');
App::uses('CakeEmail', 'Network/Email');
ini_set('max_execution_time', 300);
class AttemptedpapersController extends AdminAppController
{
    public $helpers = array('Html', 'Form','Session','Paginator','Js'=> array('Jquery'));
    public $components = array('Session','Paginator','search-master.Prg');
    public $presetVars = true;
    public $currentDateTime,$adminId;
    var $paginate = array('limit'=>1,'maxLimit'=>500,'page'=>1,'fields'=>array('Attemptedpaper.id','Attemptedpaper.total_marks','Attemptedpaper.obtained_marks','Attemptedpaper.user_id','Attemptedpaper.result',
                                                                               'Student.name','Student.email',
                                                                               'User.name',
                                                                               'Exam.name','Exam.passing_percent','Exam.negative_marking','Exam.finalized_time'
                                                                               ));
    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->adminId=$this->adminValue['User']['id'];
    }
    public function index($id=null)
    {
        try{
        $examCount=$this->Attemptedpaper->examCount($id);
        if($id==null || $examCount==0)
        {
            $this->Session->setFlash(__('Not Attempted'),'flash',array('alert'=>'danger'));
            $this->redirect(array('controller'=>'Exams','action' => 'index'));
        }
        $this->Prg->commonProcess();
        $this->Paginator->settings = $this->paginate;
        $this->Paginator->settings['conditions'] = $this->Attemptedpaper->parseCriteria($this->Prg->parsedParams());
        $this->Paginator->settings['conditions']=array('Attemptedpaper.exam_id'=>$id,'Attemptedpaper.end_time IS NOT NULL');
        $this->set('Attemptedpapers', $this->Paginator->paginate());
        $this->loadModel('Qtype');
        $this->loadModel('User');
        $this->set('Qtype',$this->Qtype->find('all'));
        $this->set('UserArr',$this->User->find('all'));
        $this->set('examId',$id);
        if ($this->request->is('ajax'))
        {
            $this->render('index','ajax'); // View, Layout
        }
        }
        catch (Exception $e)
        {
            $this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
        }
    }
    public function marksupdate($id=null,$statId=null)
    {
        try{
        $this->loadModel('ExamStat');
        $examCount=$this->Attemptedpaper->examCount($id);
        $examStatCount=$this->ExamStat->find('count',array('conditions'=>array('id'=>$statId)));
        if($id==null || $statId==null || $examCount==0 || $examStatCount==0)
        {
            $this->Session->setFlash('Invalid Post','flash',array('alert'=>'danger'));
            $this->redirect(array('controller'=>'Exams','action' => 'index'));
        }
        $attemptArr=array('id'=>$statId,'marks_obtained'=>$this->request->data['Attemptedpaper']['marks_obtained'],'user_id'=>$this->adminId,
                         'checking_time'=>$this->currentDateTime);
        $this->ExamStat->save($attemptArr);
        $page="";
        if(isset($this->request->data['Attemptedpaper']['page']) && $this->request->data['Attemptedpaper']['page']>1)
        $page="/page:".$this->request->data['Attemptedpaper']['page'];
        $this->Session->setFlash(__('Marks Updated'),'flash',array('alert'=>'success'));
        $this->redirect(array('action' =>"index/$id$page"));
        }
        catch (Exception $e)
        {
            $this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
            return $this->redirect(array('action' => 'index'));
        }
    }
    public function finalize($id=null,$pageId=null,$examResultId=null)
    {
        try{
        $examCount=$this->Attemptedpaper->examCountById($examResultId);
        if($id==null || $examCount==0)
        {
            $this->Session->setFlash(__('Not Attempted'),'flash',array('alert'=>'danger'));
            $this->redirect(array('controller'=>'Exams','action' => 'index'));
        }
        $this->loadModel('ExamResult');
        $post=$this->ExamResult->find('first',array('joins'=>array(array('table'=>'exams','alias'=>'Exam','type'=>'left',
                                                                         'conditions'=>array('ExamResult.exam_id=Exam.id'))),
                                                    'conditions'=>array('ExamResult.id'=>$examResultId),
                                                    'fields'=>array('ExamResult.total_marks','Exam.passing_percent')));
        $obtainedMarks=$this->Attemptedpaper->obtainedMarks($examResultId);
        $percent=CakeNumber::precision(($obtainedMarks*100)/$post['ExamResult']['total_marks'],2);
        if($percent>=$post['Exam']['passing_percent'])
        $result="Pass";
        else
        $result="Fail";
        $examResultArr=array('id'=>$examResultId,'user_id'=>$this->adminId,'finalized_time'=>$this->currentDateTime,'obtained_marks'=>$obtainedMarks,'percent'=>$percent,'result'=>$result);
        $this->ExamResult->save($examResultArr);
        $page="";
        if(isset($pageId) && $pageId>1)
        $page="/page:".$pageId;
        $this->Session->setFlash(__('Successfully Finalize'),'flash',array('alert'=>'success'));
        $this->redirect(array('action'=>"index/$id$page"));
        }
        catch (Exception $e)
        {
            $this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
            return $this->redirect(array('action' => 'index'));
        }
        
    }
    public function closeexam($id=null)
    {
        try{
        $this->loadModel('Exam');
        $this->loadModel('ExamResult');
        $examCount=$this->Exam->find('count',array('conditions'=>array('id'=>$id)));
        if($id==null || $examCount==0)
        {
            $this->Session->setFlash(__('Invalid Post'),'flash',array('alert'=>'danger'));
            $this->redirect(array('controller'=>'Exams','action' => 'index'));
        }
        $finalizedExam=$this->ExamResult->find('count',array('conditions'=>array('exam_id'=>$id,'user_id'=>0,'end_time IS NOT NULL')));
        if($finalizedExam>0)
        {
            $this->Session->setFlash("$finalizedExam Result(s) pending yet. Please finalize them first.",'flash',array('alert'=>'danger'));
            $this->redirect(array('controller'=>'Exams','action' => 'index'));
        }
        $this->Exam->save(array('id'=>$id,'status'=>'Closed','user_id'=>$this->adminId,'finalized_time'=>$this->currentDateTime));
        $this->Session->setFlash(__('Successfully Closed Exam'),'flash',array('alert'=>'success'));
        $this->redirect(array('controller'=>'Attemptedpapers','action' => 'cenotif',$id));
        }
        catch (Exception $e)
        {
            $this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
            return $this->redirect(array('action' => 'index'));
        }
    }
    public function cenotif($id=null,$offset=0)
    {
        try{
        if($this->emailNotification || $this->smsNotification)
        {
            $this->loadModel('Exam');
            $this->loadModel('ExamResult');
            $examCount=$this->Exam->find('count',array('conditions'=>array('id'=>$id,'status'=>'Closed')));
            if($id==null || $examCount==0)
            {
                $this->Session->setFlash(__('Invalid Post'),'flash',array('alert'=>'danger'));
                $this->redirect(array('controller'=>'Exams','action' => 'index'));
            }
            $limit=10;
            $numRows=$this->ExamResult->find('count',array('fields'=>array('Student.name'),
                                                     'joins'=>array(array('table'=>'exams','alias'=>'Exam','type'=>'Inner',
                                                                          'conditions'=>array('Exam.id=ExamResult.exam_id')),
                                                                    array('table'=>'students','alias'=>'Student','type'=>'Inner',
                                                                          'conditions'=>array('Student.id=ExamResult.student_id')),
                                                                    ),
                                                     'conditions'=>array('Exam.status'=>'Closed','Exam.id'=>$id),
                                                     'order'=>array('Exam.percent'=>'desc')));
            $post=$this->ExamResult->find('all',array('fields'=>array('Student.name','Student.email','Student.phone','Exam.name','ExamResult.total_marks','ExamResult.obtained_marks','ExamResult.total_question','ExamResult.total_answered','ExamResult.percent','ExamResult.result','ExamResult.start_time','ExamResult.end_time'),
                                                      'joins'=>array(array('table'=>'exams','alias'=>'Exam','type'=>'Inner',
                                                                          'conditions'=>array('Exam.id=ExamResult.exam_id')),
                                                                    array('table'=>'students','alias'=>'Student','type'=>'Inner',
                                                                          'conditions'=>array('Student.id=ExamResult.student_id')),
                                                                    ),
                                                     'conditions'=>array('Exam.status'=>'Closed','Exam.id'=>$id),
                                                     'order'=>array('ExamResult.percent'=>'desc'),
                                                     'limit'=>$limit,
                                                     'offset'=>$offset));
            $rank=0;
            foreach($post as $value)
            {
                $rank=$offset+1+$rank;
                $siteName=$this->siteName;$siteEmailContact=$this->siteEmailContact;$url=$this->siteDomain;
                $email=$value['Student']['email'];$studentName=$value['Student']['name'];$mobileNo=$value['Student']['phone'];
                $examName=$value['Exam']['name'];$result=$value['ExamResult']['result'];$obtainedMarks=$value['ExamResult']['obtained_marks'];
                $questionAttempt=$value['ExamResult']['total_answered'];$timeTaken=$this->CustomFunction->secondsToWords(CakeTime::fromString($value['ExamResult']['end_time'])-CakeTime::fromString($value['ExamResult']['start_time']));
                $percent=$value['ExamResult']['percent'];
                $smsMessage="Dear ".$studentName.", Name: ".$value['Exam']['name']." Result: ".$value['ExamResult']['result']." Rank: ".$rank." Obtained Marks: ".$value['ExamResult']['obtained_marks']." Ques Attempt: ".$value['ExamResult']['total_answered']." Time Taken: ".$this->CustomFunction->secondsToWords(CakeTime::fromString($value['ExamResult']['end_time'])-CakeTime::fromString($value['ExamResult']['start_time']))." Percent: ".$value['ExamResult']['percent'];
                if($this->emailNotification==1)
                {
                    /* Send Email */
                    $this->loadModel('Emailtemplate');
                    $emailTemplateArr=$this->Emailtemplate->findByType('EFD');
                    if($emailTemplateArr['Emailtemplate']['status']=="Published")
                    {
                        $message=eval('return "' . addslashes($emailTemplateArr['Emailtemplate']['description']) . '";');
                        $Email = new CakeEmail();
                        $Email->transport($this->emailSettype);
                        if($this->emailSettype=="Smtp")
                        $Email->config(array('host' => $this->emailHost,'port' =>  $this->emailPort,'username' => $this->emailUsername,'password' => $this->emailPassword,'timeout'=>90));
                        $Email->from(array($this->siteEmail =>$this->siteName));
                        $Email->to($email);
                        $Email->template('default');
                        $Email->emailFormat('html');
                        $Email->subject($emailTemplateArr['Emailtemplate']['name']);
                        $Email->send($message);
                        /* End Email */
                    }
                }
                if($this->smsNotification)
                {
                    /* Send Sms */
                    $this->loadModel('Smstemplate');
                    $smsTemplateArr=$this->Smstemplate->findByType('EFD');
                    if($smsTemplateArr['Smstemplate']['status']=="Published")
                    {
                        $url="$this->siteDomain";
                        $message=eval('return "' . addslashes($smsTemplateArr['Smstemplate']['description']) . '";');
                        $this->CustomFunction->sendSms($mobileNo,$message,$this->smsSettingArr);
                    }
                    /* End Sms */
                }
            }
            $offset=$offset+$limit;
            if($numRows>$offset)
            {
                $this->redirect(array('controller'=>'Attemptedpapers','action' => 'cenotif',$id,$offset));
            }
            else
            {
                $this->redirect(array('controller'=>'Exams','action' => 'index'));
            }
        }
        else
        {
            $this->redirect(array('controller'=>'Exams','action' => 'index'));
        }
        }
        catch (Exception $e)
        {
            $this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
            return $this->redirect(array('action' => 'index'));
        }
    }
}