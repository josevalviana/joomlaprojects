<?php
// no direct access
defined('_JEXEC') or die;

class HospitalsHelper {
	
	public static function addSubmenu($vName) {
		JSubMenuHelper::addEntry(
			JText::_('COM_HOSPITALS_SUBMENU_HOSPITALS'),
			'index.php?option=com_hospitals&view=hospitals',
			$vName == 'hospitals'
		);
		JSubMenuHelper::addEntry(
			JText::_('COM_HOSPITALS_SUBMENU_CATEGORIES'),
			'index.php?option=com_categories&extension=com_hospitals',
			$vName == 'categories'
		);
		
		$document = JFactory::getDocument();
		$document->addStyleDeclaration('
			.icon-48-hospitals {
				background-image: url(../media/com_hospitals/images/icon-48-hospitals.png);
			}
			.icon-48-hospitals-equipments {
				background-image: url(../media/com_hospitals/images/icon-48-hospitals-equipments.png);
			}
			.icon-48-hospitals-shifts {
				background-image: url(../media/com_hospitals/images/icon-48-hospitals-shifts.png);
			}
			.icon-48-hospitals-specialties {
				background-image: url(../media/com_hospitals/images/icon-48-hospitals-specialties.png);
			}
			.icon-48-hospitals-reasons {
				background-image: url(../media/com_hospitals/images/icon-48-hospitals-reasons.png);
			}
		');
		
		if ($vName == 'categories') {
			JToolBarHelper::title(
				JText::sprintf('COM_CATEGORIES_CATEGORIES_TITLE', JText::_('com_hospitals')),
				'hospitals-categories');
		}

		JSubMenuHelper::addEntry(
			JText::_('COM_HOSPITALS_SUBMENU_EQUIPMENTS'),
			'index.php?option=com_hospitals&view=equipments',
			$vName == 'equipments'
		);
		
		JSubMenuHelper::addEntry(
			JText::_('COM_HOSPITALS_SUBMENU_SPECIALTIES'),
			'index.php?option=com_hospitals&view=specialties',
			$vName == 'specialties'
		);
		
		JSubMenuHelper::addEntry(
			JText::_('COM_HOSPITALS_SUBMENU_SHIFTS'),
			'index.php?option=com_hospitals&view=shifts',
			$vName == 'shifts'
		);
		
		JSubMenuHelper::addEntry(
			JText::_('COM_HOSPITALS_SUBMENU_REASONS'),
			'index.php?option=com_hospitals&view=reasons',
			$vName == 'reasons'
		);
	}
	
	/**
	 * 
	 * Gets a list of the actions that can be performed.
	 * 
	 * @param	int		The hospital ID.
	 * 
	 * @return	JObject
	 * @since	1.7
	 */
	public static function getActions($categoryId = 0, $hospitalId = 0) {
		$user		= JFactory::getUser();
		$result 	= new JObject;
		
		if (empty($hospitalId) && empty($categoryId)) {
			$assetName = 'com_hospitals';
		} else if (empty($hospitalId)) {
			$assetName = 'com_hospitals.category.'.(int) $categoryId;
		} else {
			$assetName = 'com_hospitals.hospital.'.(int) $hospitalId;
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