<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <?php echo $this->Html->charset();?>
	<title>Download PDF</title>
	<link rel="stylesheet" type="text/css" href="<?php echo APP.'webroot'.DS.'css'.DS.'print.css'; ?>" media="all" />
</head>
<body>
<?php echo $this->fetch('content'); ?>
</body>
</html>