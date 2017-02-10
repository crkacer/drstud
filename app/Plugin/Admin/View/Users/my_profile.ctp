<div class="page-title"><div class="title-env"> <h1 class="title"><?php echo __('My Profile');?></h1></div></div>
<div class="panel">
    <div class="panel-body"><?php echo $this->Session->flash();?>
	<div class="table-responsive">
	    <table class="table table-striped table-bordered">
		<tr>
		    <td><strong class="text-danger"><small><?php echo __('Groups');?></small></strong></td>
		    <td><strong><small><?php foreach($post['Group'] as $k=>$groupName):?>
                                                                                (<?php echo++$k;?>) <?php echo$groupName['group_name'];?>
                                                                                <?php endforeach;unset($groupName);unset($k);?></small></strong></td>
		</tr>
		<tr>
		    <td><strong class="text-danger"><small><?php echo __('Username');?></small></strong></td>
		    <td><strong><small><?php echo $post['User']['username'];?></small></strong></td>
		</tr>
		<tr>
		    <td><strong class="text-danger"><small><?php echo __('Name');?></small></strong></td>
		    <td><strong><small><?php echo $post['User']['name'];?></small></strong></td>
		</tr>
		<tr>
		    <td><strong class="text-danger"><small><?php echo __('Email');?></small></strong></td>
		    <td><strong><small><?php echo $post['User']['email'];?></small></strong></td>
		</tr>
		<tr>
		    <td><strong class="text-danger"><small><?php echo __('Mobile');?></small></strong></td>
		    <td><strong><small><?php echo $post['User']['mobile'];?></small></strong></td>
		</tr>
	    </table>                
	</div>
    </div>
</div>