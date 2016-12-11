<?php
class JosPdd extends AppModel {
	var $name = 'JosPdd';
	var $displayField = 'PDDTexte';
		var $actsAs = array('Revision'=> array('limit'=>100),'Copyable');

}
