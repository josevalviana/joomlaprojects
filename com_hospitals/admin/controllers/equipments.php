<?php
// no direct access.
defined('_JEXEC') or die;

jimport('joomla.application.component.controlleradmin');

class HospitalsControllerEquipments extends JControllerAdmin {
	protected $text_prefix = 'COM_HOSPITALS_EQUIPMENTS';
	
	public function &getModel($name = 'Equipment', $prefix = 'HospitalsModel') {
		$model = parent::getModel($name, $prefix, array('ignore_request' => true));
		return $model;
	}
}