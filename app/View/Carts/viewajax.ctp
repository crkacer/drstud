<div class="container">
	<div class="row">
		<div class="col-md-12 mrg">
			<div class="panel panel-default">
			<div class="panel-heading"><?php echo __('Shopping Cart');?><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button></div>
			<?php echo $this->Form->create('Cart',array('url'=>array('action'=>'update')));?>
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
				<tr>
				    <td align="right" colspan="3"><?php //if($total>0){echo $this->Form->submit(__('Update'),array('class'=>'btn btn-warning','div'=>false));}?></td>
				    <td colspan="2">&nbsp;</td>
				</tr>
			</tbody>
		</table>
		</div>

	<?php echo $this->Form->end();?>
		<?php echo$this->Html->link(__('Proceed to Payment').' >',array('controller'=>'Checkouts'),array('class'=>'btn btn-success'));?>
			</div>
		</div>
	</div>
</div>