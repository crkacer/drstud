	<div class="container">		
			<?php $passUrl=$this->Html->url(array('controller'=>'Students','action'=>'changepass',$id));
                        $photoUrl=$this->Html->url(array('controller'=>'Students','action'=>'changephoto',$id));
                        echo $this->Session->flash();?>
				<div class="panel panel-custom mrg">
					<div class="panel-heading"><?php echo __('View Student Information');?><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button></div>
					<div class="panel-body">
						<div class="col-md-2 text-center">
							<p><div class="img-thumbnail"><?php echo $this->Html->image($std_img, array('alt' => $post['Student']['name']));?></div></p>
							<?php if($userPermissionArr['update_right']){echo $this->Html->link(__('Update Photo'),'javascript:void(0);',array('onclick'=>"show_modal('$photoUrl');",'class'=>'btn btn-success btn-sm btn-block','escape'=>false));} ?>
                                                        <?php if($userPermissionArr['update_right']){echo $this->Html->link(__('Change Password'),'javascript:void(0);',array('onclick'=>"show_modal('$passUrl');",'class'=>'btn btn-danger btn-sm btn-block','escape'=>false));} ?>
						</div>
						<div class="col-md-10"> 
							<div class="table-responsive">
								<table class="table table-striped table-bordered">
									<tr class="text-primary">
										<td><strong><small><?php echo __('Full Name');?></small></strong></td>
										<td><strong><small><?php echo __('Phone Number');?></small></strong></td>
									</tr>
									<tr>
										<td><strong><small><?php echo h($post['Student']['name']);?></small></strong></td>
										<td><strong><small><?php echo h($post['Student']['phone']);?></small></strong></td>
									</tr>
									<tr class="text-primary">
										<td><strong><small><?php echo __('Registered Email');?></small></strong></td>
										<td><strong><small><?php echo __('Alternate Number');?></small></strong></td>
									</tr>
									<tr>
										<td><strong><small><?php echo h($post['Student']['email']);?></small></strong></td>
										<td><strong><small><?php echo h($post['Student']['guardian_phone']);?></small></strong></td>
									</tr>
									</tr>
									<tr class="text-primary">
										<td><strong><small><?php echo __('Enrolment No');?>.<strong><small></td>
										<td><strong><small><?php echo __('Admission Date');?></small></strong></td>
									</tr>
									<tr>
										<td><strong><small><?php echo h($post['Student']['enroll']);?></small></strong></td>
										<td><strong><small><?php echo $this->Time->format($sysDay.$dateSep.$sysMonth.$dateSep.$sysYear,$post['Student']['created']); ?></small></strong></td>
									</tr>
									<tr class="text-primary"> 
										<td><strong><small><?php echo __('Groups');?> <strong><small></td>
										<td></td>
									</tr>
									<tr>
										<td colspan="2"><small><strong>
                                                                                <?php foreach($post['Group'] as $k=>$groupName):?>
                                                                                (<?php echo++$k;?>) <?php echo$groupName['group_name'];?>
                                                                                <?php endforeach;unset($groupName);unset($k);?></small></strong></td>
									</tr>
									<tr class="text-primary"> 
										<td><strong><small><?php echo __('Last Login');?><strong><small></td>
										<td></td>
									</tr>
									<tr>
										<td colspan="2"><small><strong><?php if($post['Student']['last_login']!=null)echo $this->Time->format($sysDay.$dateSep.$sysMonth.$dateSep.$sysYear.$dateGap.$sysHour.$timeSep.$sysMin.$timeSep.$sysSec.$dateGap.$sysMer,$post['Student']['last_login']); ?></small></strong></td>
									</tr>
								</table>
							</div>
						</div>
					</div>	
				</div>
        </div>