<div class="container">
        <div class="panel panel-custom mrg">
        <div class="panel-heading"><?php echo __('Quiz Details');?><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button></div>            
	<div class="panel-body">
                    <div class="table-responsive"> 
						<table class="table table-bordered">
							<tr>
								<td><strong><small class="text-primary"><?php echo __('Name');?></small></strong></td>
								<td><?php echo h($post['Exam']['name']);?></td>
								<td colspan=2><?php if($post['Exam']['status']=="Inactive" && $post['Exam']['type']=="Exam"){echo$this->Html->link(__('Add Questions'),array('controller'=>'Addquestions','action'=>"index/$id"),array('class'=>'btn btn-success'));}
                                                                if($post['Exam']['status']=="Active"){echo$this->Html->link(__('Finalize Result'),array('controller'=>'Attemptedpapers','action'=>"index/$id"),array('class'=>'btn btn-success'));}
                                                                if($post['Exam']['status']=="Closed"){echo$this->Html->link(__('Attempted Papers'),array('controller'=>'Attemptedpapers','action'=>"index/$id"),array('class'=>'btn btn-primary'));}?></td>
							</tr>
							<tr>
								<td><strong><small class="text-primary"><?php echo __('Eligible Group');?></small></strong></td>
								<td><?php foreach($post['Group'] as $k=>$groupName):?>
                                                                                (<?php echo++$k;?>) <?php echo$groupName['group_name'];?>
                                                                                <?php endforeach;unset($groupName);unset($k);?>
								</td>
								<td colspan=2><?php if($post['Exam']['status']=="Active"){echo$this->Form->postLink(__('Close Exam'),array('controller'=>'Attemptedpapers','action'=>'closeexam',$id),array('confirm'=>'Are you sure, you want to close this exam?','class'=>'btn btn-danger'));}
                                                                if($post['Exam']['status']=="Inactive"){echo$this->Html->link(__('Activate Exam'),array('action'=>'activateexam',$id),array('class'=>'btn btn-info'));}
                                                                if($post['Exam']['status']=="Closed"){?><?php echo$this->Form->postLink(__('Exam Closed Re-Activate Exam'),array('action'=>'activateexam',$id),array('confirm'=>'Are you sure, you want to re-activate this exam?','class'=>'btn btn-danger'));}
                                                                ?></td>
							</tr>
							<tr>
								<td><strong><small class="text-primary"><?php echo __('Start Date');?></small></strong></td>
								<td ><?php echo $this->Time->format($sysDay.$dateSep.$sysMonth.$dateSep.$sysYear.$dateGap.$sysHour.$timeSep.$sysMin.$dateGap.$sysMer,$post['Exam']['start_date']);?></td>
								<td><strong><small class="text-primary"><?php echo __('End Date');?></small></strong></td>
								<td><?php echo $this->Time->format($sysDay.$dateSep.$sysMonth.$dateSep.$sysYear.$dateGap.$sysHour.$timeSep.$sysMin.$dateGap.$sysMer,$post['Exam']['end_date']);?></td>
							</tr>
							<tr>
								<td><strong><small class="text-primary"><?php echo __('Subject');?></small></strong></td>
								<td><?php echo __($post['Subject']['subject_name']);?></td>
								<td><strong><small class="text-primary"><?php echo __('Lesson');?></small></strong></td>
								<td><?php echo __($post['Lesson']['name']);?></td>
							</tr>
							<tr>
								<td><strong><small class="text-primary"><?php echo __('Show Answer Sheet');?></small></strong></td>
								<td ><?php if($post['Exam']['declare_result']){echo __('Yes');}else{echo __('No');};?></td>
								<td><strong><small class="text-primary"><?php echo __('Browser Tolrence');?></small></strong></td>
								<td ><?php if($post['Exam']['browser_tolrance']){echo __('Yes');}else{echo __('No');};?></td>								
							</tr>
							<?php if($frontExamPaid){?>
							<tr>
								<td><strong><small class="text-primary"><?php echo __('Paid Exam');?></small></strong></td>
								<td><?php if($post['Exam']['paid_exam']=="1"){echo __('Yes');}else{echo __('No');};?></td>								
								<td><strong><small class="text-primary"><?php echo __('Amount');?></small></strong></td>
								<td><?php if($post['Exam']['paid_exam']=="1"){echo$currency.$post['Exam']['amount'];}?></td>
							</tr>
							<?php }?>
							<tr>
								<td><strong><small class="text-primary"><?php echo __('Result After Finish');?></small></strong></td>
								<td><?php if($post['Exam']['finish_result']){echo __('Yes');}else{echo __('No');};?></td>
								<td><strong><small class="text-primary"><?php echo __('Mode');?></small></strong></td>
								<td><?php if($post['Exam']['type'])echo __('Quiz');else echo __($post['Exam']['type']);?></td>
							</tr>
							
							<tr>
								<td><strong><small class="text-primary"><?php echo __('Duration');?></small></strong></td>
								<td><?php echo __($this->Function->secondsToWords($post['Exam']['duration']*60));?></td>
								<td><strong><small class="text-primary"><?php echo __('Attempt Count');?></small></strong></td>
								<td><?php if($post['Exam']['attempt_count']==0){echo __('Unlimited');}else{echo $post['Exam']['attempt_count'];};?></td>
					
							</tr>
							<tr>
								<td><strong><small class="text-primary"><?php echo __('Instant Result');?></small></strong></td>
								<td><?php if($post['Exam']['instant_result']){echo __('Yes');}else{echo __('No');};?></td>
								<td><strong><small class="text-primary"><?php echo __('Option Shuffle');?></small></strong></td>
								<td><?php if($post['Exam']['option_shuffle']){echo __('Yes');}else{echo __('No');};?></td>					
							</tr>
							<tr>
								<?php if($examExpiry){?><td><strong><small class="text-primary"><?php echo __('Expiry');?></small></strong></td>
								<td><?php if($post['Exam']['expiry']==0){echo __('Unlimited');}else{echo $post['Exam']['expiry'].__('Days');};?></td><?php }?>
								<?php if($post['Exam']['type']=="Exam"){?><td><strong><small class="text-primary"><?php echo __('Total Marks');?></small></strong></td>
								<td><?php echo $totalMarks;?></td><?php }?>
								
							</tr>							
						</table>
					</div>
					<?php if($post['Exam']['type']=="Exam"){?>
					<div class="table-responsive"> 	
						<table class="table table-bordered">
							<tr class="text-primary">
								<th><small><?php echo __('Subject');?></small></th>
								<th><small><?php echo __('Subjective');?></small></th>
								<th><small><?php echo __('Objective');?></small></th>
								<th><small><?php echo __('True &amp; False');?></small></th>
								<th><small><?php echo __('Fill in the blanks');?></small></th>
								<th><small><?php echo __('Difficulty Level');?></small></th>
								<th><small><?php echo __('Total Questions');?></small></th>
								<?php if($examCount){?><th><small><?php echo __('Question Attempt Count');?></small></th><?php }?>
							</tr>                    
							<?php $totalSubjective=0;$totalObjective=0;$totalTrueFalse=0;$totalFillBlank=0;$totalQuestion=0;$totalAttemptQuestion=0;
							$totalEasy=0;$totalMedium=0;$totalHard=0;
							foreach($SubjectDetail as $sd):?>
							<tr><td><?php echo$subject_name=h($sd['Subject']['subject_name']);?></td>
								<?php for($i=0;$i<4;$i++):?>
								<td><?php echo$QuestionDetail[$subject_name][$i];?></td>
								<?php if($i==0)$totalSubjective=$totalSubjective+$QuestionDetail[$subject_name][0];
								if($i==1)$totalObjective=$totalObjective+$QuestionDetail[$subject_name][1];
								if($i==2)$totalTrueFalse=$totalTrueFalse+$QuestionDetail[$subject_name][2];
								if($i==3)$totalFillBlank=$totalFillBlank+$QuestionDetail[$subject_name][3];
								endfor;?>								
								<td>
								<?php $i=0;$sum=0;
								foreach($DiffLevel as $diff):
								$sum=$sum+$DifficultyDetail[$subject_name][$i];
								?>
								<?php if($diff['Diff']['type']=="D")$diffType=__('H');else$diffType=__($diff['Diff']['type']);
								echo$DifficultyDetail[$subject_name][$i]."(".$diffType.")";?>
								<?php if($i==0)$totalEasy=$totalEasy+$DifficultyDetail[$subject_name][0];
								if($i==1)$totalMedium=$totalMedium+$DifficultyDetail[$subject_name][1];
								if($i==2)$totalHard=$totalHard+$DifficultyDetail[$subject_name][2];?>
								<?php $i++;endforeach;?></td>
								<td><?php echo$sum;?></td>
								<?php if($examCount){?><td><?php if($sd['ExamMaxquestion']['max_question']==0){echo $sum;}else{echo h($sd['ExamMaxquestion']['max_question']);}?></td><?php }?>
							</tr>
							<?php $totalQuestion=$totalQuestion+$sum;
							if($sd['ExamMaxquestion']['max_question']==0){$totalAttemptQuestion=$totalAttemptQuestion+$sum;}else{$totalAttemptQuestion=$totalAttemptQuestion+$sd['ExamMaxquestion']['max_question'];}
							endforeach;?>
							<?php unset($sd);?>
							<tr>
								<td><strong><?php echo __('Total');?></strong></td>
								<td><strong><?php echo$totalSubjective;?></strong></td>
								<td><strong><?php echo$totalObjective;?></strong></td>
								<td><strong><?php echo$totalTrueFalse;?></strong></td>
								<td><strong><?php echo$totalFillBlank;?></strong></td>
								<td><strong><?php echo$totalEasy;?>(<?php echo __('E');?>) <?php echo$totalMedium;?>(<?php echo __('M');?>(<?php echo$totalHard;?><?php echo __('H');?>)</strong></td>
								<td><strong><?php echo$totalQuestion;?></strong></td>
								<?php if($examCount){?><td><strong><?php echo$totalAttemptQuestion;?></strong></td><?php }?>
							</tr>
                        </table>
					</div>
					<div class="table-responsive"> 	
						<table class="table table-bordered">
							<tr>
								<?php $i=0;foreach($SubjectDetail as $sd):?>
								<td>
									<div class="chart">	
										<div id="piewrapper<?php echo$i;?>"></div>
										<?php echo $this->HighCharts->render("Pie Chart$i"); ?>
									</div>
								</td>
								<?php $i++;endforeach;?>
							</tr>
						</table>
					</div>
					<?php }else{?>
					<div class="table-responsive"> 	
						<table class="table table-bordered">
							<tr class="text-primary">
								<th><small><?php echo __('Subject');?></small></th>
								<th><small><?php echo __('Question Type');?></small></th>
								<th><small><?php echo __('Difficulty Level');?></small></th>
								<th><small><?php echo __('Total Question');?></small></th>
								<?php if($examCount){?><th><small><?php echo __('Questions Attempt Count');?></small></th><?php }?>
							</tr>                    
							<?php $totalQuestion=0;$totalAttemptQuestion=0;
							foreach($SubjectDetail as $sd):
							if($sd['MaxQuestion']==0)$attempQuestion=$sd['QuesNo'];else$attempQuestion=$sd['MaxQuestion'];
							$totalQuestion=$totalQuestion+$sd['QuesNo'];
							$totalAttemptQuestion=$totalAttemptQuestion+$attempQuestion;
							?>
							<tr>
							<td><?php echo h($sd['Subject']);?></td>
							<td><?php echo h($sd['Type']);?></td>
							<td><?php echo h($sd['Level']);?></td>
							<td><?php echo h($sd['QuesNo']);?></td>
							<?php if($examCount){?><td><?php echo$attempQuestion;?></td><?php }?>
							</tr>
							<?php endforeach;?>
							<?php unset($sd);?>
							<tr><td>&nbsp;</td><td>&nbsp;</td><td><strong><?php echo __('Total');?></strong></td>
							<td><strong><?php echo$totalQuestion;?></strong></td>
							<?php if($examCount){?><td><strong><?php echo$totalAttemptQuestion;?></strong></td><?php }?></tr>
                        </table>
					</div>
					<div class="chart">	
										<div id="piewrappersub"></div>
										<?php echo $this->HighCharts->render("Pie Chartsub"); ?>
									</div>
					<?php }?>
					
                    </div>
                </div>
            </div>