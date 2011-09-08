<?php
// no direct access.
defined('_JEXEC') or die;

jimport('joomla.application.component.controlleradmin');

class SamuReportControllerVehicles extends JControllerAdmin {
	protected $text_prefix = 'COM_SAMUREPORT_VEHICLES';
	
	public function &getModel($name = 'Vehicle', $prefix = 'SamuReportModel') {
		$model = parent::getModel($name, $prefix, array('ignore_request' => true));
		return $model;
	}
}