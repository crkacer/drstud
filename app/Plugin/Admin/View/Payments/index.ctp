
<div class="page-title"> <div class="title-env"> <h1 class="title"><?php echo __('Paypal Payment Option');?></h1></div></div><div class="panel"><div class="panel">
    <div class="panel-body"><?php echo $this->Session->flash();?>
                <?php echo $this->Form->create('Payment', array('action' => 'index','class'=>'form-horizontal'));?>
                    <div class="form-group">
                        <label for="site_name" class="col-sm-3 control-label"><?php echo __('User Name');?></label>
                        <div class="col-sm-9">
                           <?php echo $this->Form->input('username',array('label' => false,'class'=>'form-control','placeholder'=>__('User Name'),'div'=>false));?>
                        </div>
                    </div>
                     <div class="form-group">
                        <label for="site_name" class="col-sm-3 control-label"><?php echo __('Password');?></label>
                        <div class="col-sm-9">
                           <?php echo $this->Form->input('password',array('label' => false,'class'=>'form-control','placeholder'=>__('Password'),'div'=>false));?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="site_name" class="col-sm-3 control-label"><?php echo __('Signature');?></label>
                        <div class="col-sm-9">
                           <?php echo $this->Form->input('signature',array('label' => false,'class'=>'form-control','placeholder'=>__('Signature'),'div'=>false));?>
                        </div>
                    </div>		    
                    <div class="form-group">
                        <label for="site_name" class="col-sm-3 control-label"><?php echo __('Sandbox Mode');?></label>
                        <div class="col-sm-9">
                           <?php echo $this->Form->input('sandbox_mode',array('label' =>'&nbsp;'.__('True'),'class'=>'','div'=>false));?>
                        </div>
                    </div>    
                    <div class="form-group text-left">
                        <div class="col-sm-offset-3 col-sm-7">
			<?php echo$this->Form->button('<span class="fa fa-refresh"></span>&nbsp;'.__('Save Settings'),array('class'=>'btn btn-success','escpae'=>false));?>
                 </div>
                    </div>
                <?php echo $this->Form->end();?>
                </div>
            </div></div>