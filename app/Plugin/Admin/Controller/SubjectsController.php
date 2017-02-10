<?php
class SubjectsController extends AdminAppController {
    public $helpers = array('Html', 'Form','Session','Paginator','Paginator','Js'=> array('Jquery'));
    public $components = array('Session','Paginator','search-master.Prg');
    public $presetVars = true;
    var $paginate = array('fields'=>array('Subject.id','Subject.subject_name','qbank_count'),
                          'joins'=>array(array('table'=>'questions','type'=>'LEFT','alias'=>'Question','conditions'=>array('Subject.id=Question.subject_id')),
                                         array('table'=>'subject_groups','type'=>'LEFT','alias'=>'SubjectGroup','conditions'=>array('Subject.id=SubjectGroup.subject_id')),
                                         array('table'=>'question_groups','type'=>'LEFT','alias'=>'QuestionGroup','conditions'=>array('Question.id=QuestionGroup.question_id')),
                                         array('table'=>'user_groups','type'=>'LEFT','alias'=>'UserGroup','conditions'=>array('SubjectGroup.group_id=UserGroup.group_id'))),
                          'page'=>1,'order'=>array('Subject.subject_name'=>'asc'),'group'=>array('Subject.id'));
    public function index()
    {
        try
        {
            $this->Subject->UserWiseGroup($this->userGroupWiseId);
            $this->Prg->commonProcess();
            $this->Subject->virtualFields= array('qbank_count' => 'Count(DISTINCT(Question.id))');
            $this->Paginator->settings = $this->paginate;
            if($this->adminId!=1)
            $cond=array('UserGroup.user_id'=>$this->luserId);
            $this->Paginator->settings['conditions'] = array($this->Subject->parseCriteria($this->Prg->parsedParams()),$cond);
            $this->Paginator->settings['limit']=$this->pageLimit;
            $this->Paginator->settings['maxLimit']=$this->maxLimit;
            $cond="";
            $cond=" 1=1 AND `UserGroup`.`user_id`=$this->luserId";
            $this->Paginator->settings['conditions'] = array($this->Subject->parseCriteria($this->Prg->parsedParams()),$cond);
            $this->set('Subject', $this->Paginator->paginate());
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
        $this->loadModel('SubjectGroup');        
        $this->set('group_id', $this->Group->find('list',array('fields'=>array('id','group_name'),'conditions'=>array("Group.id IN($this->userGroupWiseId)"))));
        if ($this->request->is('post'))
        {
            try
            {
                $subjectArr=$this->Subject->find('first',array('conditions'=>array('subject_name'=>$this->request->data['Subject']['subject_name'])));
                if($subjectArr)
                {
                    if(is_array($this->request->data['SubjectGroup']['group_name']))
                    {
                        foreach($this->request->data['SubjectGroup']['group_name'] as $groupId)
                        {
                            if($this->SubjectGroup->find('count',array('conditions'=>array('subject_id'=>$subjectArr['Subject']['id'],'group_id'=>$groupId)))==0)                
                            $multiGroup[]=array('subject_id'=>$subjectArr['Subject']['id'],'group_id'=>$groupId);
                        }
                        if($multiGroup)
                        {
                            $this->SubjectGroup->create();
                            $this->SubjectGroup->saveAll($multiGroup);
                            $this->Session->setFlash(__('Subject Added Successfully'),'flash',array('alert'=>'success'));
                            return $this->redirect(array('action' => 'add'));
                        }
                        else
                        {
                            $this->Session->setFlash(__('Subject already exist'),'flash',array('alert'=>'danger'));
                        }
                    }
                    else
                    {
                        $this->Session->setFlash(__('Please Select atleast one group'),'flash',array('alert'=>'danger'));
                    }
                }
                else
                {
                    if(is_array($this->request->data['SubjectGroup']['group_name']))
                    {
                        $this->Subject->create();
                        if ($this->Subject->save($this->request->data))
                        {
                            foreach($this->request->data['SubjectGroup']['group_name'] as $groupId)
                            {
                                $multiGroup[]=array('subject_id'=>$this->Subject->id,'group_id'=>$groupId);
                            }
                            $this->SubjectGroup->create();
                            $this->SubjectGroup->saveAll($multiGroup);
                            $this->Session->setFlash(__('Subject Added Successfully'),'flash',array('alert'=>'success'));
                            return $this->redirect(array('action' => 'add'));
                        }
                    }
                    else
                    {
                        $this->Session->setFlash(__('Please Select atleast one group'),'flash',array('alert'=>'danger'));
                    }
                }
            }
            catch (Exception $e)
            {
                $this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
            }
        }
    }
    public function edit($id = null)
    {
        if (!$id)
        {
            throw new NotFoundException(__('Invalid post'));
        }
        $this->Subject->UserWiseGroup($this->userGroupWiseId);
        $this->loadModel('Group');
        $this->set('group_id', $this->Group->find('list',array('fields'=>array('id','group_name'),'conditions'=>array("Group.id IN($this->userGroupWiseId)"))));
        $ids=explode(",",$id);
        $post=array();
        foreach($ids as $id)
        {
            $post[]=$this->Subject->findByid($id);
            $this->Subject->UserWiseGroup($this->userGroupWiseId);
        }
        $this->set('Subject',$post);
        if (!$post)
        {
            throw new NotFoundException(__('Invalid post'));
        }
        if ($this->request->is(array('post', 'put')))
        {
            $isSave=true;
            $this->Subject->id = $id;
            try
            {
                foreach($this->request->data as $k=> $value)
                {
                    if(!is_array($value['SubjectGroup']['group_name']))
                    {
                        $this->Session->setFlash(__('Please Select any group'),'flash',array('alert'=>'danger'));
                        $isSave=false;
                        break;
                    }
                }
                if($isSave==true)
                {
                    if($this->Subject->saveAll($this->request->data))
                    {
                        
                        $this->loadModel('SubjectGroup');
                        foreach($this->request->data as $k=> $value)
                        {
                            $subjectId=$value['Subject']['id'];
                            $this->SubjectGroup->deleteAll(array('SubjectGroup.subject_id'=>$subjectId,"SubjectGroup.group_id IN($this->userGroupWiseId)"));
                            foreach($value['SubjectGroup']['group_name'] as $groupId)
                            {
                                $SubjectGroup[]=array('subject_id'=>$subjectId,'group_id'=>$groupId);
                            }
                        }
                        $this->SubjectGroup->create();
                        $this->SubjectGroup->saveAll($SubjectGroup);
                        $this->Session->setFlash(__('Subject has been updated'),'flash',array('alert'=>'success'));
                        return $this->redirect(array('action' => 'index'));
                    }
                }
            }
            catch (Exception $e)
            {
                $this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->set('isError',True);
        }
        else
        {
            $this->layout = 'ajax';
            $this->set('isError',false);
        }
        if (!$this->request->data)
        {
            $this->request->data = $post;
        }
    }    
    public function deleteall()
    {
        if ($this->request->is('post'))
        {
            try
            {
                $this->loadModel('SubjectGroup');
                $this->SubjectGroup->begin('SubjectGroup');
                foreach($this->data['Subject']['id'] as $key => $value)
                {
                    $this->SubjectGroup->deleteAll(array('SubjectGroup.subject_id'=>$value,"SubjectGroup.group_id IN($this->userGroupWiseId)"));
                }
                $this->Subject->query("DELETE `Subject` FROM `subjects` AS `Subject` LEFT JOIN `subject_groups` AS `SubjectGroup` ON `Subject`.`id` = `SubjectGroup`.`subject_id` WHERE `SubjectGroup`.`id` IS NULL");
                $this->SubjectGroup->commit();
                $this->Session->setFlash(__('Subject has been deleted'),'flash',array('alert'=>'success'));
            }
            catch (Exception $e)
            {
                $this->SubjectGroup->rollback('SubjectGroup');
                $this->Session->setFlash(__('Delete exam first!'),'flash',array('alert'=>'danger'));
                return $this->redirect(array('action' => 'index'));
            }
        }        
        $this->redirect(array('action' => 'index'));
    }
}
