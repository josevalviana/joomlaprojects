<?php
// no direct access
defined('_JEXEC') or die;

class HospitalHelper {
	
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
		$document->addStyleDeclaration('.icon-48-hospitals {background-image: url(../media/com_hospitals/images/icon-48-hospitals.png);}');
		
		if ($vName == 'categories') {
			JToolBarHelper::title(
				JText::sprintf('COM_CATEGORIES_CATEGORIES_TITLE', JText::_('com_hospitals')),
				'hospitals-categories');
		}		
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