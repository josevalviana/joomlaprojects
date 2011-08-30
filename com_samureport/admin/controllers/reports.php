<?php

defined('_JEXEC') or die;

jimport('joomla.application.component.controlleradmin');

class SamuReportControllerReports extends JControllerAdmin
{
	public function getModel($name = 'Report', $prefix = 'SamuReportModel', $config = array('ignore_request' => true))
	{
		$model = parent::getModel($name, $prefix, $config);

		return $model;
	}
}
