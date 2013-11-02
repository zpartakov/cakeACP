<?php 
/*
 * a special layout for members not admin
 * 
 */
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $html->charset(); ?>
<title>
	<?php __('Intranet '.SITENAME ." - "); ?>
	<?php 
	echo $this->pageTitle;
	?>
</title>
<link type="text/css" rel="stylesheet" href="<?php echo LOCALCSS;?>">
<link rel="SHORTCUT ICON" href="<?php echo FAVICON;?>">
<?php 
/*
 * javascript
 */
echo $javascript->link('jquery.js');
echo $javascript->link('scrolltopcontrol');
?>
</head>
<body>
<div id="page">
	<div id="image1" style="margin-bottom: 30px">
		<a href="<?php echo CHEMIN; ?>">
		<img src="<?php echo LOGO; ?>" alt="Logo" title="Logo">
		<span style="margin-left: 30px; vertical-align: top; font-size: 6em;">Intranet</span></a>
	</div>
	<?php 
	/*
	 * show home admin to administrators
	 */
	if($session->read('Auth.User.role')=="administrator") {
		echo $this->Html->link('Home admin', array('controller' => 'pages', 'action' => 'display', 'home'), array('style'=>'margin-top: 20px; font-size: 2.5em'));
	}
	?>
	<div style="position: absolute; top: 12%; right: 18%"><a href="/">Retour au site public</a></div>
	<!-- menu -->
	<ul id="principal">
		<li><?php echo $this->Html->link('Demi-journées', '/demijournees'); ?></li>
		<li><?php echo $this->Html->link('Mes coordonnées', '/coordonnees'); ?></li>
		<li><?php echo $this->Html->link('Logout', array('controller' => 'users', 'action' => 'logout')); ?></li>
	</ul>
	<div id="texte">
		<?php 
		/*
		 * the content of the view
		 */	
		echo $content_for_layout; 
		?>
	</div>
	<div style="clear:both"></div>
</div>
<div id="fond">
  <div id="pied">
    <p><?php echo COPYRIGHT; ?</p>
  </div>
</div>
</body></html>