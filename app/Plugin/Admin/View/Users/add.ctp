<div class="panel panel-custom">
    <div class="panel-heading"><?php echo __('Add Users/Teachers');?></div>
    <div class="panel-body"><?php echo $this->Session->flash();?>
        <?php echo $this->Form->create('User', array('class'=>'form-horizontal'));?>
        <div class="form-group">
            <label for="group_name" class="col-sm-3 control-label"><?php echo __('User Level');?></label>
            <div class="col-sm-9">
                <?php echo $this->Form->select('ugroup_id',$ugroup,array('empty'=>null,'label' => false,'class'=>'form-control','div'=>false));?>
                </div>
        </div>
        <div class="form-group">
            <label for="group_name" class="col-sm-3 control-label"><?php echo __('Group');?></label>
            <div class="col-sm-9">
                <?php echo $this->Form->select('UserGroup.group_name',$group_id,array('multiple'=>true,'label' => false,'class'=>'form-control multiselectgrp','div'=>false));?>
                </div>
        </div>
        <div class="form-group">
            <label for="group_name" class="col-sm-3 control-label"><small><?php echo __('Username');?></small></label>
            <div class="col-sm-9">
               <?php echo $this->Form->input('username',array('label' => false,'class'=>'form-control','placeholder'=>__('Username'),'div'=>false));?>
            </div>
        </div>
        <div class="form-group">
            <label for="group_name" class="col-sm-3 control-label"><small><?php echo __('Password');?></small></label>
            <div class="col-sm-9">
            <?php echo $this->Form->input('password',array('type'=>'password','label' => false,'class'=>'form-control','placeholder'=>__('Password'),'div'=>false,'maxlength'=>15,'minlength'=>4));?>
            </div>
        </div>
        <div class="form-group">
            <label for="group_name" class="col-sm-3 control-label"><small><?php echo __('Name');?></small></label>
            <div class="col-sm-9">
               <?php echo $this->Form->input('name',array('label' => false,'class'=>'form-control','placeholder'=>__('Name'),'div'=>false));?>
            </div>
        </div>
        <div class="form-group">
            <label for="group_name" class="col-sm-3 control-label"><small><?php echo __('Email');?></small></label>
            <div class="col-sm-9">
               <?php echo $this->Form->input('email',array('label' => false,'class'=>'form-control','placeholder'=>__('Email'),'div'=>false));?>
            </div>
        </div>
        <div class="form-group">
            <label for="group_name" class="col-sm-3 control-label"><small><?php echo __('Mobile');?></small></label>
            <div class="col-sm-9">
               <?php echo $this->Form->input('mobile',array('type'=>'number','label' => false,'class'=>'form-control','placeholder'=>__('Mobile'),'div'=>false));?>
            </div>
        </div>
        <div class="form-group text-left">
            <div class="col-sm-offset-3 col-sm-7">
                <?php echo$this->Form->button('<span class="fa fa-plus-circle"></span>&nbsp;'.__('Save'),array('class'=>'btn btn-success','escpae'=>false));?>
                <?php echo$this->Html->link('<span class="fa fa-close"></span>&nbsp;'.__('Close'),array('action'=>'index'),array('class'=>'btn btn-danger','escape'=>false));?>
            </div>
        </div>
        <?php echo $this->Form->end();?>
    </div>
</div>