<?php
// no direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.view');

class HospitalsViewHospitals extends JView {
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
		
		$canDo	= HospitalsHelper::getActions($this->state->get('filter.category_id'));
		$user	= JFactory::getUser();		
		JToolBarHelper::title(JText::_('COM_HOSPITALS_MANAGER_HOSPITALS'), 'hospitals');
		
		if ($canDo->get('core.create') || (count($user->getAuthorisedCategories('com_hospitals', 'core.create'))) >0) {
			JToolBarHelper::addNew('hospital.add');
		}
		
		if (($canDo->get('core.edit')) || ($canDo->get('core.edit.own'))) {
			JToolBarHelper::editList('hospital.edit');
		}

		if ($canDo->get('core.delete')) {
			JToolBarHelper::deleteList('', 'hospitals.delete', 'JTOOLBAR_DELETE');
			JToolBarHelper::divider();
		}

		if ($canDo->get('core.admin')) {
			JToolBarHelper::preferences('com_hospitals');
			JToolBarHelper::divider();
		}
				
		JToolBarHelper::help('JHELP_COMPONENTS_HOSPITALS_HOSPITALS');
	}
}