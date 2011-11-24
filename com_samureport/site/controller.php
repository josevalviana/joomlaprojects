<?php

defined('_JEXEC') or die;

jimport('joomla.application.component.controller');

class SamuReportController extends JController {
	public function display($cachable = false, $urlparams = false) {
		$cachable = true;
		
		JHtml::_('behavior.caption');
		
		$id = JRequest::getInt('a_id');
		$vName = JRequest::getCmd('view', 'reports');
		JRequest::setVar('view', $vName);
		
		$user = JFactory::getUser();
		
		if ($vName == 'form' && !$this->checkEditId('com_samureport.edit.report', $id)) {
			return JError::raiseError(403, JText::sprintf('JLIB_APPLICATION_ERROR_UNHELD_ID', $id));
		}
		
		parent::display($cachable, $urlparams);
		
		return $this;
	}
}