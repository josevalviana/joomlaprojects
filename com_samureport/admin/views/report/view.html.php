<?php

// No direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.view');

class SamuReportViewReport extends JView
{
	protected $form;
	protected $item;
	protected $equipments;
	protected $state;

	public function display($tpl = null)
	{
		// Initialiase variables.
		$this->form		 = $this->get('Form');
		$this->item		 = $this->get('Item');
		$this->equipments = $this->get('Equipments');
		$this->state	 = $this->get('State');		
		$this->canDo	 = SamuReportHelper::getActions($this->state->get('filter.hospital_id'));

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
		$user		= JFactory::getUser();
		$userId		= $user->get('id');
		$isNew		= ($this->item->id == 0);
		$canDo		= SamuReportHelper::getActions($this->state->get('filter.hospital_id'), $this->item->id);
		JToolBarHelper::title(JText::_('COM_SAMUREPORT_PAGE_'.($isNew ? 'ADD_REPORT' : 'EDIT_REPORT')), 'report-add.png');

		// Built the actions for new and existing records.

		// For new records, check the create permission.
		if ($isNew) {
			JToolBarHelper::apply('report.apply');
			JToolBarHelper::save('report.save');
			JToolBarHelper::save2new('report.save2new');
			JToolBarHelper::cancel('report.cancel');
		}
		else {
			// Since it's an existing record, check the edit permission, or fall back to edit own if the owner.
			if ($canDo->get('core.edit') || ($canDo->get('core.edit.own') && $this->item->created_by == $userId)) {
				JToolBarHelper::apply('report.apply');
				JToolBarHelper::save('report.save');
			}
			
			if ($canDo->get('core.create')) {
				JToolBarHelper::save2new('report.save2new');
				JToolBarHelper::save2copy('report.save2copy');
			}

			JToolBarHelper::cancel('report.cancel', 'JTOOLBAR_CLOSE');
		}

		JToolBarHelper::divider();
		JToolBarHelper::help('JHELP_SAMUREPORT_REPORT_MANAGER_EDIT');
	}
}