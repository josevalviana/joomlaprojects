<?php

defined('_JEXEC') or die;

jimport('joomla.application.component.view');

class FilaUtiViewPacientes extends JView
{
	protected $items;
	protected $pagination;
	protected $state;
	
	public function display($tpl = null)
	{
		$this->items 		= $this->get('Items');
		$this->pagination 	= $this->get('Pagination');
		$this->state 		= $this->get('State');
		
		if (count($errors = $this->get('Errors'))) {
			JError::raiseError(500, implode("\n", $errors));
			return false;
		}
		
		// We don't need toolbar in the modal window.
		if ($this->getLayout() !== 'modal') {
			$this->addToolbar();
		}
		
		parent::display($tpl);
	}
	
	protected function addToolbar()
	{
		$canDo = FilaUtiHelper::getActions();
		$user = JFactory::getUser();
		JToolBarHelper::title(JText::_('COM_FILAUTI_PACIENTES_TITLE'), 'timesand.png');
		
		if ($canDo->get('core.create')) {
			JToolBarHelper::addNew('paciente.add');
		}
		
		if (($canDo->get('core.edit')) || ($canDo->get('core.edit.own'))) {
			JToolBarHelper::editList('paciente.edit');
		}
		
		if ($canDo->get('core.delete')) {
			JToolBarHelper::deleteList('', 'pacientes.delete', 'JTOOLBAR_EMPTY_TRASH');
			JToolBarHelper::divider();
		}
		
		if ($canDo->get('core.admin')) {
			JToolBarHelper::preferences('com_filauti');
			JToolBarHelper::divider();
		}
		
		JToolBarHelper::help('JHELP_FILAUTI_PACIENTE_MANAGER');		
	}
}