<?php
echo $this->Form->input('lesson_id',array('options'=>array($lessonName),'empty'=>__('Please Select Lesson'),'class'=>'form-control validate[required]','div'=>false,'id'=>'lessonId','label'=>false));
?>