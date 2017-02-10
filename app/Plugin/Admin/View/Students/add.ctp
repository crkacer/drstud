<div class="panel panel-custom">
    <div class="panel-heading"><?php echo __('Add Students');?></div>
    <div class="panel-body"><?php echo $this->Session->flash();?>
	<?php echo $this->Form->create('Student', array('class'=>'form-horizontal','type' => 'file'));?>
	<div class="form-group">
	    <label for="email" class="col-sm-2 control-label"><small><?php echo __('Email');?><span class="text-danger"> *</span></small></label>
	    <div class="col-sm-4">
		<?php echo $this->Form->input('email',array('label' => false,'class'=>'form-control','placeholder'=>__('Email'),'div'=>false));?>
	    </div>
	    <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Group');?><span class="text-danger"> *</span></small></label>
	    <div class="col-sm-4">
		<?php echo $this->Form->select('StudentGroup.group_name',$group_id,array('multiple'=>true,'label' => false,'class'=>'form-control multiselectgrp','div'=>false));?>
	    </div>
	</div>
	<div class="form-group">
	    <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Name');?><span class="text-danger"> *</span></small></label>
	    <div class="col-sm-4">
		<?php echo $this->Form->input('name',array('label' => false,'class'=>'form-control','placeholder'=>__('Name'),'div'=>false));?>
	    </div>
	    <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Password');?><span class="text-danger"> *</span></small></label>
	    <div class="col-sm-4">
		<?php echo $this->Form->input('password',array('type'=>'password','label' => false,'class'=>'form-control','placeholder'=>__('Password'),'div'=>false,'maxlength'=>15,'minlength'=>4));?>
	    </div>
	</div>
	<div class="form-group">
	    <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Address');?><span class="text-danger"> *</span></small></label>
	    <div class="col-sm-4">
		<?php echo $this->Form->input('address',array('label' => false,'class'=>'form-control','placeholder'=>__('Address'),'div'=>false));?>
	    </div>
	    <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Phone');?><span class="text-danger"> *</span></small></label>
	    <div class="col-sm-4">
		<?php echo $this->Form->input('phone',array('type'=>'number','label' => false,'class'=>'form-control','placeholder'=>__('Phone'),'div'=>false));?>
	    </div>
	</div>
	<div class="form-group">
	    <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Guardian Phone');?></small></label>
	    <div class="col-sm-4">
		<?php echo $this->Form->input('guardian_phone',array('label' => false,'class'=>'form-control','placeholder'=>__('Guardian Phone'),'div'=>false));?>
	    </div>
	    <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Enrolment Number');?></small></label>
	    <div class="col-sm-4">
		<?php echo $this->Form->input('enroll',array('label' => false,'class'=>'form-control','placeholder'=>__('Enrolment Number'),'div'=>false));?>
	    </div>
	</div>
	<div class="form-group">
	    <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Expiry Days');?></small></label>
	    <div class="col-sm-4">
		<?php echo $this->Form->input('expiry_days',array('label' => false,'class'=>'form-control','placeholder'=>__('0 for Unlimited'),'div'=>false,'default'=>0));?>
	    </div>
	    <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Status');?></small></label>
	    <div class="col-sm-4">
		<?php echo $this->Form->select('status',array("Active"=>__('Active'),"Pending"=>__('Pending'),"Suspend"=>__('Suspend')),array('empty'=>null,'label' => false,'class'=>'form-control validate[required]','placeholder'=>'Status','div'=>false));?>
	    </div>
	</div>
	<div class="form-group">
	    <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Upload Photo');?></small></label>
	    <div class="col-sm-4">
		<?php echo $this->Form->input('photo',array('type' => 'file','label' => false,'div'=>false));?>
	    </div>	    
	</div>        
	<div class="form-group text-left">
	    <div class="col-sm-offset-2 col-sm-8">
		<?php echo$this->Form->button('<span class="fa fa-plus-circle"></span>&nbsp;'.__('Save'),array('class'=>'btn btn-success','escpae'=>false));?>
                <?php echo$this->Html->link('<span class="fa fa-close"></span>&nbsp;'.__('Close'),array('action'=>'index'),array('class'=>'btn btn-danger','escape'=>false));?>
           </div>
	</div>
	<?php echo $this->Form->end();?>
    </div>
</div>