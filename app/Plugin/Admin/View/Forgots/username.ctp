<?php echo $this->Form->create('Forgot', array('id'=>'login','class'=>'login-form','role'=>'form'));?>
<div class="login-header"><p><h3><?php echo __('Forgot Username');?></h3></p></div>
<?php echo $this->Session->flash();?>
<div class="form-group">
    <label class="control-label" for="username"><?php echo __('Email ID');?></label>
    <?php echo $this->Form->input('email',array('label' => false,'class'=>'form-control','div'=>false));?>
</div>
<div class="form-group">
    <?php echo$this->Form->button('<i class="fa fa-sign-in"></i>'.__('Submit'),array('class'=>'btn btn-primary btn-block text-left','escpae'=>false));?>

</div>
<div class="login-footer">
    <div class="pull-left"><?php echo$this->Html->link(__('Forgot Password'),array('controller'=>'Forgots','action'=>'password'));?></div>
    <div class="pull-right"><?php echo$this->Html->link(__('Login'),array('controller'=>'Users','action'=>'login_form'));?></div>
</div>
<?php echo$this->Form->end();?>