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
	}
	
	protected function addToolbar() {
		JToolBarHelper::title(JText::_('COM_VEHICLE_MANAGER_VEHICLES'));
		JToolBarHelper::addNew('vehicle.add');
		JToolBarHelper::editList('vehicle.edit');
		JToolBarHelper::deleteList('', 'vehicle.delete', 'JTOOLBAR_EMPTY_TRASH');
		JToolBarHelper::divider();
		JToolBarHelper::trash('vehicle.trash');
		JToolBarHelper::divider();
		JToolBarHelper::preferences('com_vehicle');
	}
}