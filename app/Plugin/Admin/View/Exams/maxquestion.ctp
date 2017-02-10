<script type="text/javascript">
    $(document).ready(function(){
        $('#post_req').validationEngine();
        });
</script>
<div class="container">
        <div class="panel panel-custom mrg">
	<div class="panel-body"><?php echo $this->Session->flash();?>
		<div class="panel-heading"><?php echo __('Questions Attempt Count');?><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button></div>            
		<div class="panel-body">
		<?php echo$this->Form->create('ExamMaxquestion',array('name'=>'post_req','id'=>'post_req','class'=>'form-horizontal'));?>
		<?php foreach($post as $k=>$value): ?>
		<div class="form-group">
			<label for="group_name" class="col-sm-4 control-label"><?php echo$value['Subject']['subject_name'];?>:</label>
		    <div class="col-sm-6">
		    <?php echo $this->Form->input("$k.ExamMaxquestion.max_question",array('type'=>'number','label' => false,'class'=>'form-control input-sm validate[required,custom[onlyNumberSp]','placeholder'=>__('0 for Unlimited'),'div'=>false));?>
		    <?php echo $this->Form->input("$k.ExamMaxquestion.subject_id",array('type'=>'hidden','value'=>$value['Subject']['id']));?>
		    <?php echo $this->Form->input("$k.ExamMaxquestion.exam_id",array('type'=>'hidden','value'=>$examId));?>
		    <?php echo $this->Form->input("$k.ExamMaxquestion.id", array('type' => 'hidden'));?>
		    </div>
		</div>
		<?php endforeach;?>
		
		 <div class="form-group text-left">
                        <div class="col-sm-offset-4 col-sm-7">                            
                            <button type="submit" class="btn btn-success"><span class="fa fa-plus-circle"></span>&nbsp;<?php echo __('Save');?></button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-remove"></span>&nbsp;<?php echo __('Cancel');?></button>
                        </div>
                    </div>
		</div>
	</div>
			
		    <?php echo$this->Form->end(null);?>
		</div>
	    </div>
	</div>

