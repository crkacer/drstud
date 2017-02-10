<?php
/**
 *
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

?>
<!DOCTYPE html>
<html lang="<?php echo$configLanguage;?>" dir="<?php echo$dirType;?>">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="google-translate-customization" content="839d71f7ff6044d0-328a2dc5159d6aa2-gd17de6447c9ba810-f">
	<?php echo $this->Html->charset();?>
	<title>
		<?php echo $siteTitle;?>
	</title>
	<meta name="description" content="<?php echo$siteDescription;?>"/>
	<?php
		echo $this->Html->meta('icon');
		echo $this->Html->css('http://fonts.googleapis.com/css?family=Open+Sans:400italic,400,300,700');
		echo $this->Html->css('/design500/assets/css/font-awesome.min');
		echo $this->Html->css('/design500/assets/css/bootstrap.min');
                echo $this->Html->css('/design500/assets/css/core');
		echo $this->Html->css('/design500/assets/css/system');
		echo $this->Html->css('/design500/assets/css/system-responsive');
		echo $this->Html->css('style.css');
                echo $this->Html->css('validationEngine.jquery');
		echo $this->Html->css('bootstrap-multiselect');
		if(strtolower($this->params['controller'])=="exams" && strtolower($this->params['action'])=="start")
		echo $this->Html->css('jquery.countdown');
		echo $this->fetch('meta');		
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
		echo $this->Html->script('bootstrap-multiselect');
		echo $this->Html->script('waiting-dialog.min');
		echo $this->Html->script('custom.min');
		if(strtolower($this->params['controller'])=="exams" && strtolower($this->params['action'])=="start"){
		echo $this->Html->script('jquery.plugin.min');
		echo $this->Html->script('jquery.countdown.min');}
		if($mathEditor)echo $this->Html->script('http://cdn.mathjax.org/mathjax/latest/MathJax.js?config=AM_HTMLorMML-full');
		echo $this->fetch('script');
                echo $this->Js->writeBuffer();
		$UserArr=$userValue;
		if(strlen($UserArr['Student']['photo'])>0)
		$studentImage='student_thumb/'.$UserArr['Student']['photo'];
		else
		$studentImage='User.png';
if($mathEditor){?><script type="text/x-mathjax-config">MathJax.Hub.Config({extensions: ["tex2jax.js"],jax: ["input/TeX", "output/HTML-CSS"],tex2jax: {inlineMath: [["$", "$"],["\\(", "\\)"]]}});</script><?php }?>
<?php echo $this->Html->scriptBlock("jQuery(document).ready(function () {
    'use strict';
    JQueryResponsive.init();
    Layout.init();
    document.body.oncopy = function() { return false; }
    document.body.oncut = function() { return false; }
    document.body.onpaste = function() { return false; }
});
",array('inline'=>true));?>
<?php if($translate>0){?>
<script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
}
</script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
<?php }?>
  </head>
  <body>
    <div id="google_translate_element"></div>  
    <div class="col-md-12">
    <div class="col-md-9"><?php if(strlen($frontLogo)>0){?><?php echo$this->Html->image($frontLogo,array('alt'=>$siteName,'class'=>''));} else{?>
      <div class="exam-logo"><?php echo$siteName;?></div>
      <?php }?>
    </div>
    <?php if(strtolower($this->params['controller'])=="exams" && strtolower($this->params['action'])=="start"){?>
    <div class="col-md-3 exam-photo"><?php echo$this->Html->image($studentImage,array('height'=>'75','title'=>$UserArr['Student']['name']));?></div><?php }?>
    </div>
    <div class="col-md-12"><div class="exam-border">&nbsp;</div></div>    
    <div>
      <?php echo $this->fetch('content'); ?>
    </div>
    <div id="exam-footer">
      <div class="copyright"> <span><strong><?php echo __('Powered by');?> </strong><?php echo$this->Html->Link('Eduexpression.com','http://www.eduexpression.com',array('target'=>'_blank'));?></span>
	<div class="pull-left"><?php echo __('Copyright &copy;');?> <?php echo $this->Time->format('Y',time());?><strong> <?php echo$siteName;?></strong></div>
	<div class="text-center"><strong><?php echo __('Date &amp; Time');?> </strong><span><?php echo $this->Time->format('d-m-Y h:i:s A',time());?></span></div>
      </div>
    </div>
</body>
</html>