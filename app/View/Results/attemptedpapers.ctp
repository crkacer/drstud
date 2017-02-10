<div class="page-title-breadcrumb">
    <div class="page-header pull-left">
	<div class="page-title"><?php echo __('Attempted Papers');?></div>
    </div>
</div>
<div class="panel">
    <div class="panel-body">
	<?php echo$this->html->link('<span class="glyphicon glyphicon-arrow-left"></span>&nbsp;'.__('Back'),'javascript: history.go(-1)',array('class'=>'btn btn-info','escape'=>false));?>
	<div class="table-responsive">
	    <table class="table table-bordered">
		<tr>
		    <th><?php echo __('S.N.');?></th>
		    <th class="max-column"><?php echo __('Description');?></th>
		    <th class="max-column"><?php echo __('Marked Answer');?></th>
		    <th><?php echo __('Marks Scored');?></th>
		    <th><?php echo __('Answers');?></th>
		    <th><?php echo __('Max Marks');?></th>
		    <th><?php echo __('Time Taken');?></th>
		    <th><?php echo __('Explanation');?></th>
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
			    $correctAnswer.=" ".$ques['Question'][$correctAnswer1];
			endforeach;unset($option);
			if(strlen($ques['ExamStat']['option_selected'])>1)
			{
			    $userAnswerExp=explode(",",$ques['ExamStat']['option_selected']);
			    foreach($userAnswerExp as $option):
				$userAnswer1="option".$option;
				$userAnswer.=" ".$ques['Question'][$userAnswer1];
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
		<tr <?php if($ques['Qtype']['type']=="M"){?>class="<?php echo($ques['ExamStat']['option_selected'] == $ques['ExamStat']['correct_answer'] ? "text-success" : "text-danger");?>"<?php }?>
										  <?php if($ques['Qtype']['type']=="T"){?>class="<?php echo($ques['ExamStat']['true_false'] == $ques['ExamStat']['correct_answer'] ? "text-success" : "text-danger");?>"<?php }?>
										  <?php if($ques['Qtype']['type']=="F"){?>class="<?php echo($ques['ExamStat']['fill_blank'] == $ques['ExamStat']['correct_answer'] ? "text-success" : "text-danger");?>"<?php }?>
										  <?php if($ques['Qtype']['type']=="S"){?>class="text-info"<?php }?>>
		    <td><strong><?php echo $ques['ExamStat']['ques_no'];?></strong></td>
		    <td class="max-column"><?php echo str_replace("<script","",$ques['Question']['question']);?></td>
		    <td class="max-column"><?php echo$userAnswer;?></td>
		    <td><?php echo$ques['ExamStat']['marks_obtained'];?></td>
		    <td><?php echo$correctAnswer;?></td>
		    <td><?php echo$ques['ExamStat']['marks'];?></td>
		    <td><?php echo $this->Function->secondsToWords($ques[0]['time_taken'],"Not Attempted");?></td>
		    <td><?php echo$ques['Question']['explanation'];?></td>
		</tr>
		<?php endforeach;unset($ques);?>
	    </table>
	</div>
	<?php echo$this->html->link('<span class="glyphicon glyphicon-arrow-left"></span>&nbsp;'.__('Back'),'javascript: history.go(-1)',array('class'=>'btn btn-info','escape'=>false));?>
    </div>
</div>