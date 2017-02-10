<?php
class Phonic extends AppModel
{
	 public $hasMany = array(
        'TypingPracticeQs' => array(
            'className' => 'Admin.Question',
            'order' => 'Question.created DESC'
        )
    );
	
}
?>