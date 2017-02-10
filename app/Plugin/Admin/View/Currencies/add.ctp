<div class="col-md-12">
    <?php echo $this->Session->flash();?>
    <div class="panel panel-default">
        <div class="panel-heading"><?php echo __('Add Currency');?></div>
        <div class="panel-body">
                <div class="panel-body">
                <?php echo $this->Form->create('Currency', array('class'=>'form-horizontal','type'=>'file'));?>
                    <div class="form-group">
                        <label for="group_name" class="col-sm-3 control-label"><small><?php echo __('Currency Name');?></small></label>
                        <div class="col-sm-9">
                           <?php echo $this->Form->input('name',array('label' => false,'class'=>'form-control','placeholder'=>__('Currency Name'),'div'=>false));?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="group_name" class="col-sm-3 control-label"><small><?php echo __('Short Name');?></small></label>
                        <div class="col-sm-9">
                           <?php echo $this->Form->input('short',array('label' => false,'class'=>'form-control','placeholder'=>__('Short Name'),'div'=>false));?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="group_name" class="col-sm-3 control-label"><small><?php echo __('Upload Currency (Less or equal to 50*50)');?></small></label>
                        <div class="col-sm-9">
                           <?php echo $this->Form->input('photo',array('type' => 'file','label' => false,'class'=>'','div'=>false));?>
                        </div>
                    </div>
                    <div class="form-group text-left">
                        <div class="col-sm-offset-3 col-sm-7">
                           <?php echo$this->Form->button('<span class="fa fa-plus-circle"></span>&nbsp;'.__('Save'),array('class'=>'btn btn-success','escpae'=>false));?>
                        <?php echo$this->Html->link('<span class="fa fa-close"></span>&nbsp;'.__('Close'),array('action'=>'index'),array('class'=>'btn btn-danger','escape'=>false));?>
                   </div>
            </div>
        <?php echo$this->Form->end();?>
        </div>
    </div>
</div>