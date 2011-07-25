<?php

// no direct access
defined('_JEXEC') or die('Restricted access');

class VehicleHelper {
	public static function addSubmenu($vName) {
		JSubMenuHelper::addEntry(
			JText::_('COM_VEHICLE_SUBMENU_VEHICLES'),
			'index.php?option=com_vehicle&view=vehicles',
			$vName == 'vehicles'
		);
		JSubMenuHelper::addEntry(
			JText::_('COM_VEHICLE_SUBMENU_CATEGORIES'),
			'index.php?option=com_categories&extension=com_vehicle',
			$vName == 'categories'
		);
		
		$document = JFactory::getDocument();
		$document->addStyleDeclaration('.icon-48-vehicle {background-image: url(../media/com_vehicle/images/ambulance-48x48.png);}');
		
		if ($vName == 'categories') {
			JToolBarHelper::title(
				JText::sprintf('COM_CATEGORIES_CATEGORIES_TITLE', JText::_('com_vehicle')),
				'vehicle-categories');
		}
	}
}