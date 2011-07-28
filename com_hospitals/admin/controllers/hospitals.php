<?php
// no direct access.
defined('_JEXEC') or die;

jimport('joomla.application.component.controlleradmin');

class HospitalsControllerHospitals extends JControllerAdmin {
	
	public function getModel($name = 'Hospital', $prefix = 'HospitalsModel', $config = array('ignore_request' => true)) {
		$model = parent::getModel($name, $prefix, $config);		
		return $model;
	}
	
}