    <script type="text/javascript">
    $(document).ready(function(){
    $('#myModal').modal({
    backdrop: 'static',
    keyboard: false
})});
    </script>
<div class="modal fade" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><i class="fa fa-exclamation-triangle"></i>&nbsp;<?php echo __('Exceeded permissible limit for Navigating away');?></h4>
      </div>
      <div class="modal-body">
        <p><blockquote><?php echo$UserArr['Student']['name'];?>, <?php echo __('You have exceeded the permissible limit for navigating away from your test');?></blockquote></p>
	<p><blockquote><?php echo __('Your test has finished. You can close the window now');?></blockquote></p>
	<div class="text-center">
	<?php if($examFeedback)echo$this->Html->link(__('Close'),array('controller'=>'Exams','action'=>'feedbacks',$id),array('class'=>'btn btn-default'));
	else echo$this->Html->link(__('Close'),array('controller'=>$controller,'action'=>$action,$id),array('class'=>'btn btn-default'));?></div>
      </div>      
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->