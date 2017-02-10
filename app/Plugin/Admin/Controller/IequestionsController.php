<?php
class IequestionsController extends AdminAppController {
    public $helpers = array('Html', 'Form','Session');
    public $components = array('Session','ExportCsv.Export');
    
    public function index()
    {
        try
        {
            $this->loadModel('Subject');
            $this->loadModel('Group');
            $this->set('subject_id', $this->Subject->find('list',array('fields'=>array('id','subject_name'),
                                                                       'joins'=>array(array('table'=>'subject_groups','type'=>'INNER','alias'=>'SubjectGroup','conditions'=>array('Subject.id=SubjectGroup.subject_id'))),
                                                                       'conditions'=>array("SubjectGroup.group_id IN($this->userGroupWiseId)"))));
            $this->set('group_id', $this->Group->find('list',array('fields'=>array('id','group_name'),'conditions'=>array("Group.id IN($this->userGroupWiseId)"))));
        }
        catch (Exception $e)
        {
            $this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
        }
    }
    public function importcsv()
    {
        try
        {
            if ($this->request->is('post'))
            {
                if(is_array($this->request->data['QuestionGroup']['group_name']))
                {
                    if(strlen($this->request->data['Iequestion']['subject_id'])>0)
                    {
                        $fixed = array('Iequestion' => array('subject_id' => $this->request->data['Iequestion']['subject_id']));
                        $groupName=$this->request->data['QuestionGroup']['group_name'];
                        $filename = null;$extension=null;
                        $extension = pathinfo($this->request->data['Iequestion']['file']['name'],PATHINFO_EXTENSION);
                        if($extension=="csv")
                        {
                            if (!empty($this->request->data['Iequestion']['file']['tmp_name']) && is_uploaded_file($this->request->data['Iequestion']['file']['tmp_name']))
                            {
                                $filename = basename($this->request->data['Iequestion']['file']['name']);
                                move_uploaded_file($this->data['Iequestion']['file']['tmp_name'],APP . DS . 'tmp' . DS . 'csv' . DS . $filename);
                                $this->Iequestion->importCSV(APP . DS . 'tmp' . DS . 'csv' . DS . $filename,$fixed,$groupName,'QuestionGroup');
                                $this->Session->setFlash(__('Questions imported successfully'),'flash',array('alert'=>'success'));
                                return $this->redirect(array('action' => 'index'));
                            }
                            else
                            {
                                $this->Session->setFlash(__('File not uploaded'),'flash',array('alert'=>'danger'));
                                return $this->redirect(array('action' => 'index'));
                            }
                        }
                        else
                        {
                            $this->Session->setFlash(__('Only CSV File supported'),'flash',array('alert'=>'danger'));
                            return $this->redirect(array('action' => 'index'));
                        }
                    }
                    else
                    {
                        $this->Session->setFlash(__('Please Select Subject'),'flash',array('alert'=>'danger'));
                        return $this->redirect(array('action' => 'index'));
                    }
                }
                else
                {
                    $this->Session->setFlash(__('Please Select any Group'),'flash',array('alert'=>'danger'));
                    return $this->redirect(array('action' => 'index'));
                }
            }
        }
        catch (Exception $e)
        {
            $this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
            return $this->redirect(array('action' => 'index'));
        }
    }
    public function exportcsv()
    {
        try
        {
            $data=$this->exportData();
            $this->Export->exportCSV($data,'question.csv');
        }
        catch (Exception $e)
        {
            $this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
            return $this->redirect(array('action' => 'index'));
        }
    }
    private function exportData()
    {
        try
        {
            $this->Iequestion->UserWiseGroup($this->userGroupWiseId);
            $post=$this->Iequestion->find('all',array('joins'=>array(array('table'=>'question_groups','type'=>'INNER','alias'=>'QuestionGroup','conditions'=>array('Iequestion.id=QuestionGroup.question_id')),
                                                                     array('table'=>'user_groups','type'=>'INNER','alias'=>'UserGroup','conditions'=>array('QuestionGroup.group_id=UserGroup.group_id'))),
                                                      'conditions'=>array('UserGroup.user_id'=>$this->luserId),
                                                      'group'=>array('Iequestion.id')));
            $data=$this->CustomFunction->showQuestionData($post);
            return $data;
        }
        catch (Exception $e)
        {
            $this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
            return $this->redirect(array('action' => 'index'));
        }
    
    }    
}
