<script type="text/javascript">
    $(document).ready(function(){        
        $('#start_date').datetimepicker({locale:'<?php echo$configLanguage;?>',format:'<?php echo $dpFormat;?> HH:mm'});
        $('#end_date').datetimepicker({locale:'<?php echo$configLanguage;?>',format:'<?php echo $dpFormat;?> HH:mm',useCurrent: false //Important! See issue #1075
        });
        $("#start_date").on("dp.change", function (e) {
            $('#end_date').data("DateTimePicker").minDate(e.date);
        });
        $("#end_date").on("dp.change", function (e) {
            $('#start_date').data("DateTimePicker").maxDate(e.date);
        });	
});
</script>
<script type="text/javascript">
	$(document).ready(function(){
	    $("#modalForm").validationEngine();
	    $("#addsubject").click(function () {
            var valid = $("#modalForm").validationEngine('validate');
            var vars = $("#modalForm").serialize();
            if (valid == true)
	    {
		var subid='sub'+$('#subjectId').val();
                if($("#" + subid).length == 0)
		showSubject();
		else
		alert("Subject already exist");
            }
	    else
	    {
                $("#modalForm").validationEngine();
            }
	    });
	 $('#showExam').hide();
	 $('#paidExam').hide();
	    $('#ExamTypePrepration').click(function(){
	    $('#showExam').show();
	    });
	$('#ExamTypeExam').click(function(){
	    $('#showExam').hide();
	    });
	$('#ExamPaidExam').click(function(){
	    $('#paidExam').hide();
	    });
	$('#ExamPaidExam1').click(function(){
	    $('#paidExam').show();
	    });
	$('#subjectModal').on('show.bs.modal', function (event) {
	    $('#subjectId').val('');
	    $('#quesNo').val('');
	    $('#type').val('');
	    $('#level').val('');
	    $('#maxQuestion').val('');
	    $('#modalMsg').html('');
	    });
	});
	function showSubject(){
	    sub_arr=$('#subjectId option:selected').text().split(' (Q)');
	    subject_name=sub_arr[0];
	    $('#showdetails').append('<div class="col-sm-12"><div id=sub'+$('#subjectId').val()+'><div><label for="group_name" class="col-sm-2 control-label"><small>'+subject_name+'</small></lable></div>'+
				     '<div><label for="group_name" class="col-sm-2 control-label"><small>'+$('#quesNo').val()+'</small></lable></div>'+
				     '<div><label for="group_name" class="col-sm-2 control-label"><small>'+$('#maxQuestion').val()+'</small></lable></div>'+
				     '<div><label for="group_name" class="col-sm-2 control-label"><small>'+$('#type option:selected').text()+'</small></lable></div>'+
				     '<div><label for="group_name" class="col-sm-2 control-label"><small>'+$('#level option:selected').text()+'</small></lable></div>'+
				     '<div><input type="hidden" name="data[ExamPrep]['+$('#subjectId').val()+'][subject_id]" value="'+$('#subjectId').val()+'"</div>'+
				     '<div><input type="hidden" name="data[ExamPrep]['+$('#subjectId').val()+'][ques_no]" value="'+$('#quesNo').val()+'"</div>'+
				     '<div><input type="hidden" name="data[ExamPrep]['+$('#subjectId').val()+'][max_question]" value="'+$('#maxQuestion').val()+'"</div>'+
				     '<div><input type="hidden" name="data[ExamPrep]['+$('#subjectId').val()+'][type]" value="'+$('#type').val()+'"</div>'+
				     '<div><input type="hidden" name="data[ExamPrep]['+$('#subjectId').val()+'][level]" value="'+$('#level').val()+'"</div>'+
				     '<div class="col-sm-2"><button type="button" class="btn btn-danger" onclick="delItem('+$('#subjectId').val()+');">Remove</button></div>'+
				     '</div>');
	    $('#subjectId').val('');
	    $('#quesNo').val('');
	    $('#type').val('');
	    $('#level').val('');
	    $('#maxQuestion').val('');
	    $('#modalMsg').html('<span class="text-success"><strong><?php echo __('Subject Added successfully');?>!</strong></span>');
	}
	function delItem(id)
	{
	    $('#sub'+id+'').remove();
	}
</script>

<div class="page-title"> <div class="title-env"> <h1 class="title"><?php echo __('Add Quiz');?></h1></div></div><div class="panel"><div class="panel">
    <div class="panel-heading">
		</div>	    
                <div class="panel-body"><?php echo $this->Session->flash();?>
                <?php echo $this->Form->create('Exam', array('class'=>'form-horizontal'));?>
                    <div class="form-group">
                        <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Name of Exam');?></small></label>
                        <div class="col-sm-4">
                           <?php echo $this->Form->input('name',array('label' => false,'class'=>'form-control','placeholder'=>__('Name of Exam'),'div'=>false));?>
                        </div>                    
                        <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Passing Percentage');?></small></label>
                        <div class="col-sm-4">
                           <?php echo $this->Form->input('passing_percent',array('label' => false,'class'=>'form-control','placeholder'=>__('Passing Percentage'),'div'=>false));?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Instruction');?></small></label>
                        <div class="col-sm-10">
                           <?php echo $this->Tinymce->input('instruction', array('label' => false,'class'=>'form-control','div'=>false,'placeholder'=>__('Instruction')),array('language'=>$configLanguage,'directionality'=>$dirType),'full');?>
                        </div>                        
                    </div>
                    <div class="form-group">
                        <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Exam Duration (Min.)');?></small></label>
                        <div class="col-sm-4">
                           <?php echo $this->Form->input('duration',array('label' => false,'class'=>'form-control','placeholder'=>__('0 for unlimited duration'),'div'=>false));?>			   
                        </div>                    
                        <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Attempt Count');?></small></label>
                        <div class="col-sm-4">
                           <?php echo $this->Form->input('attempt_count',array('label' => false,'class'=>'form-control','placeholder'=>__('0 for unlimited attempt'),'div'=>false));?>
			   <span class="text-danger"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Start Date');?></small></label>
                        <div class="col-sm-4">
			    <div class="input-group date" id="start_date">
			    <?php echo $this->Form->input('start_date',array('type'=>'text','label' => false,'class'=>'form-control','div'=>false));?>
                            <span class="input-group-addon"><span class="fa fa-calendar"></span></span>
			    </div>
			</div>
                        <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('End Date');?></small></label>
                        <div class="col-sm-4">
			    <div class="input-group date" id="end_date">
			    <?php echo $this->Form->input('end_date',array('type'=>'text','label' => false,'class'=>'form-control','div'=>false));?>
                           <span class="input-group-addon"><span class="fa fa-calendar"></span></span>
			    </div>
			</div>
                    </div>
		    <div class="form-group">
			<label for="group_name" class="col-sm-2 control-label"><?php echo __('Subject');?>:</label>
			<div class="col-sm-4">
			<?php $lesUrl = $this->Html->url(array('controller'=>'Ajaxcontents','action' => 'lesson'));
			echo $this->Form->select('subject_id',$esubjectId,array('id'=>'subjectId','rel'=>$lesUrl,'empty'=>__('Please Select Subject'),'label' => false,'class'=>'form-control validate[required]','div'=>false));?>
			</div>
			<label for="group_name" class="col-sm-2 control-label"><?php echo __('Lesson');?>:</label>
			<div class="col-sm-4">
			<?php echo $this->Form->select('lesson_id',$lessonId,array('id'=>'lessonId','empty'=>__('Please Select Lesson'),'label' => false,'class'=>'form-control validate[required]','div'=>false));?>
			</div>
		    </div>
                    <div class="form-group">
                        <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Show Answer Sheet');?></small></label>
                        <div class="col-sm-4">
                           <?php echo $this->Form->input('declare_result',array('type'=>'radio','options'=>array("Yes"=>__('Yes'),"No"=>__('No')),'default'=>__('Yes'),'legend'=>false,'before' => '<label class="radio-inline">','separator' => '</label><label class="radio-inline">','after'=>'</label>','label' => false,'div'=>false));?>
                        </div>                    
                        <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Select Group');?></small></label>
                        <div class="col-sm-4">
                           <?php echo $this->Form->select('ExamGroup.group_name',$group_id,array('multiple'=>true,'label' => false,'class'=>'form-control multiselectgrp','placeholder'=>__('Student Group'),'div'=>false));?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Negative Marking');?></small></label>
                        <div class="col-sm-4">
                           <?php echo $this->Form->input('negative_marking',array('type'=>'radio','options'=>array("Yes"=>__('Yes'),"No"=>__('No')),'default'=>'Yes','legend'=>false,'before' => '<label class="radio-inline">','separator' => '</label><label class="radio-inline">','after'=>'</label>','label' => false,'div'=>false));?>
                        </div>	    
                        <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Random Question');?></small></label>
                        <div class="col-sm-4">
                           <?php echo $this->Form->input('ques_random',array('type'=>'radio','options'=>array("1"=>__('Yes'),"0"=>__('No')),'default'=>'0','legend'=>false,'before' => '<label class="radio-inline">','separator' => '</label><label class="radio-inline">','after'=>'</label>','label' => false,'div'=>false));?>			   
                        </div>                                                                               
                    </div>
		     <?php if($frontExamPaid>0){?>
		     <div class="form-group">
                        <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Paid Exam');?></small></label>
                        <div class="col-sm-4">
                           <?php echo $this->Form->input('paid_exam',array('type'=>'radio','options'=>array("1"=>__('Yes'),""=>__('No')),'default'=>'','legend'=>false,'before' => '<label class="radio-inline">','separator' => '</label><label class="radio-inline">','after'=>'</label>','label' => false,'div'=>false));?>
                        </div>
			<div id="paidExam">
                        <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Amount');?></small></label>
                        <div class="col-sm-4">
                           <?php echo $this->Form->input('amount',array('label' => false,'class'=>'form-control','placeholder'=>__('Amount'),'div'=>false));?>
                        </div>
			</div>
                    </div>
		    <?php }?>
		    <div class="form-group">
                        <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Browser Tolrance');?></small></label>
                        <div class="col-sm-4">
                           <?php echo $this->Form->input('browser_tolrance',array('type'=>'radio','options'=>array("1"=>__('Yes'),"0"=>__('No')),'default'=>'1','legend'=>false,'before' => '<label class="radio-inline">','separator' => '</label><label class="radio-inline">','after'=>'</label>','label' => false,'div'=>false));?>
			</div>
			<?php if($examExpiry){?>
			<label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Expiry Days');?></small></label>
			<div class="col-sm-4">
			  <?php echo $this->Form->input('expiry',array('label' => false,'class'=>'form-control','placeholder'=>__('0 for Unlimited'),'div'=>false));?>
                        </div>
			<?php }?>
		    </div>	
		    <div class="form-group">
                        <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Result After Finish');?></small></label>
                        <div class="col-sm-4">
                           <?php echo $this->Form->input('finish_result',array('type'=>'radio','options'=>array("1"=>__('Yes'),"0"=>__('No')),'default'=>'0','legend'=>false,'before' => '<label class="radio-inline">','separator' => '</label><label class="radio-inline">','after'=>'</label>','label' => false,'div'=>false));?>
			</div>
			<label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Mode');?></small></label>
                        <div class="col-sm-4">
			    <?php echo $this->Form->input('type',array('type'=>'radio','options'=>array("Exam"=>__('Exam'),"Prepration"=>__('Prepration')),'default'=>'Exam','legend'=>false,'before' => '<label class="radio-inline">','separator' => '</label><label class="radio-inline">','after'=>'</label>','label' => false,'div'=>false));?>
                        </div>                                                                               
                    </div>
		    <div class="form-group">
                        <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Instant Result');?></small></label>
                        <div class="col-sm-4">
                           <?php echo $this->Form->input('instant_result',array('type'=>'radio','options'=>array("1"=>__('Yes'),"0"=>__('No')),'default'=>'0','legend'=>false,'before' => '<label class="radio-inline">','separator' => '</label><label class="radio-inline">','after'=>'</label>','label' => false,'div'=>false));?>
			</div>
			<label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Option Shuffle');?></small></label>
                        <div class="col-sm-4">
                           <?php echo $this->Form->input('option_shuffle',array('type'=>'radio','options'=>array("1"=>__('Yes'),"0"=>__('No')),'default'=>'1','legend'=>false,'before' => '<label class="radio-inline">','separator' => '</label><label class="radio-inline">','after'=>'</label>','label' => false,'div'=>false));?>
			</div>
		    </div>		   
		    
		    <div id="showExam">
		    <div class="form-group">
                        <label for="group_name" class="col-sm-2 control-label"><small>&nbsp;</small></label>
                        <div class="col-sm-4">
                           <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#subjectModal"><?php echo __('Add Subjects To Exams');?></button>
			</div>	    
                        <div class="col-sm-2">                           
                        </div>                                                                               
                    </div>
		    <div class="form-group">
			<div><label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Subject Name');?></small></label></div>
			<div><label for="group_name" class="col-sm-2 control-label"><small><?php echo __('No. of Questions');?></small></label></div>
			<div><label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Ques Attempt Count');?></small></label></div>
			<div><label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Question Type');?></small></label></div>
			<div><label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Difficulty Level');?></small></label></div>
			<div><label for="group_name" class="col-sm-2 control-label"><small>&nbsp;</small></label></div>
		    </div>
		    <div class="form-group" id="showdetails">
		    </div>
		    </div>
		    <div class="form-group text-left">
                        <div class="col-sm-offset-2 col-sm-7">
                            <button type="submit" class="btn btn-success"><span class="fa fa-plus-circle"></span>&nbsp;<?php echo __('Save');?></button>
                            <?php echo$this->Html->link('<span class="fa fa-close"></span>&nbsp;'.__('Close'),array('action'=>'index'),array('class'=>'btn btn-danger','escape'=>false));?>
                        </div>
                    </div>
                <?php echo $this->Form->end();?>
                </div>
            </div>
<div class="modal fade" id="subjectModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>&nbsp;</button>
        <h4 class="modal-title" id="exampleModalLabel"><?php echo __('Add Subjects To Exams');?></h4>
      </div>
      <div class="modal-body">
        <form name="modalForm" id="modalForm" class="form-horizontal">
	<div id="modalMsg" align="center"></div>
          <div class="form-group">
            <label for="group_name" class="col-sm-4 control-label"><?php echo __('Subject');?>:</label>
	    <div class="col-sm-8">
            <?php $lesUrl = $this->Html->url(array('controller'=>'Ajaxcontents','action' => 'lesson'));
	    echo $this->Form->select('subject_id',$subjectId,array('id'=>'subjectId','rel'=>$lesUrl,'empty'=>__('Please Select Subject'),'label' => false,'class'=>'form-control validate[required]','div'=>false));?>
	    </div>
          </div>
          <div class="form-group">
            <label for="group_name" class="col-sm-4 control-label"><?php echo __('No. of Questions');?>:</label>
            <div class="col-sm-8">
	    <?php echo $this->Form->input('ques_no',array('type'=>'number','id'=>'quesNo','label' => false,'class'=>'form-control validate[required]','placeholder'=>__('No. of Questions'),'div'=>false));?>
	    </div>
          </div>
	  <div class="form-group">
            <label for="group_name" class="col-sm-4 control-label"><?php echo __('Questions Attempt Count');?>:</label>
            <div class="col-sm-8">
	    <?php echo $this->Form->input('max_qusetion',array('type'=>'number','id'=>'maxQuestion','label' => false,'class'=>'form-control','placeholder'=>__('Leave blank for not showing (0 for unlimited)'),'div'=>false));?>
	    </div>
          </div>
	  <div class="form-group">
            <label for="group_name" class="col-sm-4 control-label"><?php echo __('Question Type');?>:</label>
	    <div class="col-sm-8">
            <?php echo $this->Form->select('type',$quesType,array('id'=>'type','multiple'=>true,'default'=>array(1,2,3,4),'label' => false,'class'=>'form-control validate[required]','div'=>false));?>
	    <span><?php echo __('ctrl+click to add multiples');?></span>
	    </div>
          </div>
	  <div class="form-group">
            <label for="group_name" class="col-sm-4 control-label"><?php echo __('Difficulty Level');?>:</label>
	    <div class="col-sm-8">
            <?php echo $this->Form->select('level',$diffLevel,array('id'=>'level','multiple'=>true,'default'=>array(1,2,3),'label' => false,'class'=>'form-control validate[required]','div'=>false));?>
	    <span><?php echo __('ctrl+click to add multiples');?></span>
	    </div>
          </div>
        <?php echo $this->Form->end();?>
      </div>
      <div class="modal-footer">
        <button type="button" id="addsubject" class="btn btn-primary"><?php echo __('Add');?></button>
	<button type="button" class="btn btn-default" data-dismiss="modal"><?php echo __('Close');?></button>
      </div>
    </div>
  </div>
</div>
</div>
<script type="text/javascript">
$(document).ready(function(){
$('#subjectId').change(function() {
            var selectedValue = $(this).val();
            var targeturl = $(this).attr('rel') + '?id=' + selectedValue;
            $.ajax({
                    type: 'get',
                    url: targeturl,
                    beforeSend: function(xhr) {
                            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                    },
                    success: function(response) {
                            if (response) {
                                    $('#lessonId').html(response);
                            }
                    },
                    error: function(e) {
                            
                    }
            });
    });
});
</script>