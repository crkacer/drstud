<?php
 $this->Js->JqueryEngine->jQueryObject = 'jQuery';
// Paginator options
$this->Paginator->options(array(
  'update' => '#resultDiv',
  'evalScripts' => true,
));
?>
<?php echo$this->html->link('<span class="glyphicon glyphicon-arrow-left"></span>&nbsp;'.__('Back'),array('controller'=>'Mygroups','action'=>'index'),array('class'=>'btn btn-info','escape'=>false));?>
<div id="resultDiv">
     <?php $url=$this->Html->url(array('controller'=>'Subjects'));?>
     <?php echo $this->Session->flash();?>
     <div class="page-title-breadcrumb">
	 <div class="page-header pull-left">
	     <div class="page-title"><?php echo __('Subjects');?></div>
	 </div>
     </div>
     <div class="panel">
	   <?php echo $this->element('pagination',array('IsSearch'=>'No','IsDropdown'=>'No'));
	   $page_params = $this->Paginator->params();
	   $limit = $page_params['limit'];
	   $page = $page_params['page'];
	   $serial_no = 1*$limit*($page-1)+1;?>
	   <div class="panel-body">
		 <div class="table-responsive">
		       <table class="table table-striped">
		       <tr>
			       <th><?php echo __('S.No.');?></th>
			       <th><?php echo __('Name');?></th>
		               <th><?php echo __('Lesson');?></th>
		       </tr>
		       <?php foreach($Subject as $post): $id=$post['Subject']['id'];?>
		       <tr>
			       <td><?php echo$serial_no++;?></td>
			       <td><?php echo h($post['Subject']['subject_name']);?></td>
			       <td><?php echo $this->Html->link('<span class="fa fa-list"></span>&nbsp;'.__('Lesson'),'javascript:void(0);',array('onclick'=>"show_modal('$url/lesson/$id');",'escape'=>false,'class'=>'btn btn-warning'));?>			      
		       </tr>		       
		       <?php endforeach;unset($post);?>
		       </table>
		 </div>
	   </div>
     </div>
</div>
<div class="modal fade" id="targetModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-content">        
  </div>
</div>