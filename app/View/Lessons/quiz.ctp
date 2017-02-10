<?php $dateFormat=$sysDay.$dateSep.$sysMonth.$dateSep.$sysYear; ?>
<div class="container">
    <div class="panel panel-custom mrg">
        <div class="panel-heading"><?php echo __('Quizzes');?><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button></div>
	<div class="panel-body">
	    <div class="table-responsive">
		<table class="table table-bordered">
		    <tr>
			<th><?php echo __('Quiz')?></th>
			<th><?php echo __('End date')?></th>
			<th><?php echo __('Attempt Remaining')?></th>
			<th><?php echo __('Action')?></th>
		    </tr>
		<?php foreach($post as $exam): $id=$exam['Exam']['id']; $instructionUrl=$this->Html->url(array('controller'=>'Exams','action'=>"instruction/$id")); $viewUrl=$this->Html->url(array('action'=>"view/$id")); if($exam['Exam']['attempt_count']==0){$pendingAttempt=__('Unlimited');}else{ if($exam['Exam']['paid_exam']==1 && !$exam['ExamOrder']['expiry_date']){$pendingAttempt=__('Not Purchased');}else{if($exam['Exam']['paid_exam']==1)$pendingAttempt=($exam['Exam']['attempt_order']*$exam['Exam']['attempt_count']-$exam['Exam']['attempt']);else$pendingAttempt=($exam['Exam']['attempt_count']-$exam['Exam']['attempt']);}}?>	
		    <tr>
			<td><?php echo h($exam['Exam']['name']);?></td>
			<td><?php echo CakeTime::format($dateFormat,$exam['Exam']['end_date']);?></td>
			<td><?php echo $pendingAttempt;?></td>
			<td><strong><small class="text-danger"><?php echo $this->Html->link('<span class="fa fa-arrows-alt"></span>','javascript:void(0);',array('data-toggle'=>'tooltip','title'=>__('View Details'),'onclick'=>"show_modal('$viewUrl/$lessonId');",'escape'=>false,'class'=>'btn btn-info'));?>&nbsp;&nbsp;<?php echo $this->Html->link('<span class="fa fa-sign-in"></span>',array('controller'=>'Exams','action'=>'guidelines',$id),array('data-toggle'=>'tooltip','title'=>__('Attempt Now'),'escape'=>false,'target'=>'_blank','class'=>'btn btn-success'));?>
			</small></strong></td>			
		    </tr>
		<?php endforeach;?>	
		</table>
	    </div>
	</div>
    </div>
</div>