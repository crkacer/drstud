<?php
class MygroupsController extends AppController
{
    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->authenticate();
        $this->studentId=$this->userValue['Student']['id'];
    }
    public function index()
    {
        $this->loadModel('Student');
        $this->Mygroup->virtualFields= array('fexpiry_date'=>'SELECT `StudentGroup`.`expiry_date` FROM `student_groups` AS `StudentGroup` WHERE `StudentGroup`.`student_id`=`StudentGroup`.`student_id` AND `StudentGroup`.`group_id`=`Mygroup`.`id` AND `StudentGroup`.`student_id`='.$this->studentId.' ORDER BY `StudentGroup`.`id` DESC LIMIT 1',
                                             'start_date'=>'SELECT `StudentGroup`.`date` FROM `student_groups` AS `StudentGroup` WHERE `StudentGroup`.`student_id`=`StudentGroup`.`student_id` AND `StudentGroup`.`group_id`=`Mygroup`.`id` AND `StudentGroup`.`student_id`='.$this->studentId.' ORDER BY `StudentGroup`.`id` DESC LIMIT 1');
        $Mygroup=$this->Mygroup->find('all',array('fields'=>array('Mygroup.id','Mygroup.group_name','fexpiry_date','start_date'),
                                                  'conditions'=>array('StudentGroup.student_id'=>$this->studentId),
                                                  'order'=>array('Mygroup.group_name'=>'asc'),
                                                  'group'=>array('Mygroup.id')));
        $studentArr=$this->Student->findById($this->studentId);
        $this->set('Mygroup',$Mygroup);
        $this->set('studentArr',$studentArr);
    }
    public function renew($id)
    {
        $post=$this->Mygroup->findById($id);
        if(!$post)
        return $this->redirect(array('action' => 'index'));
        $this->Cart->addPackage($id);
        return $this->redirect(array('controller'=>'Checkouts','action' => 'payment'));
    }
}