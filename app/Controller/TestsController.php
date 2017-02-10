<?php
App::uses('CakeTime', 'Utility');
App::uses('Paypal', 'Paypal.Lib');
class TestsController extends AppController
{
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
	}
}
