<?php
 $this->Js->JqueryEngine->jQueryObject = 'jQuery';
// Paginator options
$this->Paginator->options(array(
  'update' => '#resultDiv',
  'evalScripts' => true,
));
?>
<div id="resultDiv"> 
<?php echo $this->Session->flash();?>
<div class="page-title-breadcrumb">
    <div class="page-header pull-left">
	<div class="page-title"><?php echo __('Transaction History');?></div>
    </div>
</div>
<div class="panel">
   	<?php echo $this->element('pagination',array('IsSearch'=>'No','IsDropdown'=>'No'));
		$page_params = $this->Paginator->params();
		$limit = $page_params['limit'];
		$page = $page_params['page'];
		$serial_no = 1*$limit*($page-1)+1;?>
	<div class="panel-body">
		<div class="table-responsive">
			<table class="table table-striped">
			<tr>
				<th><?php echo __('S.No.');?></th>
				<th><?php echo __('Credit');?></th>
				<th><?php echo __('Debit');?></th>
				<th><?php echo __('Balance');?></th>
				<th><?php echo __('Date & Time');?></th>
				<th><?php echo __('Payment Through');?></th>
				<th><?php echo __('Remarks')?></th>
			</tr>
			<?php foreach($Transactionhistory as $post):?>
			<tr>
				<td><?php echo$serial_no++;?></td>
				<td><?php if($post['Transactionhistory']['in_amount']!=NULL)echo$currency.$post['Transactionhistory']['in_amount'];?></td>
				<td><?php if($post['Transactionhistory']['out_amount']!=NULL)echo$currency.$post['Transactionhistory']['out_amount'];?></td>
				<td><?php echo$currency.$post['Transactionhistory']['balance'];?></td>
				<td><?php echo$this->Time->format($sysDay.$dateSep.$sysMonth.$dateSep.$sysYear.$dateGap.$sysHour.$timeSep.$sysMin.$timeSep.$sysSec.$dateGap.$sysMer,$post['Transactionhistory']['date']);?></td>
				<td><?php echo$payment_type_arr[$post['Transactionhistory']['type']];?></td>
				<td><?php echo h($post['Transactionhistory']['remarks']);?></td>
			</tr>
			<?php endforeach;unset($post);?>
			</table>
		</div>
	</div>
</div>
</div>