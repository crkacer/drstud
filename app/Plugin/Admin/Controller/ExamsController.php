<?php
App::uses('CakeTime', 'Utility');
App::uses('CakeEmail', 'Network/Email');
ini_set('max_execution_time', 300);
class ExamsController extends AdminAppController {
    public $helpers = array('Html', 'Form','Session','Paginator','Time','Tinymce','Js'=> array('Jquery'));
    public $components = array('Session','Paginator','search-master.Prg','HighCharts.HighCharts','RequestHandler' => array('viewClassMap' => array('pdf' => 'CakePdf.Pdf')));
    public $presetVars = true;
    var $paginate = array('joins'=>array(
                                         array('table'=>'exam_groups','type'=>'INNER','alias'=>'ExamGroup','conditions'=>array('Exam.id=ExamGroup.exam_id')),
                                         array('table'=>'user_groups','type'=>'INNER','alias'=>'UserGroup','conditions'=>array('ExamGroup.group_id=UserGroup.group_id'))),                                         
                            'page'=>1,'order'=>array('Exam.id'=>'desc'),'group'=>array('Exam.id'));
    public function index()
    {
        try{
        $this->Exam->UserWiseGroup($this->userGroupWiseId);
        $this->Prg->commonProcess();
        $this->Paginator->settings = $this->paginate;
         $this->Paginator->settings['limit']=$this->pageLimit;
        $this->Paginator->settings['maxLimit']=$this->maxLimit;
        $cond="";
        $cond=" 1=1 AND `UserGroup`.`user_id`=$this->luserId ";
        $this->Paginator->settings['conditions'] = array($this->Exam->parseCriteria($this->Prg->parsedParams()),$cond);
        $this->set('Exam', $this->Paginator->paginate());
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
    public function add()
    {
        $this->loadModel('Group');
        $this->loadModel('Subject');
        $this->loadModel('Qtype');
        $this->loadModel('Diff');
        $this->loadModel('ExamPrep');
        $this->loadModel('Lesson');
        $this->set('group_id', $this->Group->find('list',array('fields'=>array('id','group_name'),'conditions'=>array("Group.id IN($this->userGroupWiseId)"))));
        $this->Subject->virtualFields=array('subject' => 'CONCAT(Subject.subject_name, " (Q) ",Count(DISTINCT(Question.id)))');
        $this->set('subjectId', $this->Subject->find('list',array('fields'=>array('Subject.id','subject'),
                                                                  'joins'=>array(array('table'=>'subject_groups','type'=>'LEFT','alias'=>'SubjectGroup','conditions'=>array('Subject.id=SubjectGroup.subject_id')),
                                                                                 array('table'=>'questions','type'=>'LEFT','alias'=>'Question','conditions'=>array('Subject.id=Question.subject_id'))),
                                                                  'conditions'=>array("SubjectGroup.group_id IN($this->userGroupWiseId)"),
                                                                  'order'=>array('Subject.subject_name'=>'asc'),
                                                                  'group'=>'Subject.id')));
        $this->set('esubjectId', $this->Subject->find('list',array('fields'=>array('Subject.id','subject_name'),
                                                                  'joins'=>array(array('table'=>'subject_groups','type'=>'LEFT','alias'=>'SubjectGroup','conditions'=>array('Subject.id=SubjectGroup.subject_id'))),
                                                                  'conditions'=>array("SubjectGroup.group_id IN($this->userGroupWiseId)"),
                                                                  'order'=>array('Subject.subject_name'=>'asc'))));
        $this->Qtype->virtualFields=array('quesType'=>'CONCAT(question_type,"   ")');
        $this->Diff->virtualFields=array('diffLevel'=>'CONCAT(diff_level,"   ")');
        $this->set('quesType', $this->Qtype->find('list',array('fields'=>array('id','quesType'))));
        $this->set('diffLevel', $this->Diff->find('list',array('fields'=>array('id','diffLevel'))));
        $subjectId=null;
        if ($this->request->is('post'))
        {
            $this->Exam->create();
            try
            {
                if(strtotime($this->request->data['Exam']['end_date'])<strtotime($this->request->data['Exam']['start_date']))
                {
                    $this->Session->setFlash(__('End Date is not less than Start date'),'flash',array('alert'=>'danger'));
                }
                elseif(!is_array($this->request->data['ExamGroup']['group_name']))
                {
                    $this->Session->setFlash(__('Please Select any group'),'flash',array('alert'=>'danger'));
                }
                elseif($this->request->data['Exam']['type']=="Prepration" && !isset($this->request->data['ExamPrep']))
                {
                    $this->Session->setFlash(__('Please Add Subject To Exam'),'flash',array('alert'=>'danger'));
                }
                else
                {
                    if ($this->Exam->save($this->request->data))
                    {
                        $this->loadModel('ExamGroup');
                        $examId=$this->Exam->id;
                        foreach($this->request->data['ExamGroup']['group_name'] as $groupId)
                        {
                            $examGroup[]=array('exam_id'=>$examId,'group_id'=>$groupId);                       
                        }
                        $this->ExamGroup->create();
                        $this->ExamGroup->saveAll($examGroup);
                        
                        $this->loadModel('ExamPrep');
                        $this->loadModel('ExamMaxquestion');
                        if(is_array($this->request->data['ExamPrep']))
                        {
                            $maxQuestion=array();
                            foreach($this->request->data['ExamPrep'] as $value)
                            {
                                $examPrep[]=array('exam_id'=>$examId,'subject_id'=>$value['subject_id'],'ques_no'=>$value['ques_no'],'type'=>$value['type'],'level'=>$value['level']);
                                if($value['max_question'])
                                $maxQuestion[]=array('exam_id'=>$examId,'subject_id'=>$value['subject_id'],'max_question'=>$value['max_question']);
                            }
                            $this->ExamPrep->create();
                            $this->ExamPrep->saveAll($examPrep);
                            if($maxQuestion)
                            {
                                $this->ExamMaxquestion->create();
                                $this->ExamMaxquestion->saveAll($maxQuestion);
                            }
                        }
                        if($this->request->data['Exam']['type']=="Exam")
                        {
                            $lastId=$this->Exam->id;
                            $this->Session->setFlash(__('Exam has been saved. Add questions in exam'),'flash',array('alert'=>'success'));
                            return $this->redirect(array('controller'=>'Addquestions','action' => 'index',$lastId));
                        }
                        else
                        {
                            $this->Session->setFlash(__('Exam has been saved'),'flash',array('alert'=>'success'));
                            return $this->redirect(array('action' => 'add'));
                        }
                    }
                }
                $subjectId=$this->request->data['Exam']['subject_id'];
            }
            catch (Exception $e)
            {
                $this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
            }
        }
        $this->set('lessonId', $this->Lesson->find('list',array('fields'=>array('Lesson.id','name'),'conditions'=>array('Lesson.subject_id'=>$subjectId,'Lesson.status'=>'Active'),'order'=>array('Lesson.name'=>'asc'))));
        $this->set('frontExamPaid',$this->frontExamPaid);
        
    }
    public function edit($id = null)
    {
        $this->loadModel('Subject');
        $this->loadModel('Lesson');
        $this->set('esubjectId', $this->Subject->find('list',array('fields'=>array('Subject.id','subject_name'),
                                                                  'joins'=>array(array('table'=>'subject_groups','type'=>'LEFT','alias'=>'SubjectGroup','conditions'=>array('Subject.id=SubjectGroup.subject_id'))),
                                                                  'conditions'=>array("SubjectGroup.group_id IN($this->userGroupWiseId)"),
                                                                  'order'=>array('Subject.subject_name'=>'asc'))));
        if (!$id)
        {
            throw new NotFoundException(__('Invalid post'));
        }
        $this->Exam->UserWiseGroup($this->userGroupWiseId);
        $ids=explode(",",$id);
        $post=array();
        foreach($ids as $id)
        {
            $this->Exam->UserWiseGroup($this->userGroupWiseId);
            $post[]=$this->Exam->findByid($id);            
        }
        $this->set('Exam',$post);
        $this->set('lessonId', $this->Lesson->find('list',array('fields'=>array('Lesson.id','name'),'conditions'=>array('Lesson.subject_id'=>$post[0]['Exam']['subject_id'],'Lesson.status'=>'Active'),'order'=>array('Lesson.name'=>'asc'))));
        if (!$post)
        {
            throw new NotFoundException(__('Invalid post'));
        }
        $this->loadModel('Group');
        $this->set('group_id', $this->Group->find('list',array('fields'=>array('id','group_name'),'conditions'=>array("Group.id IN($this->userGroupWiseId)"))));
        if ($this->request->is(array('post', 'put')))
        {
            $isSave=true;
            try
            {
                foreach($this->request->data as $k=> $value)
                {
                    if(strtotime($value['Exam']['end_date'])<strtotime($value['Exam']['start_date']))
                    {
                        $this->Session->setFlash(__('End Date is not less than Start date'),'flash',array('alert'=>'danger'));
                        $isSave=false;
                        break;
                    }
                    elseif(!is_array($value['ExamGroup']['group_name']))
                    {
                        $this->Session->setFlash(__('Please Select any group'),'flash',array('alert'=>'danger'));
                        $isSave=false;
                        break;
                    }
                }
                if($isSave==true)
                {
                    if($this->Exam->saveAll($this->request->data))
                    {                        
                        $this->loadModel('ExamGroup');
                        foreach($this->request->data as $k=> $value)
                        {
                            $examId=$value['Exam']['id'];
                            $this->ExamGroup->deleteAll(array('ExamGroup.exam_id'=>$examId,"ExamGroup.group_id IN($this->userGroupWiseId)"));
                            foreach($value['ExamGroup']['group_name'] as $groupId)
                            {
                                $examGroup[]=array('exam_id'=>$examId,'group_id'=>$groupId);
                            }
                        }
                        $this->ExamGroup->create();
                        $this->ExamGroup->saveAll($examGroup);
                        $this->Session->setFlash(__('Exam has been updated'),'flash',array('alert'=>'success'));
                        return $this->redirect(array('action' => 'index'));                     
                    }
                }
            }
            catch (Exception $e)
            {
                $this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
            }
            $this->set('isError',true);
        }
        else
        {
            $this->layout = 'tinymce';
            $this->set('isError',false);
        }
        
        if (!$this->request->data)
        {
            $this->request->data = $post;
        }
        $this->set('frontExamPaid',$this->frontExamPaid);
    }
    public function deleteall()
    {
        try{
        if ($this->request->is('post'))
        {
            $this->loadModel('ExamGroup');
            foreach($this->data['Exam']['id'] as $key => $value)
            {
                $this->ExamGroup->deleteAll(array('ExamGroup.exam_id'=>$value,"ExamGroup.group_id IN($this->userGroupWiseId)"));
            }
            $this->ExamGroup->query("DELETE `Exam` FROM `exams` AS `Exam` LEFT JOIN `exam_groups` AS `ExamGroup` ON `Exam`.`id` = `ExamGroup`.`exam_id` WHERE `ExamGroup`.`id` IS NULL");
            $this->Session->setFlash(__('Exam has been deleted'),'flash',array('alert'=>'success'));
        }        
        $this->redirect(array('action' => 'index'));
        }
        catch (Exception $e)
        {
            $this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
            return $this->redirect(array('action' => 'index'));
        }
    }
    public function view($id = null)
    {
        try{
        $this->layout = null;
        if (!$id)
        {
            $this->Session->setFlash(__('Invalid Post'),'flash',array('alert'=>'danger'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Exam->bindModel(array('hasAndBelongsToMany'=>array('Group'=>array('className'=>'Group',
                                                     'joinTable' => 'exam_groups',
                                                     'foreignKey' => 'exam_id',
                                                     'associationForeignKey' => 'group_id',
                                                     'conditions'=>"ExamGroup.group_id IN($this->userGroupWiseId)"))));
        $post = $this->Exam->findById($id);
        if (!$post)
        {
            $this->Session->setFlash(__('Invalid Post'),'flash',array('alert'=>'danger'));
            $this->redirect(array('action' => 'index'));
        }
        $this->loadModel('ExamQuestion');
        $this->loadModel('ExamPrep');
        $this->loadModel('Diff');
        $this->loadModel('Qtype');
        $SubjectDetail="";$DiffLevel="";
        $examCount=$this->Exam->find('count',array('joins'=>array(array('table'=>'exam_maxquestions','type'=>'INNER','alias'=>'ExamMaxquestion','conditions'=>array('Exam.id=ExamMaxquestion.exam_id'))),
                                                   'conditions'=>array('Exam.id'=>$id)));
        $totalMarks=$this->Exam->totalMarks($id);
        if($post['Exam']['type']=="Exam")
        {
            $SubjectDetail=array();
            $chartData=array();
            $TotalQuestion=$this->ExamQuestion->find('count',array('conditions'=>array('exam_id'=>$id)));
            $SubjectDetail=$this->ExamQuestion->find('all',array(
                                                             'fields'=>array('Question.subject_id','Subject.subject_name','ExamMaxquestion.max_question'),
                                                             'joins'=>array(array('table'=>'questions','type'=>'Inner','alias'=>'Question','conditions'=>array('Question.id=ExamQuestion.question_id')),
                                                                 array('table'=>'subjects','type'=>'Inner','alias'=>'Subject','conditions'=>array('Subject.id=Question.subject_id')),
                                                                 array('table'=>'exam_maxquestions','type'=>'Left','alias'=>'ExamMaxquestion','conditions'=>array('ExamQuestion.exam_id=ExamMaxquestion.exam_id','Subject.id=ExamMaxquestion.subject_id'))),
                                                             'conditions'=>array('ExamQuestion.exam_id'=>$id),
                                                             'group'=>array('Question.subject_id')));
            $DiffLevel=$this->Diff->find('all');
            $i=0;
            foreach($SubjectDetail as $value)
            {
                $subject_id=$value['Question']['subject_id'];
                $subject_name=$value['Subject']['subject_name'];
                $QuestionDetail[$subject_name][]=$this->viewquestiontype($id,$subject_id,'S');
                $QuestionDetail[$subject_name][]=$this->viewquestiontype($id,$subject_id,'M');
                $QuestionDetail[$subject_name][]=$this->viewquestiontype($id,$subject_id,'T');
                $QuestionDetail[$subject_name][]=$this->viewquestiontype($id,$subject_id,'F');
                $DifficultyDetail[$subject_name][]=$this->viewdifftype($id,$subject_id,'E');
                $DifficultyDetail[$subject_name][]=$this->viewdifftype($id,$subject_id,'M');
                $DifficultyDetail[$subject_name][]=$this->viewdifftype($id,$subject_id,'D');
                $j=0;
                foreach($DiffLevel as $diff)
                {
                    $tot_ques=(float) $DifficultyDetail[$subject_name][$j];
                    $chartData[]=array($diff['Diff']['diff_level'],$tot_ques);
                    $j++;
                    
                }
                $chartName = "Pie Chart$i";
                $pieChart = $this->HighCharts->create( $chartName, 'pie' );
                $this->HighCharts->setChartParams(
                $chartName,
                    array(
                    'renderTo'				=> "piewrapper$i",  // div to display chart inside
                    'chartWidth'			=> 250,
                    'chartHeight'			=> 300,
                    'creditsEnabled'=> FALSE,
                    'title'				=> $subject_name,
                    'titleAlign'			=> 'left',
                    'plotOptionsPieShowInLegend'=> TRUE,
                    'plotOptionsPieDataLabelsEnabled'=> TRUE,
                    'plotOptionsPieDataLabelsFormat'=>'<b>{point.y}</b>',                                                
                    )
                );
                $series = $this->HighCharts->addChartSeries();        
                $series->addName(__('Difficulty Level'))->addData($chartData);
                $pieChart->addSeries($series);
                unset($chartData);
                $i++;
            }
        }
        else
        {
            $TotalQuestionArr=$this->ExamPrep->find('all',array('fields'=>array('SUM(ques_no) AS total'),'conditions'=>array('exam_id'=>$id)));
            $subjectPrepAll=$this->ExamPrep->find('all',array('joins'=>array(array('table'=>'subjects','alias'=>'Subject','type'=>'INNER','conditions'=>array('ExamPrep.subject_id=Subject.id')),
                                                                             array('table'=>'exam_maxquestions','type'=>'Left','alias'=>'ExamMaxquestion','conditions'=>array('ExamPrep.exam_id=ExamMaxquestion.exam_id','ExamPrep.subject_id=ExamMaxquestion.subject_id'))),
                                                              'fields'=>array('Subject.subject_name','ExamPrep.ques_no','ExamPrep.type','ExamPrep.level','ExamMaxquestion.max_question'),
                                                              'conditions'=>array('ExamPrep.exam_id'=>$id)));
            $SubjectDetail=array();
            $chartData=array();
            foreach($subjectPrepAll as $value)
            {
                $subjectName=$value['Subject']['subject_name'];
                $totalQuestion=(int) $value['ExamPrep']['ques_no'];
                $chartData[]=array($subjectName,$totalQuestion);
                foreach(explode(",",$value['ExamPrep']['type']) as $examType)
                {
                    $qtypeArr=$this->Qtype->findById($examType,array('question_type'));
                    $qtype[]=$qtypeArr['Qtype']['question_type'];
                }
                $questionType=implode(" | ",$qtype);
                unset($examType,$qtype);
                foreach(explode(",",$value['ExamPrep']['level']) as $examType)
                {
                    $qtypeArr=$this->Diff->findById($examType,array('diff_level'));
                    $qtype[]=$qtypeArr['Diff']['diff_level'];
                }
                $levelType=implode(" | ",$qtype);
                unset($examType,$qtype);
                $SubjectDetail[]=array('Subject'=>$subjectName,'Type'=>$questionType,'Level'=>$levelType,'QuesNo'=>$value['ExamPrep']['ques_no'],'MaxQuestion'=>$value['ExamMaxquestion']['max_question']);
                unset($questionType,$levelType);
            }
            $TotalQuestion=$TotalQuestionArr[0][0]['total'];
            $chartName = "Pie Chartsub";
            $pieChart = $this->HighCharts->create($chartName, 'pie' );
            $this->HighCharts->setChartParams(
            $chartName,
                array(
                'renderTo'				=> "piewrappersub",  // div to display chart inside
                'title'				=> __('Subject Wise Question Count'),
                'titleAlign'=> 'center',
                                                'creditsEnabled'=> FALSE,
                                                'plotOptionsShowInLegend'=> TRUE,
                                                'plotOptionsPieShowInLegend'=> TRUE,
                                                'plotOptionsPieDataLabelsEnabled'=> TRUE,
                                                'plotOptionsPieDataLabelsFormat'=>'{point.name}:<b>{point.y}</b>',                                               
                )
            );
            $series = $this->HighCharts->addChartSeries();
            $series->addName('Total Question')->addData($chartData);
            $pieChart->addSeries($series);
            unset($chartData);
        }        
        $this->set('post', $post);
        $this->set('id', $id);
        $this->set('TotalQuestion',$TotalQuestion);
        $this->set('SubjectDetail',$SubjectDetail);
        if(isset($QuestionDetail))
        $this->set('QuestionDetail',$QuestionDetail);
        $this->set('DiffLevel',$DiffLevel);
        if(isset($DifficultyDetail))
        $this->set('DifficultyDetail',$DifficultyDetail);
        $this->set('examCount',$examCount);
        $this->set('totalMarks',$totalMarks);
        }
        catch (Exception $e)
        {
            $this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
            return $this->redirect(array('action' => 'index'));
        }
    }
    public function activateexam($id=null,$type="Active")
    {
        try{
        $examCount=$this->Exam->find('count',array('conditions'=>array('Exam.id'=>$id)));
        if($id==null || $examCount==0)
        {
            $this->Session->setFlash(__('Invalid Post'),'flash',array('alert'=>'danger'));
            $this->redirect(array('controller'=>'Exams','action' => 'index'));
        }
        $this->Exam->unbindValidation('remove', array('name','passing_percent','duration','attempt_count','start_date','end_date','subject_id','lesson_id'), true);
        if($type=="Inactive")
        {
            $this->Exam->save(array('id'=>$id,'status'=>'Inactive'));
            $this->Session->setFlash(__('Exam sucessfully inactivated'),'flash',array('alert'=>'success'));
            $this->redirect(array('controller'=>'Exams','action' => 'index'));
        }
        else
        {
            $this->Exam->save(array('id'=>$id,'status'=>'Active','user_id'=>0));
            $this->Session->setFlash(__('Exam sucessfully activated'),'flash',array('alert'=>'success'));
            $this->redirect(array('controller'=>'Exams','action' => 'aenotif',$id));
        }
        }
        catch (Exception $e)
        {
            $this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
            return $this->redirect(array('action' => 'index'));
        }
    }
    private function viewquestiontype($id,$subject_id,$type)
    {
        try{
        $this->loadModel('Question');
        return $this->Question->find('count',array(
                                                  'joins'=>array(array('table'=>'qtypes','type'=>'Inner','alias'=>'Qtype','conditions'=>array('Question.qtype_id=Qtype.id')),
                                                                 array('table'=>'exam_questions','type'=>'Inner','alias'=>'ExamQuestion','conditions'=>array('Question.id=ExamQuestion.question_id'))),
                                                  'conditions'=>array('ExamQuestion.exam_id'=>$id,'Question.subject_id'=>$subject_id,'Qtype.type'=>$type)));
        }
        catch (Exception $e)
        {
            $this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
            return $this->redirect(array('action' => 'index'));
        }
    }
    private function viewdifftype($id,$subject_id,$type)
    {
        try{
        $this->loadModel('Question');
        return $this->Question->find('count',array(
                                                  'joins'=>array(array('table'=>'diffs','type'=>'Inner','alias'=>'Diff','conditions'=>array('Question.diff_id=Diff.id')),
                                                                 array('table'=>'exam_questions','type'=>'Inner','alias'=>'ExamQuestion','conditions'=>array('Question.id=ExamQuestion.question_id'))),
                                                  'conditions'=>array('ExamQuestion.exam_id'=>$id,'Question.subject_id'=>$subject_id,'Diff.type'=>$type)));
        }
        catch (Exception $e)
        {
            $this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
            return $this->redirect(array('action' => 'index'));
        }
    }
    public function stats($id = null)
    {
        try{
        $this->layout = null;
        if (!$id)
        {
            $this->Session->setFlash(__('Invalid Post'),'flash',array('alert'=>'danger'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Exam->bindModel(array('hasAndBelongsToMany'=>array('Group'=>array('className'=>'Group',
                                                     'joinTable' => 'exam_groups',
                                                     'foreignKey' => 'exam_id',
                                                     'associationForeignKey' => 'group_id',
                                                     'conditions'=>"ExamGroup.group_id IN($this->userGroupWiseId)"))));
        $post = $this->Exam->findByIdAndStatus($id,'Closed');
        if (!$post)
        {
            $this->Session->setFlash(__('Invalid Post'),'flash',array('alert'=>'danger'));
            $this->redirect(array('action' => 'index'));
        }
        $examStats=$this->Exam->examStats($id);
        $chartRerData=array();
        $chartRerData[]=array(__('Pass'),$examStats['StudentStat']['pass']);
        $chartRerData[]=array(__('Fail'),$examStats['StudentStat']['fail']);
        $chartRerData[]=array(__('Absent'),$examStats['StudentStat']['absent']);
        $id=$examStats['Exam']['id'];
        $chartName = "My Chartss";
        $mychart = $this->HighCharts->create($chartName,'pie');
        $this->HighCharts->setChartParams(
                                              $chartName,
                                              array(
                                                    'renderTo'=> "mywrapperss",  // div to display chart inside                                                
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
        $chartRerData=array($examStats['OverallResult']['passing']);
        $chartRerData1=array($examStats['OverallResult']['average']);
        $id=$examStats['Exam']['id'];
        $chartName = "My Chartor";
        $mychart = $this->HighCharts->create($chartName,'bar');
        $this->HighCharts->setChartParams(
                                              $chartName,
                                              array(
                                                    'renderTo'=> "mywrapperor",  // div to display chart inside                                                
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
        $this->set('examStats',$examStats);
        $this->set('post',$post);
        $this->set('id',$id);
        }
        catch (Exception $e)
        {
            $this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
            return $this->redirect(array('action' => 'index'));
        }
    }
    public function downloadlist($id=null,$type)
    {
        try{
        $this->layout='pdf';
        if (!$id)
        {
            $this->Session->setFlash(__('Invalid Post'),'flash',array('alert'=>'danger'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Exam->bindModel(array('hasAndBelongsToMany'=>array('Group'=>array('className'=>'Group',
                                                     'joinTable' => 'exam_groups',
                                                     'foreignKey' => 'exam_id',
                                                     'associationForeignKey' => 'group_id',
                                                     'conditions'=>"ExamGroup.group_id IN($this->userGroupWiseId)"))));
        $post = $this->Exam->findByIdAndStatus($id,'Closed');
        if (!$post)
        {
            $this->Session->setFlash(__('Invalid Post'),'flash',array('alert'=>'danger'));
            $this->redirect(array('action' => 'index'));
        }
        $this->pdfConfig = array('filename' => $type.'-Student-'.rand().'.pdf');
        $this->set('examResult',$this->Exam->examAttendance($id,$type));
        }
        catch (Exception $e)
        {
            $this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
            return $this->redirect(array('action' => 'index'));
        }
    }
    public function downloadabsentlist($id=null)
    {
        try{
        $this->layout='pdf';
        if (!$id)
        {
            $this->Session->setFlash(__('Invalid Post'),'flash',array('alert'=>'danger'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Exam->bindModel(array('hasAndBelongsToMany'=>array('Group'=>array('className'=>'Group',
                                                     'joinTable' => 'exam_groups',
                                                     'foreignKey' => 'exam_id',
                                                     'associationForeignKey' => 'group_id',
                                                     'conditions'=>"ExamGroup.group_id IN($this->userGroupWiseId)"))));
        $post = $this->Exam->findByIdAndStatus($id,'Closed');
        if (!$post)
        {
            $this->Session->setFlash(__('Invalid Post'),'flash',array('alert'=>'danger'));
            $this->redirect(array('action' => 'index'));
        }
        $this->pdfConfig = array('filename' => 'Absent-Student-'.rand().'.pdf');
        $this->set('examResult',$this->Exam->examAbsent($id,$type));
        }
        catch (Exception $e)
        {
            $this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
            return $this->redirect(array('action' => 'index'));
        }
    }
    public function aenotif($id=null,$offset=0)
    {
        try{
        if($this->emailNotification || $this->smsNotification)
        {
            $examCount=$this->Exam->find('count',array('conditions'=>array('Exam.id'=>$id,'Exam.status'=>'Active')));
            if($id==null || $examCount==0)
            {
                $this->Session->setFlash(__('Invalid Post'),'flash',array('alert'=>'danger'));
                $this->redirect(array('controller'=>'Exams','action' => 'index'));
            }
            $limit=10;
            $numRows=$this->Exam->find('count',array('fields'=>array('Student.name','Student.email','Student.phone','Exam.name','Exam.start_date','Exam.end_date','Exam.type'),
                                                     'joins'=>array(array('table'=>'exam_groups','alias'=>'ExamGroup','type'=>'Inner',
                                                                          'conditions'=>array('Exam.id=ExamGroup.exam_id','')),
                                                                    array('table'=>'student_groups','alias'=>'StudentGroup','type'=>'Inner',
                                                                          'conditions'=>array('StudentGroup.group_id=ExamGroup.group_id')),
                                                                    array('table'=>'students','alias'=>'Student','type'=>'Inner',
                                                                          'conditions'=>array('Student.id=StudentGroup.student_id')),
                                                                    ),
                                                     'conditions'=>array('Exam.status'=>'Active','Exam.id'=>$id,'Student.status'=>'Active'),
                                                     'order'=>array('Student.id'=>'asc'),
                                                     'group'=>array('StudentGroup.student_id')));
            $post=$this->Exam->find('all',array('fields'=>array('Student.name','Student.email','Student.phone','Exam.name','Exam.start_date','Exam.end_date','Exam.type'),
                                                     'joins'=>array(array('table'=>'exam_groups','alias'=>'ExamGroup','type'=>'Inner',
                                                                          'conditions'=>array('Exam.id=ExamGroup.exam_id','')),
                                                                    array('table'=>'student_groups','alias'=>'StudentGroup','type'=>'Inner',
                                                                          'conditions'=>array('StudentGroup.group_id=ExamGroup.group_id')),
                                                                    array('table'=>'students','alias'=>'Student','type'=>'Inner',
                                                                          'conditions'=>array('Student.id=StudentGroup.student_id')),
                                                                    ),
                                                     'conditions'=>array('Exam.status'=>'Active','Exam.id'=>$id,'Student.status'=>'Active'),
                                                     'order'=>array('Student.id'=>'asc'),
                                                     'group'=>array('StudentGroup.student_id'),
                                                     'limit'=>$limit,
                                                     'offset'=>$offset));
            foreach($post as $value)
            {
                $email=$value['Student']['email'];$studentName=$value['Student']['name'];$mobileNo=$value['Student']['phone'];
                $startDate=CakeTime::format($this->sysDay.$this->dateSep.$this->sysMonth.$this->dateSep.$this->sysYear.$this->dateGap.$this->sysHour.$this->timeSep.$this->sysMin.$this->dateGap.$this->sysMer,$value['Exam']['start_date']);
                $endDate=CakeTime::format($this->sysDay.$this->dateSep.$this->sysMonth.$this->dateSep.$this->sysYear.$this->dateGap.$this->sysHour.$this->timeSep.$this->sysMin.$this->dateGap.$this->sysMer,$value['Exam']['end_date']);
                $examName=$value['Exam']['name'];$type=$value['Exam']['type'];
                $siteName=$this->siteName;$siteEmailContact=$this->siteEmailContact;$url=$this->siteDomain;
                $smsMessage="Dear ".$studentName.", ".$value['Exam']['name']." Type ".$value['Exam']['type']." is active and start on ".$startDate." end on ".$endDate;
                if($this->emailNotification)
                {
                    /* Send Email */
                    $this->loadModel('Emailtemplate');
                    $emailTemplateArr=$this->Emailtemplate->findByType('EAN');
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
                    $smsTemplateArr=$this->Smstemplate->findByType('EAN');
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
                $this->redirect(array('controller'=>'Exams','action' => 'aenotif',$id,$offset));
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
    public function  maxquestion($id = null)
    {
        $this->layout = null;
        $this->loadModel('ExamQuestion');        
        $post=$this->ExamQuestion->find('all',array('fields'=>array('Subject.id','Subject.subject_name','ExamMaxquestion.id','ExamMaxquestion.max_question'),
                                                             'joins'=>array(array('table'=>'questions','type'=>'Inner','alias'=>'Question','conditions'=>array('Question.id=ExamQuestion.question_id')),
                                                                            array('table'=>'subjects','type'=>'Inner','alias'=>'Subject','conditions'=>array('Subject.id=Question.subject_id')),
                                                                            array('table'=>'exam_maxquestions','type'=>'Left','alias'=>'ExamMaxquestion','conditions'=>array('ExamQuestion.exam_id=ExamMaxquestion.exam_id','Subject.id=ExamMaxquestion.subject_id'))),
                                                             'conditions'=>array('ExamQuestion.exam_id'=>$id),
                                                             'group'=>array('Question.subject_id')));
        $this->set('post',$post);
        $this->set('examId',$id);
        if (!$post)
        {
            $this->Session->setFlash(__('There are no question added!'),'flash',array('alert'=>'danger'));
        }
        if($this->request->is('post'))
        {
            try
            {
                $this->loadModel('ExamMaxquestion');
                $this->ExamMaxquestion->saveAll($this->request->data);                
                $this->Session->setFlash('Maximum attempt question has been saved.','flash',array('alert'=>'success'));
                $this->redirect(array('action' => 'index'));
            }
            catch (Exception $e)
            {
                $this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
                $this->redirect(array('action' => 'index'));
            }
        }
        if (!$this->request->data)
        {
            $this->request->data = $post;
        }
    }
}
