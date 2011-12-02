<?php
// no direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.controllerform');

class SamuReportControllerEquipment extends JControllerForm {

	protected $text_prefix = 'COM_SAMUREPORT_EQUIPMENT';
	
	protected function allowEdit($data = array(), $key = 'id')
	{
		// Initialise variables.
		$recordId	= (int) isset($data[$key]) ? $data[$key] : 0;
		$user		= JFactory::getUser();
		$userId		= $user->get('id');
	
		// Check general edit permission first.
		if ($user->authorise('core.edit', 'com_samureport.equipment.'.$recordId)) {
			return true;
		}
	
		// Fallback on edit.own.
		// First test if the permission is available.
		if ($user->authorise('core.edit.own', 'com_samureport.equipment.'.$recordId)) {
			// Now test the owner is the user.
			$ownerId	= (int) isset($data['created_by']) ? $data['created_by'] : 0;
			if (empty($ownerId) && $recordId) {
				// Need to do a lookup from the model.
				$record		= $this->getModel()->getItem($recordId);
	
				if (empty($record)) {
					return false;
				}
	
				$ownerId = $record->created_by;
			}
	
			// If the owner matches 'me' then do the test.
			if ($ownerId == $userId) {
				return true;
			}
		}
	
		// Since there is no asset tracking, revert to the component permissions.
		return parent::allowEdit($data, $key);
	}
	
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
	
		$app->setUserState('com_samureport.add.equipment.reportid', $reportId);
	}

}