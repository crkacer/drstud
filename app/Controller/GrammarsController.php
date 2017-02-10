<?php

class GrammarsController extends AppController
{
    public $currentDateTime,$studentId;
	public $vocahw_array = array();

	    public $helpers = array('Html','Paginator','Js'=> array('Jquery'));
    public $components = array('Paginator');

    var $paginate = array('limit' => 1);
	
    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->authenticate();
        $this->studentId=$this->userValue['Student']['id'];
		$this->SubjectName="Grammar";
        $this->limit=5;
    }
    public function index()
    {
		
		$vocahw = $this->Grammar->GrammarPracticeQs->find('all', array('conditions' => array('GrammarPracticeQs.category' => "Homework",'Subject.subject_name' => "Grammar")));
		//$vocahw = $this->Vocabulary->VocaHwQuestion->find('all');`VocaHwQuestion`.`modified`2017-01-04 19:18:00
		$this->log("Student ID->".$this->studentId,"application");
		
		$connection = ConnectionManager::getDataSource('default');
		$vocahw_query = 'SELECT q.* from questions as q, question_groups as qg, subjects as s, student_groups as sg where sg.student_id = "'.$this->studentId.'" and s.subject_name = "'.$this->SubjectName.'" and q.subject_id = s.id and sg.group_id = qg.group_id and qg.question_id = q.id';
		
		$this->log("Executing Query->".$vocahw_query,"application");
//$results = $connection->execute('SELECT * FROM stude')->fetchAll('assoc');
		$vocahw_results = $connection->execute($vocahw_query);
		//find group of student
		foreach ($vocahw_results as $question) {
			$this->log("Questions: ".$question->id,"application");
							
			$vocahw_array[] = $question->id;
		}
		$this->set("vocahwqs",$vocahw_array);
		$this->set('vocahw', $vocahw);
		//Find Subject ID
		
		//Find Student ID
		
		//Find Group ID
		
		//Find Questions of Subject ID in Group ID where Student belongs to Group
		//Filter by todays' date and yesterday's date;
		
		//Fill up question array
	}
}
