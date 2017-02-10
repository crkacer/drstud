
<div <?php if(!$isError){?>class="container"<?php }?>>
    <div class="panel panel-custom mrg">
        <div class="panel-heading"><?php echo __('Edit Users/Teachers');?><?php if(!$isError){?><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><?php }?></div>
                <div class="panel-body"><?php echo $this->Session->flash();?>
					<?php echo $this->Form->create('User', array('class'=>'form-horizontal'));?>
					<?php foreach ($User as $k=>$post): $id=$post['User']['id'];$form_no=$k+1;?>
						<div class="panel panel-default">
							<div class="panel-heading"><strong><small class="text-danger"><?php echo __('User Registration Form');?> <?php echo$form_no?></small></strong></div>
							<div class="panel-body">
							<?php if($id!=1){?>
								<div class="form-group">
									<label for="group_name" class="col-sm-3 control-label"><?php echo __('User Level');?></label>
									<div class="col-sm-9">
									   <?php echo $this->Form->select("$k.User.ugroup_id",$ugroup,array('empty'=>null,'label' => false,'class'=>'form-control','div'=>false));?>
									</div>
								</div>
								<div class="form-group">
									<label for="group_name" class="col-sm-3 control-label"><?php echo __('Group');?></label>
									<div class="col-sm-9">
									   <?php $gp2=array();
                                                                                        foreach($post['Group'] as $groupName):
                                                                                $gp2[]= $groupName['id'];?>
                                                                                <?php endforeach;unset($groupName);?>
										   <?php echo $this->Form->select("$k.UserGroup.group_name",$group_id,array('value'=>$gp2,'multiple'=>true,'label' => false,'class'=>'form-control multiselectgrp','div'=>false));$gp2=array();?>
									</div>
								</div><?php }?>
								<div class="form-group">
									<label for="group_name" class="col-sm-3 control-label"><?php echo __('Username');?></label>
									<div class="col-sm-9">
									   <?php echo $this->Form->input("$k.User.username",array('label' => false,'class'=>'form-control','placeholder'=>__('Username'),'div'=>false));?>
									</div>
								</div>
								<div class="form-group">
									<label for="group_name" class="col-sm-3 control-label"><?php echo __('Password');?></label>
									<div class="col-sm-9">
									   <?php echo $this->Form->password("$k.User.password",array('value'=>'','label' => false,'class'=>'form-control','placeholder'=>__('Password'),'div'=>false));?>
									</div>
								</div>
								<div class="form-group">
									<label for="group_name" class="col-sm-3 control-label"><?php echo __('Name');?></label>
									<div class="col-sm-9">
									   <?php echo $this->Form->input("$k.User.name",array('label' => false,'class'=>'form-control input-sm','placeholder'=>__('Name'),'div'=>false));?>
									</div>
								</div>
								<div class="form-group">
									<label for="group_name" class="col-sm-3 control-label"><?php echo __('Email');?></label>
									<div class="col-sm-9">
									   <?php echo $this->Form->input("$k.User.email",array('label' => false,'class'=>'form-control input-sm','placeholder'=>__('Email'),'div'=>false));?>
									</div>
								</div>
								<div class="form-group">
									<label for="group_name" class="col-sm-3 control-label"><?php echo __('Mobile');?></label>
									<div class="col-sm-9">
									   <?php echo $this->Form->input("$k.User.mobile",array('label' => false,'class'=>'form-control input-sm','placeholder'=>__('Mobile'),'div'=>false));?>
									</div>
								</div>
								<?php if($id!=1){?>
								<div class="form-group">
									<label for="group_name" class="col-sm-3 control-label"><?php echo __('Status');?></label>
									<div class="col-sm-9">
									   <?php echo $this->Form->select("$k.User.status",array('Active'=>__('Active'),'Suspend'=>__('Suspend')),array('empty'=>null,'label' => false,'class'=>'form-control','div'=>false));?>
									</div>
								</div>
								<?php }?>
								<div class="form-group">
									<div class="col-sm-9">
										<?php echo $this->Form->input("$k.User.id", array('type' => 'hidden'));?>
									</div>
								</div>
							</div>	
						</div>						
                    <?php endforeach; ?>
                        <?php unset($post); ?>
                        <div class="form-group text-left">
			    <div class="col-sm-offset-3 col-sm-7">                            
                            <?php echo$this->Form->button('<span class="fa fa-refresh"></span>&nbsp;'.__('Update'),array('class'=>'btn btn-success','escpae'=>false));?>
			    <?php if(!$isError){?><button type="button" class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span>&nbsp;<?php echo __('Cancel');?></button><?php }else{
			    echo$this->Html->link('<span class="fa fa-close"></span>&nbsp;'.__('Close'),array('action'=>'index'),array('class'=>'btn btn-danger','escape'=>false));}?>
			    </div>
                    </div>
                <?php echo $this->Form->end();?>
        </div>
    </div>
</div>