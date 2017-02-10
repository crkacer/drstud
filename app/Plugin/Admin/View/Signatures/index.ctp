
<div class="page-title"> <div class="title-env"> <h1 class="title"><?php echo __('Certificate Signature');?></h1></div></div>
<div class="panel">
    <div class="panel-heading">
    </div>         
    <div class="panel-body">  <?php echo $this->Session->flash();?>      
        <?php echo $this->Form->create('Signature', array( 'controller' => 'Signatures','name'=>'post_req','id'=>'post_req','class'=>'form-horizontal','type'=>'file'));?>
        <div class="form-group">
            <label for="group_name" class="col-sm-3 control-label"><small><?php echo __('Upload Image(* height less than 75px)');?></small></label>
            <div class="col-sm-6">
               <?php echo $this->Form->input('signature',array('type' => 'file','label' => false,'div'=>false));?>
            </div>
        </div>
        <div class="form-group text-left">
            <div class="col-sm-offset-3 col-sm-7">
	    <?php if($userPermissionArr['save_right']){ echo$this->Form->button('<span class="fa fa-plus-circle"></span>&nbsp;'.__('Save'),array('class'=>'btn btn-success','escpae'=>false));}?>
            <?php if($userPermissionArr['delete_right']){ echo $this->Html->link('<span class="fa fa-trash"></span>&nbsp;'.__('Delete Signature'),array('controller'=>'Signatures','action'=>'Signaturedel'),array('escape'=>false,'class'=>'btn btn-danger'));}?>
            </div>
        </div>
    <?php echo $this->Form->end();?>
    </div>
</div>