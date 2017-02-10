<script type="text/javascript">
    $(document).ready(function(){
   $('.start_date').datetimepicker({locale:'<?php echo$configLanguage;?>',format:'<?php echo $dpFormat;?>'});
});
</script>
<div <?php if(!$isError){?>class="container"<?php }?>>
    <div class="panel panel-custom mrg">
        <div class="panel-heading"><?php echo __('Edit Students');?><?php if(!$isError){?><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><?php }?></div>
                <div class="panel-body"><?php echo $this->Session->flash();?>
                <?php echo $this->Form->create('Student', array('class'=>'form-horizontal'));?>
                <?php foreach ($Student as $k=>$post): $id=$post['Student']['id'];$form_no=$k+1;?>
                    <div class="panel panel-default">
                        <div class="panel-heading"><strong class="text-danger"><small><?php echo __('Form');?> <?php echo$form_no?></small></strong></div>
			<div class="panel-body">
				<div class="row">
				<div class="form-group">
				    <label for="email" class="col-sm-2 control-label"><small><?php echo __('Email');?><span class="text-danger"> *</span></small></label>
				    <div class="col-sm-4">
					<?php echo $this->Form->input("$k.Student.email",array('label' => false,'class'=>'form-control','placeholder'=>__('Email'),'div'=>false));?>
				    </div>
				    <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Group');?><span class="text-danger"> *</span></small></label>
				    <div class="col-sm-4">
					<?php $gp2=array();
					foreach($post['Group'] as $groupName):
					$gp2[]= $groupName['id'];?>
					<?php endforeach;unset($groupName);?>
					<?php echo $this->Form->select("$k.StudentGroup.group_name",$group_id,array('value'=>$gp2,'multiple'=>true,'label' => false,'class'=>'form-control multiselectgrp','div'=>false));$gp2=array();?>
				    </div>
				</div>
				<div class="form-group">
		<label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Name');?><span class="text-danger"> *</span></small></label>
		<div class="col-sm-4">
		    <?php echo $this->Form->input("$k.Student.name",array('label' => false,'class'=>'form-control','placeholder'=>__('Name'),'div'=>false));?>
		</div>
		<label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Status');?></small></label>
		<div class="col-sm-4">
		    <?php echo $this->Form->select("$k.Student.status",array("Active"=>__('Active'),"Pending"=>__('Pending'),"Suspend"=>__('Suspend')),array('empty'=>null,'label' => false,'class'=>'form-control','placeholder'=>'Status','div'=>false));?>
		</div>
	    </div>
	    <div class="form-group">
		<label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Address');?><span class="text-danger"> *</span></small></label>
		<div class="col-sm-4">
		    <?php echo $this->Form->input("$k.Student.address",array('label' => false,'class'=>'form-control','placeholder'=>__('Address'),'div'=>false));?>
		</div>
		<label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Phone');?><span class="text-danger"> *</span></small></label>
		<div class="col-sm-4">
		    <?php echo $this->Form->input("$k.Student.phone",array('label' => false,'class'=>'form-control','placeholder'=>__('Phone'),'div'=>false));?>
		</div>
	    </div>
	    <div class="form-group">
		<label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Guardian Phone');?></small></label>
		<div class="col-sm-4">
		    <?php echo $this->Form->input("$k.Student.guardian_phone",array('label' => false,'class'=>'form-control','placeholder'=>__('Guardian Phone'),'div'=>false));?>
		</div>
		<label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Enrolment Number');?></small></label>
		<div class="col-sm-4">
		    <?php echo $this->Form->input("$k.Student.enroll",array('label' => false,'class'=>'form-control','placeholder'=>__('Enrolment Number'),'div'=>false));?>
		</div>
	    </div>
	    <div class="form-group">
		<label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Expiry Days');?> (<?php echo __('0 for Unlimited');?>)</small></label>
		<div class="col-sm-4">
		    <?php echo $this->Form->input("$k.Student.expiry_days",array('label' => false,'class'=>'form-control','placeholder'=>__('0 for Unlimited'),'div'=>false,'default'=>0));?>
		</div>
		<label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Renewal Date');?></small></label>
		<div class="col-sm-4">
		    <div class="input-group date start_date">
			<?php echo $this->Form->input("$k.Student.renewal_date",array('type'=>'text','value'=>$this->Time->format($sysDay.$dateSep.$sysMonth.$dateSep.$sysYear,$post['Student']['renewal_date']),'label' => false,'class'=>'form-control','div'=>false));?>
			<span class="input-group-addon"><span class="fa fa-calendar"></span></span>
		    </div>
		</div>
		
	    </div>
					    <div class="form-group text-left">
						    <div class="col-sm-offset-2 col-sm-7">
							    <?php echo $this->Form->input("$k.Student.id", array('type' => 'hidden'));?>                            
						    </div>
					    </div> 
					</div>
				</div>
					</div>				
                    <?php endforeach; ?>
                        <?php unset($post); ?>
                        <div class="form-group text-left">
                        <div class="col-sm-offset-2 col-sm-7">                            
                            <?php echo$this->Form->button('<span class="fa fa-refresh"></span>&nbsp;'.__('Update'),array('class'=>'btn btn-success','escpae'=>false));?>
		    <?php if(!$isError){?><button type="button" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-remove"></span>&nbsp;<?php echo __('Cancel');?></button><?php }else{
			echo$this->Html->link('<span class="fa fa-close"></span>&nbsp;'.__('Close'),array('action'=>'index'),array('class'=>'btn btn-danger','escape'=>false));}?>
                        </div>
                    </div>
                <?php echo $this->Form->end();?>
        </div>
    </div>
</div>