<?php
// no direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.view');

class ProfessionalViewProfessional extends JView {
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
		$canDo = ProfessionalHelper::getActions($this->state->get('filter.category_id'));
		
		JToolBarHelper::title(JText::_('COM_PROFESSIONAL_MANAGER_PROFESSIONAL'), 'professional');
		
		// build the actions for new and existing records.
		if ($isNew) {
			// for new records, check the create permission.
			if ($isNew && (count($user->getAuthorisedCategories('com_professional', 'core.create'))>0)) {
				JToolBarHelper::apply('professional.apply');
				JToolBarHelper::save('professional.save');
				JToolBarHelper::save2new('professional.save2new');
			}
						
			JToolBarHelper::cancel('professional.cancel');
			
		} else {
			if ($canDo->get('core.edit') || ($canDo->get('core.edit.own') && $this->item->created_by == $userId)) {
				JToolBarHelper::apply('professional.apply');
				JToolBarHelper::save('professional.save');
				
				if ($canDo->get('core.create')) {
					JToolBarHelper::save2new('professional.save2new');
					JToolBarHelper::save2copy('professional.save2copy');
				}
			}
			
			JToolBarHelper::cancel('professional.cancel', 'JTOOLBAR_CLOSE');
		}
		
		JToolBarHelper::divider();
		JToolBarHelper::help('JHELP_COMPONENTS_PROFESSIONAL_PROFESSIONAL_EDIT');
	}
}