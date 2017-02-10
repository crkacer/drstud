<div <?php if(!$isError){?>class="container"<?php }?>>    
    <div class="panel panel-custom mrg">
        <div class="panel-heading"><?php echo __('Edit Advertisements');?><?php if(!$isError){?><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><?php }?></div>
        <div class="panel-body"><?php echo $this->Session->flash();?>
	    <?php echo $this->Form->create('Advertisement', array( 'controller' => 'Advertisements','name'=>'post_req','id'=>'post_req','class'=>'form-horizontal','type'=>'file'));?>
	    <?php foreach ($Advertisement as $k=>$post): $id=$post['Advertisement']['id'];$form_no=$k+1;?>
	    <div class="panel panel-default">
		<div class="panel-heading"><strong><small class="text-danger"><?php echo __('Form');?> <?php echo$form_no?></small></strong></div>
		<div class="panel-body"><?php echo $this->Session->flash();?>
		    <div class="form-group">
			    <label for="group_name" class="col-sm-3 control-label"><?php echo __('Advertisement Name');?></label>
			    <div class="col-sm-9">
			       <?php echo $this->Form->input("$k.Advertisement.name",array('label' => false,'class'=>'form-control','placeholder'=>__('Advertisement Name'),'div'=>false));?>
			    </div>
		    </div>
		    <div class="form-group">
			    <label for="group_name" class="col-sm-3 control-label"><?php echo __('Ordering');?></label>
			    <div class="col-sm-9">
			       <?php echo $this->Form->input("$k.Advertisement.ordering",array('label' => false,'class'=>'form-control','placeholder'=>__('Ordering'),'div'=>false));?>
			    </div>
		    </div>
		     <div class="form-group">
			<label for="group_name" class="col-sm-3 control-label"><small><?php echo __('URL');?></small></label>
			<div class="col-sm-9">
			   <?php echo $this->Form->input("$k.Advertisement.url",array('label' => false,'class'=>'form-control','placeholder'=>__('URL'),'div'=>false));?>
			</div>
		    </div>
		    <div class="form-group">
			<label for="group_name" class="col-sm-3 control-label"><small><?php echo __('URL Type');?></small></label>
			<div class="col-sm-9">
			   <?php echo $this->Form->input("$k.Advertisement.url_type",array('type'=>'radio','options'=>array("Internal"=>__('Internal'),"External"=>__('External')),'legend'=>false,'before' => '<label class="radio-inline">','separator' => '</label><label class="radio-inline">','label' => false,'div'=>false));?>
			</div>
		    </div>
		    <div class="form-group">
			<label for="group_name" class="col-sm-3 control-label"><small><?php echo __('URL Target');?></small></label>
			<div class="col-sm-9">
			   <?php echo $this->Form->input("$k.Advertisement.url_target",array('type'=>'radio','options'=>array("_self"=>__('_self'),"_blank"=>__('_blank')),'legend'=>false,'before' => '<label class="radio-inline">','separator' => '</label><label class="radio-inline">','label' => false,'div'=>false));?>
			</div>
		    </div>
		    <div class="form-group">
			<label for="group_name" class="col-sm-3 control-label"><?php echo __('Status');?></label>
			<div class="col-sm-9">
			    <?php echo $this->Form->select("$k.Advertisement.status",array("Active"=>__('Active'),"Suspend"=>__('Suspend')),array('empty'=>null,'label' => false,'class'=>'form-control','div'=>false));?>
			</div>
		    </div>
		    <div class="form-group text-left">
			    <div class="col-sm-offset-3 col-sm-7">
			    <?php echo $this->Form->input("$k.Advertisement.id", array('type' => 'hidden'));?>
		          </div>
		    </div>
		</div>
	    </div>
	    <?php endforeach;?>
	    <?php unset($post);?>
	    <div class="form-group text-left">
		<div class="col-sm-offset-3 col-sm-6">
		    <button type="submit" class="btn btn-success"><span class="fa fa-refresh"></span>&nbsp;<?php echo __('Update');?></button>
		    <?php if(!$isError){?><button type="button" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-remove"></span>&nbsp; <?php echo __('Cancel');?></button><?php }?>
		</div>
	    </div>
	    <?php echo $this->Form->end();?>
	</div>
    </div>
</div>