<?php echo $this->Html->scriptBlock('$(document).ready(function(){$("#checkme").click(function() {$("#submitaccept").attr("disabled", !this.checked);});});',array('inline'=>true));?>
<div class="col-md-9 col-sm-offset-2">
    <div class="panel panel-default">
	<div class="panel-heading"><strong><?php echo __('Instructions');?></strong></div>
	<div class="panel-body">
	    <strong><?php echo str_replace("<script","",$post['Exam']['instruction']);?></strong>
	    <?php echo$this->Form->input('accept',array('type'=>'checkbox','id'=>'checkme','label'=>__('I am ready to begin'),'hiddenField'=>false));?>
	    <?php
	    if($post['Exam']['paid_exam']==1)
	    {
		if($ispaid==true)
		{?>
		<p><?php echo $this->Form->postLink(__('Start'),array('action' => 'start', $post['Exam']['id']),array('id'=>'submitaccept','class'=>'btn btn-success'));?></p>
		<?php }
		else{?>
		<p><?php echo $this->Form->postLink(__('Start'),array('action' => 'paid', $post['Exam']['id']),array('confirm' =>__('This Exam is paid. Amount should be deducted on your wallet automatically. After starting the exam timer will not stop. Do you want to pay & start?'),'id'=>'submitaccept','disabled'=>'disabled','class'=>'btn btn-danger'));?></p>
		<?php }
	    }
	    else
	    {?>
		<p><?php echo $this->Form->postLink(__('Start'),array('action' => 'start', $post['Exam']['id']),array('id'=>'submitaccept','disabled'=>'disabled','class'=>'btn btn-success'));?></p>
	    <?php }?>
	</div>
    </div>
</div>