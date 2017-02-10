<?php
 $this->Js->JqueryEngine->jQueryObject = 'jQuery';
// Paginator options
$this->Paginator->options(array(
  'update' => '#resultDiv',
  'evalScripts' => true,
));
?>
<div id="resultDiv"> 
<div class="page-title"> <div class="title-env"> <h1 class="title"><?php echo __('Questions');?></h1></div></div>
<div class="panel">
<?php echo $this->Session->flash();?>
    <div class="panel-heading">
   	<div class="btn-group">
            <?php $url=$this->Html->url(array('controller'=>'Questions')); if($userPermissionArr['save_right']){ echo $this->Html->link('<span class="fa fa-plus-circle"></span>&nbsp;'.__('Add New Question'),array('action'=>'add'),array('escape'=>false,'class'=>'btn btn-success'));}?>
            <?php if($userPermissionArr['delete_right']){ echo $this->Html->link('<span class="fa fa-trash"></span>&nbsp;'.__('Delete'),'javascript:void(0);',array('name'=>'deleteallfrm','id'=>'deleteallfrm','onclick'=>'check_perform_delete();','escape'=>false,'class'=>'btn btn-danger'));}?>
            <?php echo $this->Html->link('<span class="fa fa-exchange"></span>&nbsp;'.__('Import/Export Question'),array('controller'=>'Iequestions'),array('name'=>'ieq','id'=>'ieq','escape'=>false,'class'=>'btn btn-info'));?>
        </div>
	 <?php echo $this->Form->create(array('name'=>'searchfrm','action' => "index"));?>
		<div class="row mrg">
		    <div  class="col-md-3">
			<?php
			echo $this->Form->input('subject_ids',array('options'=>array($subjectId),'empty'=>__('Subject'),'class'=>'form-control','id'=>'subjectId','div'=>false,'label'=>false));?>
		    </div>
		    <div  class="col-md-3">
			<?php echo $this->Form->input('qtype_ids',array('options'=>array($qtypeId),'empty'=>__('Question Type'),'class'=>'form-control','div'=>false,'label'=>false));?>
		    </div>
		    <div  class="col-md-3">
			<?php echo $this->Form->input('diff_ids',array('options'=>array($diffId),'empty'=>__('Difficulty Level'),'class'=>'form-control','div'=>false,'label'=>false));?>
		    </div>
		    <div  class="col-md-3">
			<button type="submit" class="btn btn-success"><span class="fa fa-search"></span>&nbsp;<?php echo __('Search');?></button>
			<?php echo$this->Html->link('<span class="fa fa-refresh"></span>&nbsp;'.__('Reset'),array('controller'=>'Questions','action'=>'index'),array('class'=>'btn btn-warning','escape'=>false));?>
		    </div>
		</div>
	       <?php echo$this->Form->end();?>
    </div>
        <?php echo $this->element('pagination',array('IsSearch'=>'No'));
        $page_params = $this->Paginator->params();
        $limit = $page_params['limit'];
        $page = $page_params['page'];
        $serial_no = 1*$limit*($page-1)+1;?>
        <?php echo $this->Form->create(array('name'=>'deleteallfrm','action' => 'deleteall'));?>
<div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <tr>
                            <th><?php echo $this->Form->checkbox('checkbox', array('value'=>'deleteall','name'=>'selectAll','label'=>false,'id'=>'selectAll','hiddenField'=>false));?></th>
                            <th><?php echo $this->Paginator->sort('id', __('#'), array('direction' => 'desc'));?></th>
                            <th ><?php echo $this->Paginator->sort('question', __('Question'), array('direction' => 'asc'));?></th>
                            <th><?php echo $this->Paginator->sort('Subject.subject_name',__('Subject'),array('direction'=>'asc'));?></th>
                            <th><?php echo __('Group');?></th>
                            <?php if($userPermissionArr['view_right'] || $userPermissionArr['update_right'] || $userPermissionArr['delete_right']){?><th><?php echo __('Action');?></th><?php }?>                        
                        </tr>
                        <?php foreach ($Question as $post):
                        $id=$post['Question']['id'];?>
                        <tr>
                            <td><?php echo $this->Form->checkbox(false,array('value' => $post['Question']['id'],'name'=>'data[Question][id][]','id'=>"DeleteCheckbox$id",'class'=>'chkselect'));?></td>
                            <td><?php echo $serial_no++; ?></td>
                            <td ><?php echo str_replace("<script","",($post['Question']['question'])); ?></td>
                            <td><?php echo h($post['Subject']['subject_name']); ?></td>
                            <td><?php echo $this->Function->showGroupName($post['Group']);?></td>
			    <?php if($userPermissionArr['view_right'] || $userPermissionArr['update_right'] || $userPermissionArr['delete_right']){?><td class="pbutton"><div class="btn-group">
			    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
			    <?php echo __('Action');?> <span class="caret"></span>
			    </button>
			    <ul class="dropdown-menu" role="menu">
			    <?php if($userPermissionArr['view_right']){?><li><?php echo $this->Html->link('<span class="fa fa-arrows-alt"></span>&nbsp;'.__('View'),'javascript:void(0);',array('onclick'=>"show_modal('$url/viewquestion/$id');",'escape'=>false));?></li><?php }?>
			    <?php if($userPermissionArr['update_right']){?><li><?php echo $this->Html->link('<span class="fa fa-edit"></span>&nbsp;'.__('Edit'),'javascript:void(0);',array('name'=>'editallfrm','onclick'=>"check_perform_sedit('$url','$id');",'escape'=>false));?></li><?php }?>
			    <?php if($userPermissionArr['delete_right']){?><li><?php echo $this->Html->Link('<span class="fa fa-trash"></span>&nbsp;'.__('Delete'),'javascript:void(0);',array('onclick'=>"check_perform_sdelete('$id');",'escape'=>false));?></li><?php }?>
			    </ul>
			  </div></td><?php }?>
                        </tr>
                        <?php endforeach; ?>
                        <?php unset($post); ?>
                        </table>
                </div>
        <?php echo $this->Form->end();?>
	<?php echo $this->element('pagination',array('IsSearch'=>'No'));?>
    </div>
</div>
</div>