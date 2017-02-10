<?php
class TypingPractice extends AppModel
{
  //public $validationDomain='validation';
  //public $hasAndBelongsToMany=array('Exam'=>array('className'=>'Exam',
  //                                                   'joinTable' => 'packages_exams',
  //                                                   'foreignKey' => 'package_id',
  //                                                   'associationForeignKey' => 'exam_id'));
 //private $videoUrl = "http://dev.drstud.com/Lessons/index/2";
	 //public $recursive = -1;
	 public $hasMany = array(
        'TypingPracticeQs' => array(
            'className' => 'Admin.Question',
            //'conditions' => array('VocaHwQuestion.category' => "Homework"),
            'order' => 'Question.created DESC'
        )
    );
	
}
?>