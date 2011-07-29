<?php
// no direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.view');

class HospitalsViewHospital extends JView {
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
		
		$user = JFactory::getUser();
		$userId = $user->get('id');
		$isNew = ($this->item->id == 0);
		$canDo = HospitalHelper::getActions($this->state->get('filter.category_id'));
		
		JToolBarHelper::title(JText::_('COM_HOSPITALS_MANAGER_HOSPITAL'), 'hospitals');
		
		// build the actions for new and existing records.
		if ($isNew) {
			// for new records, check the create permission.
			if ($isNew && (count($user->getAuthorisedCategories('com_hospitals', 'core.create'))>0)) {
				JToolBarHelper::apply('hospital.apply');
				JToolBarHelper::save('hospital.save');
				JToolBarHelper::save2new('hospital.save2new');
			}
						
			JToolBarHelper::cancel('hospital.cancel');
			
		} else {
			if ($canDo->get('core.edit') || ($canDo->get('core.edit.own') && $this->item->created_by == $userId)) {
				JToolBarHelper::apply('hospital.apply');
				JToolBarHelper::save('hospital.save');
				
				if ($canDo->get('core.create')) {
					JToolBarHelper::save2new('hospital.save2new');
					JToolBarHelper::save2copy('hospital.save2copy');
				}
			}
			
			JToolBarHelper::cancel('hospital.cancel', 'JTOOLBAR_CLOSE');
		}
		
		JToolBarHelper::divider();
		JToolBarHelper::help('JHELP_COMPONENTS_HOSPITALS_HOSPITALS_EDIT');
	}
}