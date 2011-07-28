<?php
// no direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.controllerform');

class HospitalsControllerHospital extends JControllerForm {
	/**
	 * Method override to check if you can edit an existing record.
	 * 
	 * @param	array $data An array of input data.
	 * @param	string $key The name of the key for the primary key.
	 * 
	 * @return	boolean
	 * @since	1.7
	 */
	protected function allowEdit($data = array(), $key = 'id') {
		$recordId 	= (int) isset($data[$key]) ? $data[$key] : 0;
		$user 		= JFactory::getUser();
		$userId 	= $user->get('id');
		
		// check general edit permission first.
		if ($user->authorise('core.edit', 'com_hospitals')) {
			return true;
		}
		
		// fallback on edit.own.
		// first test if the permission is available
		if ($user->authorise('core.edit.own', 'com_hospitals')) {
			$ownerId = (int) isset($data['created_by']) ? $data['created_by'] : 0;
			if (empty($ownerId) && $recordId) {
				// need to do a lookup from the model.
				$record = $this->getModel()->getItem($recordId);
				
				if (empty($record)) {
					return false;
				}
				
				$ownerId = $record->created_by;
			}
			
			// if the owner matches 'me' then do the test.
			if ($ownerId == $userId) {
				return true;
			}
		}
		
		return parent::allowEdit($data, $key);
	}	
}