<div class="container">
    <div class="panel panel-custom mrg">
	<?php $url=$this->Html->url(array('controller'=>'Lessons'));?>
        <div class="panel-heading"><?php echo __('Lessons');?><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button></div>
	<div class="panel-body">
	    <div class="table-responsive">
		<table class="table table-striped">
		    <tr>
			    <th><?php echo __('S.No.');?></th>
			    <th><?php echo __('Name');?></th>
			    <th><?php echo __('Lesson');?></th>
		    </tr>
		    <?php $serial_no=1; foreach($lesson as $post): $id=$post['Lesson']['id'];?>
		    <tr>
			    <td><?php echo$serial_no++;?></td>
			    <td><?php echo h($post['Lesson']['name']);?></td>
			    <td><?php	//echo $this->Html->link('<span class="fa fa-arrows-alt"></span>&nbsp;'.__('Lesson'),'javascript:void(0);',array('onclick'=>"show_modal('$url/index/$id');",'escape'=>false,'class'=>'btn btn-warning'));
					echo $this->Html->link('<span class="fa fa-list"></span>&nbsp;'.__('Lesson'),array('controller'=>'Lessons','action'=>'index',$post['Lesson']['id']),array('escape'=>false,'class'=>'btn btn-warning'));?></td>
		       </tr>
		    <?php endforeach;unset($post);?>
		</table>
	    </div>
	</div>
    </div>
</div>