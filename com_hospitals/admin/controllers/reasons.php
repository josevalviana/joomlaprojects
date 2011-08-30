<?php
// no direct access.
defined('_JEXEC') or die;

jimport('joomla.application.component.controlleradmin');

class HospitalsControllerReasons extends JControllerAdmin {
	protected $text_prefix = 'COM_HOSPITALS_REASONS';
	
	public function &getModel($name = 'Reason', $prefix = 'HospitalsModel') {
		$model = parent::getModel($name, $prefix, array('ignore_request' => true));
		return $model;
	}
}