<?php
/* SVN FILE: $Id: default.ctp 7945 2008-12-19 02:16:01Z gwoo $ */
/**
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) :  Rapid Development Framework (http://www.cakephp.org)
 * Copyright 2005-2008, Cake Software Foundation, Inc. (http://www.cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright     Copyright 2005-2008, Cake Software Foundation, Inc. (http://www.cakefoundation.org)
 * @link          http://www.cakefoundation.org/projects/info/cakephp CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.cake.libs.view.templates.layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @version       $Revision: 7945 $
 * @modifiedby    $LastChangedBy: gwoo $
 * @lastmodified  $Date: 2008-12-18 18:16:01 -0800 (Thu, 18 Dec 2008) $
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */
#echo phpinfo();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $html->charset(); ?>
	<title>
		<?php __('Administration www.cocagne.ch:'); 
		?>
		<?php 
		#echo $title_for_layout;
		echo $this->pageTitle;
		?></title>

	</title>
	<?php
		echo $html->meta('icon');

		echo $html->css('cake.generic');
		echo $html->css('hiermenu');
		echo $scripts_for_layout;
	?>
<?php 
#echo $javascript->link('http://' .$_SERVER["HTTP_HOST"] ."/cake/" ."prototype.js");
#echo $javascript->link('http://' .$_SERVER["HTTP_HOST"] ."/cake/" ."scriptaculous.js?load=effects"); 
echo $javascript->link('prototype.js');
#echo $javascript->link('tiny_mce/tiny_mce'); 
echo $javascript->link('scriptaculous.js?load=effects');
echo $javascript->link('cocagne.js');
echo $javascript->link('jquery.js');

#nice for ajax-style display show/hidden
#tutorial see http://www.webbedit.co.uk/blog_posts/view/tutorial-cakephp-modalbox-crud
#echo $javascript->link('modalbox');
#echo $html->css('modalbox');

#still on developpement
echo $javascript->link('date.js');
echo $javascript->link('jquery.datePicker.js');
echo $javascript->link('date_fr.js');

echo $javascript->link('cake.datePicker.js');
echo $html->css('datePicker');

		
?>


</head>
<body>

<a href="/cake/"><img src="http://www.les-jardins-de-cocagne.ch/cms/images/cake/logococagneintranet.jpg" alt="Logo intranet Cocagne" title="Logo intranet Cocagne" width="30%"></a>
<?php echo $html->getCrumbs(' > ','Home'); ?>


<!-- navigation -->
<div id="leftnav" class="menu">
<?php 
if($_SERVER['PHP_AUTH_USER']=="renate") {
} else {
echo $this->element('menu');
}
?>
</div>
<!-- content -->
	<div id="container">
		<div id="header">
		</div>
		<div id="content">

			<?php #$session->flash(); ?>

			<?php echo $content_for_layout; ?>

		</div>
		<div id="footer">
			made with <a href="http://www.cakephp.org/">cakephp</a> by <a href="mailto:fradeff@akademia.ch">fredR</a>
					</div>
	</div>
	<?php #echo $cakeDebug; ?>
</body>
</html>
