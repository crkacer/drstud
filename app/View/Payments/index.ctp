<?php echo $this->Session->flash();?>
<div class="page-title-breadcrumb">
    <div class="page-header pull-left">
	<div class="page-title"><?php echo __('Payment From Pay Pal');?></div>
    </div>
</div>
<div class="panel">
    <div class="panel-body">
	<?php echo $this->Form->create('Payment', array( 'controller' => 'Payment', 'action' => 'checkout','name'=>'post_req','id'=>'post_req','class'=>'form-horizontal'));?>
	     <div class="form-group">
		<label for="group_name" class="col-sm-3 control-label"><?php echo __('Amount');?></label>
		<div class="col-sm-9">
		   <?php echo $this->Form->input('amount',array('label' => false,'class'=>'form-control','placeholder'=>__('Amount'),'div'=>false));?>
		</div>
	    </div>
	    <div class="form-group">
		<label for="group_name" class="col-sm-3 control-label"><?php echo __('Remarks');?></label>
		<div class="col-sm-9">
		   <?php echo $this->Form->input('remarks',array('label' => false,'class'=>'form-control','placeholder'=>__('Remarks'),'div'=>false));?>
		</div>
	    </div>                    
	    <div class="form-group text-left">
		<div class="col-sm-offset-3 col-sm-7">
		    <button type="submit" class="btn btn-success"><span class="fa fa-paypal"></span> <?php echo __('Pay From Pay Pal');?></button>
		</div>
	    </div>
	<?php echo $this->Form->end();?>
    </div>
</div>