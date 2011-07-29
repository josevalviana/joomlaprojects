<?php
// no direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.controllerform');

class HospitalsControllerHospital extends JControllerForm {
	
	protected function allowAdd($data = array()) {
		$user = JFactory::getUser();
		$categoryId = JArrayHelper::getValue($data, 'catid', JRequest::getInt('filter_category_id'), 'int');
		$allow = null;
		
		if ($categoryId) {
			$allow = $user->authorise('core.create', $this->option.'.category.'.$categoryId);
		}
		
		if ($allow === null) {
			return parent::allowAdd($data);
		} else {
			return $allow;
		}
	}
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
		$categoryId = (int) isset($data['catid']) ? $data['catid'] :0;
		
		// check general edit permission first.
		if ($user->authorise('core.edit', $this->option.'.category.'.$categoryId)) {
			return true;
		}
		
		// fallback on edit.own.
		// first test if the permission is available
		if ($user->authorise('core.edit.own', $this->option.'.category.'.$categoryId)) {
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