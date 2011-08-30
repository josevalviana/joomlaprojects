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
class HospitalsViewReason extends JView {
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
		
		JToolBarHelper::title(JText::_('COM_HOSPITALS_MANAGER_REASON'), 'hospitals-reasons');
		
		if ($canDo->get('core.edit') || $canDo->get('core.create')) {
			JToolBarHelper::apply('reason.apply');
			JToolBarHelper::save('reason.save');
			JToolBarHelper::save2new('reason.save2new');
		}
		
		if (!$isNew && $canDo->get('core.create')) {
			JToolBarHelper::save2copy('reason.save2copy');
		}
		
		if (empty($this->item->id)) {
			JToolBarHelper::cancel('reason.cancel');
		} else {
			JToolBarHelper::cancel('reason.cancel', 'JTOOLBAR_CLOSE');
		}
		
		JToolBarHelper::divider();
		JToolBarHelper::help('JHELP_COMPONENTS_HOSPITALS_REASONS_EDIT');
	}
}