<div class="container">
    <div class="panel panel-custom mrg">
        <div class="panel-heading"><?php echo __('View');?><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button></div>
    		<div class="panel-body">
		    <div class="table-responsive">
			<table class="table table-bordered">
			    <tr>
				<td><strong><small class="text-danger"><?php echo __('Name').':      ';?></small></strong><b><?php echo h($post['Lesson']['name']);?></b></td>
			    </tr>
			    <tr>
				<td><strong><small class="text-danger"><?php echo __('Sequence Order').':      ';?></small></strong><b><?php echo h($post['Lesson']['ordering']);?></b></td>
			    </tr>
			     <tr>
				<td><strong><small class="text-danger"><b><?php echo __('Description').': ';?></b></small></strong><br/><br/>
				<?php echo $post['Lesson']['description'];?></td>
			    </tr>			    
			</table>
		    </div>
		</div>
	    </div>
	</div>
    