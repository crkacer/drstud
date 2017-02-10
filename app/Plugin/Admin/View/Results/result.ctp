<?php echo$this->html->link('<span class="fa fa-arrow-left"></span>&nbsp;'.__('Back'),'javascript: history.go(-1)',array('class'=>'btn btn-info','escape'=>false));?>
<div class="row">
      <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">
		<div class="widget">
		    <h4 class="widget-title"><span><?php echo __('Assessment Report for');?> <?php echo h($examDetails['Exam']['name']);?></span></h4>
		</div>
	    </div>
                        <div class="table-responsive">
                            <table class="table table-bordered">
					<tr>
						<td><strong class="text-danger"><?php echo __('Email ID');?></strong></td>
						<td><?php echo h($examDetails['Student']['email']);?></td>
					</tr>
					<tr>
						<td><strong class="text-danger"><?php echo __('Taken Date');?></strong></td>
						<td><?php echo$this->Time->format($sysDay.$dateSep.$sysMonth.$dateSep.$sysYear,$examDetails['ExamResult']['start_time']);?></td>
					</tr>
					<tr>
						<td><strong class="text-danger"><?php echo __('Percentage');?></strong></td>
						<td><?php echo$this->Number->toPercentage($examDetails['ExamResult']['percent']);?></td>
					</tr>
					<tr>
						<td><strong class="text-danger"><?php echo __('Time Taken');?></strong></td>
						<td><?php echo $this->Function->secondsToWords($this->Time->fromString($examDetails['ExamResult']['end_time'])-$this->Time->fromString($examDetails['ExamResult']['start_time']));?></td>
					</tr>
					<tr>
						<td><strong class="text-danger"><?php echo __('Total Time');?></strong></td>
						<td><?php echo $this->Function->secondsToWords($examDetails['Exam']['duration']*60);?></td>
					</tr> 
					<tr>
						<td><strong class="text-danger"><?php echo __('Nos. of Browser tolerance attempt');?></strong></td>
						<td><?php echo $examWarning;?></td>
					</tr>
					<tr>
						<td><strong class="text-danger"><?php echo __('Result');?></strong></td>
						<td><span class="label label-<?php if($examDetails['ExamResult']['result']=="Pass")echo"success";else echo"danger";?>"><?php if($examDetails['ExamResult']['result']=="Pass"){echo __('PASSED');}else{ echo __('FAILED');}?></span></td>
					</tr>                                
			</table>
			</div>
                </div>
            </div>
	      <div class="col-md-3">
                <div class="panel panel-info">
                    <div class="panel-heading">
		<div class="widget">
		    <h4 class="widget-title"><span><?php echo __('Total Score');?></span></h4>
		</div>
	    </div>
	    <div class="panel-body" style="min-height: 260px;">
		<div class="text-center"><h2><?php echo $examDetails['ExamResult']['obtained_marks'];?> /</h2>
		<h2><?php echo$examDetails['ExamResult']['total_marks'];?></h2></div>
	    </div>
		</div>
	      </div>
	      <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
		<div class="widget">
		    <h4 class="widget-title"><span><?php __('Student Marks Distribution');?></span></h4>
		</div>
	    </div>
	    <div class="panel-body">
		<div class="chart">
		  <div id="mywrapperor"></div>
		  <?php echo $this->HighCharts->render("My Chartor");?>
	      </div>
	    </div>
		</div>
	      </div>
	      <?php if($examFeedback){?>
	       <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
		<div class="widget">
		    <h4 class="widget-title"><span><?php echo __('Feedback');?></span></h4>
		</div>
	    </div>
	    <div class="panel-body" style="min-height: 230px;">
		<?php echo$examDetails['ExamFeedback']['comments'];?>
	    </div>
		</div>
	      </div>
	      <?php }?>
	      
	      <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
		<div class="widget">
		    <h4 class="widget-title"><?php echo __('Marks Sheet');?></h4>
		</div>
	    </div>		
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <tr>
                                    <th><?php echo __('Section Name');?></th>
				    <th><?php echo __('Section proportion');?></th>
                                    <th><?php echo __('No. of Questions');?></th>
                                    <th><?php echo __('Actual');?></th>
				    <th><?php echo __('Your Percentage');?></th>
				    <th><?php echo __('Time Taken');?></th>
                                </tr>
                                <?php foreach($userMarksheet as $userValue):?>
                                <tr>                                    
                                    <td class="text-danger"><strong><?php echo h($userValue['Subject']['name']);?></strong></td>
                                    <td><?php echo CakeNumber::toPercentage($userValue['Subject']['marks_weightage']);?></td>
                                    <td><?php echo$userValue['Subject']['total_question'];?></td>
				    <td><?php echo $userValue['Subject']['obtained_marks'].'/'.$userValue['Subject']['total_marks'];?></td>
				    <td><?php echo CakeNumber::toPercentage($userValue['Subject']['percent']);?></td>
				    <td><?php echo $this->Function->secondsToWords($userValue['Subject']['time_taken'],'-');?></td>
                                </tr>
                                <?php endforeach;unset($userValue);?>                               
                            </table>
                        </div>                            
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
		<div class="widget">
		    <h4 class="widget-title"><span><?php echo __('Section Summary');?></span></h4>
		</div>
	    </div>		
                        <div class="chart">
                            <div id="mywrapperdl"></div>
                            <?php echo $this->HighCharts->render("My Chartdl");?>
                        </div>
                </div>
            </div>
	    <div class="col-md-4">
                <div class="panel panel-default">
		<div class="panel-heading">
		<div class="widget">
		    <h4 class="widget-title"><span><?php echo __('Section Summary');?></span></h4>
		</div>
	    </div>
	    <div class="table-responsive">
                  <table class="table">
			<tr>
			<td><div style="margin:5px;height:15px;width:15px;background-color:#0d233a;";>&nbsp;</div></td>
			<td><strong><?php echo __('Maximum Score');?></strong></td>
			</tr>
			<tr>
			<td><div style="margin:5px;height:15px;width:15px;background-color:#39ae39;";>&nbsp;</div></td>
			<td><strong><?php echo __('Developed Skill');?></strong></td>
			</tr>
			<tr>
			<td><div style="margin:5px;height:15px;width:15px;background-color:#f79327;";>&nbsp;</div></td>
			<td><strong><?php echo __('Needs Development');?></strong></td>
			</tr>
			<tr>
			<td><div style="margin:5px;height:15px;width:15px;background-color:#eb1d1d;";>&nbsp;</div></td>
			<td><strong><?php echo __('Lack of Skill');?></strong><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><br/></td>
			</tr>
			
		  </table>
	    </div>                  
                </div>
            </div>
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="widget">
                            <h4 class="widget-title"><?php echo __('MCQ  answered');?></h4>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tr>
                                <th><?php echo __('S.N.');?></th>
                                <th><?php echo __('Question');?></th>
                                <th><?php echo __('Marked Answer');?></th>
                                <th><?php echo __('Marks Scored');?></th>
                                <th><?php echo __('Correct Answers');?></th>
                                <th><?php echo __('Max Marks');?></th>
                                <th><?php echo __('Time Taken');?></th>
				<th><?php echo __('Level');?></th>
                            </tr>
                            <?php foreach($post as $k=>$ques):
                            if($ques['Qtype']['type']=="M")
                            {
                                $correctAnswer="";$userAnswer="";
                                if(strlen($ques['Question']['answer'])>1)
                                {
                                    $correctAnswerExp=explode(",",$ques['Question']['answer']);
                                    foreach($correctAnswerExp as $option):
                                        $correctAnswer1="option".$option;		
                                        $correctAnswer.=$ques['Question'][$correctAnswer1]."<br/>";
                                    endforeach;unset($option);
                                    if(strlen($ques['ExamStat']['option_selected'])>1)
                                    {
                                        $userAnswerExp=explode(",",$ques['ExamStat']['option_selected']);
                                        foreach($userAnswerExp as $option):
                                            $userAnswer1="option".$option;
                                            $userAnswer.=$ques['Question'][$userAnswer1]."<br/>";
                                        endforeach;unset($option);
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
                            ?>
                            <tr <?php if($ques['ExamStat']['ques_status']=='R'){?>class="text-success"<?php }elseif($ques['ExamStat']['ques_status']=='W'){?>class="text-danger"<?php }else{?>class="text-info"<?php }?>>
                                <td><strong><?php echo $ques['ExamStat']['ques_no'];?></strong></td>
                                <td><?php echo str_replace("<script","",$ques['Question']['question']);?></td>
                                <td><?php echo$userAnswer;?></td>
                                <td><?php echo$ques['ExamStat']['marks_obtained'];?></td>
                                <td><?php echo$correctAnswer;?></td>
                                <td><?php echo$ques['ExamStat']['marks'];?></td>
                                <td><?php echo $this->Function->secondsToWords($ques['ExamStat']['time_taken'],'-');?></td>
				<td><?php echo$ques['Diff']['diff_level'];?></td>
                            </tr>
                            <?php endforeach;unset($ques);?>
                        </table>
                    </div>
                </div>
            </div>
            
    </div>
<?php echo$this->html->link('<span class="fa fa-arrow-left"></span>&nbsp;'.__('Back'),'javascript: history.go(-1)',array('class'=>'btn btn-info','escape'=>false));?>