<?php
/**
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
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $this->fetch('title'); ?>
	</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
	<?php
		
		echo $this->Html->css('common'); 
		echo $this->Html->script('common'); 
	?>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="header">
            <a href="<?php echo $this->webroot; ?>Signins" style="color:#FFFFFF; text-decoration:none;"><button id="logOutBtn">Log Out</button></a>
            <div id="mobileMenuLogo">
                <button class="hamburger">&#9776;</button>                
            </div>

            <div class="mobileMenu">
                <div class="cross">X</div>
                <ul>                 
                    <li><img src="<?php echo $this->webroot; ?>img/bullet.png"/><a href="<?php echo $this->webroot; ?>Mains">Home</a></li>
                    <li><img src="<?php echo $this->webroot; ?>img/bullet.png"/><a href="<?php echo $this->webroot; ?>Profiles">Profile</a></li>
                    <li><img src="<?php echo $this->webroot; ?>img/bullet.png"/><a href="<?php echo $this->webroot; ?>Videos">Video</a></li>
                    <li><img src="<?php echo $this->webroot; ?>img/bullet.png"/><a href="<?php echo $this->webroot; ?>Homeworks">Homework</a></li>
                    <li class="hasSub">
                        <ul>
                            <li><a href="#">Typing Practice</a></li>
                            <li><a href="#">Phonics</a></li>
                            <li><a href="#">Vocabulary</a></li>
                            <li><a href="#">Grammar</a></li>
                            <li><a href="#">Reading</a></li>
                        </ul>
                    </li>
                    <li><img src="<?php echo $this->webroot; ?>img/bullet.png"/><a href="#">Test</a></li>
                    <li><img src="<?php echo $this->webroot; ?>img/bullet.png"/><a href="#">Progression</a></li>
                    <li><img src="<?php echo $this->webroot; ?>img/bullet.png"/><a href="#">Message</a></li>
                </ul>
            </div> 
        </div>
		<div class="row">
			<div class="nav">
                <img src="<?php echo $this->webroot; ?>img/logo.png" id="logo"/>

                <div id="menu">
                    <div class="menuItem">
                        <img src="<?php echo $this->webroot; ?>img/bullet.png"/>
                        <a href="<?php echo $this->webroot; ?>Mains">Home</a>
                    </div>
                    
                    <div class="menuItem">
                        <img src="<?php echo $this->webroot; ?>img/bullet.png"/>
                        <a href="<?php echo $this->webroot; ?>Profiles">Profile</a>
                    </div>

                    <div class="menuItem">
                        <img src="<?php echo $this->webroot; ?>img/bullet.png"/>
                        <a href="<?php echo $this->webroot; ?>Videos">Video</a>
                    </div>

                    <div class="menuItem">
                        <img src="<?php echo $this->webroot; ?>img/bullet.png"/>
                        <a href="<?php echo $this->webroot; ?>Homeworks">Homework</a>

                        <div class="subMenu">
                            <div class="subMenuItem"><a href="#">Typing Practice</a></div>
                            <div class="subMenuItem"><a href="#">Phonics</a></div>
                            <div class="subMenuItem"><a href="#">Vocabulary</a></div>
                            <div class="subMenuItem"><a href="#">Grammar</a></div>
                            <div class="subMenuItem"><a href="#">Reading</a></div>
                        </div>
                    </div>
					
					<div class="menuItem">
                        <img src="<?php echo $this->webroot; ?>img/bullet.png"/>
                        <a href="#">Test</a>
                    </div>

                    <div class="menuItem">
                        <img src="<?php echo $this->webroot; ?>img/bullet.png"/>
                        <a href="#">Progression</a>
                    </div>

                    <div class="menuItem">
                        <img src="<?php echo $this->webroot; ?>img/bullet.png"/>
                        <a href="#">Message</a>
                    </div>
                </div>
            </div>
			<?php echo $this->fetch('content'); ?>
		</div>
	</div>
</body>
</html>
