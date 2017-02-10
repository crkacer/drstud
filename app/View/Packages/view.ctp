<div class="container">
	<div class="row">
		<div class="col-md-12 mrg">
			<div class="panel panel-default">
			<div class="panel-heading"><?php echo __('Group Details');?><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button></div>
			<div class="table-responsive">
				<table class="table">
					<tr>
						<td><strong><?php echo __('Group Name');?> :</strong> <span class="text-danger"><strong><?php echo h($post['Package']['group_name']);?></strong></span></td>
					</tr>
					<tr>
						<td><strong><?php echo __('Amount');?> :</strong> <span class="text-danger"><strong><?php echo$currency.$post['Package']['price'];?></strong></span></td>
					</tr>
					<tr>
						<td><strong><?php echo __('Expiry');?> :</strong> <span class="text-danger"><strong><?php if($post['Package']['day']==0)echo'Unlimited';else echo$post['Package']['day'];echo ' '.__('Days');?></strong></span></td>
					</tr>
					<tr>
						<td><?php if(strlen($post['Package']['photo'])>0){
							$photo="group_thumb/".$post['Package']['photo'];}else{
							$photo="nia.png";}?>
							<?php echo$this->Html->image($photo,array('alt'=>$post['Package']['group_name']));?></td>					
					</tr>
					<tr>
						<td><?php echo str_replace("<script","",$post['Package']['description']);?></td>					
					</tr>			
				</table>
			</div>
			</div>
		</div>
	</div>
</div>