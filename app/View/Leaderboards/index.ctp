<?php echo $this->Session->flash();?>
<div class="page-title-breadcrumb">
    <div class="page-header pull-left">
	<div class="page-title"><?php echo __('Leader Board');?></div>
    </div>
</div>
<div class="panel">
    <div class="panel-body">
	<div class="table-responsive">
	    <table class="table table-striped">
		<tr>
		    <th><?php echo __('Rank');?></th>
		    <th><?php echo __('Name');?></th>
		    <th><?php echo __('Average Percentage(%)');?></th>
		    <th><?php echo __('Quiz Given');?></th>
		</tr>
		<?php foreach($scoreboard as $k=>$post):$k++?>
		<tr>
		    <td><?php echo$k;?></td>
		    <td><?php echo h($post['Selection']['name']);?></td>
		    <td><?php echo$post['Selection']['points'];?>%</td>
		    <td><?php echo$post['Selection']['exam_given'];?></td>
		</tr>
		<?php endforeach;unset($post);?>
	    </table>
	</div>
    </div>
</div>