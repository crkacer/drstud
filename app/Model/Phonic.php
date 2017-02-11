<?php
class Phonic extends AppModel
{
	 public $hasMany = array(
        'PhonicPracticeQs' => array(
            'className' => 'Admin.Question',
            'order' => 'Question.created DESC'
        )
    );
	
}
?>