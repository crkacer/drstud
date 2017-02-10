<div class="col-md-12">
<?php echo $this->Session->flash();?>
<div class="col-md-4">
    <div class="page-title-breadcrumb">
    <div class="page-header pull-left">
        <div class="page-title"><?php echo __('Your Details');?></div>
    </div>
</div>
<div class="panel">
    <div class="panel-body">
    <div><strong><?php echo$UserArr['Student']['name'];?></strong></div>
    <div><?php echo$UserArr['Student']['address'];?></div>
    <div>Mobile : <?php echo$UserArr['Student']['phone'];?></div>
    <div>Email : <?php echo$UserArr['Student']['email'];?></div>
    <div>&nbsp;</div>
    <?php if($products){?>
    <!--<div><?php //echo$this->Html->link($this->Html->image('ccavenue.png'),array('controller'=>'Checkouts','action'=>'payment'),array('escape' => false));?></div>-->
    <div>&nbsp;</div>
    <?php if($payPal==true){?><div><?php echo$this->Html->link($this->Html->image('paypal.png'),array('controller'=>'Checkouts','action'=>'payment'),array('escape' => false));?></div><?php }}?>
</div>
</div>
</div>
	<div class="col-md-8">
	<div class="page-title-breadcrumb">
    <div class="page-header pull-left">
        <div class="page-title"><?php echo __('Cart');?></div>
    </div>
</div>
    <?php echo $this->Form->create('Cart',array('url'=>array('action'=>'update')));?>
    <div class="panel">
    <div class="panel-body">
   <div class="table-responsive">
		<table class="table">
			<thead>
				<tr>
					<th><?php echo __('Package Name');?></th>
					<th><?php echo __('Price');?></th>
					<th><?php echo __('Quantity');?></th>
					<th><?php echo __('Total');?></th>
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
		<div class="success"><h2><?php echo __('PAYABLE AMOUNT');?> <?php echo $currency.$total;?></h2></div>
		<p class="text-right">
			<?php echo$this->Html->link('<span class="fa fa-shopping-cart"></span>&nbsp;'.__('Continue shopping'),array('controller'=>'Packages'),array('class'=>'btn btn-info','escape'=>false));?>
			<?php //echo $this->Form->submit(__('Update'),array('class'=>'btn btn-warning','div'=>false));?>
			
		</p>
    </div>
    </div>
	</div>
</div>
<?php echo $this->Form->end();?>
