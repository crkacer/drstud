<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<?php echo $this->Html->charset(); ?>
	<title>
	<?php echo __('Installation Complete');?>
	</title>
	<?php
		echo $this->Html->meta('icon');
		echo $this->Html->css('bootstrap.min');
                echo $this->Html->css('style');                
		echo $this->fetch('meta');		
		echo $this->fetch('css');
                echo $this->Html->script('jquery-1.8.2.min');
		echo $this->Html->script('html5shiv');
                echo $this->Html->script('respond.min');                
                echo $this->Html->script('bootstrap.min');
                echo $this->fetch('script');
                echo $this->Js->writeBuffer();		
?>
	
</head>
  <body>
	<div class="container">
		<div class="row">	
			<div  class="col-md-12 mrg">
				<div class="panel panel-default">					
                                        <div class="panel-body">						
						<div class="col-md-12 col-sm-12 col-xs-12">
						  <div class="col-md-12 col-sm-12 col-xs-12 mrg">
						  	<div class="text-center"><?php echo$this->Html->image('logo-website.fw.png',array('alt'=>'Edu Expression','class'=>'img-responsive.img-center'));?></div>
						      <div class="text-center"><span class="text-muted"><h2><?php echo __('Aho! The System is installed  successfully.');?></h2></span></div>
						  </div>
						  <div class="col-md-6 col-sm-6 col-xs-6 mrg">
						     <div class="text-center"> <?php echo$this->Html->link($this->Html->image('admin.png',array('alt'=>'Admin','class'=>'img-responsive.img-center')),'../admin/',array('escape'=>false));?></div>
						      <div class="text-center"><span class="text-muted"><h4><strong><?php echo$this->Html->link(__('Go to Admin/Teacher Interface'),'../admin/');?></strong></h4></span></div>
						      <div class="text-center"><span class="text-danger"><strong><?php echo __('User');?> : admin</strong></span></div>
						      <div class="col-md-12 col-sm-12 col-xs-3 text-center"><span class="text-danger"><strong><?php echo __('Password');?> : admin</strong></span></div>
						  </div>
						  <div class="col-md-6 col-sm-6 col-xs-6 mrg">
						  <div class="text-center"> <?php echo$this->Html->link($this->Html->image('graduated.png',array('alt'=>'Admin','class'=>'img-responsive.img-center')),'../',array('escape'=>false));?> </div>
						   <div class="text-center"> <span class="text-muted"><h4><strong><?php echo$this->Html->link(__('Go to Front End/Student Interface'),'../');?></strong></h4></span></div>
						   <div class="text-center"> <span class="text-danger"><strong><?php echo __('User');?> : student@student.com</strong></span></div>
						   <div class="col-md-12 col-sm-12 col-xs-3 text-center"> <span class="text-danger"><strong><?php echo __('Password');?> : demo123</strong></span></div>
						    </div>
						</div>                                            
					</div>
				</div>
			</div>
		</div>	
	</div>
	<div class="container">
		<div class="panel panel-success">
			<div class="panel-footer">
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12 text-center"><?php echo __('Visit our website');?> <?php echo$this->Html->link('http://www.eduexpression.com','http://www.eduexpression.com',array('target'=>'_blank'));?> <?php echo __('for documentation and support');?></div>
				</div>
			</div>
		</div>
	</div>
  </body>
</html>