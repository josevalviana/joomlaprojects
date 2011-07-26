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
	
	public static function getActions($categoryId = 0, $vehicleId = 0) {
		$user = JFactory::getUser();
		$result = new JObject();
		
		if (empty($vehicleId) && empty($categoryId)) {
			$assetName = 'com_vehicle';
		} else if (empty($vehicleId)) {
			$assetName = 'com_vehicle.category.'.(int) $categoryId;
		} else {
			$assetName = 'com_vehicle.vehicle.'.(int) $vehicleId;
		}
		
		$actions = array(
			'core.admin', 'core.manage', 'core.create', 'core.edit', 'core.edit.own', 'core.edit.state', 'core.delete'
		);
		
		foreach ($actions as $action) {
			$result->set($action, $user->authorise($action, $assetName));
		}
		
		return $result;
	}
}