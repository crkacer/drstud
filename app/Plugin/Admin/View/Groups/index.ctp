<?php
 $this->Js->JqueryEngine->jQueryObject = 'jQuery';
// Paginator options
$this->Paginator->options(array(
  'update' => '#resultDiv',
  'evalScripts' => true,
));
?>
<div id="resultDiv"> 
<div class="page-title"> <div class="title-env"> <h1 class="title"><?php echo __('Groups');?></h1></div></div>
<div class="panel">
<?php echo $this->Session->flash();?>
    <div class="panel-heading">
	<div class="btn-group">
            <?php $url=$this->Html->url(array('controller'=>'Groups')); if($userPermissionArr['save_right']){ echo $this->Html->link('<span class="fa fa-plus-circle"></span>&nbsp;'.__('Add New Group'),array('controller'=>'Groups','action'=>'add'),array('escape'=>false,'escape'=>false,'class'=>'btn btn-success'));}?>
            <?php if($userPermissionArr['update_right']){ echo $this->Html->link('<span class="fa fa-edit"></span>&nbsp;'.__('Edit'),'javascript:void(0);',array('type'=>'button','name'=>'editallfrm','id'=>'editallfrm','onclick'=>"check_perform_edit('$url');",'escape'=>false,'class'=>'btn btn-warning'));}?>
            <?php if($userPermissionArr['delete_right']){ echo $this->Html->link('<span class="fa fa-trash"></span>&nbsp;'.__('Delete'),'javascript:void(0);',array('type'=>'button','name'=>'deleteallfrm','id'=>'deleteallfrm','onclick'=>'check_perform_delete();','escape'=>false,'class'=>'btn btn-danger'));}?>
        </div>
    </div>	
<?php if($userPermissionArr['search_right'])echo $this->element('pagination');
	else echo $this->element('pagination',array('IsSearch'=>'No'));
$page_params = $this->Paginator->params();
$limit = $page_params['limit'];
$page = $page_params['page'];
$serialNo = 1*$limit*($page-1)+1;?>    
<?php echo $this->Form->create(array('name'=>'deleteallfrm','action' => 'deleteall'));?>    
    <div class="panel-body">
	<div class="table-responsive">
	    <table class="table table-striped table-bordered">
		<tr>
		    <th><?php echo $this->Form->checkbox('checkbox', array('value'=>'deleteall','name'=>'selectAll','label'=>false,'id'=>'selectAll','hiddenField'=>false));?></th>
		    <th><?php echo $this->Paginator->sort('id', __('#'), array('direction' => 'desc'));?></th>
		    <th><?php echo $this->Paginator->sort('group_name',__('Group Name'), array('direction' => 'asc'));?></th>
		    <th><?php echo $this->Paginator->sort('price',__('Price'), array('direction' => 'asc'));?></th>
		    <th><?php echo $this->Paginator->sort('day',__('Days to expire'), array('direction' => 'asc'));?></th>
		    <?php if($userPermissionArr['update_right'] || $userPermissionArr['delete_right'] || $userPermissionArr['view_right']){?><th><?php echo __('Action');?></th><?php }?>
		</tr>
		<?php foreach ($Group as $post):
		$id=$post['Group']['id'];?>
		<tr>
		    <td><?php echo $this->Form->checkbox(false,array('value' => $post['Group']['id'],'name'=>'data[Group][id][]','id'=>"DeleteCheckbox$id",'class'=>'chkselect'));?></td>
		    <td><?php echo $serialNo++; ?></td>
		    <td><?php echo h($post['Group']['group_name']); ?></td>
		    <td><?php echo $post['Group']['price'];?></td>
		    <td><?php if($post['Group']['day'] == 0) echo 'Unlimited'; else echo h($post['Group']['day']);?></td>
		    <?php if($userPermissionArr['update_right'] || $userPermissionArr['delete_right'] || $userPermissionArr['view_right']){?><td><div class="btn-group">
		    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
		    <?php echo __('Action');?> <span class="caret"></span>
		    </button>
		    <ul class="dropdown-menu" role="menu">
		    <?php if($userPermissionArr['view_right']){?><li><?php echo $this->Html->link('<span class="fa fa-arrows-alt"></span>&nbsp;'.__('View'),'javascript:void(0);',array('onclick'=>"show_modal('$url/View/$id');",'escape'=>false));?></li><?php }?>
		    <?php if($userPermissionArr['update_right']){?><li><?php echo $this->Html->link('<span class="fa fa-edit"></span>&nbsp;'.__('Edit'),'javascript:void(0);',array('name'=>'editallfrm','onclick'=>"check_perform_sedit('$url','$id');",'escape'=>false));?></li><?php }?>
		    <?php if($userPermissionArr['delete_right']){?><li><?php echo $this->Html->link('<span class="fa fa-trash"></span>&nbsp;'.__('Delete'),'javascript:void(0);',array('onclick'=>"check_perform_sdelete('$id');",'escape'=>false));?></li><?php }?>
		    </ul>
		    </div></td><?php }?>
		</tr>
		<?php endforeach; ?>
		<?php unset($post); ?>
	    </table>
	</div>
	
	<?php echo $this->Form->end();?>	
    
    <?php if($userPermissionArr['search_right'])echo $this->element('pagination');
	else echo $this->element('pagination',array('IsSearch'=>'No'));?>
    
</div></div>
</div>
