<?php

// No direct access
defined('_JEXEC') or die('Restricted access');

// import dependency
jimport('joomla.application.component.view');

/**
 * 
 * View class for a list of vehicles.
 * 
 * @author		Joseval Viana
 * @subpackage 	com_vehicle
 * @since		1.7
 *
 */
class VehicleViewVehicles extends JView {
	
	protected $items;
	protected $pagination;
	protected $state;
	
	/**
	 * Display the view
	 */
	function display($tpl=null) {
		
		// Get data from the model
		$this->state = $this->get('State');
		$this->items = $this->get('Items');
		$this->pagination = $this->get('Pagination');
		
		// Check for errors.
		if (count($errors = $this->get('Errors'))) {
			JError::raiseError(500, implode('\n', $errors));
			return false;
		}
		
		$this->addToolbar();
		parent::display($tpl);
		
		$this->setDocument();
	}
	
	protected function addToolbar() {
		$categoryId = $this->state->get('filter.category_id');
		$canDo = VehicleHelper::getActions($categoryId);
		$user = JFactory::getUser();
		JToolBarHelper::title(JText::_('COM_VEHICLE_MANAGER_VEHICLES'), 'vehicle');
		
		if ($canDo->get('core.create') || (count($user->getAuthorisedCategories('com_vehicle', 'core.create'))) >0) {
			JToolBarHelper::addNew('vehicle.add');
		}
		
		if ($canDo->get('core.edit') || ($canDo->get('core.edit.own'))) {
			JToolBarHelper::editList('vehicle.edit');
		}
		
		if ($canDo->get('core.delete')) {
			JToolBarHelper::deleteList('', 'vehicles.delete', 'JTOOLBAR_EMPTY_TRASH');
			JToolBarHelper::divider();
		} else if ($canDo->get('core.edit.state')) {
			JToolBarHelper::trash('vehicles.trash');
			JToolBarHelper::divider();
		}

		if ($canDo->get('core.admin')) {
			JToolBarHelper::preferences('com_vehicle');
			JToolBarHelper::divider();
		}
		
		JToolBarHelper::help('JHELP_COMPONENTS_VEHICLES_VEHICLES');
	}
	
	protected function setDocument() {
		$document = JFactory::getDocument();
		$document->setTitle(JText::_('COM_VEHICLE_ADMINISTRATION'));
	}
}