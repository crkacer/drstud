<?php
echo $this->Html->css('select2/select2');
echo $this->Html->css('select2/select2-bootstrap');
echo $this->fetch('css');
echo $this->Html->script('select2.min');
echo $this->fetch('script');
$studentUrl=$this->Html->url(array('controller'=>'Sendsms','action'=>'studentsearch'));
$teacherUrl=$this->Html->url(array('controller'=>'Sendsms','action'=>'teachersearch'));
echo $this->Session->flash();?>
<script type="text/javascript">
    $(document).ready(function(){
        $('#studentId').select2({
        minimumInputLength: 1,
	tags: true,
        ajax: {
          url: '<?php echo$studentUrl;?>',
          dataType: 'json',
          data: function (term, page) {
            return {
              q: term
            };
          },          
          results: function (data, page) {
            return { results: data };
          }
        }
      });
        $('#teacherId').select2({
        minimumInputLength: 1,
	tags: true,
        ajax: {
          url: '<?php echo$teacherUrl;?>',
          dataType: 'json',
          data: function (term, page) {
            return {
              q: term
            };
          },          
          results: function (data, page) {
            return { results: data };
          }
        }
      });	
	$('#students').hide();
	$('#teachers').hide();
	$('#any').hide();
    $('#SendsmsType').change(function(){
    if($('#SendsmsType').val()=="Student")
    {
	$('#students').show();
	$('#teachers').hide();
	$('#any').hide();
    }
    else if($('#SendsmsType').val()=="Teacher")
    {
	$('#teachers').show();
	$('#students').hide();
	$('#any').hide();
    }
    else if($('#SendsmsType').val()=="Any")
    {
	$('#any').show();
	$('#students').hide();
	$('#teachers').hide();
    }
    else
    {
	$('#any').hide();
	$('#students').hide();
	$('#teachers').hide();
    }
    });
    $('#SendsmsSmsTemplate').change(function() {
    $('#SendsmsMessage').val($('#SendsmsSmsTemplate').val());
    sms_character_count();
    });
    $('#SendsmsMessage').keyup(function () {
	sms_character_count();
    });
    $('#SendsmsMessage').focus(function () {
	sms_character_count();
    });    
    });
</script>
<div class="panel panel-custom">
    <div class="panel-heading"><?php echo __('Send Sms');?></div>
    <div class="panel-body">
    <?php echo $this->Session->flash();?>
		    <?php echo $this->Form->create('Sendsms', array('class'=>'form-horizontal'));?>                    
		    <div class="form-group">
			<label for="site_name" class="col-sm-2 control-label"><?php echo __('Type');?></label>
			<div class="col-sm-10">
			   <?php echo $this->Form->select('type',array('Student'=>__('Students'),'Teacher'=>__('Teachers'),'Any'=>__('Any Sms')),array('required'=>'required','empty'=>__('Please Select'),'label' => false,'class'=>'form-control','div'=>false));?>
			</div>			
		    </div>
		    <div class="form-group" id="students">
			<label for="site_name" class="col-sm-2 control-label"><?php echo __('Students');?></label>
			<div class="col-sm-10">
			   <?php echo $this->Form->input('student_id',array('type'=>'text','id'=>'studentId','label' => false,'class'=>'form-control','placeholder'=>__('Default all student if you add manually then search students name'),'div'=>false));?>
			</div>			
		    </div>
		    <div class="form-group" id="teachers">
			<label for="site_name" class="col-sm-2 control-label"><?php echo __('Teachers');?></label>
			<div class="col-sm-10">
			   <?php echo $this->Form->input('teacher_id',array('type'=>'text','id'=>'teacherId','label' => false,'class'=>'form-control','placeholder'=>__('Default all teachers if you add manually then search teacher name'),'div'=>false));?>
			</div>			
		    </div>
		    <div class="form-group" id="any">
			<label for="site_name" class="col-sm-2 control-label"><?php echo __('Any Number');?></label>
			<div class="col-sm-10">
			   <?php echo $this->Form->input('any_sms',array('type'=>'text','placeholder'=>__('Type any number comma seprated'),'label' => false,'class'=>'form-control','div'=>false));?>
			</div>			
		    </div>
		    <div class="form-group">
			<label for="site_name" class="col-sm-2 control-label"><?php echo __('Select Sms Template');?></label>
			<div class="col-sm-10">
			   <?php echo $this->Form->select('sms_template',$smsTemplate,array('empty'=>__('Please Select'),'label' => false,'class'=>'form-control','div'=>false));?>
			</div>			
		    </div>
		    <div class="form-group">
			<label for="group_name" class="col-sm-2 control-label"><?php echo __('Sms Template');?>:</label>
			<div class="col-sm-8">
			    <?php echo $this->Form->textarea('message',array('label' => false,'class'=>'form-control','placeholder'=>__('If you do not want to select sms template then simply type sms message'),'div'=>false,'rows'=>5));?>
			</div>
			<div class="span2"><div id="characterLeft"></div></div>
		    </div>
		    <div class="form-group text-left">
			<div class="col-sm-offset-2 col-sm-10">
			    <button type="submit" class="btn btn-success"><span class="fa fa-mobile"></span>&nbsp;<?php echo __('Send');?></button>
			    <?php echo$this->Html->link('<span class="fa fa-refresh"></span>&nbsp;'.__('Reset'),array('action'=>'index'),array('class'=>'btn btn-danger','escape'=>false));?>
			</div>
		    </div>
		    <?php echo$this->Form->end(null);?>
                </div>
            </div>
        