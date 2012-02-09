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
		$user = JFactory::getUser();
		JToolBarHelper::title(JText::_('COM_FILAUTI_PACIENTES_TITLE'), 'paciente.png');
		
		JToolBarHelper::addNew('paciente.add');
		JToolBarHelper::editList('paciente.edit');		
		JToolBarHelper::deleteList('', 'pacientes.delete', 'JTOOLBAR_EMPTY_TRASH');
		JToolBarHelper::divider();
		
		JToolBarHelper::preferences('com_filauti');
		JToolBarHelper::divider();
		
		JToolBarHelper::help('JHELP_FILAUTI_PACIENTE_MANAGER');		
	}
}