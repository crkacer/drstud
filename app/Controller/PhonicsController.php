<?php
App::uses('ConnectionManager', 'Model');


class PhonicsController extends AppController
{
	public $helpers = array('Html','Paginator','Js'=> array('Jquery'));
    public $components = array('Paginator');
    public $currentDateTime,$studentId;
    var $paginate = array('page'=>1,'group'=>array('Subject.id'),'order'=>array('Subject.id'=>'desc'),
						  'joins'=>array(array('table'=>'subject_groups','type'=>'INNER','alias'=>'SubjectGroup','conditions'=>array('Subject.id=SubjectGroup.subject_id')),
                                        array('table'=>'student_groups','type'=>'INNER','alias'=>'StudentGroup','conditions'=>array('SubjectGroup.group_id=StudentGroup.group_id')),
                                         ));
	public $lessons_array = array();
    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->authenticate();
        $this->studentId=$this->userValue['Student']['id'];
        
    }
    public function index()
    {
	
		$this->log("Student ID->".$this->studentId,"application");
		
		$connection = ConnectionManager::getDataSource('default');
		$this->log("Executing Query","application");
//$results = $connection->execute('SELECT * FROM stude')->fetchAll('assoc');
		$results = $connection->execute('SELECT * FROM student_groups WHERE student_id = '.$this->studentId.'');
		//find group of student
		foreach ($results as $student_groups) {
			$this->log("Groups: ".$student_groups->group_id,"application");
			
			//find subjects
			$subjects_query = 'SELECT * FROM subject_groups WHERE group_id = '.$student_groups->group_id.'';
			$subjects_result = $connection->execute($subjects_query);
			
			foreach($subjects_result as $subjects) {
				$this->log("Subjects : ".$subjects->subject_id,"application");
				$subject_name_query = 'SELECT subject_name from subjects where id = "'.$subjects->subject_id.'"';
				$subject_name_result = $connection->execute($subject_name_query);
				$subject_name = null;
				
				foreach($subject_name_result as $name) {
					$subject_name = $name->subject_name;
					
				//		//Gross code
				}
				$this->log("Subject Name 1 : ".$subject_name,"application");
				
				//find lessons
				$lessons_query = 'SELECT * FROM lessons WHERE subject_id = '.$subjects->subject_id.'';
				$lessons_result = $connection->execute($lessons_query);
				foreach($lessons_result as $lesson) {
					$this->log("Lessons : ".$lesson->description,"application");
					$this->log("Subject Name 2 : ".$subject_name,"application");
					$lessons_array[] = array("Name"=>$subject_name,"Desc"=>$lesson->description);
				}
			}
		}
		$this->set("Lessons",$lessons_array);
		

	}

}
