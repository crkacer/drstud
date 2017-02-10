<div class="col-md-9 col-sm-offset-2">
    <div class="panel panel-default">
	<div class="panel-heading"><strong><?php echo$post['Exam']['name'];?></strong></div>
	<div class="panel-body">	    
	    <div class="col-xs-12 col-sm-12 progress-container">
		<div class="progress active">
		    <div class="progress-bar progress-bar-success" style="width:0%"></div>
		</div>
	    </div>    
	    <div id="slider">
		<div class="wrap"> 
		    <div class="panel">
			<div class="row">
			    <div class="col-md-6 dg-content"><?php echo __('Please close all of your chat windows, screen-saver, and anti-virus programs before starting your test');?></div>
			    <div class="col-md-6">
				<div class="dg-icon step-1"></div>
			    </div>
			</div>
		    </div> 
		    <div class="panel">
			<div class="col-md-6 dg-content">
			<?php echo __('Please do not press "F5" during your test. This will finish your test and you will not be able to re-open the test');?>
			</div>
			<div class="col-md-6">
			    <div class="dg-icon step-2"></div>
			</div>
		    </div> 
		    <div class="panel">
			<div class="col-md-6 dg-content">
			<?php echo __('Your responses will be saved. If your test is disconnected for any reason, your responses up until that point will be saved');?>
			</div>
			<div class="col-md-6">
			    <div class="dg-icon step-3"></div>
			</div>
		    </div>
		    <div class="panel">
			<div class="col-md-6 dg-content">
			<?php echo __('Please close all programs that upload or download files in the background For example: Dropbox, torrent, etc');?><br/>
			    <?php echo$this->Html->link(__('Next'),array('action'=>'instruction',$post['Exam']['id']),array('class'=>'btn btn-info'));?>
			</div>
			<div class="col-md-6">
			    <div class="dg-icon step-4"></div>
			</div>
		    </div>
		</div>
	    </div>
	</div>
    </div>
</div>
<?php echo $this->Html->script('progress');
echo $this->fetch('script');
echo $this->Js->writeBuffer();?>