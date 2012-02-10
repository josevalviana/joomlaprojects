<?php

defined('_JEXEC') or die;

jimport('joomla.application.component.view');

class FilaUtiViewPaciente extends JView
{
	protected $form;
	protected $item;
	protected $state;
	
	public function display($tpl = null)
	{
		$this->form = $this->get('Form');
		$this->item = $this->get('Item');
		$this->state = $this->get('State');
		//$this->canDo = FilaUtiHelper::getActions();
		
		if (count($errors = $this->get('Errors'))) {
			JError::raiseError(500, implode("\n", $errors));
			return false;
		}
		
		$this->addToolbar();
		parent::display($tpl);
	}
	
	protected function addToolbar()
	{
		JRequest::setVar('hidemainmenu', true);
		$user = JFactory::getUser();
		$userId = $user->get('id');
		$isNew = ($this->item->id == 0);
		//$canDo = FilaUtiHelper::getActions();
		JToolBarHelper::title(JText::_('COM_FILAUTI_PAGE_'.($isNew ? 'ADD_PACIENTE' : 'EDIT_PACIENTE')), 'paciente-add.png');
		
		if ($isNew) {
			JToolBarHelper::apply('paciente.apply');
			JToolBarHelper::save('paciente.save');
			JToolBarHelper::save2new('paciente.save2new');
			JToolBarHelper::cancel('paciente.cancel');
		} else {
			JToolBarHelper::apply('paciente.apply');
			JToolBarHelper::save('paciente.save');
			JToolBarHelper::cancel('paciente.cancel', 'JTOOLBAR_CLOSE');
		}
		
		JToolBarHelper::divider();
		JToolBarHelper::help('JHELP_FILAUTI_PACIENTE_MANAGER_EDIT');
	}
}