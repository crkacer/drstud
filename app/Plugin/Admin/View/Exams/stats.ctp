<div class="container">
        <div class="panel panel-custom mrg">
		<div class="panel-heading"><?php echo __('Exam Stats');?><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button></div>            
		<div class="panel-body">
		<?php echo$this->Form->create('Result',array('controller'=>'Results','action'=>'index','name'=>'post_req','id'=>'post_req'));?>
		    <div class="table-responsive">
			<table class="table table-bordered">
			    <tr>
				<th><?php echo __('Exam');?></th>
				<th><?php echo __('Overall Result');?></th>
				<th><?php echo __('Student Stats');?></th>							
			    </tr>
			    <tr>
				<td><strong class="text-danger"><?php echo h($post['Exam']['name']);?></strong><br/>
				<?php echo __('From');?>: <strong class="text-danger"><?php echo$this->Time->format($sysDay.$dateSep.$sysMonth.$dateSep.$sysYear.$dateGap.$sysHour.$timeSep.$sysMin.$dateGap.$sysMer,$examStats['Exam']['start_date']);?></strong><br/>
				<?php echo __('To');?>: <strong class="text-danger"><?php echo$this->Time->format($sysDay.$dateSep.$sysMonth.$dateSep.$sysYear.$dateGap.$sysHour.$timeSep.$sysMin.$dateGap.$sysMer,$examStats['Exam']['end_date']);?></strong><br/>
				<?php echo$this->Html->link(__('Details'),'#',array('onclick'=>"examResult($id);"));?>
				<p><strong class="text-success"><?php echo __('No of Student Passed');?>: <?php echo $examStats['StudentStat']['pass'];?></strong>&nbsp;&nbsp;<?php echo$this->Html->link('<span class="fa fa-download"></span>'.__('Download'),array('controller'=>'Exams','action'=>'downloadlist',$id,'Pass','ext' => 'pdf'),array('escape'=>false));?></p>
				<p><strong class="text-danger"><?php echo __('No of Student Failed');?>: <?php echo $examStats['StudentStat']['fail'];?></strong>&nbsp;&nbsp;<?php echo$this->Html->link('<span class="fa fa-download"></span>'.__('Download'),array('controller'=>'Exams','action'=>'downloadlist',$id,'Fail','ext' => 'pdf'),array('escape'=>false));?></p>
				<p><strong class="text-info"><?php echo __('No of Student Absent')?>: <?php echo $examStats['StudentStat']['absent'];?></strong>&nbsp;&nbsp;<?php echo$this->Html->link('<span class="fa fa-download"></span>&nbsp;'.__('Download'),array('controller'=>'Exams','action'=>'downloadabsentlist',$id,'ext' => 'pdf'),array('escape'=>false));?></p>
				</td>
				<td>
					<div class="chart">
					<div id="mywrapperor"></div>
					<?php echo $this->HighCharts->render("My Chartor");?>
					</div>
				</td>
				<td>
					<div class="chart">
					<div id="mywrapperss"></div>
					<?php echo $this->HighCharts->render("My Chartss");?>
					</div>
				</td>
			    </tr>
			</table>
		    </div>
		    <?php echo$this->Form->hidden('id',array('value'=>''));
		    echo$this->Form->hidden('examWise');echo$this->Form->hidden('status');echo$this->Form->hidden('StudentGroup.group_name');?>
		    <?php echo$this->Form->end(null);?>
		</div>
	    </div>
	</div>
<script type="text/javascript">
	function examResult(id)
	{
		$(document).ready(function(){
		$('#ResultId').val(id);
		$("#post_req" ).submit();
		});
	}
</script>