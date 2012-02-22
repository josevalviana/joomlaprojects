<?php

defined('_JEXEC') or die;

class FilaUtiHelper
{
	public static $extension = 'com_filauti';
	
	public static function addSubmenu($vName) {
		JSubMenuHelper::addEntry(
			JText::_('COM_FILAUTI_PACIENTES'),
			'index.php?option=com_filauti&view=pacientes',
			$vName == 'pacientes'
		);
		
		$document = JFactory::getDocument();
		$document->addStyleDeclaration('.icon-48-timesand ' .
		                               '{background-image: url(../media/com_filauti/images/timesand-48x48.png);}');
	}
	
	public static function getActions($pacienteId = 0) {
		$user = JFactory::getUser();
		$result = new JObject;
		
		if (empty($pacienteId)) {
			$assetName = 'com_filauti';
		} else {
			$assetName = 'com_filauti.paciente.'.(int) $pacienteId;
		}
		
		$actions = array(
			'core.admin', 'core.manage', 'core.create', 'core.edit', 'core.edit.own', 'core.delete'
		);
		
		foreach ($actions as $action) {
			$result->set($action, $user->authorise($action, $assetName));
		}
		
		return $result;
	}
}