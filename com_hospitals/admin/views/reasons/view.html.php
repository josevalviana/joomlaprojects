<?php
// no direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.view');

class HospitalsViewReasons extends JView {
	protected $items;
	protected $pagination;
	protected $state;
	
	/**
	 * Display the view
	 */
	public function display($tpl = null) {
		// initialise variables.
		$this->items 		= $this->get('Items');
		$this->pagination	= $this->get('Pagination');
		$this->state 		= $this->get('State');
		
		// check for errors.
		if (count($errors = $this->get('Errors'))) {
			JError::raiseError(500, implode("\n", $errors));
			return false;
		}
		
		$this->addToolbar();
		parent::display($tpl);
	}
	
	protected function addToolbar() {
		
		$canDo = HospitalsHelper::getActions();
		
		JToolBarHelper::title(JText::_('COM_HOSPITALS_MANAGER_REASONS'), 'hospitals-reasons');
		
		if ($canDo->get('core.create')) {
			JToolBarHelper::addNew('reason.add');
		}
		if ($canDo->get('core.edit')) {
			JToolBarHelper::editList('reason.edit');
		}
		if ($canDo->get('core.delete')) {
			JToolBarHelper::deleteList('', 'reasons.delete', 'JTOOLBAR_DELETE');
			JToolBarHelper::divider();
		}
		
		if ($canDo->get('core.admin')) {
			JToolBarHelper::preferences('com_hospitals');
			JToolBarHelper::divider();
		}
		
		JToolBarHelper::help('JHELP_COMPONENTS_HOSPITALS_REASONS');
	}
}