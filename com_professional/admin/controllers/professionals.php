<?php
// no direct access.
defined('_JEXEC') or die;

jimport('joomla.application.component.controlleradmin');

class ProfessionalControllerProfessionals extends JControllerAdmin {
	
	public function getModel($name = 'Professional', $prefix = 'ProfessionalModel', $config = array('ignore_request' => true)) {
		$model = parent::getModel($name, $prefix, $config);		
		return $model;
	}
	
}