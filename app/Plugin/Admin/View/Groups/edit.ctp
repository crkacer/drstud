<div <?php if(!$isError){?>class="container"<?php }?>>    
    <div class="panel panel-custom mrg">
        <div class="panel-heading"><?php echo __('Edit Groups');?><?php if(!$isError){?><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><?php }?></div>
        <div class="panel-body"><?php echo $this->Session->flash();?>
	    <?php echo $this->Form->create('Group',array('class'=>'form-horizontal','type'=>'file'));?>
	    <?php foreach ($Group as $k=>$post): $id=$post['Group']['id'];$form_no=$k;?>
	    <div class="panel panel-default">
		<div class="panel-heading"><strong><small class="text-danger"><?php echo __('Form');?> <?php echo$form_no?></small></strong></div>
		<div class="panel-body">
		    <div class="form-group">
			<label for="group_name" class="col-sm-3 control-label"><?php echo __('Group Name');?></label>
			<div class="col-sm-9">
			   <?php echo $this->Form->input("$k.Group.group_name",array('label' => false,'class'=>'form-control','placeholder'=> __('Group Name'),'div'=>false));?>
			</div>
		    </div>
		    <div class="form-group">
			<label for="group_name" class="col-sm-3 control-label"><?php echo __('Description');?></label>
			<div class="col-sm-9">
			   <?php echo $this->Form->input("$k.Group.description",array('label' => false,'class'=>'form-control','placeholder'=> __('Description'),'div'=>false));?>
			</div>
		    </div>
		    <div class="form-group">
			<label for="group_name" class="col-sm-3 control-label"><?php echo __('Price');?></label>
			<div class="col-sm-9">
			   <?php echo $this->Form->input("$k.Group.price",array('label' => false,'class'=>'form-control','placeholder'=> __('0 for free purchasing'),'div'=>false));?>
			</div>
		    </div>
		    <div class="form-group">
			<label for="group_name" class="col-sm-3 control-label"><small><?php echo __('Days to expire');?></small></label>
			<div class="col-sm-9">
			   <?php echo $this->Form->input("$k.Group.day",array('type'=>'number','label' => false,'class'=>'form-control','placeholder'=> __('0 for unlimited'),'div'=>false));?>
			</div>
		    </div>
		    <div class="form-group">
			<label for="group_name" class="col-sm-3 control-label"><small><?php echo __('Upload Photo');?></small></label>
			<div class="col-sm-4">
			    <?php echo $this->Form->input("$k.Group.photo",array('type' => 'file','label' => false,'div'=>false));?>
			</div>	    
		    </div>        
		    <div class="form-group text-left">
			<div class="col-sm-offset-3 col-sm-6">
			    <?php echo $this->Form->input("$k.Group.id", array('type' => 'hidden'));?>
			</div>
		    </div>
		</div>
	    </div>
	    <?php endforeach;?>
	    <?php unset($post); ?>
	    <div class="form-group text-left">
		<div class="col-sm-offset-3 col-sm-6">
		    <?php echo$this->Form->button('<span class="fa fa-refresh"></span>&nbsp;'.__('Update'),array('class'=>'btn btn-success','escpae'=>false));?>
		    <?php if(!$isError){?><button type="button" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-remove"></span>&nbsp;<?php echo __('Cancel');?></button><?php }else{
			echo$this->Html->link('<span class="fa fa-close"></span>&nbsp;'.__('Close'),array('action'=>'index'),array('class'=>'btn btn-danger','escape'=>false));}?>
		</div>
	    </div>
	    <?php echo $this->Form->end();?>
	</div>
    </div>
</div>