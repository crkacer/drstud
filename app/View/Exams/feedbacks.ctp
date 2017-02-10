<?php echo$this->Html->scriptBlock("function closeExamWindow(){var ww = window.open(window.location, '_self'); ww.close();}",array('inline'=>true));
if($isClose=="Yes"){echo $this->Html->scriptBlock("setTimeout(function(){closeExamWindow(); }, 1500);",array('inline'=>true));}?>
<div class="col-md-9 col-sm-offset-2">
<?php echo $this->Session->flash();?>
    <div class="panel panel-default">
	<div class="panel-heading"><center><?php if($isClose=="Yes"){echo $this->Session->flash();}else{echo __("Thank you for using the quiz");}?></center></div>
	<div class="panel-body">
	    <?php echo $this->Form->create('Exam', array( 'controller' => 'Exams', 'action' => "feedbacks/$id",'name'=>'post_req','id'=>'post_req','class'=>'form-horizontal'));?>
	    <div class="form-group">
		<label for="subject_name" class="col-sm-3 control-label"><small><?php echo __('1. The test instructions were');?></small></label>
		<div class="col-sm-4">
		   <?php echo $this->Form->select('test_instruction',array('Largely Clear'=>__('Largely Clear'),'Medium Clear'=>__('Medium Clear'),'Not Clear'=>__('Not Clear')),array('empty'=>false,'label' => false,'class'=>'form-control','div'=>false));?>
		</div>
	    </div>
	    <div class="form-group">
		<label for="subject_name" class="col-sm-3 control-label"><small><?php echo __('2. Language of question was');?></small></label>
		<div class="col-sm-4">
		   <?php echo $this->Form->select('question_language',array('Largely Clear'=>__('Largely Clear'),'Medium Clear'=>__('Medium Clear'),'Not Clear'=>__('Not Clear')),array('empty'=>false,'label' => false,'class'=>'form-control','div'=>false));?>
		</div>
	    </div>
	    <div class="form-group">
		<label for="subject_name" class="col-sm-3 control-label"><small><?php echo __('3. Overall test experience was');?></small></label>
		<div class="col-sm-4">
		   <?php echo $this->Form->select('test_experience',array('Good'=>__('Good'),'Better'=>__('Better'),'Best'=>__('Best')),array('empty'=>false,'label' => false,'class'=>'form-control','div'=>false));?>
		</div>
	    </div>
	    <div class="form-group">
		<label for="subject_name" class="col-sm-3 control-label"><small><?php echo __('Any other feedback suggestion');?></small></label>
		<div class="col-sm-4">
		   <?php echo $this->Form->input('comments',array('type'=>'textarea','required'=>'required','label' => false,'class'=>'form-control','div'=>false));?>
		</div>
	    </div>
	    <div class="form-group text-left">
		<div class="col-sm-offset-3 col-sm-7">
		    <button type="submit" class="btn btn-success"><span class="fa fa-plus"></span><?php echo __('Submit');?></button>
		    <?php echo$this->Html->link('<span class="fa fa-close"></span>'.__('Close'),'#',array('onClick'=>'closeExamWindow();','class'=>'btn btn-danger','escape'=>false));?>
		</div>
	    </div>
	    <?php echo $this->Form->end();?>
	</div>
    </div>
</div>