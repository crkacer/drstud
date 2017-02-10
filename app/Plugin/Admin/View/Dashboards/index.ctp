<?php echo $this->Session->flash();?>
<div class="row">
	<div class="col-sm-3">
		<div class="xe-widget xe-counter" data-count=".num" data-from="0" data-to="<?php echo$totalInprogressExam;?>" data-suffix="" data-duration="2">
			<div class="xe-icon"> <i class="fa fa-ellipsis-h"></i></div>
			<div class="xe-label"> <strong class="num"><?php echo$totalInprogressExam;?></strong> <span><?php echo __('In Progress Exam');?></span> </div>
		</div>
		<div class="xe-widget xe-counter xe-counter-purple" data-count=".num" data-from="0" data-to="<?php echo$totalUpcomingExam;?>" data-suffix="" data-duration="3" data-easing="false">
			<div class="xe-icon"> <i class="fa fa-cloud"></i></div>
			<div class="xe-label"> <strong class="num"><?php echo$totalUpcomingExam;?></strong> <span><?php echo __('Upcoming Exam');?></span></div>
		</div>
		<div class="xe-widget xe-counter xe-counter-info" data-count=".num" data-from="0" data-to="<?php echo$totalCompletedExam;?>" data-duration="4" data-easing="true">
			<div class="xe-icon"> <i class="fa fa-check"></i> </div>
			<div class="xe-label"> <strong class="num"><?php echo$totalCompletedExam;?></strong> <span><?php echo __('Completed Exam');?></span> </div>
		</div>
		<div class="xe-widget xe-counter xe-counter-info" data-count=".num" data-from="0" data-to="<?php echo$totalStudents;?>" data-duration="4" data-easing="true">
			<div class="xe-icon"> <i class="fa fa-graduation-cap"></i> </div>
			<div class="xe-label"> <strong class="num"><?php echo$totalStudents;?></strong> <span><?php echo __('Students');?></span> </div>
		</div>
	</div>
	<div class="col-md-9">
		<div class="panel panel-custom">
			<div class="panel-heading"><?php echo __('In Progress & Upcoming Exams');?></div>
			<div class="table-responsive">
				<table class="table">
					<tr>
						<th><?php echo __('Date');?></th>
						<th><?php echo __('Exam Name');?></th>
						<th><?php echo __('Group');?></th>
						<th><?php echo __('Marks');?></th>
						<th><?php echo __('Duration');?></th>
					</tr>
					<tr>
					<?php $i=0; foreach($UpcomingExam as $post):$i++;?>
					<tr>
						<td><?php echo$this->Time->format($sysDay.$dateSep.$sysMonth.$dateSep.$sysYear,$post['Exam']['start_date']);?></td>
						<td><?php echo h($post['Exam']['name']);?></td>
						<td><?php echo$this->Function->showGroupName($post['Group']);?></td>
						<td><?php echo $post['Exam']['total_marks'];?></td>
						<td><?php echo __($this->Function->secondsToWords($post['Exam']['duration']*60));?></td>
					</tr>
					<?php endforeach;?>
					<?php unset($post);?>
					<?php for($j=$i;$j<3;$j++):?>
					<tr><td colspan="5">&nbsp;</td></tr>
					<?php endfor;?>
					<?php unset($i);unset($j);?>
				</table>
			</div>					
		</div>
	</div>
</div>
<div class="row">
	<?php echo$this->Form->create('Result',array('controller'=>'Results','action'=>'index','name'=>'post_req','id'=>'post_req'));?>
	<div class="col-md-12">
		<div class="panel panel-custom">
		<div class="panel-heading"><?php echo __('Recent Exam Results');?></div>
			<div class="table-responsive">
			<table class="table table-bordered">
				<tr>
					<th><?php echo __('Exam');?></th>
					<th><?php echo __('Overall Result');?></th>
					<th><?php echo __('Student Stats');?></th>							
				</tr>
				<?php foreach($recentExamResult as $recentValue):
				$id=$recentValue['RecentExam']['Exam']['id'];?>
					<tr>
						<td><strong class="text-danger"><?php echo h($recentValue['RecentExam']['Exam']['name']);?></strong><br/>
						<?php echo __('From');?>: <strong class="text-danger"><?php echo$this->Time->format($sysDay.$dateSep.$sysMonth.$dateSep.$sysYear.$dateGap.$sysHour.$timeSep.$sysMin.$dateGap.$sysMer,$recentValue['RecentExam']['Exam']['start_date']);?></strong><br/>
						<?php echo __('To');?>: <strong class="text-danger"><?php echo$this->Time->format($sysDay.$dateSep.$sysMonth.$dateSep.$sysYear.$dateGap.$sysHour.$timeSep.$sysMin.$dateGap.$sysMer,$recentValue['RecentExam']['Exam']['end_date']);?></strong><br/>
						<?php echo$this->Html->link(__('Details'),'javascript:void(0)',array('onclick'=>"examResult($id);"));?>
						</td>
						<td>
							<div class="chart">
							<div id="mywrapperor<?php echo$id;?>"></div>
							<?php echo $this->HighCharts->render("My Chartor$id");?>
							</div>
						</td>
						<td>
							<div class="chart">
							<div id="mywrapperss<?php echo$id;?>"></div>
							<?php echo $this->HighCharts->render("My Chartss$id");?>
							</div>
						</td>
					</tr>
					<?php endforeach;?>
					<?php unset($recentValue);?>
			</table>
			</div>
		</div> 
	</div>
	<?php echo$this->Form->hidden('id',array('value'=>''));
	echo$this->Form->hidden('examWise');echo$this->Form->hidden('status');echo$this->Form->hidden('StudentGroup.group_name');?>
	<?php echo$this->Form->end(null);?>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-custom">
		<div class="panel-heading"><?php echo __('Top 10 Student Group Wise');?></div>
			<div class="table-responsive">
			<table class="table table-striped table-bordered">
				<tr>
					<td>
					<div class="chart">
					<div id="mywrapperd2"></div>
					<?php echo $this->HighCharts->render("My Chartd2");?>
					</div>
					</td>
					
			</table>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-custom">
			<div class="panel-heading"><?php echo __('Student Statistic Table');?></div>
			<div class="table-responsive">
			<table class="table table-striped table-bordered">
				<tr>
					<th><?php echo __('Group');?></th>
					<th><?php echo __('Total Students');?></th>
					<th><?php echo __('Total Active');?></th>
					<th><?php echo __('Total Pending');?></th>
					<th><?php echo __('Total Suspended');?></th>
				</tr>
				<?php foreach($studentStatitics as $studentValue):?>
				<tr>
					<td><?php echo h($studentValue['GroupName']['name']);?></td>
					<td><?php echo$studentValue['GroupName']['total_student'];?></td>
					<td><?php echo __($studentValue['GroupName']['active']);?></td>
					<td><?php echo __($studentValue['GroupName']['pending']);?></td>
					<td><?php echo __($studentValue['GroupName']['suspend']);?></td>
				</tr>
				<?php endforeach;unset($studentValue);?>												
			</table>
			</div>
		</div> 
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-custom">
		<div class="panel-heading"><?php echo __('Top 10 Question Bank Subject Wise');?></div>									
			<div class="chart">
			<div id="piewrapperqc"></div>
			<?php echo $this->HighCharts->render("Pie Chartqc");?>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div  class="col-md-12">
		<div class="panel panel-custom">
		<div class="panel-heading"><?php echo __('Top 10 Difficulty Level of Questions');?></div>
			<div class="chart">
			<div id="mywrapperdl"></div>
			<?php echo $this->HighCharts->render("My Chartdl");?>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-custom">
		<div class="panel-heading"><?php echo __('Question Count Table');?></div>
			<div class="table-responsive">
			<table class="table table-striped table-bordered">
				<tr>
					<th><?php echo __('Bank Name');?></th>
					<th><?php echo __('Total Question');?></th>
					<th><?php echo __('Total Easy');?></th>
					<th><?php echo __('Total Normal');?></th>
					<th><?php echo __('Total Difficult');?></th>							
				</tr>
				<?php foreach($Subject as $sd):?>
				<tr><td><?php echo h($subject_name=$sd['Subject']['subject_name']);?></td>
				<td><?php echo$DifficultyDetail[$subject_name]['total_question'];?></td>
				<?php $i=0; foreach($DiffLevel as $diff):?>
				<td><?php echo$DifficultyDetail[$subject_name][$i];?></td>
				<?php $i++;endforeach;?>
				</tr>
				<?php endforeach;?>
				<?php unset($sd);?>	
					
			</table>
			</div>
		</div> 
	</div>
</div>
<script type="text/javascript">
function examResult(id)
{
	$(document).ready(function(){$('#ResultId').val(id);$("#post_req" ).submit();});
}
</script>
