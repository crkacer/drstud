<?php
 $this->Js->JqueryEngine->jQueryObject = 'jQuery';
// Paginator options
$this->Paginator->options(array(
  'update' => '#resultDiv',
  'evalScripts' => true,
));
?>
<div id="resultDiv"> 

<div class="row">
    <?php echo $this->element('pagination',array('IsSearch'=>'No','IsDropdown'=>'No'));
        $page_params = $this->Paginator->params();
        $limit = $page_params['limit'];
        $page = $page_params['page'];
        $serial_no = 1*$limit*($page-1)+1;?>
</div>
	<?php echo $this->Session->flash();?>
	<div class="row">
		<div class="col-md-12">
		<div class="btn-group">
		<?php echo $this->Html->link('<span class="fa fa-arrow-left"></span>&nbsp;'.__('Back To Exam'),array('controller' => 'Exams','action'=>'index'),array('escape' => false,'class'=>'btn btn-info'));?>
		</div>
		<?php foreach($Attemptedpapers as $post):?>
			<div class="panel panel-default">
			    <div class="panel-heading">
				<div class="widget">
				<h4 class="widget-title"><?php echo __('Attempted Papers of');?> <span><?php echo$post['Exam']['name'];?></span></h4>
			    </div>
			</div>
				<div class="table-responsive">
					<table class="table table-striped table-bordered">                            
						<tr>
							<td><?php echo __('Name');?></td>
							<td><?php echo h($post['Student']['name']);?></td>
							<td><?php echo __('Email');?></td>
							<td><?php echo h($post['Student']['email']);?></td>
						</tr>
						<tr>
							<td><?php echo __('Total Marks');?></td>
							<td><?php echo$post['Attemptedpaper']['total_marks'];?></td>
							<td><?php echo __('Obtained Marks');?></td>
							<td><?php echo$post['Attemptedpaper']['obtained_marks'];echo ($post['Attemptedpaper']['user_id']==0)? __('Pending'):"";?></td>
						</tr>
						<tr>
							<td><?php echo __('Result Finalized');?></td>
							<td><?php $examResultId=$post['Attemptedpaper']['id']; if($post['Attemptedpaper']['user_id']==0){echo$this->Form->postLink(__('Finalize It'),array('action'=>'finalize',$examId,$page,$examResultId),array('confirm'=>'Are you sure, you want to finalize this paper','class'=>'btn btn-success'));}
							else{?><span class="label label-<?php if($post['Attemptedpaper']['result']=="Pass")echo"success";else echo"danger";?>"><?php if($post['Attemptedpaper']['result']=="Pass"){echo __('PASSED');}else{echo __('FAILED');}?></span><?php }?></td>
							<td><?php echo __('Finalized By');?></td>
							<td><?php echo h($post['User']['name']);?></td>
						</tr>                           
					</table>
				</div>
				<div class="panel-body">
					<div class="col-md-13">                    
						<div class="panel-group" id="accordion">
							<?php foreach($post['Question'] as $k=>$ques):?>
								<div class="panel panel-default">
									<div class="panel-heading">
									 <a data-toggle="collapse" href="#collapse<?php echo$ques['ExamStat']['ques_no'];?>">
										  <?php if($Qtype[$ques['qtype_id']-1]['Qtype']['type']=="M"){?><span class="<?php echo($ques['ExamStat']['option_selected'] == $ques['ExamStat']['correct_answer'] ? "text-success" : "text-danger");?>"><?php }?>
										  <?php if($Qtype[$ques['qtype_id']-1]['Qtype']['type']=="T"){?><span class="<?php echo($ques['ExamStat']['true_false'] == $ques['ExamStat']['correct_answer'] ? "text-success" : "text-danger");?>"><?php }?>
										  <?php if($Qtype[$ques['qtype_id']-1]['Qtype']['type']=="F"){?><span class="<?php echo($ques['ExamStat']['fill_blank'] == $ques['ExamStat']['correct_answer'] ? "text-success" : "text-danger");?>"><?php }?>
										  <?php if($Qtype[$ques['qtype_id']-1]['Qtype']['type']=="S"){?><span class="text-info"><?php }?>
										  <strong><?php echo __('Question No');?>.<?php echo $ques['ExamStat']['ques_no'];?>&nbsp;(<?php echo$Qtype[$ques['qtype_id']-1]['Qtype']['question_type'];?>)</strong></span>
										</a>
									</div>
									<div id="collapse<?php echo$ques['ExamStat']['ques_no'];?>" class="collapse<?php echo($k==0)?"in":"";?>">
										<div class="table-responsive">                    
											<table class="table table-bordered">
												
												<tr>
													<td colspan="4"><?php echo str_replace("<script","",$ques['question']);?></td>                                
												</tr>
												<?php if($Qtype[$ques['qtype_id']-1]['Qtype']['type']=="M"){?>
												<?php if(strlen($ques['option1'])>0){?>
												<tr class="text-left">
													<td><strong class="text-warning"><?php echo __('Option1');?></strong></td>
													<td colspan="3"><?php echo str_replace("<script","",$ques['option1']);?></td>
												</tr>
												<?php }?>
												<?php if(strlen($ques['option2'])>0){?>
												<tr class="text-left">
												  <td><strong class="text-warning"><?php echo __('Option2');?> </strong></td>
												  <td colspan="3"><?php echo str_replace("<script","",$ques['option2']);?></td>
												</tr>
												<?php }?>
												<?php if(strlen($ques['option3'])>0){?>												
												<tr class="text-left">
												  <td><strong class="text-warning"><?php echo __('Option3');?></strong></td>
												  <td colspan="3"><?php echo str_replace("<script","",$ques['option3']);?></td>												
												</tr>
												<?php }?>
												<?php if(strlen($ques['option4'])>0){?>
												<tr class="text-left">
												  <td><strong class="text-warning"><?php echo __('Option4');?></strong></td>
												  <td colspan="3"><?php echo str_replace("<script","",$ques['option4']);?></td>
												</tr>
												<?php }?>
												<?php if(strlen($ques['option5'])>0){?>
												<tr class="text-left">
												  <td><strong class="text-warning"><?php echo __('Option5');?></strong></td>
												  <td colspan="3"><?php echo str_replace("<script","",$ques['option5']);?></td>
												</tr>
												<?php }?>
												<?php if(strlen($ques['option6'])>0){?>
												<tr class="text-left">
												  <td><strong class="text-warning"><?php echo __('Option6');?></strong></td>
												  <td colspan="3"><?php echo str_replace("<script","",$ques['option6']);?></td>
												</tr>
												<?php }}
												if($Qtype[$ques['qtype_id']-1]['Qtype']['type']=="M")
												{
													$correctAnswer="";$userAnswer="";
													if(strlen($ques['answer'])>1)
													{
													    $correctAnswerExp=explode(",",$ques['answer']);
													    foreach($correctAnswerExp as $option):
														$correctAnswer1="option".$option;		
														$correctAnswer.=" ".$ques[$correctAnswer1];
													    endforeach;unset($option);
													    if(strlen($ques['ExamStat']['option_selected'])>1)
													    {
														$userAnswerExp=explode(",",$ques['ExamStat']['option_selected']);
														foreach($userAnswerExp as $option):
														    $userAnswer1="option".$option;
														    $userAnswer.=" ".$ques[$userAnswer1];
														endforeach;unset($option);
													    }
													}		    
													else
													{
													    if($ques['ExamStat']['option_selected'])
													    {
														$userAnswer="option".$ques['ExamStat']['option_selected'];
														$userAnswer=$ques[$userAnswer];
													    }
													    $correctAnswer="option".$ques['answer'];			
													    $correctAnswer=$ques[$correctAnswer];
													}
												}
												if($Qtype[$ques['qtype_id']-1]['Qtype']['type']=="T")
												{
												    $userAnswer=$ques['ExamStat']['true_false'];
												    $correctAnswer=$ques['true_false'];
												}
												if($Qtype[$ques['qtype_id']-1]['Qtype']['type']=="F")
												{
												    $userAnswer=$ques['ExamStat']['fill_blank'];
												    $correctAnswer=$ques['fill_blank'];
												}
												if($Qtype[$ques['qtype_id']-1]['Qtype']['type']=="S")
												{
												    $userAnswer=$ques['ExamStat']['answer'];
												    $correctAnswer="";
												}?>
												<tr>
													<td colspan="2"><?php echo __('Marked Answer');?>: <?php echo h($userAnswer);?></td>
													<td colspan="2"><span class="text-success"><?php echo __('Correct Answer');?>: <?php echo h($correctAnswer);?></span></td>
												</tr>
												<tr>
													<td><?php echo __('Time Taken');?>: <?php echo $this->Function->secondsToWords($ques[0]['time_taken'],"Not Attempted");?></td>
													<td><?php echo __('Marks');?>: <?php echo$ques['ExamStat']['marks'];?></td>
													<td><?php echo __('Marks Obtained');?>: <?php if($Qtype[$ques['qtype_id']-1]['Qtype']['type']=="S" && $post['Attemptedpaper']['user_id']==0){$id=$ques['ExamStat']['exam_id'];$statId=$ques['ExamStat']['id'];
														echo $this->Form->create('Attemptedpaper',array('controller'=>'Attemptedpaper','action' =>"marksupdate/$id/$statId",'name'=>'post_req','id'=>'post_req','inputDefaults'=>array('label'=>false,'div'=>false)));
														echo $this->Form->input('marks_obtained',array('value'=>$ques['ExamStat']['marks_obtained'],'label'=>false,'div'=>false,'autocomplete'=>'off','size'=>4,'maxlength'=>4));
														echo $this->Form->hidden('page',array('value'=>$page));
														?>&nbsp;<?php echo $this->Form->end(array('label'=>'Update','div'=>false,'class'=>'btn btn-default'));                                    
													}else{echo$ques['ExamStat']['marks_obtained'];}?></td>
													<?php $userName="";
													if($Qtype[$ques['qtype_id']-1]['Qtype']['type']=="S")
													{
														foreach($UserArr as $User):
														if($User['User']['id']==$ques['ExamStat']['user_id'])
														{
															$userName=$User['User']['name'];
															break;
														}
														endforeach;unset($User);
													}?>                                
													<td><?php echo __('Checked by');?>: <?php echo($ques['ExamStat']['user_id']==0)?__('System'):h($userName);?></td>
												</tr>
												<tr>
													<td colspan="4"><hr/></td>
												</tr>
											</table>
											
										</div>
									</div>	
								</div>	
							<?php endforeach;unset($ques);?> 
						</div>	
					</div>
				</div>
			</div>
			<?php endforeach;unset($post);?>
		</div>
	</div>
	</div>