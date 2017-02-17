<?php echo $this->Session->flash(); ?>

<div class="" id="dashBoard">
               
	<div  id="upperDashBoard">                   
		<div class="dashBoardTitle">
			Dashboard
		</div>
		<div class="dashBoardUrl">
			Home / Phonics
		</div>


		<div class="phonics_section">
			 <h2>Phonics</h2>
			 <div class="phonics_tab">
				  <ul>
						<li class="active"><a href="#">Todays Homework</a></li>
						<li><a href="#">Previous Homework</a></li>
				  </ul>
			 </div>

			 <div class="phonics_top">
				  <h6>11-09-2016</h6>
				  <span class="buttons">
						<a href="#" class="phonics_prev">Prev</a>
						<a href="#" class="phonics_next">Next</a>
				  </span>
			 </div>

			<div class="phonics_area">
				<div class="phonics_row">
					<div class="phonics_box">
						<div class="phonics_inner">
							<div class="phonics_left">
								<span class="right_green"></span>
								<span class="speaker"></span>
								<span class="phnics_text">apple<br>‘ӕpl</span>
							</div>

							<div class="phonics_right">
                                <div id="dom-target" style="display: none;">
                                    <?php $output = "20";
                                    echo htmlspecialchars($output);?></div>
                                <button onclick="startRecording(this);">record</button>
								<button id = "btnStop" onclick="stopRecording(this);" disabled>stop</button>
								<button id = "btnUpload" onclick="uploadRecording(this);" disabled>upload</button>
								<span id="countdown" class="timer"></span>
							<!-- <h2>Log</h2>-->
								<pre id="log" style="display:none"></pre>
							</div>
							
							<span id="recordingslist"></span>
						</div>
					</div><!--close phonics_box-->

				</div><!--close phonics_row-->
				 
			</div><!--close phonics_area-->
			 
		</div><!--close phonics_section-->


	</div>                
</div>
<?php $this->Html->script('/design700/assets/scripts/recordmp3', array('block' => 'scriptBottom')); ?>
<?php $this->Html->script('/design700/assets/scripts/main', array('block' => 'scriptBottom')); ?>
