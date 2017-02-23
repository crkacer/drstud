<?php
 $this->Js->JqueryEngine->jQueryObject = 'jQuery';
// Paginator options
$this->Paginator->options(array(
  'update' => '#resultDiv',
  'evalScripts' => true,
));
?>
<div id="resultDiv"> 

<div class="page-title"> <div class="title-env"> <h1 class="title"><?php echo __('Homework Phonic');?></h1></div></div>
<div class="panel"><?php echo $this->Session->flash();?>
    <?php $url=$this->Html->url(array('controller'=>'HomeworkPhonic')); 
        if($userPermissionArr['search_right'])echo $this->element('pagination');
        else echo $this->element('pagination',array('IsSearch'=>'No'));
        $page_params = $this->Paginator->params();
        $limit = $page_params['limit'];
        $page = $page_params['page'];
        $serial_no = 1*$limit*($page-1)+1;?>
        <?php echo $this->Form->create(array('name'=>'deleteallfrm','action' => 'deleteall'));?>
        <?php echo $this->Session->flash();?>
<div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <tr>
                            <th><?php echo $this->Form->checkbox('checkbox', array('value'=>'deleteall','name'=>'selectAll','label'=>false,'id'=>'selectAll','hiddenField'=>false));?></th>
                            <th><?php echo $this->Paginator->sort('student_id', __('#'), array('direction' => 'desc'));?></th>
                            <th><?php echo $this->Paginator->sort('student_name', __('Student ID'), array('direction' => 'asc'));?></th>
                            <th><?php echo $this->Paginator->sort('student_name', __('Student Name'), array('direction' => 'asc'));?></th>
                            <th><?php echo $this->Paginator->sort('question_type', __('Question Type'), array('direction' => 'asc'));?></th>
                            <th><?php echo $this->Paginator->sort('question', __('Question'), array('direction' => 'asc'));?></th>
                            <?php if($userPermissionArr['update_right'] || $userPermissionArr['delete_right'] || $userPermissionArr['view_right']){?><th><?php echo __('Action');?></th><?php }?>
                        </tr>
                        <?php foreach ($HomeworkPhonic as $post):
                        $id=$post['HomeworkPhonic']['id'];?>
                        <tr>
                            <td><?php echo $this->Form->checkbox(false,array('value' => $post['HomeworkPhonic']['id'],'name'=>'data[HomeworkPhonic][id][]','id'=>"DeleteCheckbox$id",'class'=>'chkselect'));?></td>
                            <td><?php echo $serial_no++; ?></td>
                            <td><?php echo h($post['HomeworkPhonic']['student_id']); ?></td>
                            <td><?php echo h($post['HomeworkPhonic']['student_name']); ?></td>
                            <td><?php echo h($post['HomeworkPhonic']['question_type']); ?></td>
                            <td><?php echo h($post['HomeworkPhonic']['question']); ?></td>
                            <?php if($userPermissionArr['update_right'] || $userPermissionArr['delete_right'] || $userPermissionArr['view_right']){?><td><div class="btn-group">
                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                <?php echo __('Action');?> <span class="caret"></span>&nbsp;
                </button>
                <ul class="dropdown-menu" role="menu">
                <?php if($userPermissionArr['view_right']){ ?><li><?php echo $this->Html->link('<span class="fa fa-arrows-alt"></span>&nbsp;'.__('View'),'javascript:void(0);',array('onclick'=>"show_modal('$url/View/$id');",'escape'=>false));?></li><?php }?>
                <?php if($userPermissionArr['delete_right']){?><li><?php echo $this->Html->Link('<span class="fa fa-trash"></span>&nbsp;'.__('Delete'),'javascript:void(0);',array('onclick'=>"check_perform_sdelete('$id');",'escape'=>false));?></li><?php }?>
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
    </div>
</div></div>