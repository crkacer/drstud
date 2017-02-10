<?php
$answer_select=array();
                if($post['Question']['qtype_id']==1)
                {
                    $answer_select=$post['Question']['answer'];
                }
                ?>
                <script type="text/javascript">
    $(document).ready(function(){
        $('#myquestiontab').hide();
        $('#tf').hide();
        $('#ftb').hide();
        <?php if($post['Question']['qtype_id']==1){?>
        $('#myquestiontab').show();<?php }
        elseif($post['Question']['qtype_id']==2){?>
        $('#tf').show();<?php }
        elseif($post['Question']['qtype_id']==3){?>
        $('#ftb').show();<?php }?>
        $('#qtype_id1').click(function() {
            $('#myquestiontab').show();
            $('#tf').hide();
            $('#ftb').hide();
        });
        $('#qtype_id2').click(function() {
            $('#tf').show();
            $('#myquestiontab').hide();
            $('#ftb').hide();
        });
        $('#qtype_id3').click(function() {
            $('#ftb').show();
            $('#myquestiontab').hide();
            $('#tf').hide();
        });
        $('#qtype_id4').click(function() {
            $('#ftb').hide();
            $('#myquestiontab').hide();
            $('#tf').hide();
        });        
        });
</script>

		    <div class="table-responsive">
			<table class="table table-bordered">
			    <tr>
				<td><strong><small class="text-primary"><?php echo __('Question Type');?></small></strong></td>
				<td><?php echo h($post['Qtype']['question_type']);?></td>
				<td><strong><small class="text-primary"><?php echo __('Subject');?></small></strong></td>
				<td colspan="3"><?php echo h($post['Subject']['subject_name']);?></td>				
			    </tr>
			    <tr>
				<td colspan="6">                   
                    <div id="Question">
                    <strong><?php echo __('Question');?> : </strong>
                    <?php echo str_replace("<script","",$post['Question']['question']);?><hr/>
                    </div>
		    <div id="myquestiontab">
								<div class="tab-pane" id="Answer1">
									<strong><?php echo __('Option1');?> : </strong><?php echo str_replace("<script","",$post['Question']['option1']);?><hr/>
								</div>
								<div class="tab-pane" id="Answer2">
									<strong><?php echo __('Option2');?>: </strong><?php echo str_replace("<script","",$post['Question']['option2']);?><hr/>
								</div>
								<div class="tab-pane" id="Answer3">
									<strong><?php echo __('Option3');?> : </strong><?php echo str_replace("<script","",$post['Question']['option3']);?><hr/>
								</div>
								<div class="tab-pane" id="Answer4">
									<strong><?php echo __('Option4');?>  : </strong><?php echo str_replace("<script","",$post['Question']['option4']);?><hr/>
								</div>
								<?php if(strlen($post['Question']['option5'])>0){?>
								<div class="tab-pane" id="Answer5">
									<strong><?php echo __('Option5');?>  : </strong><?php echo str_replace("<script","",$post['Question']['option5']);?><hr/>
								</div>
								<?php } if(strlen($post['Question']['option6'])>0){?>
								<div class="tab-pane" id="Answer6">
									<strong><?php echo __('Option6');?>  : </strong><?php echo str_replace("<script","",$post['Question']['option6']);?><hr/>
								</div>
								<?php }?>
                                                                <div class="tab-pane" id="CorrectAnswer">
                                                                    <p><br/><strong><?php echo __('Correct Answer');?> :<?php echo __("Option$answer_select");?> </strong></p>
								</div>
								</div>
                                                         <div id="tf">
                                                         <p><br/><strong><?php echo __('Answer');?> : </strong><?php echo ucfirst(strtolower($post['Question']['true_false']));?></p>
                                                        </div>
                                                        </div>
                                                        </div>
                                                        </div>
                                                        </div>
                                                         </div>
                                                  <div class="form-group" id="ftb">
                                                                    <p><br/><strong><?php echo __('Answer');?> : </strong><?php echo $post['Question']['fill_blank'];?></p>
								</div>
				</td>
			    </tr>
			    <?php if(strlen($post['Question']['explanation'])>0){?>
			    <tr>
				<td><strong><small class="text-primary"><?php echo __('Explanation');?></small></strong></td>
				<td colspan="5"><?php echo str_replace("<script","",$post['Question']['explanation']);?></td>				
			    </tr>
			    <?php }?>
			    <?php if(strlen($post['Question']['hint'])>0){?>
			    <tr>
				<td><strong><small class="text-primary"><?php echo __('Hint');?></small></strong></td>
				<td colspan="5"><?php echo$post['Question']['hint'];?></td>				
			    </tr>
			    <?php }?>
			    <tr>
				<td><strong><small class="text-primary"><?php echo __('Marks');?></small></strong></td>
				<td><?php echo h($post['Question']['marks']);?></td>
				<td><strong><small class="text-primary"><?php echo __('Negative Marks');?></small></strong></td>
				<td><?php echo h($post['Question']['negative_marks']);?></td>
				<td><strong><small class="text-primary"><?php echo __('Difficulty Level');?></small></strong></td>
				<td><?php echo h($post['Diff']['diff_level']);?></td>
			    </tr>			   
			</table>
		    </div>
		