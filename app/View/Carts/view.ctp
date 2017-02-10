<div class="col-md-12">
<div class="col-md-9">
   <?php if($userValue){?>
<div class="page-title-breadcrumb">
    <div class="page-header pull-left">
        <div class="page-title"><?php echo __('Shopping Cart');?>
	</div>
    </div>
</div>
<?php }else{?>
   <div class="panel-heading">
        <div class="widget">
            <h2 class="widget-title"><?php echo __('Shopping Cart');?></h2>
        </div>
    </div>
<?php }?>
<?php echo $this->Form->create('Cart',array('url'=>array('action'=>'update')));?>
		<?php if($userValue){?>
		<div class="panel">
		<div class="panel-body"><?php }?>

		<div class="table-responsive">
		<table class="table">
			<thead>
				<tr>
					<th><?php echo __('Package Name');?></th>
					<th><?php echo __('Price');?></th>
					<th><?php echo __('Quantity');?></th>
					<th><?php echo __('Total');?></th>
					<th>&nbsp;</th>
				</tr>
			</thead>
			<tbody>
				<?php $total=0;?>
				<?php foreach ($products as $product):?>
				<tr>
					<td><?php echo $product['Package']['group_name'];?></td>
					<td><?php echo $currency.$product['Package']['price'];?></td>
					<td class="col-sm-1">
						<div>
						<?php echo $this->Form->hidden('package_id.',array('value'=>$product['Package']['id']));?>
						<?php //echo $this->Form->input('count.',array('type'=>'number', 'label'=>false,'class'=>'form-control input-sm', 'value'=>$product['Package']['count']));
						echo $product['Package']['count'];?>
						</div>
					</td>
					<td><?php echo$currency.$product['Package']['count']*$product['Package']['price'];?></td>
					<td><?php echo$this->html->link('<span class="fa fa-trash-o"></span>&nbsp;',array('controller'=>'Carts','action'=>'delete',$product['Package']['id']),array('escape'=>false));?></td>
				</tr>
				<?php $total = $total + ($product['Package']['count']*$product['Package']['price']);?>
				<?php endforeach;?>
			</tbody>
		</table>
		</div>
		 
		<p class="text-right">
			<?php echo$this->Html->link('<span class="fa fa-shopping-cart"></span>&nbsp;'.__('Continue shopping'),array('controller'=>'Packages'),array('class'=>'btn btn-info','escape'=>false));?>
			<?php //if($total>0){echo $this->Form->submit(__('Update'),array('class'=>'btn btn-warning','div'=>false));}?>
			
		</p>
<?php if($userValue){?>    
    </div>
    </div><?php }?>
	</div>
	<?php echo $this->Form->end();?>
	<div class="col-md-3">
	<?php if($userValue){?>
	<div class="page-title-breadcrumb">
	    <div class="page-header pull-left">
        <div class="page-title"><?php echo __('Checkout');?>
	</div>
    </div>
</div>
<?php }else{?>
	<div class="page-heading">
        <div class="widget">
            <h2 class="widget-title"><?php echo __('Checkout');?></h2>
        </div>	
    </div>
    <?php }if($userValue){?>
		<div class="panel">
		<div class="panel-body"><?php }?>
    <?php if($products){?><div class="success"><h2><?php echo $currency.$total;?></h2></div>
    <?php echo$this->Html->link(__('Proceed to Payment'.'>'),array('controller'=>'Checkouts'),array('class'=>'btn btn-success'));}?><p>&nbsp;</p><br>
	 <?php if($userValue){?>    
    </div>
    </div><?php }?>
	</div>
</div>

