<?php
// no direct access
defined('_JEXEC') or die;

class ProfessionalHelper {
	
	public static function addSubmenu($vName) {
		JSubMenuHelper::addEntry(
			JText::_('COM_PROFESSIONAL_SUBMENU_PROFESSIONALS'),
			'index.php?option=com_professional&view=professionals',
			$vName == 'professionals'
		);
		JSubMenuHelper::addEntry(
			JText::_('COM_PROFESSIONAL_SUBMENU_CATEGORIES'),
			'index.php?option=com_categories&extension=com_professional',
			$vName == 'categories'
		);
		
		$document = JFactory::getDocument();
		$document->addStyleDeclaration('.icon-48-professional {background-image: url(../media/com_professional/images/icon-48-professional.png);}');
		
		if ($vName == 'categories') {
			JToolBarHelper::title(
				JText::sprintf('COM_CATEGORIES_CATEGORIES_TITLE', JText::_('com_professional')),
				'professional-categories');
		}
	}
	
	public static function getActions($categoryId = 0, $professionalId = 0) {
		$user		= JFactory::getUser();
		$result 	= new JObject;
		
		if (empty($professionalId) && empty($categoryId)) {
			$assetName = 'com_professional';
		} else if (empty($professionalId)) {
			$assetName = 'com_professional.category.'.(int) $categoryId;
		} else {
			$assetName = 'com_professional.professional.'.(int) $professionalId;
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