<?php
// no direct access.
defined('_JEXEC') or die;

jimport('joomla.application.component.controlleradmin');

class SamuReportControllerProfessionals extends JControllerAdmin {
	protected $text_prefix = 'COM_SAMUREPORT_PROFESSIONALS';
	
	public function &getModel($name = 'Professional', $prefix = 'SamuReportModel') {
		$model = parent::getModel($name, $prefix, array('ignore_request' => true));
		return $model;
	}
}