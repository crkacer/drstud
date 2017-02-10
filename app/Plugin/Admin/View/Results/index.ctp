<?php echo $this->Session->flash();?>
		<?php if(!isset($studentId)){?>
			<div class="page-title"> <div class="title-env"> <h1 class="title"><?php echo __('Exam Wise');?></h1></div></div>
			<div class="panel">
				<div class="panel-body">
					<?php echo $this->Form->create('Result',array('class'=>'form-horizontal'));?>
					<div class="form-group">
					<label for="subject_name" class="col-sm-2 control-label"><small><?php echo __('Group');?></small></label>
						<div class="col-sm-6">
						<?php echo $this->Form->select('StudentGroup.group_name',$group_id,array('multiple'=>true,'label' => false,'class'=>'form-control multiselectgrp','div'=>false));?>
						</div>
					</div>
					<div class="form-group">
					<label for="subject_name" class="col-sm-2 control-label"><small><?php echo __('Name of Exam');?></small></label>
						<div class="col-sm-4">
						<?php echo $this->Form->select('id',$examOptions,array('empty'=>__('Please Select Exam'),'class'=>'form-control'));?>
						</div>
					<label for="subject_name" class="col-sm-2 control-label"><small><?php echo __('Status of Result');?></small></label>
						<div class="col-sm-4">
						<?php  echo $this->Form->select('status',array("Pass"=>__('PASSED'),"Fail"=>__('FAILED')),array('empty'=>__('Please Select Result Status'),'class'=>'form-control'));?>
						</div>
					</div>
					<div class="form-group text-left">
					    <div class="col-sm-offset-2 col-sm-7">
					    <?php echo$this->Form->button('<span class="fa fa-search"></span>&nbsp;'.__('Search'),array('class'=>'btn btn-success','escpae'=>false));?>
				    </div>
					</div>
					<?php echo $this->Form->input('examWise',array('type'=>'hidden','value'=>'1'));
					echo$this->Form->end();?>
					<?php if($isExam){$status=$this->request->data['Result']['status'];$examId=$this->request->data['Result']['id'];$studentGroup=null;
					if(is_array($this->request->data['StudentGroup']['group_name'])){$studentGroup=implode(",",$this->request->data['StudentGroup']['group_name']);}?>
					<div class="text-left"><?php echo$this->Html->link('<span class="fa fa-download"></span>&nbsp;'.__('Download Result'),array('controller'=>'Results','action'=>'downloadresult',"examId:$examId","stuentGroup:$studentGroup","status:$status",'ext' => 'pdf'),array('class'=>'btn btn-info','escape'=>false));?></div>
					<div class="table-responsive">
						<table class="table table-striped table-bordered">
							<tr class="default">
							    <th><?php echo __('Rank');?></th>
							    <th><?php echo __('Student Name');?></th>
							    <th><?php echo __('Email');?></th>
							    <th><?php echo __('Test');?></th>
							    <th><?php echo __('Max Marks');?></th>
							    <th><?php echo __('Marks Scored');?></th>
							    <th><?php echo __('Percent');?></th>
							    <th><?php echo __('Result');?></th>
							    <th><?php echo __('Action');?></th>
							</tr>
							<?php foreach($examResult as $rank=>$examValue):
							$url=$this->Html->url(array('controller'=>'Results'));
							$id=$examValue['ExamResult']['id'];?>
							<tr>
								<td><?php echo++$rank;?></td>
								<td><?php echo $this->Html->link(h($examValue['Student']['name']),'#',array('onclick'=>"show_modal('$url/View/$id');",'escape'=>false));?></td>
								<td><?php echo$examValue['Student']['email'];?></td>
								<td><?php echo$examValue['Exam']['name'];?></td>
								<td><?php echo$examValue['ExamResult']['total_marks'];?></td>
								<td><?php echo$examValue['ExamResult']['obtained_marks'];?></td>
								<td><?php echo$examValue['ExamResult']['percent'].'%';?></td>
								<td><span class="label label-<?php if($examValue['ExamResult']['result']=="Pass")echo"success";else echo"danger";?>"><?php if($examValue['ExamResult']['result']=="Pass"){echo __('PASSED');}else{ echo __('FAILED');}?></span></td>
								<td><?php echo$this->Html->link('<span class="fa fa-arrows-alt"></span>&nbsp; ',array('action'=>'result',$examValue['ExamResult']['id']),array('data-toggle'=>'tooltip','title'=>__('View Result'),'escape'=>false));?>
								<?php echo$this->Html->link('<span class="fa fa-print"></span>&nbsp; ',array('controller'=>'../Results','action'=>'printresult',$examValue['ExamResult']['id']),array('data-toggle'=>'tooltip','title'=>__('Download/Print Result'),'target'=>'_blank','escape'=>false));?>
								<?php echo$this->Form->postlink('<span class="fa fa-trash"></span>&nbsp; ',array('action'=>'delete',$examValue['ExamResult']['id']),array('confirm' => __('Are you sure you want to delete record'),'data-toggle'=>'tooltip','title'=>__('Delete Result'),'escape'=>false));?></td>
							</tr>
							<?php endforeach;unset($examValue);?>
						</table>
						</div><?php echo $this->Form->end();?>
					<?php }?>
					</div>	
			</div>
				<div class="page-title"> <div class="title-env"> <h1 class="title"><?php echo __('Student Wise');?></h1></div></div>
			<div class="panel">
				<div class="panel-body">	
					<?php echo $this->Form->create('Result',array('class'=>'form-horizontal'));?>
					<div class="form-group">
					<label for="subject_name" class="col-sm-3 control-label"><small><?php echo __('Name or Enrolment Number');?></small></label>
						<div class="col-sm-3">
						<?php echo $this->Form->input('name',array('label' => false,'class'=>'form-control input-sm]','placeholder'=>__('Name or Enrolment Number'),'div'=>false));?>				
						</div>
					</div>
					<div class="form-group">
					<label for="subject_name" class="col-sm-3 control-label"><small><?php echo __('Group');?></small></label>
						<div class="col-sm-3">
						<?php echo $this->Form->select('StudentGroup.group_name',$group_id,array('multiple'=>true,'label' => false,'class'=>'form-control multiselectgrp','div'=>false));?>
						</div>
					</div>
					<div class="form-group text-left">
						<div class="col-sm-offset-3 col-sm-7">
							<?php echo$this->Form->button('<span class="fa fa-search"></span>&nbsp;'.__('Search'),array('class'=>'btn btn-success','escpae'=>false));?>
						</div>
					</div>
					<?php echo $this->Form->input('studentWise',array('type'=>'hidden','value'=>'1'));
					echo$this->Form->end();?>
				</div>			
					
					<?php if($isStudent){?>
						<div class="table-responsive">
						<table class="table table-striped table-bordered">
							<tr class="default">
								<th><?php echo __('Student Name');?></th>
								<th><?php echo __('Email');?></th>
								<th><?php echo __('Enrolment Number');?></th>
								<th><?php echo __('Group');?></th>						
							</tr>
							<?php foreach($studentDetails as $studentValue):
							$url=$this->Html->url(array('controller'=>'Results'));
							?>
							<tr>
								<td><?php echo $this->Html->link(h($studentValue['Student']['name']),array('action'=>'index',$studentValue['Student']['id']));?></td>
								<td><?php echo h($studentValue['Student']['email']);?></td>
								<td><?php echo h($studentValue['Student']['enroll']);?></td>
								<td><?php echo $this->Function->showGroupName($studentValue['Group']);?></td>
							</tr>
							<?php endforeach;unset($studentValue);?>
						</table>
						</div>
					<?php }}?>
					<?php if(isset($examResult) && isset($studentId)){?>
						<?php echo$this->html->link('<span class="fa fa-arrow-left"></span>&nbsp;'.__('Back'),'javascript: history.go(-1)',array('class'=>'btn btn-info','escape'=>false));?>
						<?php echo$this->Html->link('<span class="fa fa-download"></span>&nbsp;'.__('Download Result'),array('controller'=>'Results','action'=>'dwstdresult',$studentId,'ext' => 'pdf'),array('class'=>'btn btn-info','escape'=>false));?>
						<div class="panel">
						<div class="panel-body">
						<div class="table-responsive">
						<table class="table table-striped table-bordered">
							<tr class="default">
								<th><?php echo __('#');?></th>
								<th><?php echo __('Student Name');?></th>
								<th><?php echo __('Email');?></th>
								<th><?php echo __('Test');?></th>
								<th><?php echo __('Max Marks');?></th>
								<th><?php echo __('Marks Scored');?></th>
								<th><?php echo __('Percent');?></th>
								<th><?php echo __('Result Status');?></th>
								<th><?php echo __('Action');?></th>
							</tr>
							<?php foreach($examResult as $rank=>$examValue):
							$url=$this->Html->url(array('controller'=>'Results'));
							$id=$examValue['ExamResult']['id'];?>
							<tr>
								<td><?php echo++$rank;?></td>
								<td><?php echo $this->Html->link(h($examValue['Student']['name']),'#',array('onclick'=>"show_modal('$url/View/$id');",'escape'=>false));?></td>
								<td><?php echo$examValue['Student']['email'];?></td>
								<td><?php echo$examValue['Exam']['name'];?></td>
								<td><?php echo$examValue['ExamResult']['total_marks'];?></td>
								<td><?php echo$examValue['ExamResult']['obtained_marks'];?></td>
								<td><?php echo$examValue['ExamResult']['percent'].'%';?></td>
								<td><span class="label label-<?php if($examValue['ExamResult']['result']=="Pass")echo"success";else echo"danger";?>"><?php if($examValue['ExamResult']['result']=="Pass"){echo __('PASSED');}else{ echo __('FAILED');}?></span></td>
								<td><?php echo$this->Html->link('<span class="fa fa-arrows-alt"></span>&nbsp; ',array('action'=>'result',$examValue['ExamResult']['id']),array('data-toggle'=>'tooltip','title'=>__('View Result'),'escape'=>false));?>
								<?php echo$this->Html->link('<span class="fa fa-print"></span>&nbsp; ',array('controller'=>'../Results','action'=>'printresult',$examValue['ExamResult']['id']),array('data-toggle'=>'tooltip','title'=>__('Download/Print Result'),'target'=>'_blank','escape'=>false));?>
								<?php echo$this->Form->postlink('<span class="fa fa-trash"></span>&nbsp; ',array('action'=>'delete',$examValue['ExamResult']['id']),array('confirm' => __('Are you sure you want to delete record'),'data-toggle'=>'tooltip','title'=>__('Delete Result'),'escape'=>false));?></td>
								</tr>
							<?php endforeach;unset($examValue);?>
						</table>
						</div>
						</div>
					<?php }?>
			</div>