<?php echo $this->Session->flash();?>
<div class="row">
<div class="col-md-2">
		<div class="panel panel-primary">
		<div class="panel-heading">
			<h4 ><?php echo __('My Profile');?></h4>
		</div>
		<div class="list-group">
			<?php echo$this->Html->link(__("Profile"),array('controller'=>'Profiles','action'=>'index'),array('class'=>'list-group-item'));?>
                        <?php echo$this->Html->link(__("Edit Profile"),array('controller'=>'Profiles','action'=>'editProfile'),array('class'=>'list-group-item active'));?>
			<?php echo$this->Html->link(__("Change Photo"),array('controller'=>'Profiles','action'=>'changePhoto'),array('class'=>'list-group-item'));?>
			<?php echo$this->Html->link(__('Change Password'),array('controller'=>'Profiles','action'=>'changePass'),array('class'=>'list-group-item'));?>			
		</div>
		</div>
	</div>
    <div class="col-md-10">    
        <div class="page-title-breadcrumb">
    <div class="page-header pull-left">
	<div class="page-title"><?php echo __('Edit Profile');?></div>
    </div>
</div>
		<div class="panel">
                <div class="panel-body">
                <?php echo $this->Form->create('Profile', array( 'controller' => 'Profiles', 'action' => 'editProfile','name'=>'post_req','id'=>'post_req','class'=>'form-horizontal'));?>
                     <div class="form-group">
                        <label for="group_name" class="col-sm-3 control-label"><?php echo __('Enrolment No');?></label>
                        <div class="col-sm-9">
                           <?php echo $this->Form->input('enroll',array('required'=>true,'label' => false,'class'=>'form-control','placeholder'=>__('Enrolment No'),'div'=>false));?>
                        </div>
                    </div>
                   <div class="form-group">
                        <label for="group_name" class="col-sm-3 control-label"><?php echo __('Phone Number');?></label>
                        <div class="col-sm-9">
                           <?php echo $this->Form->input('phone',array('required'=>true,'label' => false,'class'=>'form-control','placeholder'=>__('Phone Number'),'div'=>false));?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="group_name" class="col-sm-3 control-label"><?php echo __('Guardian Phone');?></label>
                        <div class="col-sm-9">
                           <?php echo $this->Form->input('guardian_phone',array('label' => false,'class'=>'form-control','placeholder'=>__('Guardian Phone'),'div'=>false));?>
                        </div>
                    </div>
		    <div class="form-group">
                        <label for="group_name" class="col-sm-3 control-label"><?php echo __('Auto Renewal');?></label>
                        <div class="col-sm-1">
                           <?php echo $this->Form->input('auto_renewal',array('label' => false,'class'=>'form-control','div'=>false));?>
                        </div>
                    </div>
                    <div class="form-group text-left">
                        <div class="col-sm-offset-3 col-sm-7">
                            <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-refresh"></span>&nbsp;<?php echo __('Update');?></button>                            
                        </div>
                    </div>
                <?php echo $this->Form->end();?>
                </div>
            </div>
        </div>
    </div>