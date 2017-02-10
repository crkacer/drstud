	<div class="container">		
				<div class="panel panel-custom mrg">
					<div class="panel-heading"><?php echo __('View Group Information');?><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button></div>
					<div class="panel-body">
						<div class="col-md-3 text-center">
							<p><div class="img-thumbnail"><?php echo $this->Html->image($std_img, array('alt' => $post['Group']['group_name']));?></div></p>
						</div>
						
						<div class="col-md-9"> 
							<div class="table-responsive">
								<table class="table table-striped table-bordered">
									<tr >
										<td colspan="2" align="left" class="text-primary"><strong><small><?php echo __('Group Name');?>: </small></strong><strong><small><?php echo h($post['Group']['group_name']);?></small></strong></td>										
									</tr>
									<tr >
										<td colspan="2"  align="left" class="text-primary"><strong><small><?php echo __('Description');?>: </small></strong><strong><small><?php echo h($post['Group']['description']);?></small></strong></td>
									</tr>
									<tr>
										<td colspan="2"  align="left" class="text-primary"><strong><small><?php echo __('Amount');?>: </small></strong><strong><small><?php echo h($post['Group']['price']);?></small></strong></td>
									</tr>
									
									<tr>
										<td colspan="2"  align="left" class="text-primary"><strong><small><?php echo __('Expiry Days');?>: </small></strong><strong><small><?php if($post['Group']['day']==0)echo'Unlimited';else echo$post['Group']['day'];echo ' '.__('Days');?></small></strong></td>
									</tr>
									</tr>
								</table>
							</div>
						</div>
					</div>	
				</div>
        </div>