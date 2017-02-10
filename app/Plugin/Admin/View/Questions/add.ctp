<?php
if($mathEditor)
$editorType="math";
else
$editorType="full";
?>
<script type="text/javascript">
    $(document).ready(function(){
        $('#tf').hide();
        $('#ftb').hide();
	<?php if($this->request->data){?>
	$('#myquestiontab').hide();
        <?php if($this->request->data['Question']['qtype_id']==1){?>
        $('#myquestiontab').show();<?php }
        elseif($this->request->data['Question']['qtype_id']==2){?>
        $('#tf').show();<?php }
        elseif($this->request->data['Question']['qtype_id']==3){?>
        $('#ftb').show();<?php }}else{?>$('#qtype_id1').prop('checked', true);<?php }?>
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
		$('#qtype_id5').click(function() {
           $('#ftb').hide();
            $('#myquestiontab').hide();
            $('#tf').hide();
        });
        });
</script>

<div class="page-title"> <div class="title-env"> <h1 class="title"><?php echo __('Add Question');?></h1></div></div>
<div class="panel"> <?php echo $this->Session->flash();?>   
                <div class="panel-body">
		<?php echo $this->Form->create('Question', array( 'controller' => 'Question', 'action' => 'add','name'=>'post_req','id'=>'post_req'));?>
                 <div class="col-md-12">
                 <div class="row">
                 <h5><strong><?php echo __('Question Type');?></strong></h5>
                 <div class="panel panel-default">
                 <div class="panel-body">                 
                 <div class="radio-inline">                 
                    <?php echo $this->Form->radio('qtype_id',$qtype_id,array('id'=>'qtype_id','legend'=>false,'hiddenField'=>false,'separator'=> '</div><div class="radio-inline">',
                                                                             'label'=>array('class'=>'radio-inline')));?>
                 </div>
                 </div>
                 </div>
                 </div>
                 </div></div>
                
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
                    <?php echo $this->Tinymce->input('question', array('label' => false,'class'=>'form-control','div'=>false,'placeholder'=>__('Type your question here')),array('language'=>$configLanguage,'directionality'=>$dirType),$editorType);?>
                    </div>
								<div class="tab-pane" id="Answer1">
									
									<?php echo $this->Tinymce->input('option1', array('label' => false,'class'=>'form-control','div'=>false,'placeholder'=>__('Option1')),array('language'=>$configLanguage,'directionality'=>$dirType),$editorType);?>
								</div>
								<div class="tab-pane" id="Answer2">
									
									<?php echo $this->Tinymce->input('option2', array('label' => false,'class'=>'form-control','div'=>false,'placeholder'=>__('Option2')),array('language'=>$configLanguage,'directionality'=>$dirType),$editorType);?>
								</div>
								<div class="tab-pane" id="Answer3">
									
									<?php echo $this->Tinymce->input('option3', array('label' => false,'class'=>'form-control','div'=>false,'placeholder'=>__('Option3')),array('language'=>$configLanguage,'directionality'=>$dirType),$editorType);?>
								</div>
								<div class="tab-pane" id="Answer4">
									
									<?php echo $this->Tinymce->input('option4', array('label' => false,'class'=>'form-control','div'=>false,'placeholder'=>__('Option4')),array('language'=>$configLanguage,'directionality'=>$dirType),$editorType);?>
								</div>
								<div class="tab-pane" id="Answer5">
									
									<?php echo $this->Tinymce->input('option5', array('label' => false,'class'=>'form-control','div'=>false,'placeholder'=>__('Option5')),array('language'=>$configLanguage,'directionality'=>$dirType),$editorType);?>
								</div>
								<div class="tab-pane" id="Answer6">
									
									<?php echo $this->Tinymce->input('option6', array('label' => false,'class'=>'form-control','div'=>false,'placeholder'=>__('Option6')),array('language'=>$configLanguage,'directionality'=>$dirType),$editorType);?>
								</div>
                                                                <div class="tab-pane" id="CorrectAnswer">
                                                                    <?php echo $this->Form->input('answer',array('type'=>'select','multiple' => 'checkbox','label'=>false,'options'=>array(1=>__('Answer1'),2=>__('Answer2'),3=>__('Answer3'),4=>__('Answer4'),5=>__('Answer5'),6=>__('Answer6'))));?>
								</div>
							</div>
                                                         <div class="panel-body" id="tf">
                                                         <div class="col-md-12">
                                                         <div class="row">
                                                         <h5><strong><?php echo __('True/False');?></strong></h5>
                                                         <div class="panel panel-default">
                                                         <div class="panel-body">    
                                                        <div class="radio-inline">
                                                            <?php echo $this->Form->radio('true_false',$options=array("True"=>__('True'),"False"=>__('False')),array('legend'=>false,'hiddenField'=>false,'separator'=> '</div><div class="radio-inline">',                                                                                                                     'label'=>array('class'=>'radio-inline')));?>
                                                        </div>
                                                        </div>
                                                        </div>
                                                        </div>
                                                        </div>
                                                        </div>
							 <div class="panel-body">
                                                  <div class="form-group" id="ftb">
                                                                    <?php echo $this->Form->input('fill_blank',array('class'=>'form-control','div'=>false,'label'=>__('Blank Space'),'escape'=>false,'placeholder'=>__('Blank Space')));?>
								</div>                                            
						<div class="form-group">
					    <?php echo $this->Tinymce->input('explanation', array('label'=>__('Explanation (Optional)'),'class'=>'form-control','div'=>false,'placeholder'=>__('Provide explanation in support of correct answer')),array('language'=>$configLanguage,'directionality'=>$dirType),$editorType);?>
						</div>
                                        
							    <div class="form-group">
								<label for="group_name" class="col-sm-1 control-label"><?php echo __('Groups');?></label>
								<div class="col-sm-2">
								    <?php echo $this->Form->select('QuestionGroup.group_name',$group_id,array('multiple'=>true,'class'=>'form-control multiselectgrp','div'=>false));?>
								</div>
								
								<!----- Quiz / Question Type Start -------------->
								<label for="category" class="col-sm-1 control-label"><?php echo __('Category');?></label>
						    	<?php $category_type = ['Homework' => 'Homework', 'Exam' => 'Exam', 'Both' => 'Both']; ?>
							    <div class="col-sm-2">
										<?php echo $this->Form->select('category', $category_type,array('multiple'=>false,'class'=>'form-control','div'=>false));
											//echo $this->Form->input('category',array('class'=>'form-control','div'=>false,'placeholder'=>__('category')));
										?>
										
									</div>
								
								
								<!-------- Quiz / Question Type End ------------->
								<label for="group_name" class="col-sm-1 control-label"><?php echo __('Subject');?></label>
								
								<div class="col-sm-2">
								    <?php echo $this->Form->input('subject_id',array('options'=>array($subject_id),'empty'=>__('Please Select'),'default'=>$selSubject,'class'=>'form-control','div'=>false,'label'=>false));?>
								</div>
							    </div>
							     <div class="col-sm-12">
							     <div class="row">
							    <div class="form-group">							   
                                                                    <?php echo $this->Form->input('hint', array('type'=>'text','class'=>'form-control','label'=>__('Hint(optional)'),'div'=>false,'placeholder'=>__('Hint to help answer correctly')));?>
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
								<div class="col-sm-7">
								    <?php echo$this->Form->button('<span class="fa fa-plus-circle"></span>&nbsp;'.__('Save'),array('class'=>'btn btn-success','escpae'=>false));?>
								     <?php echo$this->Html->link('<span class="fa fa-close"></span>&nbsp;'.__('Close'),array('action'=>'index'),array('class'=>'btn btn-danger','escape'=>false));?>
            							</div>
							    </div>
							    <?php echo $this->Form->end();?>
</div>
</div>


