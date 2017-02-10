
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

<?php echo $this->Form->create('Forgot', array('id'=>'login','class'=>'login-form','role'=>'form'));?>
<div class="login-header"><p><h3><?php echo __('Reset Password');?></h3></p></div>
<?php echo $this->Session->flash();?>
<div class="form-group">
    <label class="control-label" for="username"><?php echo __('Password');?></label>
    <?php echo $this->Form->input('password',array('id'=>'password','value'=>'','label' => false,'class'=>'form-control','autocomplete'=>'off','div'=>false,'type'=>'password','required'=>true));?>
</div>
<div class="form-group">
    <label class="control-label" for="username"><?php echo __('Confirm Password');?></label>
    <?php echo $this->Form->input('password',array('id'=>'con_password','value'=>'','label' => false,'class'=>'form-control','autocomplete'=>'off','div'=>false,'type'=>'password','required'=>true));?>
</div>

<div class="form-group">
    <?php echo$this->Form->button('<i class="fa fa-sign-in"></i>'.__('Submit'),array('class'=>'btn btn-primary btn-block text-left','escpae'=>false));?>
</div>
<div class="login-footer">
    <div class="pull-left"><?php echo$this->Html->link(__('Forgot Username'),array('controller'=>'Forgots','action'=>'username'));?></div>
    <div class="pull-right"><?php echo$this->Html->link(__('Login'),array('controller'=>'Users','action'=>'login_form'));?></div>
</div>
<?php echo$this->Form->end();?>