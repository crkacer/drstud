<div class="panel panel-custom">
    <div class="panel-heading"><?php echo __('Add Email Template');?></div>
    <div class="panel-body"><?php echo $this->Session->flash();?>
        <?php echo $this->Form->create('Emailtemplate', array('class'=>'form-horizontal'));?>
            <div class="form-group">
                <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Name');?>:</small></label>
                <div class="col-sm-10">
                   <?php echo $this->Form->input('name',array('label' => false,'class'=>'form-control','placeholder'=>__('Name'),'div'=>false));?>
                </div>
            </div>
            <div class="form-group">
                <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Email Template');?>:</small></label>
                <div class="col-sm-10">
                    <?php echo $this->Tinymce->input('description',array('label' => false,'class'=>'form-control','placeholder'=>__('Email Template'),'div'=>false),array('language'=>$configLanguage,'directionality'=>$dirType),'absolute');?>
                </div>
            </div>
            <div class="form-group text-left">
                <div class="col-sm-offset-2 col-sm-6">
                    <button type="submit" class="btn btn-success"><span class="fa fa-plus-circle"></span>&nbsp; <?php echo __('Save');?></button>
                    <?php echo$this->Html->link('<span class="fa fa-close"></span>&nbsp; '.__('Close'),array('controller'=>'Emailtemplates','action'=>'index'),array('class'=>'btn btn-danger','escape'=>false));?>
                </div>
            </div>
        <?php echo$this->Form->end();?>
        </div>
    </div>
