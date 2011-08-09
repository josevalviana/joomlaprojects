<?php
// no direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.view');

class HospitalsViewShift extends JView {
	protected $form;
	protected $item;
	protected $state;
	
	public function display($tpl = null) {
		$this->form 	= $this->get('Form');
		$this->item 	= $this->get('Item');
		$this->state 	= $this->get('State');
		
		if (count($errors = $this->get('Errors'))) {
			JError::raiseError(500, implode("\n", $errors));
			return false;
		}
		
		$this->addToolbar();
		parent::display($tpl);
	}
	
	protected function addToolbar() {
		JRequest::setVar('hidemainmenu', true);
	
		$user	= JFactory::getUser();
		$isNew	= ($this->item->id == 0);
		$canDo	= HospitalsHelper::getActions();
	
		JToolBarHelper::title(JText::_('COM_HOSPITALS_MANAGER_SHIFT'), 'hospitals-shifts');
	
		if ($canDo->get('core.edit') || $canDo->get('core.create')) {
			JToolBarHelper::apply('shift.apply');
			JToolBarHelper::save('shift.save');
			JToolBarHelper::save2new('shift.save2new');
		}
	
		if (!$isNew && $canDo->get('core.create')) {
			JToolBarHelper::save2copy('shift.save2copy');
		}
	
		if (empty($this->item->id)) {
			JToolBarHelper::cancel('shift.cancel');
		} else {
			JToolBarHelper::cancel('shift.cancel', 'JTOOLBAR_CLOSE');
		}
	
		JToolBarHelper::divider();
		JToolBarHelper::help('JHELP_COMPONENTS_HOSPITALS_SHIFTS_EDIT');
	}
}