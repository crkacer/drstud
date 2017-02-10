<?php echo$this->html->link('<span class="glyphicon glyphicon-arrow-left"></span>&nbsp;'.__('Back'),'javascript: history.go(-1)',array('class'=>'btn btn-info','escape'=>false));
$bookmarkUrl=$this->Html->Url(array('controller'=>'Results','action'=>'bookmark',$id));?>
<script type="text/javascript">
function navigation(quesNo){$('.exam-panel').hide();$('#quespanel'+quesNo).show();}
function callPrev(quesNo){if(quesNo!=1)quesNo--;$('.exam-panel').hide();$('#quespanel'+quesNo).show();}
function callNext(quesNo){if($('#totalQuestion').text()!=quesNo)quesNo++;$('.exam-panel').hide();$('#quespanel'+quesNo).show();}
function callComparePrev(rank){rank--;$('.compare').hide();$('#comppanel'+rank).show(20,'linear');}
function callCompareNext(rank){rank++;$('.compare').hide();$('#comppanel'+rank).show(20,'linear');}
function callBoomark(quesNo){$.ajax({method: "POST",url: '<?php echo$bookmarkUrl;?>',data:'&id='+quesNo,beforeSend: function(){$('#exam-loading').show();}}).done(function(data) {
	if(data=='Y'){$('#navbtn'+quesNo).addClass('btn-success');
	$('#bookmark'+quesNo).addClass('btn-danger');
	$('#bookmark'+quesNo).html('<span class="fa fa-star-o"></span> Unbookmark');}
	else{$('#navbtn'+quesNo).removeClass('btn-success');
	$('#bookmark'+quesNo).removeClass('btn-danger');
	$('#bookmark'+quesNo).html('<span class="fa fa-star"></span> Bookmark');}
	$('#exam-loading').hide();});}
$(document).ready(function(){
$('.exam-panel').hide();
$('#quespanel1').show();
$('.compare').hide();
$('#comppanel0').show();
});
</script>
<style type="text/css">
		/* bootstrap hack: fix content width inside hidden tabs */
.tab-content > .tab-pane,.pill-content > .pill-pane {display: block;     /* undo display:none          */
height: 0;          /* height:0 is also invisible */
overflow-y: hidden; /* no-overflow                */
}
.tab-content > .active,.pill-content > .active {height: auto;       /* let the content decide it  */
} /* bootstrap hack end */
</style>
<div style="display: none;"><label id="totalQuestion"><?php echo$examDetails['Result']['total_question'];?></label></div>
<br/><br/>
<div class="row my-result">
	<div class="col-md-12">
		<ul class="nav nav-tabs">
			<li class="active"><a href="#score-card" data-toggle="tab"><?php echo __('SCORE CARD');?></a></li>
			<li><a href="#subject-report" data-toggle="tab"><?php echo __('SUBJECT REPORT');?></a></li>
			<li><a href="#time-management" data-toggle="tab"><?php echo __('TIME MANAGEMENT');?></a></li>
			<?php if($examDetails['Exam']['declare_result']=="Yes"){?>
			<li><a href="#question" data-toggle="tab"><?php echo __('QUESTION REPORT');?></a></li>
			<li><a href="#solution" data-toggle="tab"><?php echo __('SOLUTION');?></a></li><?php }?>
			<li><a href="#compare-report" data-toggle="tab"><?php echo __('COMPARE REPORT');?></a></li>
		</ul>		  
		<!-- Tab panes -->
		<div class="tab-content">
			<div class="tab-pane active" id="score-card">
				<div class="rtest_heading"><strong><?php echo __('Score Card For');?>  </strong><?php echo h($examDetails['Exam']['name']);?></div>
				<div class="table-responsive">
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
							<td><strong class="text-primary"><?php echo CakeNumber::toPercentage($percentile,2);?></strong></td>
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
				</div>
			<div class="col-sm-6">
			<div class="rtest_heading"><strong><?php echo __('Performance Report For');?>  </strong><?php echo h($examDetails['Exam']['name']);?></div>
			<div class="chart">
				<div id="mywrapperd2"></div>
				<?php echo $this->HighCharts->render("My Chartd2");?>
			</div>
			</div>
			<div class="col-sm-6">
			<div class="rtest_heading"><strong><?php echo __('Question & Marks Wise Report For');?>  </strong><?php echo h($examDetails['Exam']['name']);?></div>
			<div class="chart">
				<div id="mywrapperd3"></div>
				<?php echo $this->HighCharts->render("My Chartd3");?>
			</div>
			</div>
		</div>
		<div class="tab-pane" id="subject-report">
			<div class="rtest_heading"><strong><?php echo __('Subject Report For');?>  </strong><?php echo h($examDetails['Exam']['name']);?></div>
			<div class="table-responsive">
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
			</div>
			<div class="rtest_heading"><strong><?php echo __('Graphical Report For');?>  </strong><?php echo h($examDetails['Exam']['name']);?></div>
			<div class="col-md-12 col-sm-12">
				<div class="chart">
					<div id="mywrapperdl"></div>
					<?php echo $this->HighCharts->render("My Chartdl");?>
				</div>
			</div>
		</div>
		<div class="tab-pane" id="time-management">
			<div class="rtest_heading"><strong><?php echo __('Time Management For');?>  </strong><?php echo h($examDetails['Exam']['name']);?></div>
			<div class="table-responsive">
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
			</div>
			<div class="col-md-12 col-sm-12">
				<div class="chart">
					<div id="piewrapperqc"></div>
					<?php echo $this->HighCharts->render("Pie Chartqc");?>
				</div>
			</div>
		</div>
		<?php if($examDetails['Exam']['declare_result']=="Yes"){?>
		<div class="tab-pane" id="question">
			<div class="rtest_heading"><strong><?php echo __('Question Report For');?>  </strong><?php echo h($examDetails['Exam']['name']);?></div>
			<div class="table-responsive">
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
		</div>
		<div class="tab-pane" id="solution">
			<div class="rtest_heading"><strong><?php echo __('Solution For');?>  </strong><?php echo h($examDetails['Exam']['name']);?></div>
			<div class="col-sm-9">
				<?php foreach($post as $k=>$ques):$quesNo=$ques['ExamStat']['ques_no'];?>
				<div class="exam-panel" id="quespanel<?php echo$quesNo;?>">
					<div class="table-responsive">
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
								<td><?php if($ques['ExamStat']['ques_status']==NULL && !$ques['ExamStat']['answer'])echo'<strong class="text-info">'.__('Not Attempt').'</strong>';else echo'<strong class="text-warning">'.__('Attempt').'</strong>';?></strong></td>
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
					<div class="col-sm-2">
					<?php echo$this->Form->button('&larr;'.__('Prev'),array('type'=>'button','onclick'=>"callPrev($quesNo);",'class'=>'btn btn-default btn-sm btn-block','escape'=>false));?>
					</div>
					<div class="col-sm-2">
					<?php echo$this->Form->button(__('Next').'&rarr;',array('type'=>'button','onclick'=>"callNext($quesNo);",'class'=>'btn btn-default btn-sm btn-block','escape'=>false));?>
					</div>
					<div class="col-sm-2">
					<?php if($ques['ExamStat']['bookmark']=="Y"){$btnBookmark='<span class="fa fa-star-o"></span>'.__('Unbookmark');$btnColor='btn-danger';}else{$btnBookmark='<span class="fa fa-star"></span> '.__('Bookmark');$btnColor='btn-success';}
					echo$this->Form->button($btnBookmark,array('type'=>'button','onclick'=>"callBoomark($quesNo);",'id'=>"bookmark$quesNo",'class'=>"btn $btnColor btn-sm btn-block",'escape'=>false));?>
					</div>
				</div>
				<?php endforeach;unset($ques);?>
			</div>
			<div class="col-sm-3">
				<div class="panel-group" id="accordion">
				<?php $i=0; foreach($userSectionQuestion as $subjectName=>$quesArr):$i++;
				$subjectNameId=str_replace(" ","",h($subjectName));
				?>			
				<div class="panel panel-default" style="max-height: 375px;overflow-y: scroll;">
					<div class="panel-heading">
					<h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#<?php echo$subjectNameId;?>"><?php echo h($subjectName);?></a></h4>
					</div>
					<div id="<?php echo$subjectNameId;?>" class="panel-collapse collapse<?php if($i==1){?> in<?php }?>">
						<div class="panel-body">
							<div class="row">
								<?php foreach($quesArr as $value):$quesNo=$value['ExamStat']['ques_no'];
								if($value['ExamStat']['bookmark']=="Y")$btnColor="btn-success";else$btnColor="btn-default";?>
								<div class="col-md-3 cols-sm-3 col-xs-3 mrg-1"><?php echo$this->Form->button($quesNo,array('type'=>'button','onclick'=>"navigation($quesNo)",'id'=>"navbtn$quesNo",'class'=>"btn btn-circle $btnColor btn-sm navigation"));?></div>
								<?php endforeach;unset($quesArr);?>
							</div>
						</div>
					</div>
				</div>
				<?php endforeach;unset($i);unset($value);?>
				</div>
			</div>
		</div>
		<?php }?>
		<div class="tab-pane" id="compare-report">
			<div class="rtest_heading"><strong><?php echo __('Compare Report For');?>  </strong><?php echo h($examDetails['Exam']['name']);?></div>
			<div class="com-md-12 col-sm-12 col-xs-12">
				<div class="col-md-3 col-sm-6 col-xs-6">
					<div class="table-responsive">
						<table class="table">
							<tr>
								<td><?php echo __('Total Ques.');?></td>
								<td><strong><?php echo $examDetails['Result']['total_question'];?></strong></td>
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
				</div>
				<div class="col-md-3 col-sm-6 col-xs-6">
					<div class="table-responsive">
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
				</div>
				<?php foreach($compareArr as $k=>$compPost):?>
				<div id="comppanel<?php echo$k;?>" class="compare">
					<div class="col-md-3 col-sm-6 col-xs-6">
						<div class="table-responsive">
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
						<div class="col-md-3 col-sm-6 col-xs-6"><?php if($k<$compareCount){echo$this->Form->button(__('Next'),array('onClick'=>"callCompareNext($k);",'class'=>'btn btn-sm btn-primary'));}?></div>
						<div class="col-md-3 col-sm-6 col-xs-6"><?php if($k!=0){echo$this->Form->button(__('Previous'),array('onClick'=>"callComparePrev($k);",'class'=>'btn btn-sm btn-primary'));}?></div>
					</div>
					<div class="col-md-3 col-sm-6 col-xs-6">
						<div class="table-responsive">
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