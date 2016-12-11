<?php
class JosDemiejourneesDetail extends AppModel {

	var $name = 'JosDemiejourneesDetail';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
		'JosUser' => array(
			'className' => 'JosUser',
			'foreignKey' => 'user',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

}
?>