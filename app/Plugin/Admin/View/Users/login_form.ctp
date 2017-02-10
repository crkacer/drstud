<?php echo $this->Form->create('User',array('id'=>'post_req','role'=>'form','class'=>'login-form'));?>
	<div class="login-header"><p><h3><?php echo __('Log In');?></h3><span><?php echo __('Dear user, log in to access the admin area!');?></span></p></div>
	<?php echo $this->Session->flash();?>
	<div class="form-group">
		<label class="control-label" for="username"><?php echo __('Admin / Teacher Username');?></label>
		<?php echo $this->Form->input('username',array('label' => false,'id'=>'username','class'=>'form-control','required'=>true,'div'=>false));?>
	</div>
	<div class="form-group">
		<label class="control-label" for="passwd"><?php echo __('Password');?></label>
		<?php echo $this->Form->input('password',array('label' => false,'id'=>'passwd','class'=>'form-control','required'=>true,'div'=>false));?>
	</div>
	<div class="form-group">
	<?php echo$this->Form->button('<i class="fa fa-lock"></i>'.__('Log In'),array('class'=>'btn btn-primary btn-block text-left','escpae'=>false));?>
	</div>
	<div class="login-footer">
		<div class="pull-left"><?php echo$this->Html->link(__('Forgot Password'),array('controller'=>'Forgots','action'=>'password'));?></div>
		<div class="pull-right"><?php echo$this->Html->link(__('Forgot User Name'),array('controller'=>'Forgots','action'=>'username'));?></div>
	</div>
<?php echo$this->Form->end();?>