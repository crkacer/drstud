<div <?php if(!$isError){?>class="container"<?php }?>>
    <div class="panel panel-custom mrg">
        <div class="panel-heading"><?php echo __('Edit Subjects');?><?php if(!$isError){?><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><?php }?></div>
                <div class="panel-body"><?php echo $this->Session->flash();?>
                <?php echo $this->Form->create('Subject', array('class'=>'form-horizontal'));?>
                <?php foreach ($Subject as $k=>$post): $id=$post['Subject']['id'];$form_no=$k+1;?>
                    <div class="panel panel-default">
						<div class="panel-heading"><strong><small class="text-danger"><?php echo __('Form');?> <?php echo$form_no?></small></strong></div>
						<div class="panel-body"><?php echo $this->Session->flash();?>	
							<div class="form-group">
								<label for="subject_name" class="col-sm-3 control-label"><small><?php echo __('Select Group');?></small></label>
								<div class="col-sm-9">
								   <?php $gp2=array();
								   foreach($post['Group'] as $groupName):
								   $gp2[]= $groupName['id'];?>
								   <?php endforeach;unset($groupName);?>
								   <?php echo $this->Form->select("$k.SubjectGroup.group_name",$group_id,array('value'=>$gp2,'multiple'=>true,'label' => false,'class'=>'form-control multiselectgrp','div'=>false));$gp2=array();?>
								</div>
							</div>
							<div class="form-group">
								<label for="subject_name" class="col-sm-3 control-label"><small><?php echo __('Subject Name');?></small></label>
								<div class="col-sm-9">
								   <?php echo $this->Form->input("$k.Subject.subject_name",array('label' => false,'class'=>'form-control','placeholder'=>__('Subject Name'),'div'=>false));?>
								</div>
							</div>							
							<div class="form-group text-left">
								<div class="col-sm-offset-3 col-sm-7">
									<?php echo $this->Form->input("$k.Subject.id", array('type' => 'hidden'));?>                            
								</div>
							</div>
						</div>	
					</div>	
                    <?php endforeach; ?>
                        <?php unset($post); ?>
                        <div class="form-group text-left">
                        <div class="col-sm-offset-3 col-sm-7">                            
                            <?php echo$this->Form->button('<span class="fa fa-refresh"></span>&nbsp;'.__('Update'),array('class'=>'btn btn-success','escpae'=>false));?>
			    <?php if(!$isError){?><button type="button" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-remove"></span>&nbsp;<?php echo __('Cancel');?></button><?php }else{
			    echo$this->Html->link('<span class="fa fa-close"></span>&nbps;'.__('Close'),array('action'=>'index'),array('class'=>'btn btn-danger','escape'=>false));}?>
		    </div>
                    </div>
                <?php echo $this->Form->end();?>
        </div>
    </div>
</div>
