<?php

// no direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.controller');

class SamuReportController extends JController
{

	protected $default_view = 'reports';

	public function display($cachable = false, $urlparams = false)
	{
		require_once JPATH_COMPONENT.'/helpers/samureport.php';

		// Load the submenu.
		SamuReportHelper::addSubmenu(JRequest::getCmd('view', 'reports'));

		$view		= JRequest::getCmd('view', 'reports');
		$layout 	= JRequest::getCmd('layout', 'reports');
		$id			= JRequest::getInt('id');

		// Check for edit form.
		if ($view == 'report' && $layout == 'edit' && !$this->checkEditId('com_samureport.edit.report', $id)) {
			// Somehow the person just went to the form - we don't allow that.
			$this->setError(JText::sprintf('JLIB_APPLICATION_ERROR_UNHELD_ID', $id));
			$this->setMessage($this->getError(), 'error');
			$this->setRedirect(JRoute::_('index.php?option=com_samureport&view=reports', false));

			return false;
		}

		parent::display();

		return $this;
	}
}