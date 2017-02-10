<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <?php echo $this->Html->charset();?>
	<title>Download PDF</title>
	<?php echo $this->Html->css('http://fonts.googleapis.com/css?family=Open+Sans:400italic,400,300,700');
		echo $this->Html->css('/design500/assets/css/font-awesome.min');
		echo $this->Html->css('/design500/assets/css/bootstrap.min');
                echo $this->Html->css('/design500/assets/css/core');
		echo $this->Html->css('/design500/assets/css/system');
		echo $this->Html->css('/design500/assets/css/system-responsive');
		echo $this->Html->css('/Admin/css/style.css');
		echo $this->fetch('css');
		echo $this->Html->script('jquery-1.8.2.min');
		echo $this->Html->script('html5shiv');
                echo $this->Html->script('respond.min');                
                echo $this->Html->script('bootstrap.min');
                echo $this->Html->script('jquery.validationEngine-en');
                echo $this->Html->script('jquery.validationEngine');
		echo $this->Html->script('/design500/assets/js/jquery.metisMenu');
		echo $this->Html->script('/design500/assets/js/bootstrap-switch.min');
		echo $this->Html->script('/design500/assets/js/jquery.cookie');
		echo $this->Html->script('/design500/assets/js/core');
		echo $this->Html->script('/design500/assets/js/system-layout');
		echo $this->Html->script('/design500/assets/js/jquery-responsive');
		echo $this->Html->script('/Admin/js/custom.min');
		echo $this->fetch('script');
                echo $this->Js->writeBuffer();?>
</head>
<body>
<?php echo $this->fetch('content'); ?>
</body>
</html>