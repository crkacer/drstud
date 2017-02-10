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
  <html lang="en">
    <head>
      <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
	  <meta name="description" content="<?php echo$siteDescription;?>" />
	  <meta name="author" content="<?php echo$siteName;?>" />
	  <meta name="google-translate-customization" content="839d71f7ff6044d0-328a2dc5159d6aa2-gd17de6447c9ba810-f">
	  <?php echo $this->Html->charset();?>
	  <title><?php echo $siteTitle;?></title>
	  <?php
	  echo $this->Html->meta('icon');
	  echo $this->Html->css('http://fonts.googleapis.com/css?family=Arimo:400,700,400italic');
	  echo $this->Html->css('/design600/assets/css/linecons');
	  echo $this->Html->css('/design600/assets/css/font-awesome.min');
	  echo $this->Html->css('/design600/assets/css/bootstrap');
	  echo $this->Html->css('/design600/assets/css/core');
	  echo $this->Html->css('/design600/assets/css/forms');
	  echo $this->Html->css('/design600/assets/css/components');
	  echo $this->Html->css('/design600/assets/css/skins');
	  echo $this->Html->css('/design600/assets/css/custom');
	  echo $this->Html->css('style.css');
	  echo $this->Html->css('validationEngine.jquery');
	  echo $this->fetch('meta');		
	  echo $this->fetch('css');
	  echo $this->Html->script('/design600/assets/js/jquery-1.11.1.min');
	  echo $this->Html->script('jquery.validationEngine-en');
          echo $this->Html->script('jquery.validationEngine');
	  echo $this->Html->script('html5shiv');
	  echo $this->Html->script('respond.min');
	  echo $this->Html->script('/design600/assets/js/bootstrap.min');
	  echo $this->Html->script('/design600/assets/js/TweenMax.min');
	  echo $this->Html->script('/design600/assets/js/resizeable');
	  echo $this->Html->script('/design600/assets/js/joinable');
	  echo $this->Html->script('/design600/assets/js/api');
	  echo $this->Html->script('/design600/assets/js/toggles');
	  echo $this->Html->script('/design600/assets/js/widgets');
	  echo $this->Html->script('/design600/assets/js/globalize.min');
	  echo $this->Html->script('/design600/assets/js/toastr.min');
	  echo $this->Html->script('/design600/assets/js/custom');
	  echo $this->Html->script('bootstrap-multiselect');
	  echo $this->Html->script('moment-with-locales');
	  echo $this->Html->script('bootstrap-datetimepicker.min');      
	  echo $this->Html->script('waiting-dialog.min');
	  echo $this->Html->script('main.custom.min');
	  if($mathEditor)echo $this->Html->script('http://cdn.mathjax.org/mathjax/latest/MathJax.js?config=AM_HTMLorMML-full');
	  echo $this->fetch('script');
	  echo $this->Js->writeBuffer();
	  $UserArr=$this->Session->read('User');
if($mathEditor){?><script type="text/x-mathjax-config">MathJax.Hub.Config({extensions: ["tex2jax.js"],jax: ["input/TeX", "output/HTML-CSS"],tex2jax: {inlineMath: [["$", "$"],["\\(", "\\)"]]}});</script><?php }?>
<?php if($translate>0){?>
<script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
}
</script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
<?php }?>
</head>
     <body><!--Modal Default-->
     <div id="google_translate_element"></div>
      <?php echo $this->fetch('content'); ?>
</body>
</html>