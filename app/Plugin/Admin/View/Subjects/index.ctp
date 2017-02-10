<?php
 $this->Js->JqueryEngine->jQueryObject = 'jQuery';
// Paginator options
$this->Paginator->options(array(
  'update' => '#resultDiv',
  'evalScripts' => true,
));
?>
<div id="resultDiv"> 
<div class="page-title"> <div class="title-env"> <h1 class="title"><?php echo __('Subjects');?></h1></div></div>
<div class="panel">
<?php echo $this->Session->flash();?>
    <div class="panel-heading">
	<div class="btn-group">
            <?php $url=$this->Html->url(array('controller'=>'Subjects')); if($userPermissionArr['save_right']){ echo $this->Html->link('<span class="fa fa-plus-circle"></span>&nbsp;'.__('Add New Subject'),array('controller'=>'Subjects','action'=>'add'),array('escape'=>false,'class'=>'btn btn-success'));}?>
            <?php if($userPermissionArr['update_right']){ echo $this->Html->link('<span class="fa fa-edit"></span>&nbsp;'.__('Edit'),'javascript:void(0);',array('name'=>'editallfrm','id'=>'editallfrm','onclick'=>"check_perform_edit('$url');",'escape'=>false,'class'=>'btn btn-warning'));}?>
            <?php if($userPermissionArr['delete_right']){ echo $this->Html->link('<span class="fa fa-trash"></span>&nbsp;'.__('Delete'),'javascript:void(0);',array('name'=>'deleteallfrm','id'=>'deleteallfrm','onclick'=>'check_perform_delete();','escape'=>false,'class'=>'btn btn-danger'));}?>
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
                            <th><?php echo $this->Paginator->sort('subject_name', __('Subject Name'), array('direction' => 'asc'));?></th>
                            <th><?php echo __('Groups');?></th>
			    <th><?php echo __('Question Bank');?></th>
                            <?php if($userPermissionArr['update_right'] || $userPermissionArr['delete_right']){?><th><?php echo __('Action');?></th><?php }?>                       
                        </tr>
                        <?php foreach ($Subject as $post):
                        $id=$post['Subject']['id'];?>
                        <tr>
                            <td><?php echo $this->Form->checkbox(false,array('value' => $post['Subject']['id'],'name'=>'data[Subject][id][]','id'=>"DeleteCheckbox$id",'class'=>'chkselect'));?></td>
                            <td><?php echo $serial_no++; ?></td>
                            <td><?php echo h($post['Subject']['subject_name']); ?></td>
                            <td><?php echo $this->Function->showGroupName($post['Group']);?></td>
                            <td><?php echo $post['Subject']['qbank_count']; ?></td>
			    <?php if($userPermissionArr['update_right'] || $userPermissionArr['delete_right']){?><td><div class="btn-group">
			    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
			    <?php echo __('Action');?> <span class="caret"></span>
			    </button>
			    <ul class="dropdown-menu" role="menu">
			    <?php if($userPermissionArr['update_right']){?><li><?php echo $this->Html->link('<span class="fa fa-plus-circle"></span>&nbsp;'.__('Add Question'),array('controller'=>'Questions','action'=>'add',$post['Subject']['id']),array('escape'=>false));?></li><?php }?>
                            <?php if($userPermissionArr['update_right']){?><li><?php echo $this->Html->link('<span class="fa fa-edit"></span>&nbsp;'.__('Edit'),'javascript:void(0);',array('name'=>'editallfrm','onclick'=>"check_perform_sedit('$url','$id');",'escape'=>false));?></li><?php }?>
                            <?php if($userPermissionArr['delete_right']){?><li><?php echo $this->Html->Link('<span class="fa fa-trash"></span>&nbsp;'.__('Delete'),'javascript:void(0);',array('onclick'=>"check_perform_sdelete('$id');",'escape'=>false));?></li><?php }?>
                            </ul>
			    </div></td><?php }?>	    
                        </tr>
                        <?php endforeach; ?>
                        <?php unset($post); ?>
                        </table>
                </div>
        <?php if($userPermissionArr['search_right'])echo $this->element('pagination');
	else echo $this->element('pagination',array('IsSearch'=>'No'));?>
    </div>
</div>

</div>