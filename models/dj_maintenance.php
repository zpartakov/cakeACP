<?php
class DjMaintenance extends AppModel {

	var $name = 'DjMaintenance';
	var $validate = array(
		'stop' => array('date'),
		'start' => array('notempty')
	);

}
?>