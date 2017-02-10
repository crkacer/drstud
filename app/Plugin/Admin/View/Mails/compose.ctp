<?php
echo $this->Html->css('select2/select2');
echo $this->Html->css('select2/select2-bootstrap');
echo $this->fetch('css');
echo $this->Html->script('select2.min');
echo $this->fetch('script');
$studentUrl=$this->Html->url(array('controller'=>'Mails','action'=>'studentsearch'));?>
<script type="text/javascript">
    $(document).ready(function(){
$('#studentId').select2({
        minimumInputLength: 1,
	tags: true,
        ajax: {
          url: '<?php echo$studentUrl;?>',
          dataType: 'json',
          data: function (term, page) {
            return {
              q: term
            };
          },          
          results: function (data, page) {
            return { results: data };
          }
        }<?php if($type){?>,
	initSelection: function (element, callback) {callback({"id": "<?php echo$this->request->data['Mail']['to_email'];?>", "text": "<?php echo$this->request->data['Mail']['to_email'];?>"});
	}<?php }?>
      });
});
</script>
    <div class="panel panel-custom">
        <div class="panel-heading"><?php echo __('Compose Mail');?></div>
<div class="panel">
                <div class="panel-body"><?php echo $this->Session->flash();?>
		<?php echo $this->Form->create('Mail', array( 'controller' => 'Mails','class'=>'form-horizontal'));?>
                    <div class="form-group">
                        <label for="group_name" class="col-sm-3 control-label"><small><?php echo __('To');?></small></label>
                        <div class="col-sm-9">
                           <?php echo $this->Form->input('to_email',array('label' => false,'id'=>'studentId','class'=>'form-control','placeholder'=>__('Search Student Mail'),'div'=>false));?>
			</div>
                    </div>
		    <div class="form-group">
                        <label for="group_name" class="col-sm-3 control-label"><small><?php echo __('Subject');?></small></label>
                        <div class="col-sm-9">
                           <?php echo $this->Form->input('subject',array('label' => false,'class'=>'form-control','placeholder'=>__('Subject'),'div'=>false));?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="group_name" class="col-sm-3 control-label"><small></small></label>
                        <div class="col-sm-9">
                           <?php echo $this->Tinymce->input('message', array('placeholder'=>__('Message'),'class'=>'form-control','label' => false),array('language'=>$configLanguage,'directionality'=>$dirType),'full');?>
                        </div>
                    </div>
                    <div class="form-group text-left">
                        <div class="col-sm-offset-3 col-sm-7">
			<?php echo$this->Form->button('<span class="fa fa-plus-circle"></span>&nbsp;'.__('Send'),array('class'=>'btn btn-success','escpae'=>false));
			echo$this->Html->link('<span class="fa fa-close"></span>&nbsp;'.__('Close'),array('action'=>'index'),array('class'=>'btn btn-danger','escape'=>false));?>
			</div>
                    </div>
                <?php echo $this->Form->end();?>
                </div>
            </div>
    </div>
	    