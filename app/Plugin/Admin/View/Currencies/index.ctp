<?php
 $this->Js->JqueryEngine->jQueryObject = 'jQuery';
// Paginator options
$this->Paginator->options(array(
  'update' => '#resultDiv',
  'evalScripts' => true,
));
?>
<div id="resultDiv"> 
<div class="page-title"> <div class="title-env"> <h1 class="title"><?php echo __('Currency');?></h1></div></div>
<div class="panel">
<?php echo $this->Session->flash();?>
    <div class="panel-heading">
	<div class="btn-group">
            <?php $url=$this->Html->url(array('controller'=>'Currencies'));if($userPermissionArr['save_right']){ echo $this->Html->link('<span class="fa fa-plus-circle"></span>&nbsp;'.__('Add New Currency'),array('controller'=>'Currencies','action'=>'add'),array('escape'=>false,'class'=>'btn btn-success'));}?>
            <?php if($userPermissionArr['delete_right']){ echo $this->Html->link('<span class="fa fa-trash"></span>&nbsp;'.__('Delete'),'javascript:void(0);',array('name'=>'deleteallfrm','id'=>'deleteallfrm','onclick'=>'check_perform_delete();','escape'=>false,'class'=>'btn btn-danger'));}?>
        </div>
    </div>
        <?php if($userPermissionArr['search_right'])echo $this->element('pagination');
	else echo $this->element('pagination',array('IsSearch'=>'No'));
        $pageParams = $this->Paginator->params();
        $limit = $pageParams['limit'];
        $page = $pageParams['page'];
        $serialNo = 1*$limit*($page-1)+1;?>
        <?php echo $this->Form->create(array('name'=>'deleteallfrm','action' => 'deleteall'));?>

<div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <tr>
                            <th><?php echo $this->Form->checkbox('checkbox', array('value'=>'deleteall','name'=>'selectAll','label'=>false,'id'=>'selectAll','hiddenField'=>false));?></th>
                            <th><?php echo $this->Paginator->sort('id', __('#'), array('direction' => 'desc'));?></th>
                            <th><?php echo $this->Paginator->sort('name', __('Currency Name'), array('direction' => 'asc'));?></th>
			    <th><?php echo $this->Paginator->sort('short', __('Short Name'), array('direction' => 'asc'));?></th>
                            <th><?php echo __('Currency');?></th>
                            <?php if($userPermissionArr['delete_right']){?><th><?php echo __('Action');?></th><?php }?>
                        </tr>
                        <?php foreach ($Currency as $post):
                        $id=$post['Currency']['id'];?>
                        <tr>
                            <td><?php echo $this->Form->checkbox(false,array('value' => $post['Currency']['id'],'name'=>'data[Currency][id][]','id'=>"DeleteCheckbox$id",'class'=>'chkselect'));?></td>
                            <td><?php echo $serialNo++;?></td>
                            <td><?php echo h($post['Currency']['name']);?></td>
			    <td><?php echo h($post['Currency']['short']);?></td>
                            <td><?php echo $this->Html->image('currencies/'.$post['Currency']['photo'],array('height'=>'16'));?></td>
                            <?php if($userPermissionArr['delete_right']){?><td class="pbutton"><div class="btn-group">
			    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
			    <?php echo __('Action');?> <span class="caret"></span>
			    </button>
			    <ul class="dropdown-menu" role="menu">
			    <li><?php echo $this->Html->Link('<span class="fa fa-trash"></span>&nbsp;'.__('Delete'),'javascript:void(0);',array('onclick'=>"check_perform_sdelete('$id');",'escape'=>false));?></li>
			    </ul>
			  </div></td><?php }?>
                        </tr>
                        <?php endforeach;?>
                        <?php unset($post);?>
                        </table>
                </div>
		<?php echo $this->Form->end();?>
<?php if($userPermissionArr['search_right'])echo $this->element('pagination');
	else echo $this->element('pagination',array('IsSearch'=>'No'));?>

        </div>
    </div>
</div>