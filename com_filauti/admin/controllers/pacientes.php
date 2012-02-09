<?php

defined('_JEXEC') or die;

jimport('joomla.application.component.controlleradmin');

class FilaUtiControllerPacientes extends JControllerAdmin
{
	public function getModel($name = 'Paciente', $prefix = 'FilaUtiModel', $config = array('ignore_request' => true)) {
		$model = parent::getModel($name, $prefix, $config);
		
		return $model;
	}
}