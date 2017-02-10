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


<div class="col-md-9">
    <div class="page-heading">
        <div class="widget">
            <h2 class="widget-title"><?php echo __('Reset Password');?></h2>
        </div>
    </div>
    <?php echo $this->Session->flash();?>
        <?php echo $this->Form->create('Forgot', array('name'=>'post_req','id'=>'post_req','class'=>'form-horizontal','role'=>'form'));?>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-3 control-label"><?php echo __('Password');?> :</label>
            <div class="col-sm-9">
            <?php echo $this->Form->input('password',array('id'=>'password','value'=>'','autocomplete'=>'off','label' => false,'required'=>true,'class'=>'form-control','placeholder'=>__('Password'),'div'=>false));?>
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-3 control-label"><?php echo __('Confirm Password');?> :</label>
            <div class="col-sm-9">
            <?php echo $this->Form->input('password',array('value'=>'','id'=>'con_password','autocomplete'=>'off','label' => false,'required'=>true,'class'=>'form-control','placeholder'=>__('Confirm Password'),'div'=>false));?>
            </div>
        </div>
        
        <div class="form-group text-center">
            <div class="col-sm-offset-3 col-sm-2">
            <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-log-in"> </span><?php echo __('Submit');?></button>
            </div>
        </div>
    <?php echo$this->Form->end();?>
</div>