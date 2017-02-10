<?php
 $this->Js->JqueryEngine->jQueryObject = 'jQuery';
// Paginator options
$this->Paginator->options(array(
  'update' => '#resultDiv',
  'evalScripts' => true,
));
?>
<div id="resultDiv"> 
<div class="page-title"> <div class="title-env"> <h1 class="title"><?php echo __('Menu Names');?></h1></div></div>
<div class="panel">
<?php echo $this->Session->flash();?>
    <div class="panel-heading">
	<div class="btn-group">
            <?php $url=$this->Html->url(array('controller'=>'Menunames')); ?>
            <?php if($userPermissionArr['update_right']){ echo $this->Html->link('<span class="fa fa-edit"></span>&nbsp;'.__('Edit'),'javascript:void(0);',array('type'=>'button','name'=>'editallfrm','id'=>'editallfrm','onclick'=>"check_perform_edit('$url');",'escape'=>false,'class'=>'btn btn-warning'));}?>
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
		    <th><?php echo $this->Paginator->sort('model_name',__('Model Name'), array('direction' => 'asc'));?></th>
		    <th><?php echo $this->Paginator->sort('page_name',__('Page Name'), array('direction' => 'asc'));?></th>
		    <th><?php echo $this->Paginator->sort('icon',__('Icon'), array('direction' => 'asc'));?></th>
		    <th><?php echo $this->Paginator->sort('ordering',__('Ordering'), array('direction' => 'asc'));?></th>
		    <?php if($userPermissionArr['update_right']){?><th><?php echo __('Action');?></th><?php  }?>
		</tr>
		<?php foreach ($Group as $post):
		$id=$post['Menuname']['id'];?>
		<tr>
		    <td><?php echo $this->Form->checkbox(false,array('value' => $post['Menuname']['id'],'name'=>'data[Menuname][id][]','id'=>"DeleteCheckbox$id",'class'=>'chkselect'));?></td>
		    <td><?php echo $serialNo++; ?></td>
		    <td><?php echo h($post['Menuname']['model_name']); ?></td>
		    <td><?php echo h($post['Menuname']['page_name']); ?></td>
		    <td><?php echo h($post['Menuname']['icon']); ?></td>
		    <td><?php echo h($post['Menuname']['ordering']); ?></td>
		    <?php if($userPermissionArr['update_right']){?><td>	    
		    <?php echo $this->Html->link('<span class="fa fa-edit"></span>&nbsp;'.__('Edit'),'javascript:void(0);',array('name'=>'editallfrm','onclick'=>"check_perform_sedit('$url','$id');",'escape'=>false,'class'=>'btn btn-warning'));?>
		    </td><?php }?>
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
