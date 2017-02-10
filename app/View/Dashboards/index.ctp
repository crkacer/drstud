<?php echo $this->Session->flash();
$dateFormat=$sysDay.$dateSep.$sysMonth.$dateSep.$sysYear;?>
<div class="" id="dashBoard">
               
	<div  id="upperDashBoard">                   
		<div class="dashBoardTitle">
			Dashboard
		</div>
		<div class="dashBoardUrl">
			Home / Dashboard
		</div>
		<div class="row">
			<div class="col-md-4 col-sm-4">                                
			<div class="panel">		
				<div class="panel-body"><h3><?php echo __('My Quizzes Stats');?></h3>
				<div class="table-responsive">
					<table class="table">
					<tr>
						<td><strong><?php echo __('Total Quiz Given');?> : </strong><strong class="text-success"><?php echo$totalExamGiven;?></strong></td>					
					</tr>
					<tr>
						<td><strong><?php echo __('Absent in');?> : </strong><strong class="text-danger"><?php echo$userTotalAbsent;?></strong></td>					
					</tr>
					<tr>
						<td><strong><?php echo __('Best Score in');?> : </strong><strong class="text-success"><?php echo h($bestScore);?></strong></td>
					</tr>
					<tr>
						<td><strong><?php echo __('On');?> : </strong><strong class="text-info"><?php echo$bestScoreDate?></strong></td>
					</tr>
					<tr>
						<td><strong><?php echo __('Failed in');?> : </strong><strong class="text-danger"><?php echo$failedExam;?> Exam</strong></td>
					</tr>
					<tr>
						<td><strong><?php echo __('Average Percentage');?> : </strong><strong class="text-info"><?php echo$averagePercent;?>%</strong></td>
					</tr>
					<tr>
						<td><strong><?php echo __('Your Rank');?> : </strong><strong class="text-info"><?php echo$rank;?></strong></td>
					</tr>
					</table>
				</div>
				</div>
			</div>
			</div>
			<div class="col-md-8 col-sm-8">
			<div class="panel">
				<div class="panel-body"><h3><?php echo __('Month Wise Performance');?></h3>
				<div class="chart">
					<div id="mywrapperdl"></div>
					<?php echo $this->HighCharts->render("My Chartdl");?>
				</div>
				</div>
			</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
			<div class="panel">
				<div class="panel-body"><h3><?php echo __('Quiz Wise Performance');?> (<strong><span class="text-info"><?php echo __('Top 10');?></span></strong>)</h3>
				<div class="chart">
					<div id="mywrapperd2"></div>
					<?php echo $this->HighCharts->render("My Chartd2");?>
				</div>
				</div>
			</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="panel">
					<div class="panel-body"><h3><?php echo __('Todays Exam');?>  (<strong><span class="text-info"><?php echo __('Top');?> <?php echo$limit;?></span></strong>)</h3>
					<div class="table-responsive">
						<table class="table table-striped">
						<?php if($todayExam){?>
						<tr>
							<th colspan="8"><?php echo __('These are the exam(s) that can be taken right now');?></th>
						</tr>
						<?php echo$this->Function->showExamList("today",$todayExam,$currency,$dateFormat,$frontExamPaid,$examExpiry);?>
						<?php }else{?>
						<tr>
							<th colspan="8"><?php echo __('No Exams found for today');?></th>
						</tr>
						<?php }?>
						</table>
					</div>
					</div>
				</div>
			</div>
		</div>
		<div class="modal fade" id="targetModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-content">        
			</div>
		</div>


	</div><!-- id="dashBoard" -->
               
</div><!-- id="upperDashBoard" -->  