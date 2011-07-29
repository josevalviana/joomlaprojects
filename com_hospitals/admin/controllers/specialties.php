<?php
// no direct access.
defined('_JEXEC') or die;

jimport('joomla.application.component.controlleradmin');

class HospitalsControllerSpecialties extends JControllerAdmin {
	protected $text_prefix = 'COM_HOSPITALS_SPECIALTIES';
	
	public function &getModel($name = 'Specialty', $prefix = 'HospitalsModel') {
		$model = parent::getModel($name, $prefix, array('ignore_request' => true));
		return $model;
	}
}