<?php echo $this->Session->flash();?>
<div class="row">
	<?php echo $this->element('pagination',array('IsSearch'=>'No','IsDropdown'=>'No'));
	$page_params = $this->Paginator->params();
	$limit = $page_params['limit'];
	$page = $page_params['page'];
	$serial_no = 1*$limit*($page-1)+1;?>
</div>
<div class="page-title-breadcrumb">
    <div class="page-header pull-left">
	<div class="page-title"><?php echo __('Payment History');?></div>
</div>
</div>
<div class="panel">
    <div class="panel-body">
	<div class="table-responsive">
	    <table class="table table-striped">
				<tr>
					<th><?php echo __('S.No.');?></th>
					<th><?php echo __('Group');?></th>
					<th><?php echo __('Transaction ID');?></th>
					<th><?php echo __('Amount');?></th>
					<th><?php echo __('Date');?></th>
					<th><?php echo __('Payment Mode');?></th>
					<th><?php echo __('Renewal Type');?></th>
				</tr>
				<?php foreach($Order as $post):
				$id=$post['Payment']['id'];
				$viewUrl=$this->Html->url(array('controller'=>'Orderhistories','action'=>"view",$id));?>
				<tr>
					<td><?php echo$serial_no++;?></td>
					<td><?php echo h($post['Group']['group_name']);?></td>
					<td><?php echo h($post['Payment']['transaction_id']);?></td>
					<td><?php echo$currency.$post['Payment']['amount'];?></td>
					<td><?php echo$this->Time->format($dtFormat,$post['Orderhistory']['date']);?></td>
					<td><?php echo h($post['Payment']['type']);?></td>
					<td><?php echo h($post['Payment']['payment_type']);?></td>
				</tr>
				<?php endforeach;unset($post);?>
				</table>
			</div>
		</div>
	</div>
<div class="modal fade" id="targetModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-content">        
  </div>
</div>