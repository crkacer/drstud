<?php echo $this->Session->flash();?>
<div class="row">
<div class="col-md-2">
		<div class="panel panel-primary">
		<div class="panel-heading">
			<h4 ><?php echo __('My Profile');?></h4>
		</div>
		<div class="list-group">
                        <?php echo$this->Html->link(__("Profile"),array('controller'=>'Profiles','action'=>'index'),array('class'=>'list-group-item'));?>
			<?php echo$this->Html->link(__("Edit Profile"),array('controller'=>'Profiles','action'=>'editProfile'),array('class'=>'list-group-item'));?>
			<?php echo$this->Html->link(__("Change Photo"),array('controller'=>'Profiles','action'=>'changePhoto'),array('class'=>'list-group-item active'));?>
			<?php echo$this->Html->link(__('Change Password'),array('controller'=>'Profiles','action'=>'changePass'),array('class'=>'list-group-item'));?>			
		</div>
		</div>
	</div>
    <div class="col-md-10">    
        <div class="page-title-breadcrumb">
    <div class="page-header pull-left">
	<div class="page-title"><?php echo __('Change Photo');?></div>
    </div>
</div>
		<div class="panel">
                <div class="panel-body">
                <?php echo $this->Form->create('Profile', array( 'controller' => 'Profiles', 'action' => 'changePhoto','name'=>'post_req','id'=>'post_req','class'=>'form-horizontal','type' => 'file'));?>
                     <div class="form-group">
                        <label for="group_name" class="col-sm-3 control-label"><?php echo __('Upload Photo');?></label>
                        <div class="col-sm-9">
                           <?php echo $this->Form->input('photo',array('required'=>true,'type' => 'file','label' => false,'div'=>false));?>
                        </div>
                    </div>                   
                    <div class="form-group text-left">
                        <div class="col-sm-offset-3 col-sm-7">
                            <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-refresh"></span>&nbsp;<?php echo __('Submit');?></button>                            
                        </div>
                    </div>
                <?php echo $this->Form->end();?>
                </div>
            </div>
        </div>
    </div>