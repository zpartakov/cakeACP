<?php 
/*
 * a special layout for members not admin
 * 
 */
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $html->charset(); ?>
<title>Intranet coopérative le panier bio a deux roues - 
<?php 
		echo $this->pageTitle;
		?></title>
		 <?php 
if($_SERVER["REMOTE_ADDR"]=="129.194.8.73") {
	} else {?>
<link type="text/css" rel="stylesheet" href="http://www.p2r.ch/declaration2.css">
<link rel="SHORTCUT ICON" href="http://www.p2r.ch/images/favicon.ico">
<?php 
echo $javascript->link('jquery.js');

	echo $javascript->link('scrolltopcontrol');

	} ?>
</head>
<body>
<div id="page">
 <div id="image1" style="margin-bottom: 30px">
 <?php 
if($_SERVER["REMOTE_ADDR"]=="129.194.8.73") {
	?>
<img src="http://www.unige.ch/communication/publier/charte/logo/logo.jpg" alt="Logo intranet Cocagne" title="Logo intranet Cocagne" />
<?php
}else {
	?>
<a href="/cake/"><img src="http://www.p2r.ch/images/p2r_Logo_last_vert.png" alt="Logo" title="Logo">
	<?php 
}
?>
<span style="margin-left: 30px; vertical-align: top; font-size: 6em;">Intranet</span></a>
</div>
    
            <?php 
        if($session->read('Auth.User.role')=="administrator") {
        	echo $this->Html->link('Home admin', array('controller' => 'pages', 'action' => 'display', 'home'), array('style'=>'margin-top: 20px; font-size: 2.5em'));
        	  //      $this->redirect(array('controller'=>'pages', 'action'=>'display','home'));
        }
        ?>
        <div style="position: absolute; top: 12%; right: 18%"><a href="/">Retour au site public</a></div>
        
    <ul id="principal">
    
        <li><?php echo $this->Html->link('Demi-journées', '/demijournees'); ?></li>
        <li><?php echo $this->Html->link('Mes coordonnées', '/coordonnees'); ?></li>
        <li><?php echo $this->Html->link('Logout', array('controller' => 'users', 'action' => 'logout')); ?></li>
        
    </ul>
     <div id="texte">
     			<?php echo $content_for_layout; ?>
     
        </div>
    
    <div style="clear:both"></div>
</div>
<div id="fond">
 <?php 
if($_SERVER["REMOTE_ADDR"]=="129.194.8.73") {
} else {
	?>
  <div id="pied">
    <p>© 2012 • Le panier bio à deux roues • contact: info(at)p2r.ch</p>
  </div>
  <?php 
}?>
</div>


</body></html>