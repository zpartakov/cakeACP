<?php
/*
 * Load all files in alaxos/libs folder
 */
$f = new Folder(APP . 'plugins' . DS . 'alaxos' . DS . 'libs');

$files = $f->read();
foreach($files[1] as $file)
{
	if(file_exists(APP . 'plugins' . DS . 'alaxos' . DS . 'libs' . DS . $file) && $file != 'additional_translations.php')
	{
		require_once APP . 'plugins' . DS . 'alaxos' . DS . 'libs' . DS . $file;
	}
}

/*
 * Some functions of the Alaxos plugin need to have a locale set. By default, a locale is set below to make them work.
 *
 * But this is up to you to use the DateTool :: set_current_locale() function in your application to modify this default locale.
 *
 * Don't modify it below, but do it for instance in the beforeFilter() function of your AppController.
 * This will prevent to forget to modify it again whenever you make an Alaxos plugin update.
 */
DateTool :: set_current_locale('fr');
?>