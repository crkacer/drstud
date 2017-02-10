<?php
if($mathEditor)
$editorType="math";
else
$editorType="full";
                $answerSelect=array();
                if($post['Question']['qtype_id']==1)
                {
                    $answerSelect=explode(",",$post['Question']['answer']);
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
	<?php if($this->request->data){?>
	$('#myquestiontab').hide();
        <?php if($this->request->data['Question']['qtype_id']==1){?>
        $('#myquestiontab').show();<?php }
        elseif($this->request->data['Question']['qtype_id']==2){?>
        $('#tf').show();<?php }
        elseif($this->request->data['Question']['qtype_id']==3){?>
        $('#ftb').show();<?php }}?>
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
<div <?php if(!$isError){?>class="container"<?php }?>>
<div class="panel panel-custom mrg">
<div class="panel-heading"><?php echo __('Edit Question Type');?><?php if(!$isError){?><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><?php }?></div>

                 <div class="panel-body">
		 <?php echo $this->Form->create('Question');?>
		 <?php echo $this->Session->flash();?>
                 <div class="col-md-12">
                 <div class="row">
                 <div class="panel panel-default">
                 <div class="panel-body">		  
                 <div class="radio-inline">                 
                    <?php echo $this->Form->radio('qtype_id',$qtype_id,array('id'=>'qtype_id','legend'=>false,'hiddenField'=>false,'separator'=> '</div><div class="radio-inline">'));?>
                 </div>
                 </div>
                 </div>
                 </div>
                 </div>
                
                <ul class="nav nav-tabs" id="myquestiontab">
                <li class="active"><a href="#Question" data-toggle="tab"><?php echo __('Question');?></a></li>                
                <li><a href="#Answer1" data-toggle="tab"><?php echo __('Option1');?></a></li>
                <li><a href="#Answer2" data-toggle="tab"><?php echo __('Option2');?></a></li>
                <li><a href="#Answer3" data-toggle="tab"><?php echo __('Option3');?></a></li>
                <li><a href="#Answer4" data-toggle="tab"><?php echo __('Option4');?></a></li>
		<li><a href="#Answer5" data-toggle="tab"><?php echo __('Option5');?></a></li>
		<li><a href="#Answer6" data-toggle="tab"><?php echo __('Option6');?></a></li>
                <li><a href="#CorrectAnswer" data-toggle="tab"><?php echo __('Correct Answers');?></a></li>
                </ul>                    
                    <div class="tab-content">
                    <div class="tab-pane active" id="Question">
                    <h4><?php echo __('Question');?></h4><hr/>                    
                    <?php echo $this->Tinymce->input('question',array('label' => false,'class'=>'form-control','div'=>false,'placeholder'=>__('Question')),array('language'=>$configLanguage,'directionality'=>$dirType),$mathEditor);?>
                    </div>
								<div class="tab-pane" id="Answer1">
									<h4><?php echo __('Option1');?></h4><hr/>
									<?php echo $this->Tinymce->input('option1',array('label' => false,'class'=>'form-control','div'=>false,'placeholder'=>__('Option1')),array('language'=>$configLanguage,'directionality'=>$dirType),$editorType);?>
								</div>
								<div class="tab-pane" id="Answer2">
									<h4><?php echo __('Option2');?></h4><hr/>
									<?php echo $this->Tinymce->input('option2',array('label' => false,'class'=>'form-control','div'=>false,'placeholder'=>__('Option2')),array('language'=>$configLanguage,'directionality'=>$dirType),$editorType);?>
								</div>
								<div class="tab-pane" id="Answer3">
									<h4><?php echo __('Option3');?></h4><hr/>
									<?php echo $this->Tinymce->input('option3',array('label' => false,'class'=>'form-control','div'=>false,'placeholder'=>__('Option3')),array('language'=>$configLanguage,'directionality'=>$dirType),$editorType);?>
								</div>
								<div class="tab-pane" id="Answer4">
									<h4><?php echo __('Option4');?></h4><hr/>
									<?php echo $this->Tinymce->input('option4',array('label' => false,'class'=>'form-control','div'=>false,'placeholder'=>__('Option4')),array('language'=>$configLanguage,'directionality'=>$dirType),$editorType);?>
								</div>
								<div class="tab-pane" id="Answer5">
									<h4><?php echo __('Option5');?></h4><hr/>
									<?php echo $this->Tinymce->input('option5',array('label' => false,'class'=>'form-control','div'=>false,'placeholder'=>__('Option5')),array('language'=>$configLanguage,'directionality'=>$dirType),$editorType);?>
								</div>
								<div class="tab-pane" id="Answer6">
									<h4><?php echo __('Option6');?></h4><hr/>
									<?php echo $this->Tinymce->input('option6',array('label' => false,'class'=>'form-control','div'=>false,'placeholder'=>__('Option6')),array('language'=>$configLanguage,'directionality'=>$dirType),$editorType);?>
								</div>
                                                                <div class="tab-pane" id="CorrectAnswer">
								 <?php echo $this->Form->input('answer',array('type'=>'select','selected'=>$answerSelect,'multiple' => 'checkbox','label'=>false,'options'=>array(1=>__('Answer1'),2=>__('Answer2'),3=>__('Answer3'),4=>__('Answer4'),5=>__('Answer5'),6=>__('Answer6'))));?>
                                                                    
								</div>
							</div>
                                                         <div class="panel-body" id="tf">
                                                         <div class="col-md-12">
                                                         <div class="row">
                                                         <h5><strong><?php echo __('True/False');?></strong></h5>
                                                         <div class="panel panel-default">
                                                         <div class="panel-body">    
                                                        <div class="radio-inline">
                                                            <?php echo $this->Form->radio('true_false',$options=array("True"=>__('True'),"False"=>__('False')),array('legend'=>false,'hiddenField'=>false,'separator'=> '</div><div class="radio-inline">',
                                                                                                                     'label'=>array('class'=>'radio-inline')));?>
                                                        </div>
                                                        </div>
                                                        </div>
                                                        </div>
                                                        </div>
                                                         </div>
                                                  <div class="form-group" id="ftb">
                                                                    <?php echo $this->Form->input('fill_blank',array('class'=>'form-control','div'=>false,'label'=>__('Blank Space'),'escape'=>false,'placeholder'=>__('Blank Space')));?>
								</div>
						<div class="form-group">
						    <?php echo $this->Tinymce->input('explanation', array('type'=>'text','label'=>__('Explanation'),'class'=>'form-control','div'=>false,'placeholder'=>__('Explanation')),array('language'=>$configLanguage,'directionality'=>$dirType),$editorType);?>
						    </div>                                        
					<div class="form-group">
					<?php $gp2=array();
							    foreach($post['Group'] as $groupName):
							    $gp2[]= $groupName['id'];?>
							    <?php endforeach;unset($groupName);?>
								<label for="group_name" class="col-sm-1 control-label"><?php echo __('Groups');?></label>
								<div class="col-sm-5">
								    <?php echo $this->Form->select('QuestionGroup.group_name',$group_id,array('value'=>$gp2,'multiple'=>true,'class'=>'form-control multiselectgrp','div'=>false));?>
								</div>
								<label for="group_name" class="col-sm-1 control-label"><?php echo __('Subject');?></label>
								<div class="col-sm-5">
								    <?php echo $this->Form->input('subject_id',array('options'=>array($subject_id),'empty'=>__('Please Select'),'class'=>'form-control','div'=>false,'label'=>false));?>
								</div>
							    </div>
							    <div class="col-md-12">
							    <div class="row">
							    <div class="form-group">
                                                                    <?php echo $this->Form->input('hint', array('type'=>'text','label'=>__('Hint(optional)'),'class'=>'form-control','div'=>false,'placeholder'=>__('Hint')));?>
								</div>
							    </div>
							    </div>
								<div class="col-md-4">
									<div class="row">
										<div class="form-group">
										    <?php echo $this->Form->input('marks',array('class'=>'form-control','div'=>false,'placeholder'=>__('Marks')));?>
										</div>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
                                                                            <?php echo $this->Form->input('negative_marks',array('class'=>'form-control','div'=>false,'placeholder'=>__('without minus sign')));?>
									</div>
								</div>
								
								<div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <?php echo $this->Form->input('diff_id',array('options'=>array($diff_id),'empty'=>__('Please Select'),'class'=>'form-control','div'=>false,'label'=>__('Difficulty Level')));?>
                                                                    </div>
								</div>
                       <div class="form-group text-left">
                        <div class="col-sm-5">                            
                           <?php echo $this->Form->hidden('id');?>
			   <?php echo$this->Form->button('<span class="fa fa-refresh"></span>&nbsp;'.__('Update'),array('class'=>'btn btn-success','escpae'=>false));?>
		    <?php if(!$isError){?><button type="button" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-remove"></span>&nbsp;<?php echo __('Cancel');?></button><?php }else{
			echo$this->Html->link('<span class="fa fa-close"></span>&nbsp;'.__('Close'),array('action'=>'index'),array('class'=>'btn btn-danger','escape'=>false));}?>
		 </div>
                    </div>
                <?php echo $this->Form->end();?>
		</div>
</div></div>
