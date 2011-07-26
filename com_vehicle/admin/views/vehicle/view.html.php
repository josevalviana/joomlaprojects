<?php

// no direct access
defined('_JEXEC') or die('Restricted access');

// importing dependency
jimport('joomla.application.component.view');

/**
 * View to edit a vehicle.
 * 
 * @subpackage	com_vehicle
 * @since		1.7
 */
class VehicleViewVehicle extends JView
{
	protected $form;
	protected $item;
	protected $state;
	
	/**
	 * Display the view
	 */
	public function display($tpl = null) {
		// Initialise variables.
		$this->form		= $this->get('Form');
		$this->item		= $this->get('Item');
		$this->state	= $this->get('State');
		
		// Check for errors.
		if (count($errors = $this->get('Errors'))) {
			JError::raiseError(500, implode("\n", $errors));
			return false;
		}
		
		$this->addToolbar();
		parent::display($tpl);
		
		$this->setDocument();
	}
	
	protected function addToolbar() {
		JRequest::setVar('hidemainmenu', true);
		
		$categoryId = $this->state->get('filter.category_id');
		
		$user = JFactory::getUser();
		$isNew = ($this->item->id == 0);
		$canDo = VehicleHelper::getActions($categoryId);
		
		JToolBarHelper::title(JText::_('COM_VEHICLE_MANAGER_VEHICLE'), 'vehicle');
		
		if ($isNew) {
			if ($isNew && (count($user->getAuthorisedCategories('com_vehicle', 'core.create')) >0)) {
				JToolBarHelper::apply('vehicle.apply');
				JToolBarHelper::save('vehicle.save');
				JToolBarHelper::save2new('vehicle.save2new');
			}
			
			JToolBarHelper::cancel('vehicle.cancel');
		} else {
			if ($canDo->get('core.edit') || ($canDo->get('core.edit.own'))) {
				JToolBarHelper::apply('vehicle.apply');
				JToolBarHelper::save('vehicle.save');
				
				if ($canDo->get('core.create')) {
					JToolBarHelper::save2new('vehicle.save2new');
					JToolBarHelper::save2copy('vehicle.save2copy');
				}								
			}
			
			JToolBarHelper::cancel('vehicle.cancel', 'JTOOLBAR_CLOSE');
		}
		
		JToolBarHelper::divider();
		JToolBarHelper::help('JHELP_COMPONENTS_VEHICLES_VEHICLES_EDIT');
	}
	
	protected function setDocument() {
		$isNew = ($this->item->id < 1);
		$document = JFactory::getDocument();
		$document->setTitle($isNew ? JText::_('COM_VEHICLE_VEHICLE_CREATING') : JText::_('COM_VEHICLE_VEHICLE_EDITING'));
	}
}