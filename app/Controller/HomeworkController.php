<?php
App::uses('CakeTime', 'Utility');
App::uses('Paypal', 'Paypal.Lib');
class HomeworkController extends AppController
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
		$this->log("Student ID->".$this->studentId,"application");
		
		$connection = ConnectionManager::getDataSource('default');
		$this->log("Executing Query","application");
//$results = $connection->execute('SELECT * FROM stude')->fetchAll('assoc');
		$results = $connection->execute('SELECT * FROM student_groups WHERE student_id = '.$this->studentId.'');
		
		
	}
}
