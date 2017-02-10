<?php echo $this->Session->flash();
$dateFormat=$sysDay.$dateSep.$sysMonth.$dateSep.$sysYear;?>
<div class="page-title-breadcrumb">
    <div class="page-header pull-left">
	<div class="page-title"><?php echo __('My Exams');?></div>
    </div>
</div>
<div class="panel">
    <div class="panel-heading">
        <div class="btn-group">
			<?php echo$this->Html->link(__("Todays Exam"),array('controller'=>'Exams','action'=>'index'),array('class'=>'btn btn-default'));?>
			<?php if($frontExamPaid){echo$this->Html->link(__("Purchased Exam"),array('controller'=>'Exams','action'=>'Purchased'),array('class'=>'btn btn-default'));}?>
			<?php echo$this->Html->link(__('Upcoming Exam'),array('controller'=>'Exams','action'=>'Upcoming'),array('class'=>'btn btn-default'));?>
			<?php if($frontExamPaid && $examExpiry){echo$this->Html->link(__('Expired Exam'),array('controller'=>'Exams','action'=>'Expired'),array('class'=>'btn btn-success'));}?>
		</div>
    </div>
<div class="panel-body">
		<div class="panel panel-default">
		<div class="panel-heading">
			<div class="widget">
				<h4 class="widget-title"><?php echo __('Expired Exam');?></h4>
			</div>
		</div>
			<div class="table-responsive">
				<table class="table table-striped">
					<?php if($expiredExam){?>
					<tr>
						<th colspan="9"><?php echo __('These are the exam(s) which has been expired');?></th>
					</tr>
					<?php echo$this->Function->showExamList("expired",$expiredExam,$currency,$dateFormat,$frontExamPaid,$examExpiry);?>
					<?php }else{?>
					<tr>
						<th colspan="9"><?php echo __('No Exams found');?></th>
					</tr>
					<?php }?>
				</table>
			</div>
		</div> 
	</div>
</div>
<div class="modal fade" id="targetModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-content">        
  </div>
</div>