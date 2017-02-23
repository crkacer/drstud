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

<?php if ( ($this->here == "/admin/users/login_form") || ($this->here == "/admin/Users/login_form")){ 
	//php  {echo "true"; } else { echo "False";}?>
	<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>Sign In</title> 
<?php	
		echo $this->Html->css('/design700/assets/css/login-common');
		echo $this->Html->css('/design700/assets/css/jquery.mCustomScrollbar.css');
		//echo $this->Html->css('/design700/assets/css/signIn');
										   

		echo $this->fetch('css');
?>    

</head>
<body class="signin">
    <div class="container signin">
        
        <div id="win" class="signin">
            <div id="winLogo" class="signin"></div>
            
                
            <?php echo $this->Session->flash();?>
                                	
               <?php echo $this->Form->create('User',array('id'=>'post_req','role'=>'form','class'=>'login-form'));?>
	<div class="login-header"><p><h3><?php echo __('Log In');?></h3><span><?php echo __('Dear user, log in to access the admin area!');?></span></p></div>
	<?php echo $this->Session->flash();?>
	<div class="form-group">
		<label class="control-label" for="username"><?php echo __('Admin / Teacher Username');?></label>
		<?php echo $this->Form->input('username',array('label' => false,'id'=>'username','class'=>'form-control','required'=>true,'div'=>false));?>
	</div>
	<div class="form-group">
		<label class="control-label" for="passwd"><?php echo __('Password');?></label>
		<?php echo $this->Form->input('password',array('label' => false,'id'=>'passwd','class'=>'form-control','required'=>true,'div'=>false));?>
	</div>
	<div class="form-group">
	<?php echo$this->Form->button('<i class="fa fa-lock"></i>'.__('Log In'),array('class'=>'btn btn-primary btn-block text-left','escpae'=>false));?>
	</div>
	<div class="login-footer">
		<div class="pull-left"><?php echo$this->Html->link(__('Forgot Password'),array('controller'=>'Forgots','action'=>'password'));?></div>
		<div class="pull-right"><?php echo$this->Html->link(__('Forgot User Name'),array('controller'=>'Forgots','action'=>'username'));?></div>
	</div>
<?php echo$this->Form->end();?>
                           
           

            
        </div>
        
   
        
    </div>
</body>
</html>
	    
    
<?php }else{?>
<!DOCTYPE html>
  <html lang="<?php echo$configLanguage;?>" dir="<?php echo$dirType;?>">
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
	  echo $this->Html->css('bootstrap-multiselect');
	  echo $this->Html->css('bootstrap-datetimepicker.min');
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
    <?php if($this->Session->check('User')){?>
     <body class="page-body skin-navy">
     <?php if($translate>0){?><div id="google_translate_element"></div><?php }?>
     <div class="page-container">
      <div class="sidebar-menu toggle-others fixed">
	<div class="sidebar-menu-inner">
	  <header class="logo-env"> <!-- logo -->
	    <div class="logo"><?php if(strlen($frontLogo)>0){echo$this->Html->image($frontLogo,array('alt'=>$siteName,'class'=>'img-responsive'));} else{echo$siteName; }?></div>
	    <div class="mobile-menu-toggle visible-xs">
	      <a href="#" data-toggle="user-info-menu"> <i class="fa-bell-o"></i> <span class="badge badge-success"><?php echo$totalInbox;?></span> </a> <a href="#" data-toggle="mobile-menu"> <i class="fa-bars"></i> </a></div>
	  </header>
	  <?php echo $this->MenuBuilder->build('main-menu');?>
	</div>
      </div>
      <div class="main-content">
      <nav class="navbar user-info-navbar" role="navigation">
	<ul class="user-info-menu left-links list-inline list-unstyled">
	  <li class="hidden-sm hidden-xs"> <a href="#" data-toggle="sidebar"> <i class="fa-bars"></i> </a> </li>
	  <li class="dropdown hover-line"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="fa-envelope-o"></i> <span class="badge badge-green"><?php echo$totalInbox;?></span> </a> <ul class="dropdown-menu messages"><li>
	  <ul class="dropdown-menu-list list-unstyled ps-scrollbar">
	    <?php foreach($mailArr as $post):$id=$post['Mail']['id'];$url=$this->Html->url(array('controller'=>'Mails','action'=>'View',$id));?>
	    <?php echo($post['Mail']['type']=="Unread") ? "<li class=\"active\"><strong>" : "<li>";?><a href="#" onclick="show_modal('<?php echo$url;?>')"><?php echo h($post['Mail']['from_email']);?> - <?php echo h($post['Mail']['subject']);?><?php echo($post['Mail']['type']=="Unread") ? "</strong>" : "";?></a></li>
	    <?php endforeach;unset($post);?>
	  </ul>
	  </li>
	      <li class="external"><?php echo$this->Html->link('<span>'.__('All Messages').'</span> <i class="fa-link-ext"></i>',array('controller'=>'Mails','action'=>'index'),array('escape'=>false));?></li>
	  </ul> </li>
	</ul>
	
	<ul class="user-info-menu right-links list-inline list-unstyled">
	  <li class="dropdown user-profile"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-user"></i> <span><?php echo h($UserArr['User']['name']);?><i class="fa-angle-down"></i> </span> </a>
	    <ul class="dropdown-menu user-profile-menu list-unstyled">
	      <li><?php echo $this->Html->link('<i class="fa-user"></i>'.__('My Profile'),array('controller' => 'Users','action' => 'myProfile'),array('escape'=>false));?></li>
	      <li><?php echo $this->Html->link('<i class="fa-info"></i>'.__('Help'),array('controller' => 'Helps','action' => 'index'),array('escape'=>false));?></li>
	      <li><?php echo $this->Html->link('<i class="fa-cog"></i>'.__('Change Password'),array('controller' =>'Users','action' =>'changePass'),array('escape'=>false));?></li>
	      <li class="last"><?php echo $this->Html->link('<i class="fa fa-power-off"></i>'.__('Logout'),array('controller' =>'Users','action'=>'logout'),array('escape' => false));?></li>
	    </ul>
	  </li>
	</ul>
      </nav>
      <?php echo $this->fetch('content');?>      
    <!-- Main Footer -->
    <footer class="main-footer sticky footer-type-1">
      <div class="footer-inner">
	<div class="footer-text">&copy; <?php echo$this->Time->format('Y',time());?> <?php echo$siteName;?> <?php echo __('Powered by');?> <?php echo$this->Html->Link('Intellizens.com','http://www.intellizens.com',array('target'=>'_blank'));?></div>
	<div class="text-center"><strong><?php echo __('Date &amp; Time');?> </strong><span><?php echo $this->Time->format('d-m-Y h:i:s A',time());?></span></div>
	<div class="go-up"> <a href="#" rel="go-top"> <i class="fa-angle-up"></i> </a> </div>
      </div>
    </footer>
    </div>
  </div>
<div class="page-loading-overlay"> <div class="loader-2"></div> </div>
<?php }else{?>
<body class="page-body login-page login-light">
<div class="login-container">
<div class="text-center"><?php if(strlen($frontLogo)>0){echo$this->Html->image($frontLogo,array('alt'=>$siteName,'class'=>'img-responsive'));} else{ echo$this->Html->image('logo-website.fw.png',array('alt'=>'Edu Expression','align'=>'center','class'=>'img-responsive'));}?></div>
<div class="row"> <div class="col-sm-6">
<?php echo $this->fetch('content');?>
</div> </div> </div> <?php }?>
<div class="modal fade" id="targetModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-content"></div>
</div>
</body>
</html>
<?php } ?>