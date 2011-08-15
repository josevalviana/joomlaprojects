<?php

// No direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.view');

class SamuReportViewReports extends JView
{
	protected $items;
	protected $pagination;
	protected $state;

	public function display($tpl = null)
	{
		$this->items		= $this->get('Items');
		$this->pagination	= $this->get('Pagination');
		$this->state		= $this->get('State');		
		$this->hospitals    = $this->get('Hospitals');
		$this->authors		= $this->get('Authors');
		$this->shifts       = $this->get('Shifts');

		// Check for errors.
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
		$canDo		= SamuReportHelper::getActions($this->state->get('filter.hospital_id'));
		$user		= JFactory::getUser();
		JToolBarHelper::title(JText::_('COM_SAMUREPORT_REPORTS_TITLE'), 'report.png');

		if ($canDo->get('core.create')) {
			JToolBarHelper::addNew('report.add');
		}

		if (($canDo->get('core.edit')) || ($canDo->get('core.edit.own'))) {
			JToolBarHelper::editList('report.edit');
		}

		if ($canDo->get('core.delete')) {
			JToolBarHelper::deleteList('', 'reports.delete','JTOOLBAR_DELETE');
			JToolBarHelper::divider();
		}

		if ($canDo->get('core.admin')) {
			JToolBarHelper::preferences('com_samureport');
			JToolBarHelper::divider();
		}

		JToolBarHelper::help('JHELP_SAMUREPORT_REPORT_MANAGER');
	}
}
