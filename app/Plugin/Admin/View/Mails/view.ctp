<div class="container">
	<div class="panel panel-custom mrg">
        <div class="panel-heading"><?php echo h($post['Mail']['subject']);?><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button></div>
		<div class="panel-body">
			<div class="btn-group">
				<?php echo$this->Html->link('<span class="fa fa-mail-reply"></span>&nbsp;'.__('Reply'),array('controller'=>'Mails','action'=>'compose','reply',$post['Mail']['id']),array('class'=>'btn btn-primary pll prl','escape'=>false));?>
				<?php echo$this->Html->link('<span class="fa fa-mail-forward"></span>&nbsp;'.__('Forward'),array('controller'=>'Mails','action'=>'compose','forward',$post['Mail']['id']),array('class'=>'btn btn-primary pll prl','escape'=>false));?>
			</div>
			<div><?php echo str_replace("<script","",$post['Mail']['message']);?></div>
		</div>
	</div>
</div>