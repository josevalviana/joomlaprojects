<?php
// no direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.controllerform');

class SamuReportControllerVehicle extends JControllerForm {

	protected $text_prefix = 'COM_SAMUREPORT_VEHICLE';
	
	public function add()
	{
		// Initialise variables.
		$app = JFactory::getApplication();
	
		// Get the result of the parent method. If an error, just return it.
		$result = parent::add();
		if (JError::isError($result)) {
			return $result;
		}
	
		// Look for the Report ID.
		$reportId = JRequest::getInt('reportid');
		if (empty($reportId)) {
			$this->setRedirect(JRoute::_('index.php?option='.$this->option.'&view='.$this->view_item.'&layout=edit', false));
			return JError::raiseWarning(500, JText::_('COM_MODULES_ERROR_INVALID_EXTENSION'));
		}
	
		$app->setUserState('com_samureport.add.vehicle.reportid', $reportId);
	}
}