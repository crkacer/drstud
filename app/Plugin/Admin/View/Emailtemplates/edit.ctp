<div <?php if(!$isError){?>class="container"<?php }?>>    
    <div class="panel panel-custom mrg">
        <div class="panel-heading"><?php echo __('Edit Email Templates');?><?php if(!$isError){?><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><?php }?></div>
                <div class="panel-body">
					<?php echo $this->Form->create('Emailtemplate', array('class'=>'form-horizontal'));?>
					<?php foreach ($Emailtemplate as $k=>$post): $id=$post['Emailtemplate']['id'];$form_no=$k+1;?>
						<div class="panel panel-default">
							<div class="panel-heading"><strong><small class="text-danger"><?php echo __('Form');?> <?php echo$form_no?></small></strong></div>
		  <div class="panel-body">
		    <div class="form-group">
			  <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Name');?>:</small></label>
			  <div class="col-sm-10">
			     <?php echo $this->Form->input("$k.Emailtemplate.name",array('label' => false,'class'=>'form-control','placeholder'=>__('Name'),'div'=>false));?>
			  </div>
		    </div>
		     <div class="form-group">
			  <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Email Template');?>:</small></label>
			  <div class="col-sm-10">
			     <?php echo $this->Tinymce->input("$k.Emailtemplate.description",array('label' => false,'class'=>'form-control','placeholder'=>__('Email Template'),'div'=>false),array('language'=>$configLanguage,'directionality'=>$dirType),'absolute');?>
			  </div>
		    </div>
		    <div class="form-group">
                <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Status');?>:</small></label>
                <div class="col-sm-10">
		<?php
		$option=array('Published'=>__('Published'),'Unpublished'=>__('Unpublished'));
		?>
                   <?php echo $this->Form->select("$k.Emailtemplate.status",$option,array('label' => false,'class'=>'form-control','empty'=>false,'div'=>false));?>
                </div>
            </div>
	
		      <div class="form-group text-left">
			  <div class="col-sm-6">
			      <?php echo $this->Form->input("$k.Emailtemplate.id",array('type' => 'hidden'));?>
			  </div>
		      </div>
		  </div>
		</div>
                    <?php endforeach; ?>
                        <?php unset($post); ?>
                        <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-6">                            
                             <?php echo$this->Form->button('<span class="fa fa-refresh"></span> '.__('Update'),array('class'=>'btn btn-success','escpae'=>false));?>
		    <?php if(!$isError){?><button type="button" class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> <?php echo __('Cancel');?></button><?php }else{
			echo$this->Html->link('<span class="fa fa-close"></span> '.__('Close'),array('action'=>'index'),array('class'=>'btn btn-danger','escape'=>false));}?>     </div>
                    </div>
                <?php echo$this->Form->end();?>
                </div>
            </div>
        </div>
    