	<div class="container">
		<div class="row">
		<div class="col-md-12"> 
                        <?php echo $this->Session->flash();?>
				<div class="panel panel-default mrg">
					<div class="panel-heading"><div class="widget-modal"><h4 class="widget-modal-title"><?php echo __('View Slides');?></strong></h4><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button></div></div>
					<div class="panel-body">
						<div class="col-md-12"> 
							<div class="row">
								<p><div class="img-thumbnail"><?php echo $this->Html->image($photoImg,array());?></div></p>
							</div>
						</div>
					</div>	
				</div>
        </div>
		</div>
    </div>
