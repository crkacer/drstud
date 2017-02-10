<div class="panel panel-custom">
    <div class="panel-heading"><?php echo __('Add Advertisement');?></div>
    <div class="panel-body"><?php echo $this->Session->flash();?>
    <?php echo $this->Form->create('Advertisement', array( 'controller' => 'Advertisements', 'action' => 'add','name'=>'post_req','id'=>'post_req','class'=>'form-horizontal','type'=>'file'));?>
        <div class="form-group">
            <label for="group_name" class="col-sm-3 control-label"><small><?php echo __('Advertisement Name');?></small></label>
            <div class="col-sm-9">
               <?php echo $this->Form->input('name',array('label' => false,'class'=>'form-control','placeholder'=>__('Advertisement Name'),'div'=>false));?>
            </div>
        </div>
        <div class="form-group">
            <label for="group_name" class="col-sm-3 control-label"><small><?php echo __('Ordering');?></small></label>
            <div class="col-sm-9">
               <?php echo $this->Form->input('ordering',array('label' => false,'class'=>'form-control','placeholder'=>__('Ordering'),'div'=>false));?>
            </div>
        </div>
        <div class="form-group">
            <label for="group_name" class="col-sm-3 control-label"><small><?php echo __('URL');?></small></label>
            <div class="col-sm-9">
               <?php echo $this->Form->input('url',array('label' => false,'class'=>'form-control','placeholder'=>__('URL'),'div'=>false));?>
            </div>
        </div>
        <div class="form-group">
            <label for="group_name" class="col-sm-3 control-label"><small><?php echo __('URL Type');?></small></label>
            <div class="col-sm-9">
               <?php echo $this->Form->input('url_type',array('type'=>'radio','options'=>array("Internal"=>__('Internal'),"External"=>__('External')),'default'=>'Internal','legend'=>false,'before' => '<label class="radio-inline">','separator' => '</label><label class="radio-inline">','label' => false,'div'=>false));?>
            </div>
        </div>
        <div class="form-group">
            <label for="group_name" class="col-sm-3 control-label"><small><?php echo __('URL Target');?></small></label>
            <div class="col-sm-9">
               <?php echo $this->Form->input('url_target',array('type'=>'radio','options'=>array("_self"=>__('_self'),"_blank"=>__('_blank')),'default'=>'_self','legend'=>false,'before' => '<label class="radio-inline">','separator' => '</label><label class="radio-inline">','label' => false,'div'=>false));?>
            </div>
        </div>
        <div class="form-group">
            <label for="group_name" class="col-sm-3 control-label"><small><?php echo __('Upload Image (350*260)');?></small></label>
            <div class="col-sm-9">
               <?php echo $this->Form->input('photo',array('type' => 'file','label' => false,'div'=>false));?>
            </div>
        </div>
        <div class="form-group text-left">
            <div class="col-sm-offset-3 col-sm-7">
                <button type="submit" class="btn btn-success"><span class="fa fa-plus-circle"></span>&nbsp;<?php echo __('Save');?></button>
                <?php echo$this->Html->link('<span class="fa fa-close"></span>&nbsp'.__('Close'),array('action'=>'index'),array('class'=>'btn btn-danger','escape'=>false));?>
           </div>
        </div>
    <?php echo $this->Form->end();?>
    </div>
</div>