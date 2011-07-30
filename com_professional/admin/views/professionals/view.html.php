<?php
// no direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.view');

class ProfessionalViewProfessionals extends JView {
	protected $items;
	protected $pagination;
	protected $state;
	
	public function display($tpl = null) {
		
		$this->items 		= $this->get('Items');
		$this->pagination 	= $this->get('Pagination');
		$this->state 		= $this->get('State');
		
		if (count($errors = $this->get('Errors'))) {
			JError::raiseError(500, implode("\n", $errors));
			return false;
		}
		
		$this->addToolbar();		
		parent::display($tpl);
	}
	
	protected function addToolbar() {
		
		$canDo	= ProfessionalHelper::getActions($this->state->get('filter.category_id'));
		$user	= JFactory::getUser();		
		JToolBarHelper::title(JText::_('COM_PROFESSIONAL_MANAGER_PROFESSIONALS'), 'professional');
		
		if ($canDo->get('core.create') || (count($user->getAuthorisedCategories('com_professional', 'core.create'))) >0) {
			JToolBarHelper::addNew('professional.add');
		}
		
		if (($canDo->get('core.edit')) || ($canDo->get('core.edit.own'))) {
			JToolBarHelper::editList('professional.edit');
		}

		if ($canDo->get('core.delete')) {
			JToolBarHelper::deleteList('', 'professionals.delete', 'JTOOLBAR_DELETE');
			JToolBarHelper::divider();
		}

		if ($canDo->get('core.admin')) {
			JToolBarHelper::preferences('com_professional');
			JToolBarHelper::divider();
		}
				
		JToolBarHelper::help('JHELP_COMPONENTS_PROFESSIONAL_PROFESSIONALS');
	}
}