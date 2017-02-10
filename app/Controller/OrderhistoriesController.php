<?php
class OrderhistoriesController extends AppController
{
    public $helpers = array('Paginator');
    public $components = array('Paginator');
    public $currentDateTime,$studentId;
    var $paginate = array('limit'=>20,'maxLimit'=>500,'page'=>1,'order'=>array('Orderhistory.id'=>'desc'));
    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->authenticate();
        $this->studentId=$this->userValue['Student']['id'];
    }
    public function index()
    {
        $this->Paginator->settings = $this->paginate;
        $this->Paginator->settings['conditions'] = array('Payment.student_id'=>$this->studentId,'Payment.status'=>'Approved');
        $this->set('Order', $this->Paginator->paginate());
    }
    public function view($id)
    {
        $this->layout = null;
        $postArr=$this->Orderhistory->find('all',array('conditions'=>array('Payment.id'=>$id)));
        $this->set('postArr',$postArr);
    }
}
