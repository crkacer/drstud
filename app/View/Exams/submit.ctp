<style type="text/css">
.modal-backdrop {background-color:#000;}
.modal-backdrop.in{opacity: .5;}
</style>
<div class="container">
	<div class="row">
	<div class="col-md-7 col-sm-offset-2 mrg">
			<div class="panel panel-default">
			<div class="panel-heading">
				<div class="widget-modal">
					<h4 class="widget-modal-title"><span><?php echo __('Finalize');?> <?php if($post['Exam']['type']=="Exam") echo __('Quiz');else echo$post['Exam']['type'];?></span>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</h4>
				</div>
			</div>
			<div class="panel-body">
			<p><?php echo __('Do you wish to submit and close the');?> <?php echo$post['Exam']['type'];?> <?php echo __('Once you submit, you will not be able to review the');?> <?php if($post['Exam']['type']=="Exam") echo __('Quiz');else echo$post['Exam']['type'];?></p>
			<p><?php echo __('Summary of your attempts in this');?> <?php if($post['Exam']['type']=="Exam") echo __('Quiz');else echo$post['Exam']['type'];?> <?php echo __('as show below');?></p>
			<div class="row"><div class="col-xs-4"><h4><?php echo __('Attempted');?></h4></div><div class="col-xs-3"><h4><span class="label label-default"><?php echo$attempted;?></span></h4></div></div>
			<div class="row"><div class="col-xs-4"><h4><?php echo __('Not Attempted');?></h4></div><div class="col-xs-3"><h4><span class="label label-default"><?php echo$notAttempted;?></span></h4></div></div>
			<div class="row"><div class="col-xs-4"><h4><?php echo __('Answered');?></h4></div><div class="col-xs-3"><h4><span class="label label-success"><?php echo$answered;?></span></h4></div></div>
			<div class="row"><div class="col-xs-4"><h4><?php echo __('Not Answered');?></h4></div><div class="col-xs-3"><h4><span class="label label-warning"><?php echo$notAnswered;?></span></h4></div></div>
			<div class="row"><div class="col-xs-4"><h4><?php echo __('Review');?></h4></div><div class="col-xs-3"><h4><span class="label label-primary"><?php echo$review;?></span></h4></div></div>
			<div class="row">
				<div class="col-sm-4">
					<?php echo $this->Form->postLink('<span class="glyphicon glyphicon-lock"></span>&nbsp;'.__('Finish'),array('controller'=>'Exams','action' => 'finish', $examId),array('class'=>'btn btn-success','escape'=>false));?>
				</div>
				<div class="col-sm-3">
					<button type="button" class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span><?php echo __('Cancel');?></button>
				</div>
				<div class="col-sm-4">
					<?php echo$this->Html->link('&larr;'.__('Return To First Question'),array('action'=>'start',$examId,1),array('class'=>'btn btn-warning','escape'=>false));?>
				</div>
			</div>
			</div>
		</div>
	</div>
	</div>
</div>
