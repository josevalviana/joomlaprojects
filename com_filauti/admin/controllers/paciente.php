<?php

defined('_JEXEC') or die;

jimport('joomla.application.component.controllerform');

class FilaUtiControllerPaciente extends JControllerForm
{
	function __construct($config = array())
	{
		$this->view_list = 'pacientes';
		
		parent::__construct($config);
	}
	
	protected function allowEdit($data = array(), $key = 'id')
	{
		// Initialise variables.
		$recordId = (int) isset($data[$key]) ? $data[$key] : 0;
		$user		= JFactory::getUser();
		$userId		= $user->get('id');
		
		// Check general edit permission first.
		if ($user->authorise('core.edit', 'com_filauti.paciente.'.$recordId)) {
			return true;
		}
		
		// Fallback on edit.own.
		// First test if the permission is available.
		if ($user->authorise('core.edit.own', 'com_filauti.paciente.'.$recordId)) {
			// Now test the owner is the user.
			$ownerId = (int) isset($data['created_by']) ? $data['created_by'] : 0;
			if (empty($ownerId) && $recordId) {
				// Need to do a lookup from the model.
				$record = $this->getModel()->getItem($recordId);
				
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
}