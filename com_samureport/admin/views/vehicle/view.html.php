<?php
// no direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.view');

class SamuReportViewVehicle extends JView {
	protected $form;
	protected $item;
	protected $state;
	
	/**
	 * Display the view
	 */
	public function display($tpl = null) {
		// initialise variables.
		$this->form		= $this->get('Form');
		$this->item 	= $this->get('Item');
		$this->state	= $this->get('State');
		
		// check for errors.
		if (count($errors = $this->get('Errors'))) {
			JError::raiseError(500, implode("\n", $errors));
			return false;
		}
		
		if ($this->getLayout() !== 'modal') {
			$this->addToolbar();
		}
		
		parent::display($tpl);
	}
	
	/**
	 * Add the page title and toolbar.
	 * 
	 * @since 1.7
	 */
	protected function addToolbar() {
		JRequest::setVar('hidemainmenu', true);
		
		$user	= JFactory::getUser();
		$isNew	= ($this->item->id == 0);
		$canDo	= SamuReportHelper::getActions();
		
		JToolBarHelper::title(JText::_('COM_SAMUREPORT_MANAGER_VEHICLE'), 'reports-vehicles');
		
		if ($canDo->get('core.edit') || $canDo->get('core.create')) {
			JToolBarHelper::apply('vehicle.apply');
			JToolBarHelper::save('vehicle.save');
			JToolBarHelper::save2new('vehicle.save2new');
		}
		
		if (!$isNew && $canDo->get('core.create')) {
			JToolBarHelper::save2copy('vehicle.save2copy');
		}
		
		if (empty($this->item->id)) {
			JToolBarHelper::cancel('vehicle.cancel');
		} else {
			JToolBarHelper::cancel('vehicle.cancel', 'JTOOLBAR_CLOSE');
		}
		
		JToolBarHelper::divider();
		JToolBarHelper::help('JHELP_COMPONENTS_REPORTS_VEHICLES_EDIT');
	}
}