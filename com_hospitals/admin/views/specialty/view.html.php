<?php
// no direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.view');

/**
 * View to edit an equipment.
 * 
 * @subpackage	com_hospitals
 * @since 1.7
 */
class HospitalsViewSpecialty extends JView {
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
		
		$this->addToolbar();
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
		$canDo	= HospitalsHelper::getActions();
		
		JToolBarHelper::title(JText::_('COM_HOSPITALS_MANAGER_SPECIALTY'), 'hospitals-specialties');
		
		if ($canDo->get('core.edit') || $canDo->get('core.create')) {
			JToolBarHelper::apply('specialty.apply');
			JToolBarHelper::save('specialty.save');
			JToolBarHelper::save2new('specialty.save2new');
		}
		
		if (!$isNew && $canDo->get('core.create')) {
			JToolBarHelper::save2copy('specialty.save2copy');
		}
		
		if (empty($this->item->id)) {
			JToolBarHelper::cancel('specialty.cancel');
		} else {
			JToolBarHelper::cancel('specialty.cancel', 'JTOOLBAR_CLOSE');
		}
		
		JToolBarHelper::divider();
		JToolBarHelper::help('JHELP_COMPONENTS_HOSPITALS_SPECIALTIES_EDIT');
	}
}