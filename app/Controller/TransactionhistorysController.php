<?php
class TransactionhistorysController extends AppController
{
    public $helpers = array('Paginator','Js'=> array('Jquery'));
    public $components = array('Paginator');
    public $currentDateTime,$studentId;
    var $paginate = array('page'=>1,'order'=>array('Transactionhistory.id'=>'desc'));
    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->authenticate();
        $this->studentId=$this->userValue['Student']['id'];
    }
    public function index()
    {
        $this->Paginator->settings = $this->paginate;
        $this->Paginator->settings['conditions'] = array('Transactionhistory.student_id'=>$this->studentId);
        $this->Paginator->settings['limit']=$this->pageLimit;
        $this->Paginator->settings['maxLimit']=$this->maxLimit;
        $this->set('Transactionhistory', $this->Paginator->paginate());
        $payment_type_arr=array("AD"=>__('Administrator'),"PG"=>__('Payment Gateway'),"EM"=>__('Pay Exam'));
        $this->set('payment_type_arr',$payment_type_arr);
        if ($this->request->is('ajax'))
        {
            $this->render('index','ajax'); // View, Layout
        }
    }    
}
