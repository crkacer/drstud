<?php
 $this->Js->JqueryEngine->jQueryObject = 'jQuery';
// Paginator options
$this->Paginator->options(array(
  'update' => '#resultDiv',
  'evalScripts' => true,
));
?>
<div id="resultDiv"> 
<div class="page-title"> <div class="title-env"> <h1 class="title"><?php echo __('Users/Teachers');?></h1></div></div>
<div class="panel">
<?php echo $this->Session->flash();?>
    <div class="panel-heading">
	<div class="btn-group">
            <?php $url=$this->Html->url(array('controller'=>'Users')); if($userPermissionArr['save_right']){ echo $this->Html->link('<span class="fa fa-plus-circle"></span>&nbsp;'.__('Add New User/Teacher'),array('controller'=>'Users','action'=>'add'),array('escape'=>false,'class'=>'btn btn-success'));}?>
            <?php if($userPermissionArr['update_right']){ echo $this->Html->link('<span class="fa fa-edit"></span>&nbsp;'.__('Edit'),'javascript:void(0);',array('name'=>'editallfrm','id'=>'editallfrm','onclick'=>"check_perform_edit('$url');",'escape'=>false,'class'=>'btn btn-warning'));}?>
            <?php if($userPermissionArr['delete_right']){ echo $this->Html->link('<span class="fa fa-trash"></span>&nbsp;'.__('Delete'),'javascript:void(0);',array('name'=>'deleteallfrm','id'=>'deleteallfrm','onclick'=>'check_perform_delete();','escape'=>false,'class'=>'btn btn-danger'));}?>
            <?php echo $this->Html->link('<span class="fa fa-plus-circle"></span>&nbsp;'.__('Assign Form Rights'),array('action'=>'assignrights'),array('escape'=>false,'class'=>'btn btn-success'));?>
        </div>
    </div>
        <?php if($userPermissionArr['search_right'])echo $this->element('pagination');
	else echo $this->element('pagination',array('IsSearch'=>'No'));
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
			    <th><?php echo $this->Paginator->sort('Ugroup.name', __('Level'), array('direction' => 'asc'));?></th>
                            <th><?php echo $this->Paginator->sort('username', __('User Name'), array('direction' => 'asc'));?></th>
                            <th><?php echo $this->Paginator->sort('name', __('Name'), array('direction' => 'asc'));?></th>
                            <th><?php echo $this->Paginator->sort('email', __('Email'), array('direction' => 'asc'));?></th>
                            <th><?php echo $this->Paginator->sort('mobile', __('Mobile'), array('direction' => 'asc'));?></th>
                            <th><?php echo __('Groups');?></th>
                            <th><?php echo $this->Paginator->sort('status', __('Status'), array('direction' => 'asc'));?></th>
                            <?php if($userPermissionArr['update_right'] || $userPermissionArr['delete_right']){?><th><?php echo __('Action');?></th><?php }?>
                        </tr>
                        <?php foreach ($User as $post):
                        $id=$post['User']['id'];?>
                        <tr>
                            <td><?php echo $this->Form->checkbox(false,array('value' => $post['User']['id'],'name'=>'data[User][id][]','id'=>"DeleteCheckbox$id",'class'=>'chkselect'));?></td>
                            <td><?php echo $serial_no++; ?></td>
			    <td><?php echo h($post['Ugroup']['name']); ?></td>
                            <td><?php echo h($post['User']['username']); ?></td>
                            <td><?php echo h($post['User']['name']); ?></td>
                            <td><?php echo h($post['User']['email']); ?></td>
                            <td><?php echo h($post['User']['mobile']); ?></td>
			    <td><?php echo $this->Function->showGroupName($post['Group']);?></td>
                            <td><span class="label label-<?php if($post['User']['status']=="Active")echo"success";else echo"danger";?>"><?php echo __($post['User']['status']); ?></span></td>
                            <?php if($userPermissionArr['update_right'] || $userPermissionArr['delete_right']){?><td>
			    <div class="btn-group">
			    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
			    <?php echo __('Action');?> <span class="caret"></span>&nbsp;
			    </button>
			    <ul class="dropdown-menu" role="menu">
			    <?php if($userPermissionArr['update_right']){?><li><?php echo $this->Html->link('<span class="fa fa-edit"></span>&nbsp;'.__('Edit'),'javascript:void(0);',array('name'=>'editallfrm','onclick'=>"check_perform_sedit('$url','$id');",'escape'=>false));?></li><?php }?>
                            <?php if($id!=1){ if($userPermissionArr['delete_right']){ ?><li><?php echo $this->Html->Link('<span class="fa fa-trash"></span>&nbsp;'.__('Delete'),'javascript:void(0);',array('onclick'=>"check_perform_sdelete('$id');",'escape'=>false));?></li><?php }}?>
			    </ul>
			    </div>
			    </td><?php }?>
			</tr>
                        <?php endforeach; ?>
                        <?php unset($post); ?>
                        </table>
                </div>
        <?php echo $this->Form->end();?>
	<?php if($userPermissionArr['search_right'])echo $this->element('pagination');
	else echo $this->element('pagination',array('IsSearch'=>'No'));?>
    </div>
</div>

</div>