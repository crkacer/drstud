<div <?php if(!$isError){?>class="container"<?php }?>>
    <div class="panel panel-custom mrg">
	<div class="panel-heading"><?php echo __('Students Wallet');?><?php if(!$isError){?><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><?php }?></div>            
                <div class="panel-body"><?php echo $this->Session->flash();?>
                <?php echo $this->Form->create('Student', array( 'class'=>'form-horizontal'));?>
                <?php foreach ($Student as $k=>$post): $id=$post['Student']['id'];$form_no=$k+1;?>
                    <div class="panel panel-default">
                        <div class="panel-heading"><strong class="text-danger"><small><?php echo __('Transaction Form');?> <?php echo$form_no?></small></strong></div>
			    <div class="panel-body">
				<div class="form-group">
				    <label for="group_name" class="col-sm-3 control-label"><small><?php echo __('Email');?></small></label>
				    <div class="col-sm-9">
					<?php echo h($post['Student']['email']);?>
				    </div>
				</div>
				<div class="form-group">
				    <label for="group_name" class="col-sm-3 control-label"><small><?php echo __('Name');?></small></label>
				    <div class="col-sm-9">
					<?php echo h($post['Student']['name']);?>
				    </div>
				</div>
				<div class="form-group">
				    <label for="group_name" class="col-sm-3 control-label"><small><?php echo __('Mobile');?></small></label>
				    <div class="col-sm-9">
					<?php echo h($post['Student']['phone']);?>
				    </div>
				</div>
				<div class="form-group">
				    <label for="group_name" class="col-sm-3 control-label"><small><?php echo __('Balance');?></small></label>
				    <div class="col-sm-9">
					<?php echo (empty($post['Wallet']['balance'])) ? $currency."0.00" : $currency.$post['Wallet']['balance'];?>
				    </div>
				</div>
				<div class="form-group">
				    <label for="group_name" class="col-sm-3 control-label"><small><?php echo __('Amount');?></small></label>
				    <div class="col-sm-3">
					<?php echo $this->Form->input("$k.Student.amount",array('label' => false,'class'=>'form-control','placeholder'=>__('Amount'),'autocomplete'=>'off','div'=>false,'type'=>'number'));?>
				    </div>
				</div>
				<div class="form-group">
				    <label for="group_name" class="col-sm-3 control-label"><small><?php echo __('Action');?></small></label>
					<div class="col-sm-3">
					    <?php echo $this->Form->select("$k.Student.action",array("Added"=>__('ADD'),"Deducted"=>__('DEDUCT')),array('empty'=>__('Please Select'),'label' => false,'class'=>'form-control','div'=>false));?>
					</div>
				</div>
				<div class="form-group">
				    <label for="group_name" class="col-sm-3 control-label"><small><?php echo __('Remarks');?></small></label>
				    <div class="col-sm-3">
					<?php echo $this->Form->textarea("$k.Student.remarks",array('label' => false,'class'=>'form-control','placeholder'=>__('Remarks'),'div'=>false));?>
				    </div>
				</div>
				<div class="form-group text-left">
				    <div class="col-sm-offset-3 col-sm-7">
					<?php echo $this->Form->input("$k.Student.id", array('type' => 'hidden'));?>
				    </div>
				</div>
			    </div>
		    </div>				
                    <?php endforeach; ?>
                        <?php unset($post); ?>
                        <div class="form-group text-left">
                        <div class="col-sm-offset-3 col-sm-7">                            
                            <?php echo$this->Form->button('<span class="fa fa-refresh"></span>&nbsp;'.__('Update'),array('class'=>'btn btn-success','escpae'=>false));?>
		    <?php if(!$isError){?><button type="button" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-remove"></span>&nbsp;<?php echo __('Cancel');?></button><?php }else{
			echo$this->Html->link('<span class="fa fa-close"></span>&nbsp;'.__('Close'),array('action'=>'index'),array('class'=>'btn btn-danger','escape'=>false));}?>
                        </div>
                    </div>
               <?php echo $this->Form->end();?>
        </div>
    </div>
</div>