<?php echo $this->Session->flash();?>
<div class="page-title-breadcrumb">
    <div class="page-header pull-left">
	<div class="page-title"><?php echo __('My Group');?></div>
</div>
</div>
<div class="panel">
    <div class="panel-body">
	<div class="table-responsive">
	    <table class="table table-striped">
				<tr>
					<th><?php echo __('S.No.');?></th>
					<th><?php echo __('Group');?></th>
					<th><?php echo __('Start Date');?></th>
					<th><?php echo __('Expiry Date');?></th>
					<th><?php echo __('Action');?></th>
				</tr>
				<?php $serialNo=1; foreach($Mygroup as $post):$id=$post['Mygroup']['id'];?>
				<tr>
					<td><?php echo$serialNo++;?></td>
					<td><?php echo h($post['Mygroup']['group_name']);?></td>
					<td><?php echo$this->Time->format($dtFormat,$post['Mygroup']['start_date']);?></td>
					<td><?php if($post['Mygroup']['fexpiry_date']==NULL)echo'Unlimited';else echo$this->Time->format($dtFormat,$post['Mygroup']['fexpiry_date']);?></td>
					<td><?php if(strtotime($post['Mygroup']['fexpiry_date'])>=strtotime($currentDate) || $post['Mygroup']['fexpiry_date']==NULL)echo $this->Html->link('<span class="fa fa-list"></span>&nbsp;'.__('Subjects'),array('controller'=>'Subjects','action'=>'index',$post['Mygroup']['id']),array('escape'=>false,'class'=>'btn btn-warning'));?>
					<?php if(strtotime($post['Mygroup']['fexpiry_date'])<=strtotime($currentDate)+86400*7 && $post['Mygroup']['fexpiry_date']!=NULL && !$studentArr['Student']['auto_renewal'])echo $this->Html->link('<span class="fa fa-list"></span>&nbsp;'.__('Renew'),array('controller'=>'Mygroups','action'=>'renew',$post['Mygroup']['id']),array('escape'=>false,'class'=>'btn btn-danger'));?></td>
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