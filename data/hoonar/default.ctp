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
<?php if($this->Session->check('Student')){?>
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
                echo $this->Html->script('jquery-1.11.1.min');
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
		$std_img='student_thumb/'.$UserArr['Student']['photo'];
		else
		$std_img='User.png';
if($mathEditor){?><script type="text/x-mathjax-config">MathJax.Hub.Config({extensions: ["tex2jax.js"],jax: ["input/TeX", "output/HTML-CSS"],tex2jax: {inlineMath: [["$", "$"],["\\(", "\\)"]]}});</script><?php }?>
<?php echo $this->Html->scriptBlock("jQuery(document).ready(function () {
    'use strict';
    JQueryResponsive.init();
    Layout.init();
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
  <div id="google_translate_element"></div>
  <body class="sidebar-color-black font-source-sans-pro layout-sidebar-collapsed"><!--Modal Default-->
   <div class="fluid"><!--BEGIN TEMPLATE SETTING-->
    <div class="hidden-xs hidden-sm">
        <div id="template-setting">
            <div class="pull-right">
                    <div id="setting-sidebar-collapsed" data-on="success" data-off="default"
                         class="make-switch switch-small"><input type="checkbox" class="switch"/></div>
                </div>
                <div class="mbm clearfix"></div>
            </div>
        </div>
    </div>
    <!--END TEMPLATE SETTING--><!--BEGIN TOPBAR-->
    <div class="page-header-topbar">
        <nav id="topbar" role="navigation" class="navbar navbar-default container pln prn">
            <div class="container-fluid pln prn">
                <div id="topbar-menu" class="navbar-collapse pln prn">
                    <ul class="nav navbar-nav logo-wrapper">                       
                        <li class="pull-left logo"><?php if(strlen($frontLogo)>0){?><?php echo$this->Html->image($frontLogo,array('alt'=>$siteName,'class'=>'','height'=>'40'));} else{?>
		    <?php echo __('Welcome to');?> <?php echo$siteName;?> <?php echo __('Dashboard');?>
		    <?php }?>
			  </li>
                    </ul>
		    <ul class="nav navbar-nav navbar-left custom-navbar">
                         <li class="btn-menu-toggle">
                            <div id="menu-toggle" class="show-collapsed custom-menutoggle"><i class="fa fa-bars"></i></div>
                        </li>
			<li><?php echo$this->Html->link("<i class=\"fa fa-envelope\"></i><span class=\"badge badge-warning\">$totalInbox</span>",array('controller'=>'Mails','action'=>'index'),array('escape'=>false));?></li>
		     </ul>
                    
                    <ul class="nav navbar-nav navbar-right">
                       <li><?php if($frontExamPaid>0){echo __('Balance').': &nbsp;'.$currency.$walletBalance;}?></li>
			<li class="dropdown"><a data-toggle="dropdown" href="#" class="dropdown-toggle"><i
                                class="fa fa-user"></i>&nbsp;<span class="caret"></span></a>
                            <ul class="dropdown-menu dropdown-user pull-right">
                                <li>
                                    <div class="navbar-content">
                                        <div class="row">
					  <div class="col-md-4 col-xs-2">
					    <?php echo $this->Html->image($std_img, array('alt' => h($UserArr['Student']['name']),'class'=>'img-responsive img-circle'));?>
                                                <p class="text-center mtm"><?php echo$this->Html->link('<small>'.__('Set Avatar').'</small>',array('controller'=>'Profiles','action'=>'changePhoto'),array('class'=>'change-avatar','escape'=>false));?></p>
                                            </div>
                                             <div class="col-md-8 col-xs-8"><span class="text-danger"><?php echo h($UserArr['Student']['name']);?></span>
                                                <p class="text-muted small"><?php echo h($UserArr['Student']['email']);?></p>
                                                <div class="divider"></div>
						<?php echo $this->Html->link(__('My Profile'),array('controller' => 'Profiles','action' => 'index'),array('class'=>'btn btn-default btn-sm mrg'));?>
                                                </div>
                                        </div>
                                    </div>
                                    <div class="navbar-footer">
                                        <div class="navbar-footer-content">
                                            <div class="row">
                                                <div class="col-md-6 col-xs-6">
						<?php echo $this->Html->link('<span class="fa fa-cog"></span>&nbsp;'.__('Change Password'),array('controller' => 'Profiles','action' => 'changePass'),array('escape' => false,'class'=>'btn btn-primary btn-sm'));?>
						</div>
                                                <div class="col-md-6 col-xs-6">
						<?php echo $this->Html->link('<span class="fa fa-power-off"></span>&nbsp;'.__('Sign out'),array('controller' => 'Users', 'action' => 'logout'),array('escape' => false,'class'=>'btn btn-danger btn-sm'));?>
						</div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </li>
                       
                    </ul>
                </div>
            </div>
        </nav>
    </div>
   <!--END TOPBAR-->
    <div id="setting-sidebar-collapsed"></div>
    <div id="wrapper"><!--BEGIN PAGE WRAPPER-->
        <div id="page-wrapper"><!--BEGIN SIDEBAR MAIN-->
            <div class="sidebar-main sidebar">
                <div class="sidebar-collapse sidebar-scroll">
                    <ul id="sidebar-main" class="nav">
	      <?php foreach($menuArr as $menuName=>$menu): $menuIcon=$menu['icon'];h($menuName);if($frontExamPaid && ($menuName=="Payment" || $menuName=="Transaction History")){?>
	      <li <?php echo (strtolower($this->params['controller'])==strtolower($menu['controller']))?"class=\"active\"":"";?>><?php echo $this->Html->link("<i class=\"icon- $menuIcon\"></i><span class=\"menu-title\">&nbsp;$menuName</span>",array('controller' => $menu['controller'],'action'=>$menu['action']),array('escape' => false));?></li><?php }else{
	      if($menuName!="Payment" && $menuName!="Transaction History"){?>
	      <li <?php echo (strtolower($this->params['controller'])==strtolower($menu['controller']))?"class=\"active\"":"";?>><?php echo $this->Html->link("<i class=\"icon- $menuIcon\"></i><span class=\"menu-title\">&nbsp;$menuName</span>",array('controller' => $menu['controller'],'action'=>$menu['action']),array('escape' => false));?></li><?php }}?>
	      <?php endforeach;unset($menu);unset($menuName);unset($menuIcon);?>    
	    </ul>
                </div>
            </div>
            <!--END SIDEBAR MAIN--><!--BEGIN PAGE CONTENT-->
            <div class="page-content"><!--BEGIN TITLE & BREADCRUMB PAGE-->
		<div class="box-content"><!--BEGIN CONTENT-->
                    <div class="content">
                        <div class="row">
                            <div class="col-md-12">
                    <?php echo $this->fetch('content'); ?>
			    </div>
			</div>
		    </div>
		</div>
	  </div>
	  <!--END PAGE CONTENT--></div>
        <!--END PAGE WRAPPER--></div>
<div id="footer">
        <div class="copyright"> <span><strong> <?php echo __('Powered by');?> </strong><?php echo$this->Html->Link('ampdigitalnet.com','http://www.ampdigitalnet.com/',array('target'=>'_blank'));?></span>
            <div class="pull-left"><?php echo __('Copyright &copy;');?> <?php echo$this->Time->format('Y',time());?><strong> <?php echo$siteName;?></strong>
	    </div><div class="text-center"><strong><?php echo __('Date &amp; Time');?> </strong><span><?php echo $this->Time->format('d-m-Y h:i:s A',time());?></span></div>
        </div>
    </div>
</body>
</html>
<?php }else{?>      
<!DOCTYPE html>
<html lang="<?php echo$configLanguage;?>" dir="<?php echo$dirType;?>">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta charset="utf-8">
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
		echo $this->Html->css('/design300/css/font-awesome.min');
		echo $this->Html->css('/design300/css/bootstrap.min');
		echo $this->Html->css('/design300/css/font');
		echo $this->Html->css('/design300/css/settings');
		echo $this->Html->css('/design300/css/style');
		echo $this->Html->css('validationEngine.jquery');
		echo $this->Html->css('bootstrap-multiselect');
		echo $this->Html->css('style');
		echo $this->fetch('meta');		
		echo $this->fetch('css');
		echo $this->Html->script('/design300/js/jquery.min');
		echo $this->Html->script('html5shiv');
                echo $this->Html->script('respond.min');
		echo $this->Html->script('jquery.validationEngine-en');
                echo $this->Html->script('jquery.validationEngine');		
		echo $this->Html->script('/design300/js/bootstrap.min');
		echo $this->Html->script('/design300/js/rs-slider');
		echo $this->Html->script('bootstrap-multiselect');
		echo $this->Html->script('waiting-dialog.min');
		echo $this->Html->script('custom.min');
                if($mathEditor)echo $this->Html->script('http://cdn.mathjax.org/mathjax/latest/MathJax.js?config=AM_HTMLorMML-full');
if($mathEditor){?><script type="text/x-mathjax-config">MathJax.Hub.Config({extensions: ["tex2jax.js"],jax: ["input/TeX", "output/HTML-CSS"],tex2jax: {inlineMath: [["$", "$"],["\\(", "\\)"]]}});</script><?php }?>
<?php if($translate>0){?>
<script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
}
</script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
<?php }?>
</head>
<body>
<div id="preloader">
<div id="status">&nbsp;</div>
</div>
<div id="wrapper">
<div class="h-wrapper">
 
<div class="topbar">
<div class="container">
<div class="row">
<div class="col-sm-6">
  
</div>
<div class="col-sm-6">
<div class="pull-right hidden-xs">
<ul class="social-icon unstyled">
 <?php if(strlen($contact[0])>0){?>
	    <li><a href="#"><i class="fa fa-phone"></i><span><?php echo$contact[0];?></span></a></li><?php }?>
	    <?php if(strlen($contact[1])>0){?>
	    <li><a href="mailto:<?php echo$contact[1];?>"><i class="fa fa-envelope"></i><span><?php echo$contact[1];?></span></a></li><?php }?>
	    <?php if(strlen($contact[2])>0){?>
	    <li><a href="<?php echo$contact[2];?>" target="_blank"><i class="fa fa-facebook"></i><span><?php echo __('follow on facebook');?></span></a></li><?php }?>
</ul>
</div>
</div>
</div>
</div>
</div>
<?php if($this->params['controller']=="pages"){?>
<header class="header-wrapper header-transparent with-topbar">
 <?php }else {?>
<header class="header-wrapper header-transparent header-stylecol with-topbar">
 <?php }?>
<div class="main-header">
<div class="container">
<div class="row">
<div class="col-sm-12 col-md-3">
  <div class="logo-text"><?php if(strlen($frontLogo)>0){?><?php echo$this->Html->image($frontLogo,array('alt'=>$siteName,'class'=>'img-responsive'));} else{?><?php echo$siteName;?><?php }?></div></div>
<div class="col-sm-12 col-md-9" >
<nav class="navbar-right">
<ul class="menu">
<li class="toggle-menu"><i class="fa icon_menu"></i></li>
<?php foreach($frontmenuArr as $menuName=>$menu): $menuIcon=$menu['icon'];h($menuName);if($this->params['controller']=="pages"){$this->params['controller']="";}$isMenu=true;
	      if($menuName=="Register" && $frontRegistration!=1){$isMenu=false;}?>
	      <li <?php if($isMenu==true){ echo (strtolower($this->params['controller'])==strtolower($menu['controller']))?"class=\"current-menu-item\"":"";?>><?php echo $this->Html->link("<span class=\"$menuIcon\"></span>&nbsp;$menuName",array('controller' => $menu['controller'],'action'=>$menu['action']),array('escape' => false));?></li>
	      <?php } endforeach;unset($menu);unset($menuName);unset($menuIcon);?>
	      <?php foreach($contents as $menu): $menuName=h($menu['Content']['link_name']);
	      if($menu['Content']['is_url']=="External"){?><li><?php echo$this->Html->Link($menu['Content']['link_name'],$menu['Content']['url'],array('target'=>$menu['Content']['url_target']));?></li><?php }else{?><li <?php echo (strtolower($contentId)==strtolower($menu['Content']['page_url']))?"class=\"current-menu-item\"":"";?>><?php echo $this->Html->link($menuName,array('controller' => 'Contents','action'=>'pages',$menu['Content']['page_url']),array('escape' => false));?></li><?php }?>
	      <?php endforeach;unset($menu);unset($menuName);?>
	      
</ul>
</nav>
</nav>
</div>
</div>
</div>  
</div>  
</header>
</div>
<div class="push-top"></div>
<div class="tp-banner-container rs_fullwidth">
<?php if($frontSlides==1 && $this->params['controller']==""){?>
<div class="tp-banner">
			  <ul>
			  <?php foreach($slides as $k=>$value): $photoImg='slides_thumb/'.$value['Slide']['photo'];?>
			  <li data-transition="fade" data-masterspeed="500" data-slotamount="7" data-delay="8000" data-title="<?php echo$value['Slide']['slide_name'];?>">
			  <?php echo $this->Html->image($photoImg,array('alt'=>$value['Slide']['slide_name'],'width'=>'1140'));?>
			  <div class="bg-overlay op5"></div>
			  </li>
			  <?php endforeach;unset($k);unset($value);?>
			  </ul>
	</div>

</div>
		<?php }?>
 <?php if($this->params['controller']!=""){?>
<section class="section mt80"><?php }else{?>
  <section class="section"><?php }?>
<div class="container">
<?php echo $this->fetch('content');?>
<?php if($this->params['controller']!=""){?>
<div class="col-sm-12 col-md-3 sm-box2">
<div class="box-services-b">
<div class="box-left"><i class="fa fa-bullhorn"></i></div>
<div class="box-right-all">
  <h3 class="title-small "> <?php echo __('Latest News & Events');?> </h3>
				    <ul>				
					<?php foreach($news as $value):$id=$value['News']['id'];?>
					<li><?php echo$this->Html->link($value['News']['news_title'],array('controller'=>'News','action'=>'show',$id));?></li>
					<?php endforeach;unset($value);?>				  
				  </ul>
</div>
</div>
<div class="mb50"></div>
</div>
<?php }?>
</div>
</section>
</div>

<div id="footer_index"></div>
<footer class="footer-wrapper footer-bg">
<div class="container">
<div class="row">
<div class="col-sm-6 col-md-4 col-sm-push-6 col-md-push-4 xs-box">
<?php echo __('Time');?> <span><?php echo $this->Time->format('d-m-Y h:i:s A',time());?></span>
</div>
<div class="col-sm-6 col-md-4 col-sm-pull-6 col-md-pull-4">
<p class="copyright"><?php echo __('&copy; Copyright');?> <?php echo$this->Time->format('Y',time());?><span> <?php echo$siteName;?></span></p>
</div>
<span><?php echo __('Powered by');?> <?php echo$this->Html->Link('ampdigitalnet.com','http://www.ampdigitalnet.com/',array('target'=>'_blank'));?></span>
</div>
</div>
</footer>
</div>
<div id="_include_main_plugins"></div>
<div id="_include_owl_carousel"></div>
<div id="_include_isotope"></div> 
<?php echo $this->Html->script('/design300/js/script');
echo $this->fetch('script');
echo $this->Js->writeBuffer();?>
</body></html>
<?php }?>