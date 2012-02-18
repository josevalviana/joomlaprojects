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
}