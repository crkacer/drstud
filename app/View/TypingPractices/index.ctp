<?php
 $this->Js->JqueryEngine->jQueryObject = 'jQuery';
// Paginator options
$this->Paginator->options(array(
  'update' => '#exam-heading',
  'evalScripts' => true,
));
?>
<div class="" id="dashBoard">
			 
	
	<div  id="upperDashBoard">                   
		<div class="dashBoardTitle">
		Dashboard
		</div>
		<div class="dashBoardUrl">
		Home / Typing Practice
		</div>
		<div id="resDiv">
	
		</div>
                    <div class="phonics_section">
                    	 <h2>Typing Practice</h2>
                         <div class="content mCustomScrollbar">
                         <div class="phonics_tab">
                         	  <ul>
                              		<li class="active"><a href="#">Todays Homework</a></li>
                                    <li><a href="#">Previous Homework</a></li>
                              </ul>
                         </div>
                         
                         <div class="vocabulary">
                             <div class="phonics_top">
                                  <h6>11-09-2016</h6>
                                  <span class="buttons">
                                        <a href="#" class="phonics_prev">Prev</a>
                                        <a href="#" class="phonics_next">Next</a>
                                  </span>
                             </div>
                             
                             <!-- ************** REPEAT BOX ************** -->
                              
                             <?php //print_r($vocahw);
							foreach ($vocahw as $value) { ?>
								<div class="exam-heading"><?php echo __("Question");?></div>
									<div class="panel panel-default">
										<div class="table-responsive exam-panel">
											<table class="table">
												<thead>
												<tr>
													<td>
														<h4>
															<div class="pull-left mrg-left"><strong><?php echo __('Question');?> <?php echo __("1");?></strong></div> 
															<div class="pull-right mrg-left mrg-right"><strong><?php echo __('Correct Marks');?>: <span class="text-success"><?php echo $value['TypingPracticeQs']['marks'];?></span> , <?php echo __('Negative Marks');?>: <span class="text-danger"><?php echo $value['TypingPracticeQs']['negative_marks'];?></span></strong></div>
														</h4>
													</td>
												</tr>
												<tr>
													<td>
														<div class="question_box">
															<div class="mrg-left">
															
																<strong><?php echo str_replace("<script","",$value['TypingPracticeQs']['question']);?></strong>
															</div>
														</div>
													</td>
												</tr>
												</thead>
												<?php if(strlen($value['TypingPracticeQs']['hint'])>0){?>
												<tr>
													<td><div class="mrg-left"><strong><?php echo __('Hint');?> : </strong><?php echo str_replace("<script","",$value['TypingPracticeQs']['hint']);?></div></td>
												</tr>
												<?php } ?>
											</table>
											<!---- ANSWER SECTION --------->
											
											<?php if ($value['Qtype']['type']=="M"){

										print("Question Type is M");
										//print_r($value);
										$options=array();
										$optColor1_1='<span>';$optColor1_2='<span>';$optColor1_3='<span>';
										$optColor1_4='<span>';$optColor1_5='<span>';$optColor1_6='<span>';$optColor2='</span>';
										$option_array = array();
										$i = 1;
										do  {
											if ($value["TypingPracticeQs"]["option".$i] != "")
											$option_array[$i] =  $value["TypingPracticeQs"]["option".$i];
											$i ++;
										}while($i < 7);
										/*$optionKeyArr=explode(",",$value['VocaHwQuestion']['options']);*/
										foreach($option_array as $value2)
										{
											$optKey="option".$value2;
											$doptCol='optColor1'.'_'.$value2;
											//if(strlen($userExamQuestion['Question'][$optKey])>0)
											//$options[$value]=$$doptCol.str_replace("<script","",$value['Question'][$optKey]).$optColor2;
										}
										unset($value2);?>
										<tr>
											<td>								
												<?php if(strlen($value['TypingPracticeQs']['answer'])>1)
												{
													?><div class="checkbox"><?php
													$optionSelected=array();
													//$optionSelected=explode(",",$value['ExamStat']['option_selected']);
													echo$this->Form->input('option_selected',array('type'=>'select','multiple' => 'checkbox','label'=>false,'options'=>$option_array,'value'=>"option1",'escape'=>false));
													?></div><?php
												}
												else
												{
													//$optionSelected=$value['ExamStat']['option_selected'];
													//echo$this->Form->input('option_selected',array('type'=>'radio','label'=>false,'legend'=>false,'div'=>false,'options'=>$option_array,'value'=>"option1",'before' => '<div class="radio"><label>','separator' => '</label></div><div class="radio"><label>','escape'=>false));
													?>
														<div class="answer">
														  	<span class="ans_title">Answer</span>
															  <ul>
															  <?php foreach ($option_array as $answervalue) { ?>
																	<li class="pull-left"><span class="box12"><input type="radio" name="genre" id="radio-1" value="action" /><label for="radio-1"></label></span><?php echo $answervalue; ?></li>
																<?php } ?>
																	
															  </ul>
														 </div>
													<?php
												}
												?>
											</td>
										</tr>
										
									<?php			
									}elseif ($value['Qtype']['type']=="T"){
										print("Question Type is T");
									}elseif ($value['Qtype']['type']=="F") {
										print("Question Type is F");
									}elseif ($value['Qtype']['type']=="S") {
										print("Question Type is S");
									} ?>
										</div>
									</div>
					
									<?php
									//print_r($value);
										//foreach ($value as $subval) {
										//print_r($subval);
										//foreach($subval as $key => $keyval) {
										//print("Key: ".$key." : Value: ".$keyval);

										//}
										//print("end of valueentry");?></br><?php
									//}
									//print("end of vocahw entry");?></br><?php
								} ?>
                             
                             <!-- ************** REPEAT BOX ************** -->

                        
                         </div><!--close vocabulary-->
                         
                         </div>
                    </div><!--close phonics_section-->

                    
                </div>                
            </div>