<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php echo $html->charset(); ?>
<title>
	<?php __('Intranet '.SITENAME ." - "); ?>
	<?php 
	echo $this->pageTitle;
	?>
</title>
<?php
	echo $html->meta('icon');
	echo $html->css('cake.generic');
	echo $html->css('hiermenu');
	echo $scripts_for_layout;
?>
<!-- import here local css -->
<link type="text/css" rel="stylesheet" href="<?php echo LOCALCSS;?>">
<!-- import here local favicon -->
<link rel="SHORTCUT ICON" href="<?php echo FAVICON;?>">
<?php 
	/*
	 * javascript
	 */
	echo $javascript->link('cocagne.js');
	echo $javascript->link('jquery.js');
	#still on developpement
	echo $javascript->link('date.js');
	echo $javascript->link('jquery.datePicker.js');
	echo $javascript->link('date_fr.js');
	echo $javascript->link('cake.datePicker.js');
	echo $html->css('datePicker');
	echo $javascript->link('scrolltopcontrol');
?>
</head>

<body>
<a href="<?php echo CHEMIN; ?>">
<img src="<?php echo LOGO; ?>" alt="Logo" title="Logo" width="30%">


</a>
<?php echo $html->getCrumbs(' > ','Home'); ?>

<?php  
/*
 * show navigation admin only to admin users
 * 
 */
if($session->read('Auth.User.role')=="administrator") { ?>
<!-- navigation -->
<div id="leftnav" class="menu">
<?php echo $this->element('menu');?>
</div>
<?php } ?>

<!-- content -->
	<div id="container">
		<div id="header">
		</div>
		<div id="content">
			<?php #$session->flash(); ?>
			<?php echo $content_for_layout; ?>
		</div>
	</div>
	<?php #echo $cakeDebug; ?>
	    <div style="clear:both"></div>
</div>
<div id="fond">
	  <div id="pied">
    <p><?php echo COPYRIGHT; ?></p>
  </div>
  </div>
</body>
</html>
