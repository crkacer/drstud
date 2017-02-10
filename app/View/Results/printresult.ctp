<div class="col-sm-12"><?php if(strlen($frontLogo)>0){?><?php echo$this->Html->image($frontLogo,array('alt'=>$siteName,'class'=>'img-responsive'));} else{?><?php echo$siteName;?><?php }?></div>
<center><h3 ><?php echo __('Exam Result').' '.__('of').' '.h($examDetails['Exam']['name']);?></h3></center>
<div style="display: none;"><label id="totalQuestion"><?php echo$examDetails['Result']['total_question'];?></label></div>
<br/><br/>
<div class="row my-result">
	<div class="col-md-12">
				  
		<!-- Tab panes -->
		<div class="tab-content">
				<div class="rtest_heading"><strong><?php echo __('Score Card For %s',h($examDetails['Exam']['name']));?></strong></div>
					<table class="table">
						<tr>
							<td><?php echo __('Total No. of Student');?></td>
							<td><strong class="text-primary"><?php echo $totalStudentCount;?></strong></td>
							<td><?php echo __('My Marks');?></td>
							<td><strong class="text-primary"><?php echo $examDetails['Result']['obtained_marks'];?></strong></td>
							<td><?php echo __('Correct Question');?></td>
							<td><strong class="text-primary"><?php echo $correctQuestion;?></strong></td>
							<td><?php echo __('Incorrect Question');?></td>
							<td><strong class="text-danger"><?php echo $incorrectQuestion;?></strong></td>
						</tr>
						<tr>
							<td><?php echo __('Total Marks of Test');?></td>
							<td><strong class="text-primary"><?php echo $examDetails['Result']['total_marks'];?></strong></td>
							<td><?php echo __('My Percentile');?></td>
							<td><strong class="text-primary"><?php echo CakeNumber::toPercentage($percentile);?></strong></td>
							<td><?php echo __('Right Marks');?></td>
							<td><strong class="text-primary"><?php echo $rightMarks;?></strong></td>
							<td><?php echo __('Negative Marks');?></td>
							<td><strong class="text-danger"><?php echo str_replace("-","",$negativeMarks);?></strong></td>
						</tr>
						<tr>
							<td><?php echo __('Total Question in Test');?></td>
							<td><strong class="text-primary"><?php echo $examDetails['Result']['total_question'];?></strong></td>
							<td><?php echo __('Total Answered Question in Test');?></td>
							<td><strong class="text-primary"><?php echo $examDetails['Result']['total_answered'];?></strong></td>
							<td><?php echo __('Left Question');?></td>
							<td><strong class="text-danger"><?php echo $leftQuestion;?></strong></td>
							<td><?php echo __('Left Question Marks');?></td>
							<td><strong class="text-danger"><?php echo $leftQuestionMarks;?></strong></td>
						</tr>
						<tr>
							<td><?php echo __('Total Time of Test');?></td>
							<td><strong class="text-primary"><?php echo $this->Function->secondsToWords($examDetails['Exam']['duration']*60);?></strong></td>
							<td><?php echo __('My Time');?></td>
							<td><strong class="text-primary"><?php echo $this->Function->secondsToWords($this->Time->fromString($examDetails['Result']['end_time'])-$this->Time->fromString($examDetails['Result']['start_time']));?></strong></td>
							<td><?php echo __('My Rank');?></td>
							<td><strong class="text-primary"><?php echo $myRank;?></strong></td>
							<td><?php echo __('Result');?></td>
							<td><span class="label label-<?php if($examDetails['Result']['result']=="Pass")echo"success";else echo"danger";?>"><?php if($examDetails['Result']['result']=="Pass"){echo __('PASSED');}else{echo __('FAILED');}?></span></td>
						</tr>	                              
					</table>
				
			<div class="col-sm-6">
			<div class="rtest_heading"><strong><?php echo __('Performance Report For %s',h($examDetails['Exam']['name']));?></strong></div>
			<div class="chart">
				<div id="mywrapperd2"></div>
				<?php echo $this->HighCharts->render("My Chartd2");?>
			</div>
			</div>
			<div class="col-sm-6">
			<div class="rtest_heading"><strong><?php echo __('Question & Marks Wise Report For %s',h($examDetails['Exam']['name']));?></strong></div>
			<div class="chart">
				<div id="mywrapperd3"></div>
				<?php echo $this->HighCharts->render("My Chartd3");?>
			</div>
			</div>
		</div>
		<div class="tab-pane" id="subject-report">
			<div class="rtest_heading"><strong><?php echo __('Subject Report For %s',h($examDetails['Exam']['name']));?></strong></div>
				<table class="table table-striped">
					<tr>
						<th><?php echo __('Name');?></th>
						<th><?php echo __('Total Questions');?></th>
						<th><?php echo __('Correct');?>/<br><?php echo __('Incorrect Question');?></th>
						<th><?php echo __('Marks Scored')?>/<br><?php echo __('Negative Marks');?></th>
						<th><?php echo __('Unattempted Questions');?>/<br><?php echo __('Marks');?></th>
						</tr>
					<?php foreach($userMarksheet as $userValue):?>
					<tr>                                    
						<td class="text-primary"><strong><?php echo h($userValue['Subject']['name']);?></strong></td>
						<td><?php echo$userValue['Subject']['total_question'];?></td>
						<td><span class="text-success"><?php echo$userValue['Subject']['correct_question'];?></span>/<span class="text-danger"><?php echo$userValue['Subject']['incorrect_question'];?></span></td>
						<td><span class="text-success"><?php echo$userValue['Subject']['marks_scored'];?></span>/<span class="text-danger"><?php echo$userValue['Subject']['negative_marks'];?></span></td>
						<td><span class="text-warning"><?php echo$userValue['Subject']['unattempted_question'];?></span>/<span class="text-danger"><?php echo$userValue['Subject']['unattempted_question_marks'];?></span></td>
					</tr>
					<?php endforeach;unset($userValue);?>
				</table>
			<div class="rtest_heading"><strong><?php echo __('Graphical Report For %s',h($examDetails['Exam']['name']));?></strong></div>
			<div class="col-md-12 col-sm-12">
				<div class="chart">
					<div id="mywrapperdl"></div>
					<?php echo $this->HighCharts->render("My Chartdl");?>
				</div>
			</div>
		</div>
		<div class="tab-pane" id="time-management">
			<div class="rtest_heading"><strong><?php echo __('Time Management For %s',h($examDetails['Exam']['name']));?></strong></div>
				<table class="table table-striped">
					<tr>
						<th><?php echo __('Name');?></th>
						<th><?php echo __('Total Questions');?></th>
						<th><?php echo __('Correct');?>/<br><?php echo __('Incorrect Question');?></th>
						<th><?php echo __('Marks Scored');?>/<br><?php echo __('Negative Marks');?></th>
						<th><?php echo __('Percentage');?></th>
						<th><?php echo __('Unattempted Questions');?>/<br><?php echo __('Marks');?></th>
						<th><?php echo __('Total Time');?></th>
						</tr>
					<?php foreach($userMarksheet as $userValue):?>
					<tr>                                    
						<td class="text-primary"><strong><?php echo h($userValue['Subject']['name']);?></strong></td>
						<td><?php echo$userValue['Subject']['total_question'];?></td>
						<td><span class="text-success"><?php echo$userValue['Subject']['correct_question'];?></span>/<span class="text-danger"><?php echo$userValue['Subject']['incorrect_question'];?></span></td>
						<td><span class="text-success"><?php echo$userValue['Subject']['marks_scored'];?></span>/<span class="text-danger"><?php echo$userValue['Subject']['negative_marks'];?></span></td>
						 <td><?php echo CakeNumber::toPercentage($userValue['Subject']['percent'],2);?></td>
						<td><span class="text-warning"><?php echo$userValue['Subject']['unattempted_question'];?></span>/<span class="text-danger"><?php echo$userValue['Subject']['unattempted_question_marks'];?></span></td>
						<td><?php echo $this->Function->secondsToWords($userValue['Subject']['time_taken'],'-');?></td>
					</tr>
					<?php endforeach;unset($userValue);?>
				</table>
			<div class="col-md-12 col-sm-12">
				<div class="chart">
					<div id="piewrapperqc"></div>
					<?php echo $this->HighCharts->render("Pie Chartqc");?>
				</div>
			</div>
		</div>
		<?php if($examDetails['Exam']['declare_result']=="Yes"){?>
		<div class="tab-pane" id="question">
			<div class="rtest_heading"><strong><?php echo __('Question Report For %s',h($examDetails['Exam']['name']));?></strong></div>
				<table class="table table-bordered">
				<tr>
					<th><?php echo __('Q.No.');?></th>
					<th><?php echo __('Question');?></th>
					<th><?php echo __('Your Answer');?></th>
					<th><?php echo __('Correct Answer');?></th>
					<th><?php echo __('Max. Marks');?></th>
					<th><?php echo __('Your Score');?></th>
					<th><?php echo __('Your Time');?></th>
					<th><?php echo __('Level');?></th>
				</tr>
				<?php foreach($post as $k=>$ques):$quesNo=$ques['ExamStat']['ques_no'];
				if($ques['Qtype']['type']=="M")
				{
					$correctAnswer="";$userAnswer="";
					if(strlen($ques['Question']['answer'])>1)
					{
						$correctAnswerExp=explode(",",$ques['Question']['answer']);
						foreach($correctAnswerExp as $option):
							$correctAnswer1="option".$option;		
							$correctAnswer.=$ques['Question'][$correctAnswer1]."<br>";
						endforeach;unset($option);
						if(strlen($ques['ExamStat']['option_selected'])>1)
						{
							$userAnswerExp=explode(",",$ques['ExamStat']['option_selected']);
							foreach($userAnswerExp as $option):
							$userAnswer1="option".$option;
							$userAnswer.=$ques['Question'][$userAnswer1]."<br>";
							endforeach;unset($option);
						}
						else
						{
							if($ques['ExamStat']['option_selected'])
							{
								$userAnswer="option".$ques['ExamStat']['option_selected'];
								$userAnswer=$ques['Question'][$userAnswer];
							}
						}
					}		    
					else
					{
						if($ques['ExamStat']['option_selected'])
						{
							$userAnswer="option".$ques['ExamStat']['option_selected'];
							$userAnswer=$ques['Question'][$userAnswer];
						}
						$correctAnswer="option".$ques['Question']['answer'];			
						$correctAnswer=$ques['Question'][$correctAnswer];
					}
				}
				if($ques['Qtype']['type']=="T")
				{
					$userAnswer=$ques['ExamStat']['true_false'];
					$correctAnswer=$ques['Question']['true_false'];
				}
				if($ques['Qtype']['type']=="F")
				{
					$userAnswer=$ques['ExamStat']['fill_blank'];
					$correctAnswer=$ques['Question']['fill_blank'];
				}
				if($ques['Qtype']['type']=="S")
				{
					$userAnswer=$ques['ExamStat']['answer'];
					$correctAnswer="";
				}
				if($ques['ExamStat']['ques_status']=="R")
				$quesStatus="text-success";
				elseif($ques['ExamStat']['ques_status']=="W")
				$quesStatus="text-danger";
				else
				$quesStatus="text-info";
				?>
				<tr class="<?php echo$quesStatus;?>">
					<td><strong><?php echo $ques['ExamStat']['ques_no'];?></strong></td>
					<td><?php echo str_replace("<script","",$ques['Question']['question']);?></td>
					<td><?php echo __($userAnswer);?></td>
					<td><?php echo __($correctAnswer);?></td>
					<td><?php echo$ques['ExamStat']['marks'];?></td>
					<td><?php echo$ques['ExamStat']['marks_obtained'];?></td>
					<td><?php echo $this->Function->secondsToWords($ques['ExamStat']['time_taken'],'-');?></td>
					<td><?php echo __($ques['Diff']['diff_level']);?></td>
				</tr>
				<?php endforeach;unset($ques);?>
				</table>
			
		</div>
		<div class="tab-pane" id="solution">
			<div class="rtest_heading"><strong><?php echo __('Solution For %s',h($examDetails['Exam']['name']));?></strong></div>
			<div class="col-sm-12">
				<?php foreach($post as $k=>$ques):$quesNo=$ques['ExamStat']['ques_no'];?>
				<div class="exam-panel" id="quespanel<?php echo$quesNo;?>">
						<table class="table table-bordered">
							<?php
							if($ques['Qtype']['type']=="M")
							{
								$options=array();
								$optionKeyArr=explode(",",$ques['ExamStat']['options']);
								$index=0;
								foreach($optionKeyArr as $value)
								{
									$optKey="option".$value;
									if(strlen($ques['Question'][$optKey])>0)
									{
										$index++;
										$options[$value]=str_replace("<script","",$ques['Question'][$optKey]);
									}
								}
								unset($value,$key);
								$correctAnswer="";$userAnswer="";
								if(strlen($ques['Question']['answer'])>1)
								{
									$correctAnswerExp=explode(",",$ques['Question']['answer']);
									foreach($correctAnswerExp as $option):
										$correctAnswer[]="Option".(array_search($option, array_keys($options))+1);
									endforeach;unset($option);
									$correctAnswer=implode(",",$correctAnswer);
									
									$userAnswerExp=explode(",",$ques['ExamStat']['option_selected']);
									foreach($userAnswerExp as $option):
									$userAnswer[]="Option".(array_search($option, array_keys($options))+1);
									endforeach;unset($option);
									$userAnswer=implode(",",$userAnswer);
								}		    
								else
								{
									if($ques['ExamStat']['option_selected'])
									{
										$userAnswer="Option".(array_search($ques['ExamStat']['option_selected'], array_keys($options))+1);
									}
									$correctAnswer="Option".(array_search($ques['Question']['answer'], array_keys($options))+1);
								}
							}
							if($ques['Qtype']['type']=="T")
							{
								$userAnswer=$ques['ExamStat']['true_false'];
								$correctAnswer=$ques['Question']['true_false'];
							}
							if($ques['Qtype']['type']=="F")
							{
								$userAnswer=$ques['ExamStat']['fill_blank'];
								$correctAnswer=$ques['Question']['fill_blank'];
							}
							if($ques['Qtype']['type']=="S")
							{
								$userAnswer=$ques['ExamStat']['answer'];
								$correctAnswer="";
							}
							if($ques['ExamStat']['ques_status']=="R")
							$quesStatus="text-success";
							elseif($ques['ExamStat']['ques_status']=="W")
							$quesStatus="text-danger";
							else
							$quesStatus="text-info";
							
							?>
							<tr class="<?php echo$quesStatus;?>">
							<tr><td colspan="3"><?php echo '<strong>'.__('Question').': '.$quesNo.'</strong>&nbsp;&nbsp;'.str_replace("<script","",$ques['Question']['question']);?></td></tr>
							<tr><td colspan="3">
							<?php
							if($ques['Qtype']['type']=="M")
							{
								$correctImg="";$incorrectImg="";$optionSerial=0;
								foreach($options as $opt=>$option):$optionSerial++;
								if(strlen($ques['Question']['answer'])>1)
								{
									$correctImg="";$incorrectImg="";
									foreach(explode(",",$ques['ExamStat']['option_selected']) as $value){
									if($opt==$value && $ques['ExamStat']['ques_status']=='W'){$incorrectImg=$this->Html->image('incorrect_icon.png');break;}}
									unset($value);
									foreach(explode(",",$ques['ExamStat']['correct_answer']) as $value){
									if($opt==$value){$incorrectImg=$this->Html->image('correct_icon.png');break;}}
									unset($value);
								}
								else
								{
									if($opt==$ques['ExamStat']['correct_answer']){$correctImg=$this->Html->image('correct_icon.png');}else{$correctImg="";}
									if($opt==$ques['ExamStat']['option_selected'] && $ques['ExamStat']['ques_status']=='W'){$incorrectImg=$this->Html->image('incorrect_icon.png');}else{$incorrectImg="";}
								}
								echo '<p>'.$optionSerial.'. '.$incorrectImg.$correctImg.' '.$option.'</p>';
								endforeach;unset($option);
							}
							if($ques['Qtype']['type']=="T")
							{
								$correctImgTrue="";$correctImgFalse="";$incorrectImgTrue="";$incorrectImgFalse="";
								if($ques['Question']['true_false']=="True")
								{
									$correctImgTrue=$this->Html->image('correct_icon.png');
								}
								else
								{
									$correctImgFalse=$this->Html->image('correct_icon.png');
								}
								if($ques['ExamStat']['ques_status']=='W' && $ques['ExamStat']['true_false']=="True")
								{
									$incorrectImgTrue=$this->Html->image('incorrect_icon.png');
								}
								if($ques['ExamStat']['ques_status']=='W' && $ques['ExamStat']['true_false']=="False")
								{
									$incorrectImgFalse=$this->Html->image('incorrect_icon.png');
								}
								echo $correctImgTrue.$incorrectImgTrue.__('True').' / '.$correctImgFalse.$incorrectImgFalse.__('False');
							}
							?>
							</td></tr>
							<tr>
								<td><?php if($ques['ExamStat']['ques_status']==NULL)echo'<strong class="text-info">'.__('Not Attempt').'</strong>';else echo'<strong class="text-warning">'.__('Attempt').'</strong>';?></strong></td>
								<?php if($ques['ExamStat']['ques_status']=='R'){?><td><strong class="text-success"><?php echo __('Correct');?></strong></td><?php }?>
								<?php if($ques['ExamStat']['ques_status']=='W'){?><td><strong class="text-danger"><?php echo __('Incorrect');?></strong></td>
								<td><strong><?php echo __('Your Answers');?> :</strong>&nbsp;<strong class="text-danger"><?php echo __($userAnswer);?></strong>
								<?php if($ques['Qtype']['type']!="S"){?><strong><?php echo __('Correct Answer');?> :</strong>&nbsp;<strong class="text-success"><?php echo __($correctAnswer);?></strong><?php }?></td><?php }else{?>
								<?php if($ques['Qtype']['type']!="S"){?><td><strong><?php echo __('Correct Answer');?> :</strong>&nbsp;<strong class="text-success"><?php echo __($correctAnswer);?></strong></td><?php }}?>
			
							</tr>
							<tr><td><strong><?php echo __('Max Marks');?> :</strong>&nbsp;&nbsp;<?php echo$ques['ExamStat']['marks'];?></td>
							<td><strong><?php echo __('Marks Scored');?> :</strong>&nbsp;&nbsp;<?php echo$ques['ExamStat']['marks_obtained'];?></td>
							<td><strong><?php echo __('Time Taken');?> :</strong>&nbsp;&nbsp;<?php echo $this->Function->secondsToWords($ques['ExamStat']['time_taken'],'-');?></td>
							</tr>
							<?php if($ques['Question']['explanation']){?><tr><td colspan="3"><strong><?php echo __('Solution');?> :</strong>&nbsp;&nbsp;<?php echo$ques['Question']['explanation'];?></td></tr><?php }?>
						</table>
					
				</div>
				<?php endforeach;unset($ques);?>
			</div>
	</div>
		</div>
		<?php }?>
		<div class="tab-pane" id="compare-report">
			<div class="rtest_heading"><strong><?php echo __('Compare Report For %s',h($examDetails['Exam']['name']));?></strong></div>
			<div class="com-md-12 col-sm-12 col-xs-12">
				<div class="col-md-3 col-sm-6 col-xs-6">
						<table class="table">
							<tr>
								<td><?php echo __('Total Ques.');?></td>
								<td><strong><?php echo $examDetails['Result']['total_questiont'];?></strong></td>
							</tr>
							<tr>
								<td><?php echo __('Maximum Marks');?></td>
								<td><strong><?php echo $examDetails['Result']['total_marks'];?></strong></td>
							</tr>
							<tr>
								<td><?php echo __('Attempted Ques.');?></td>
								<td><strong class="text-success"><?php echo $attemptedQuestion;?></strong></td>
							</tr>
							<tr>
								<td><?php echo __('Unattempted Ques.');?></td>
								<td><strong class="text-danger"><?php echo $leftQuestion;?></strong></td>
							</tr>
							<tr>
								<td><?php echo __('Correct Ques.');?></td>
								<td><strong class="text-success"><?php echo $correctQuestion;?></strong></td>
							</tr>
							<tr>
								<td><?php echo __('Incorrect Ques.');?></td>
								<td><strong class="text-danger"><?php echo $incorrectQuestion;?></strong></td>
							</tr>
						</table>
					
				</div>
				<div class="col-md-3 col-sm-6 col-xs-6">
						<table class="table">
							<tr>
								<td><?php echo __('Total Score');?></td>
								<td><strong class="text-primary"><?php echo $examDetails['Result']['obtained_marks'];?>/<?php echo $examDetails['Result']['total_marks'];?></strong></td>
							</tr>
							<tr>
								<td><?php echo __('Percentage');?></td>
								<td><strong><?php echo$this->Number->toPercentage($examDetails['Result']['percent']);?></strong></td>
							</tr>
							<tr>
								<td><?php echo __('Percentile');?></td>
								<td><strong><?php echo CakeNumber::toPercentage($percentile);?></strong></td>
							</tr>
							<tr>
								<td><?php echo __('Total Time');?></td>
								<td><strong><?php echo $this->Function->secondsToWords($this->Time->fromString($examDetails['Result']['end_time'])-$this->Time->fromString($examDetails['Result']['start_time']));?></strong></td>
							</tr>
							<tr>
								<td><?php echo __('Rank');?></td>
								<td valign="top" rowspan="2"><?php echo$this->Html->image($studentImage,array('width'=>60,'height'=>70,'class'=>'img-thumbnail'));?></td>
							</tr>
							<tr>
								<td><div class="rank"><?php echo $myRank;?></div></td>
							</tr>
						</table>
					
				</div>
				<?php foreach($compareArr as $k=>$compPost):?>
				<div id="comppanel<?php echo$k;?>" class="compare">
					<div class="col-md-3 col-sm-6 col-xs-6">
							<table class="table">
								<tr>
									<td><?php echo __('Total Ques.');?></td>
									<td><strong><?php echo $compPost[0]['Result']['total_question'];?></strong></td>
								</tr>
								<tr>
									<td><?php echo __('Maximum Marks');?></td>
									<td><strong><?php echo $compPost[0]['Result']['total_marks'];?></strong></td>
								</tr>
								<tr>
									<td><?php echo __('Attempted Ques.');?></td>
									<td><strong class="text-success"><?php echo $compPost['attempted_question'];?></strong></td>
								</tr>
								<tr>
									<td><?php echo __('Unattempted Ques.');?></td>
									<td><strong class="text-danger"><?php echo $compPost['left_question'];?></strong></td>
								</tr>
								<tr>
									<td><?php echo __('Correct Ques.');?></td>
									<td><strong class="text-success"><?php echo $compPost['correct_question'];?></strong></td>
								</tr>
								<tr>
									<td><?php echo __('Incorrect Ques.');?></td>
									<td><strong class="text-danger"><?php echo $compPost['incorrect_question'];?></strong></td>
								</tr>
							</table>
						
						
					</div>
					<div class="col-md-3 col-sm-6 col-xs-6">
							<table class="table">
								<tr>
									<td><?php echo __('Total Score');?></td>
									<td><strong class="text-primary"><?php echo $compPost[0]['Result']['obtained_marks'];?>/<?php echo $compPost[0]['Result']['total_marks'];?></strong></td>
								</tr>
								<tr>
									<td><?php echo __('Percentage');?></td>
									<td><strong><?php echo$this->Number->toPercentage($compPost[0]['Result']['percent']);?></strong></td>
								</tr>
								<tr>
									<td><?php echo __('Percentile');?></td>
									<td><strong><?php echo CakeNumber::toPercentage($compPost['percentile']);?></strong></td>
								</tr>
								<tr>
									<td><?php echo __('Total Time');?></td>
									<td><strong><?php echo $this->Function->secondsToWords($this->Time->fromString($compPost[0]['Result']['end_time'])-$this->Time->fromString($compPost[0]['Result']['start_time']));?></strong></td>
								</tr>
								<tr>
									<td><?php echo __('Rank');?></td>
									<td valign="top" rowspan="2"><?php echo$this->Html->image($compPost['student_image'],array('width'=>60,'height'=>70,'class'=>'img-thumbnail'));?></td>
								</tr>
								<tr>
									<td><div class="rank"><?php echo $compPost['rank'];?></div>
									<div class="rank_name"><?php echo$compPost[0]['Student']['name'];?></div></td>
								</tr>
							</table>
											
					</div>
				</div>
				<?php endforeach;unset($compPost);?>
				<div style="display: none;"><label id="totalRank"><?php echo$compareCount;?></label></div>
			</div>
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="chart">
					<div id="mywrapperd5"></div>
					<?php echo $this->HighCharts->render("My Chartd5");?>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
setTimeout(function(){if (typeof(window.print) != 'undefined') {
    window.print();
    window.close();
}}, 1500);
</script>