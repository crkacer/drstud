<div class="page-title"> <div class="title-env"> <h1 class="title"><?php echo __('Transaction History');?></h1></div></div>
<div class="panel">
<div class="panel-heading"><?php echo $this->Session->flash();?>
<div class="btn-group">
    <?php echo$this->html->link('<span class="fa fa-arrow-left"></span>&nbsp;'.__('Back'),'javascript: history.go(-1)',array('class'=>'btn btn-info','escape'=>false));?>
    </div>
</div>
<?php echo $this->element('pagination',array('IsAction'=>'trnhistory'));
        $page_params = $this->Paginator->params();
        $limit = $page_params['limit'];
        $page = $page_params['page'];	
        $serial_no = 1*$limit*($page-1)+1;?>
	
<div class="panel-body">
	    <div class="table-responsive">
		<table class="table table-striped">
		    <tr>
			<th><?php echo $this->Paginator->sort('id', __('#'), array('direction' => 'desc'));?></th>
			<th><?php echo $this->Paginator->sort('email', __('Email'), array('direction' => 'asc'));?></th>
			<th><?php echo $this->Paginator->sort('in_amount', __('Credit'), array('direction' => 'asc'));?></th>
			<th><?php echo $this->Paginator->sort('out_amount', __('Debit'), array('direction' => 'asc'));?></th>
			<th><?php echo $this->Paginator->sort('balance', __('Balance'), array('direction' => 'asc'));?></th>
			<th><?php echo $this->Paginator->sort('date', __('Date & Time'), array('direction' => 'asc'));?></th>
			<th><?php echo $this->Paginator->sort('type', __('Payment Through'), array('direction' => 'asc'));?></th>
			<th><?php echo $this->Paginator->sort('remarks', __('Remarks'), array('direction' => 'asc'));?></th>
		    </tr>
		    <?php foreach($Transactionhistory as $post):?>
		    <tr>
			<td><?php echo$serial_no++;?></td>
			<td><?php echo$post['Student']['email'];?></td>
			<td><?php echo$currency.$post['Wallet']['in_amount'];?></td>
			<td><?php echo$currency.$post['Wallet']['out_amount'];?></td>
			<td><?php echo$currency.$post['Wallet']['balance'];?></td>
			<td><?php echo$this->Time->format($sysDay.$dateSep.$sysMonth.$dateSep.$sysYear.$dateGap.$sysHour.$timeSep.$sysMin.$timeSep.$sysSec.$dateGap.$sysMer,$post['Wallet']['date']);?></td>
			<td><?php echo$payment_type_arr[$post['Wallet']['type']];?></td>
			<td><?php echo$post['Wallet']['remarks'];?></td>
		    </tr>
		    <?php endforeach;unset($post);?>
		</table>
	    </div>
	</div>
</div>