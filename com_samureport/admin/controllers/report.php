<?php

// No direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.controllerform');

class SamuReportControllerReport extends JControllerForm {
	
	protected function allowEdit($data = array(), $key = 'id')
	{
		$recordId	= (int) isset($data[$key]) ? $data[$key] : 0;
		$user		= JFactory::getUser();
		$userId		= $user->get('id');
		if ($user->authorise('core.edit', 'com_samureport.report.'.$recordId)) {
			return true;
		}
		if ($user->authorise('core.edit.own', 'com_samureport.report.'.$recordId)) {
			$ownerId	= (int) isset($data['created_by']) ? $data['created_by'] : 0;
			if (empty($ownerId) && $recordId) {
				$record		= $this->getModel()->getItem($recordId);
	
				if (empty($record)) {
					return false;
				}
	
				$ownerId = $record->created_by;
			}
			if ($ownerId == $userId) {
				return true;
			}
		}
		return parent::allowEdit($data, $key);
	}
}
