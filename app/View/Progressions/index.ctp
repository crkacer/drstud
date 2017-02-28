<?php echo $this->Session->flash();
$dateFormat=$sysDay.$dateSep.$sysMonth.$dateSep.$sysYear;?>
<div class="" id="dashBoard">
               
<div  id="upperDashBoard">                   
	<div class="dashBoardTitle">
		Dashboard
	</div>
	<div class="dashBoardUrl">
		Home / Progression
	</div>


	<div class="phonics_section">
		 <div class="prog_left">
			  <h2>My Test Progression</h2>
			  <div class="prog_box">
				   <ul>
						<li>Total Exam Given : <span class="green"><?php echo$totalExamGiven;?></span></li>
						<li>Absent Exams : <span class="red"><?php echo$userTotalAbsent;?></span></li>
						<li>Best Score in : <span class="green"><?php echo h($bestScore);?></span></li>
						<li>On : <span class="blue"><?php echo$bestScoreDate?></span></li>
						<li>Failed in : <span class="red"><?php echo$failedExam;?> Exam</span></li>
						<li>Avarage Percentage : <span class="green"><?php echo$averagePercent;?>%</span></li>
						<li>Your Rank : <span class="blue"><?php echo$rank;?></span></li>
				   </ul>
			  </div>
		 </div><!--close prog_left-->

		 <div class="prog_right">
			  <h2>My Homework Progression</h2>
			  <div class="prog_box">
				   <ul>
						<li>Total Homwork Given : <span class="green"><?php echo$totalHWGiven;?></span></li>
						<li>Best Score in : <span class="green"><?php echo h($bestScoreHW);?></span></li>
						<li>More Practice  in : <span class="green"><?php echo h($worstScoreHW);?></span></li>
						<li>Missed Homework : <span class="red"><?php echo $missedHW;?></span></li>
				   </ul>
			  </div>
		 </div><!--close prog_left-->

		 <div class="prog_section">
			  <div class="prog_title">Month Wise Performance</div>
			  <div class="graph"><img src="images/graph1.png" alt=""/></div>
		 </div>

		 <div class="prog_section">
			  <div class="prog_title">Test Wise Performance <strong>(Top 5)</strong></div>
			  <div class="graph"><img src="images/graph2.png" alt=""/></div>
		 </div>
		 </div>
	</div><!--close phonics_section-->


</div>       