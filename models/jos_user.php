<?php
class JosUser extends AppModel {

	var $name = 'JosUser';
var $displayField = 'username';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasMany = array(
		'JosDemiejourneesDetail' => array(
			'className' => 'JosDemiejourneesDetail',
			'foreignKey' => 'user',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
?>
