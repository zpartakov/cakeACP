<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $html->charset(); ?>
	<title>
		<?php __('Administration www.p2r.ch:'); ?>
		<?php 
		#echo $title_for_layout;
		echo $this->pageTitle;
		?></title>

	</title>
<?php 
if($_SERVER["REMOTE_ADDR"]=="129.194.8.73") {
?>


<link rel="stylesheet" type="text/css" href="http://cms.unige.ch/cms2/c5/updates/concrete5.6.2.1_updater/concrete/css/ccm.base.css?v=d84e2d439a3414c90b6f02446484418a" />
<script type="text/javascript" src="http://cms.unige.ch/cms2/c5/updates/concrete5.6.2.1_updater/concrete/js/jquery.js?v=d84e2d439a3414c90b6f02446484418a"></script>
<script type="text/javascript" src="http://cms.unige.ch/cms2/c5/updates/concrete5.6.2.1_updater/concrete/js/ccm.base.js?v=d84e2d439a3414c90b6f02446484418a"></script>

<meta content="noimageindex" name="robots" />
<link rel="stylesheet" type="text/css" href="http://cms.unige.ch/cms2/c5/files/cache/css/unige/main.css" />
<link rel="stylesheet" type="text/css" href="http://cms.unige.ch/cms2/c5/packages/unige/themes/unige/typography.css" />
<link rel="stylesheet" type="text/css" href="http://cms.unige.ch/cms2/c5/packages/unige/themes/unige/css/grids-min.css" />

<script src="http://unige.ch/jquery/autoHeight.js" type="text/javascript"><!----> </script>
<script src="http://unige.ch/themes/unige/js/slides.min.jquery.js" type="text/javascript"><!----> </script>
<script src="http://unige.ch/themes/unige/js/uni.js" type="text/javascript"><!----> </script>
<?php
} else {
	

?>

<?php
		echo $html->meta('icon');

		echo $html->css('cake.generic');
		echo $html->css('hiermenu');
		echo $scripts_for_layout;
		?>
<!-- import here local css -->
		<link type="text/css" rel="stylesheet" href="http://www.p2r.ch/declaration2.css">
<!-- import here local favicon -->
		<link rel="SHORTCUT ICON" href="http://www.p2r.ch/images/favicon.ico">
		
		<?php
}
	?>

<?php 
//echo $javascript->link('prototype.js');
//echo $javascript->link('scriptaculous.js?load=effects');
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
<a href="/cake/">



<?php 
if($_SERVER["REMOTE_ADDR"]=="129.194.8.73") {
	?>
<pre>
SERVICE DE COMMUNICATION
Imprimer cette page
unige.channuaire 
Accueil | Contact | Portail UNIGE
 
Université de Genève > Service de communication > Publier > Charte graphique > Logo
</pre>
<img src="http://www.unige.ch/communication/publier/charte/logo/logo.jpg" alt="Logo intranet Cocagne" title="Logo intranet Cocagne" />
	
	<?php
} else {
?>
<img src="http://www.p2r.ch/cms/images/cake/logococagneintranet.jpg" alt="Logo" title="Logo" width="30%">
<?php
}
?>

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
