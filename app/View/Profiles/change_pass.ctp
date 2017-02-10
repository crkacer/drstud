<script type="text/javascript">
$(document).ready(function(){
  $('#password').change(function(){validatePassword();});
  $('#con_password').keyup(function(){validatePassword();})
function validatePassword(){
  if($('#password').val() != $('#con_password').val()) {
    document.getElementById('con_password').setCustomValidity("Passwords Don't Match");
  } else {
   document.getElementById('con_password').setCustomValidity('');
  }
}
});
</script>
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
			<?php echo$this->Html->link(__("Change Photo"),array('controller'=>'Profiles','action'=>'changePhoto'),array('class'=>'list-group-item'));?>
			<?php echo$this->Html->link(__('Change Password'),array('controller'=>'Profiles','action'=>'changePass'),array('class'=>'list-group-item active'));?>			
		</div>
		</div>
	</div>
    <div class="col-md-10">    
        <div class="page-title-breadcrumb">
    <div class="page-header pull-left">
	<div class="page-title"><?php echo __('Change Password');?></div>
    </div>
</div>
		<div class="panel">
                <div class="panel-body">
                <?php echo $this->Form->create('Profile', array('name'=>'post_req','id'=>'post_req','class'=>'form-horizontal'));?>
                     <div class="form-group">
                        <label for="group_name" class="col-sm-3 control-label"><?php echo __('Old Password');?></label>
                        <div class="col-sm-9">
			<?php echo $this->Form->input('oldPassword',array('required'=>true,'type'=>'password','value'=>'','label' => false,'class'=>'form-control','placeholder'=>__('Old Password'),'div'=>false,'maxlength'=>15,'minlength'=>4));?>
		  </div>
                    </div>
                    <div class="form-group">
                        <label for="group_name" class="col-sm-3 control-label"><?php echo __('Password');?></label>
                        <div class="col-sm-9">
			<?php echo $this->Form->input('password',array('required'=>true,'id'=>'password','value'=>'','label' => false,'class'=>'form-control','placeholder'=>__('Password'),'div'=>false,'maxlength'=>15,'minlength'=>4));?>
		  </div>
                    </div>
                    <div class="form-group">
                        <label for="group_name" class="col-sm-3 control-label"><?php echo __('Confirm Password');?></label>
                        <div class="col-sm-9">
			<?php echo $this->Form->input('con_password',array('required'=>true,'type'=>'password','value'=>'','id'=>'con_password','label' => false,'class'=>'form-control','placeholder'=>__('Confirm Password'),'div'=>false));?>
		 </div>
                    </div>
                    <div class="form-group text-left">
                        <div class="col-sm-offset-3 col-sm-7">
                            <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-refresh"></span> <?php echo __('Update');?></button>                            
                        </div>
                    </div>
                <?php echo $this->Form->end(null);?>
                </div>
            </div>
        </div>
    </div>