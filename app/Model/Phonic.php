<?php
class Phonic extends AppModel
{
	 public $hasMany = array(
        'PhonicPracticeQs' => array(
            'className' => 'Admin.Question',
            'order' => 'Question.created DESC'
        )
    );
/*
	public function insert($id) {
    $this->insertLocation= array('locationData'=>'INSERT INTO `student_homeworks`(`id`, `student_id`, `question_type`, `record_location`, `subject_id`) VALUES (NULL, 1, "R","/appp", 6)');
   
  }*/
	
}
?>