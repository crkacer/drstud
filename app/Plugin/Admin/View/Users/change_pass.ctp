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

<div class="page-title"><div class="title-env"> <h1 class="title"><?php echo __('Change Password');?></h1></div></div>
<div class="panel">
    <div class="panel-body"><?php echo $this->Session->flash();?>
	<?php echo $this->Form->create('User', array('class'=>'form-horizontal'));?>
	     <div class="form-group">
		<label for="group_name" class="col-sm-3 control-label"><?php echo __('Old Password');?></label>
		<div class="col-sm-9">
		<?php echo $this->Form->input('oldPassword',array('required'=>true,'type'=>'password','value'=>'','label' => false,'class'=>'form-control','placeholder'=>__('Old Password'),'div'=>false,'maxlength'=>15,'minlength'=>4));?>
	    </div>
	    </div>
	    <div class="form-group">
		<label for="group_name" class="col-sm-3 control-label"><?php echo __('Password');?></label>
		<div class="col-sm-9">
		  <?php echo $this->Form->input('password',array('id'=>'password','value'=>'','label' => false,'class'=>'form-control','placeholder'=>__('Password'),'div'=>false,'maxlength'=>15,'minlength'=>4));?>
		</div>
	    </div>
	    <div class="form-group">
		<label for="group_name" class="col-sm-3 control-label"><?php echo __('Confirm Password');?></label>
		<div class="col-sm-9">
		<?php echo $this->Form->input('con_password',array('type'=>'password','value'=>'','id'=>'con_password','label' => false,'class'=>'form-control','placeholder'=>__('Confirm Password'),'div'=>false));?>
		</div>
	    </div>
	    <div class="form-group text-left">
		<div class="col-sm-offset-3 col-sm-7">
		    <?php echo$this->Form->button('<span class="fa fa-refresh"></span>&nbsp;'.__('Update'),array('class'=>'btn btn-success','escpae'=>false));?>                            
		</div>
	    </div>
	<?php echo $this->Form->end();?>
    </div>
</div>