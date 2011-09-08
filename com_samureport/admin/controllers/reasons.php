<?php
// no direct access.
defined('_JEXEC') or die;

jimport('joomla.application.component.controlleradmin');

class SamuReportControllerReasons extends JControllerAdmin {
	protected $text_prefix = 'COM_SAMUREPORT_REASONS';
	
	public function &getModel($name = 'Reason', $prefix = 'SamuReportModel') {
		$model = parent::getModel($name, $prefix, array('ignore_request' => true));
		return $model;
	}
}