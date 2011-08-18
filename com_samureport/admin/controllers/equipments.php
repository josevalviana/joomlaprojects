<?php
// no direct access.
defined('_JEXEC') or die;

jimport('joomla.application.component.controlleradmin');

class SamuReportControllerEquipments extends JControllerAdmin {
	protected $text_prefix = 'COM_SAMUREPORT_EQUIPMENTS';
	
	public function &getModel($name = 'Equipment', $prefix = 'SamuReportModel') {
		$model = parent::getModel($name, $prefix, array('ignore_request' => true));
		return $model;
	}
}