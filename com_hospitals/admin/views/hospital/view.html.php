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
		
		$document = JFactory::getDocument();
		$document->addStyleDeclaration('.icon-48-hospitals {background-image: url(../media/com_hospitals/images/icon-48-hospitals.png);}');
		
		$this->addToolbar();
		parent::display($tpl);
	}
	
	protected function addToolbar() {
		JRequest::setVar('hidemainmenu', true);
		
		$isNew = ($this->item->id == 0);
		
		JToolBarHelper::title(JText::_('COM_HOSPITALS_MANAGER_HOSPITAL'), 'hospitals');
		
		JToolBarHelper::apply('hospital.apply');
		JToolBarHelper::save('hospital.save');
		JToolBarHelper::save2new('hospital.save2new');
		JToolBarHelper::save2copy('hospital.save2copy');
		JToolBarHelper::cancel('hospital.cancel', 'JTOOLBAR_CLOSE');
		JToolBarHelper::divider();
		JToolBarHelper::help('JHELP_COMPONENTS_HOSPITALS_HOSPITALS_EDIT');
	}
}