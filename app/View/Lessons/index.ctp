<?php echo $this->Html->scriptBlock('$(document).ready(function(){$("#checkme").click(function() {$("#submitaccept").attr("disabled", !this.checked);});});',array('inline'=>true));?>
<?php $url=$this->Html->url(array('controller'=>'Lessons'));?>
<?php echo $this->Session->flash();?>
<div class="page-title-breadcrumb">
    <div class="page-header pull-left">
	<div class="page-title"><?php echo h($Lesson['Lesson']['name']);?></div>
    </div>
</div>
<div class="panel">
	<div class="panel-body">
		<div class="page-title"><?php echo $Lesson['Lesson']['description'];?></div>
		<div class=""><?php echo$this->Form->input('accept',array('type'=>'checkbox','id'=>'checkme','label'=>__('I have read the lesson. I am ready to begin the quiz'),'hiddenField'=>false));?></div>
		<div class=""><p><?php $id=$Lesson['Lesson']['id']; echo $this->Form->button(__('Quiz'),array('onclick'=>"show_modal('$url/quiz/$id');",'id'=>'submitaccept','disabled'=>'disabled','class'=>'btn btn-success'));?></p></div>
	</div>
</div>
<div class="modal fade" id="targetModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-content">        
  </div>
</div>