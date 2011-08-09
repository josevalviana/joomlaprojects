<?php
// no direct access.
defined('_JEXEC') or die;

jimport('joomla.application.component.controlleradmin');

class HospitalsControllerShifts extends JControllerAdmin {
	protected $text_prefix = 'COM_HOSPITALS_SHIFTS';
	
	public function &getModel($name = 'Shift', $prefix = 'HospitalsModel') {
		$model = parent::getModel($name, $prefix, array('ignore_request' => true));
		return $model;
	}
}