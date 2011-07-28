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
		
		$document = JFactory::getDocument();
		$document->addStyleDeclaration('.icon-48-hospitals {background-image: url(../media/com_hospitals/images/icon-48-hospitals.png);}');
		
		$this->addToolbar();		
		parent::display($tpl);
	}
	
	protected function addToolbar() {
		JToolBarHelper::title(JText::_('COM_HOSPITALS_MANAGER_HOSPITALS'), 'hospitals');
		
		JToolBarHelper::addNew('hospital.add');
		JToolBarHelper::editList('hospital.edit');
		
		JToolBarHelper::deleteList('', 'hospitals.delete', 'JTOOLBAR_EMPTY_TRASH');
		JToolBarHelper::divider();
		
		JToolBarHelper::trash('hospitals.trash');
		JToolBarHelper::divider();
		
		JToolBarHelper::preferences('com_hospitals');
		JToolBarHelper::divider();
		
		JToolBarHelper::help('JHELP_COMPONENTS_HOSPITALS_HOSPITALS');
	}
}