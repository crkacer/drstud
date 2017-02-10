<div class="row">
<?php echo $this->Session->flash();?>    
    <div class="col-md-12">    
        <div class="panel panel-default mrg">
            <div class="panel-heading"><div class="widget-modal"><h4 class="widget-modal-title"><?php echo __('Add Testimonials');?></strong></h4></div></div>
                <div class="panel-body">
                <?php echo $this->Form->create('Testimonial', array( 'controller' => 'Testimonials','class'=>'form-horizontal','type'=>'file'));?>
                    <div class="form-group">
                        <label for="group_name" class="col-sm-3 control-label"><small><?php echo __('Name');?></small></label>
                        <div class="col-sm-9">
                           <?php echo $this->Form->input('name',array('label' => false,'class'=>'form-control','placeholder'=> __('Name'),'div'=>false));?>
                        </div>
                    </div>
                   <div class="form-group">
                        <label for="group_name" class="col-sm-3 control-label"><small><?php echo __('Description');?></small></label>
                        <div class="col-sm-9">
                           <?php echo $this->Form->input('description',array('label' => false,'class'=>'form-control','placeholder'=>__('Description'),'div'=>false));?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="group_name" class="col-sm-3 control-label"><small><?php echo __('Upload Photo (150*150)');?></small></label>
                        <div class="col-sm-9">
                           <?php echo $this->Form->input('photo',array('type' => 'file','label' => false,'div'=>false));?>
                        </div>
                    </div>
                    <div class="form-group text-left">
                        <div class="col-sm-offset-3 col-sm-7">
                            <?php echo$this->Form->button('<span class="fa fa-plus-circle"></span>&nbsp;'.__('Save'),array('class'=>'btn btn-success','escpae'=>false));?>
                            <?php echo$this->Html->link('<span class="fa fa-close"></span>&nbsp;'.__('Close'),array('action'=>'index'),array('class'=>'btn btn-danger','escape'=>false));?>
                     </div>
                    </div>
                </form>
                </div>
            </div>
        </div>
        
    
</div>
