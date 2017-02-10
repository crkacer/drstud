<?php
 $this->Js->JqueryEngine->jQueryObject = 'jQuery';
// Paginator options
$this->Paginator->options(array(
  'update' => '#resultDiv',
  'evalScripts' => true,
));
?>
<div id="resultDiv"> 
<div class="page-title"> <div class="title-env"> <h1 class="title"><?php echo __('Students');?></h1></div></div>
<div class="panel">
<?php echo $this->Session->flash();?>
    <div class="panel-heading">
	<div class="btn-group">
            <?php $url=$this->Html->url(array('controller'=>'Students')); if($userPermissionArr['save_right']){ echo $this->Html->link('<span class="fa fa-plus-circle"></span>&nbsp;'.__('Add New Student'),array('controller'=>'Students','action'=>'add'),array('escape'=>false,'class'=>'btn btn-success'));}?>
            <?php if($userPermissionArr['update_right']){ echo $this->Html->link('<span class="fa fa-edit"></span>&nbsp;'.__('Edit'),'javascript:void(0);',array('name'=>'editallfrm','id'=>'editallfrm','onclick'=>"check_perform_edit('$url');",'escape'=>false,'class'=>'btn btn-warning'));}?>
            <?php if($userPermissionArr['delete_right']){ echo $this->Html->link('<span class="fa fa-trash"></span>&nbsp;'.__('Delete'),'javascript:void(0);',array('name'=>'deleteallfrm','id'=>'deleteallfrm','onclick'=>'check_perform_delete();','escape'=>false,'class'=>'btn btn-danger'));}?>
	    <?php if($userPermissionArr['save_right']){echo $this->Html->link('<span class="fa fa-exchange"></span>&nbsp;'.__('Import/Export Students'),array('controller'=>'Iestudents'),array('escape'=>false,'class'=>'btn btn-default'));}?>
            <?php if($frontExamPaid>0){if($userPermissionArr['update_right']){echo $this->Html->link('<span class="fa fa-shopping-cart"></span>&nbsp;'.__('Wallet'),'javascript:void(0);',array('name'=>'walletallfrm','id'=>'walletallfrm','onclick'=>"check_perform_select('$url','wallet');",'escape'=>false,'class'=>'btn btn-info'));}
            if($userPermissionArr['update_right']){echo $this->Html->link('<span class="fa fa-briefcase"></span>&nbsp;'.__('Transaction History'),array('controller'=>'Students','action'=>'trnhistory'),array('escape'=>false,'class'=>'btn btn-primary'));}}?>
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
                            <th><?php echo $this->Paginator->sort('email', __('Email'), array('direction' => 'asc'));?></th>
			    <th><?php echo $this->Paginator->sort('name', __('Name'), array('direction' => 'asc'));?></th>
                            <th><?php echo $this->Paginator->sort('phone', __('Phone'), array('direction' => 'asc'));?></th>
                            <th><?php echo __('Groups');?></th>
                            <th><?php echo $this->Paginator->sort('created', __('Admission Date'), array('direction' => 'asc'));?></th>
                            <th><?php echo $this->Paginator->sort('status', __('Status'), array('direction' => 'asc'));?></th>
                            <?php if($userPermissionArr['view_right'] || $userPermissionArr['update_right'] || $userPermissionArr['delete_right']){?><th><?php echo __('Action');?></th><?php }?>
                        </tr>
                        <?php foreach ($Student as $post):
                        $id=$post['Student']['id'];
                        ?>
                        <tr>
                            <td><?php echo $this->Form->checkbox(false,array('value' => $post['Student']['id'],'name'=>'data[Student][id][]','id'=>"DeleteCheckbox$id",'class'=>'chkselect'));?></td>
                            <td><?php echo $serial_no++; ?></td>
                            <td  <?php echo($post['Student']['reg_status']=="Live") ? "class=\"danger\"" : "";?>><?php echo $post['Student']['email']; ?></td>
                            <td><?php echo h($post['Student']['name']); ?></td>
			    <td><?php echo h($post['Student']['phone']); ?></td>
                            <td><?php echo $this->Function->showGroupName($post['Group']);?></td>
                            <td><?php echo $this->Time->format($sysDay.$dateSep.$sysMonth.$dateSep.$sysYear,h($post['Student']['created'])); ?></td>
                            <td><span class="label label-<?php if($post['Student']['status']=="Active")echo"success";elseif($post['Student']['status']=="Pending")echo"danger";else echo"default";?>"><?php echo __($post['Student']['status']); ?></span></td>
                            <?php if($userPermissionArr['view_right'] || $userPermissionArr['update_right'] || $userPermissionArr['delete_right']){?><td><div class="btn-group">
			    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
			    <?php echo __('Action');?> <span class="caret"></span>
			    </button>
			    <ul class="dropdown-menu" role="menu">
			    <?php if($userPermissionArr['view_right']){?><li><?php echo $this->Html->link('<span class="fa fa-arrows-alt"></span>&nbsp;'.__('View'),'javascript:void(0);',array('onclick'=>"show_modal('$url/View/$id');",'escape'=>false));?></li><?php }?>
                            <li><?php if($frontExamPaid>0){if($userPermissionArr['update_right']){echo $this->Html->link('<span class="fa fa-shopping-cart"></span>&nbsp;'.__('Wallet'),'javascript:void(0);',array('name'=>'walletallfrm','onclick'=>"show_modal('$url/wallet/$id');",'escape'=>false));}}?></li>
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
	<?php if($userPermissionArr['search_right'])echo $this->element('pagination');
	else echo $this->element('pagination',array('IsSearch'=>'No'));?>
    </div>
</div>

</div>