<?php

defined('_JEXEC') or die;

jimport('joomla.application.component.view');

class FilaUtiViewPaciente extends JView
{
	protected $form;
	protected $item;
        protected $evolucoes;
        protected $sofas;
	protected $state;
	
	public function display($tpl = null)
	{
		// Initialiase variables.
		$this->form		= $this->get('Form');
		$this->item             = $this->get('Item');
                $this->evolucoes        = $this->get('Evolucoes');
                $this->sofas            = $this->get('Sofas');
		$this->state            = $this->get('State');
		$this->canDo            = FilaUtiHelper::getActions();
		
		// Check for errors.
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
		$canDo = FilaUtiHelper::getActions($this->item->id);
		JToolBarHelper::title(JText::_('COM_FILAUTI_PAGE_'.($isNew ? 'ADD_PACIENTE' : 'EDIT_PACIENTE')), 'timesand.png');
		
		if ($isNew) {
			JToolBarHelper::apply('paciente.apply');
			JToolBarHelper::save('paciente.save');
			JToolBarHelper::save2new('paciente.save2new');
			JToolBarHelper::cancel('paciente.cancel');
		} else {
			if ($canDo->get('core.edit') || ($canDo->get('core.edit.own') && $this->item->created_by == $userId)) {
				JToolBarHelper::apply('paciente.apply');
				JToolBarHelper::save('paciente.save');
				
				if ($canDo->get('core.create')) {
					JToolBarHelper::save2new('paciente.save2new');
					JToolBarHelper::save2copy('paciente.save2copy');
				}
			}
			JToolBarHelper::cancel('paciente.cancel', 'JTOOLBAR_CLOSE');
		}
		
		JToolBarHelper::divider();
		JToolBarHelper::help('JHELP_FILAUTI_PACIENTE_MANAGER_EDIT');
	}
}