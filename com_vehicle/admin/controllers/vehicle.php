<?php

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.controllerform');

class VehicleControllerVehicle extends JControllerForm
{
	protected function allowAdd($data = array()) {
		// Initialise variables.
		$user = JFactory::getUser();
		$categoryId = JArrayHelper::getValue($data, 'catid', JRequest::getInt('filter_category_id'), 'int');
		$allow = null;
		
		if ($categoryId) {
			// If the category has been passed in the URL check it.
			$allow = $user->authorise('core.create', $this->option.'.category.'.$categoryId);
		}
		
		if ($allow === null) {
			// In the absense of better information, revert to the component permissions.
			return parent::allowAdd($data);
		} else {
			return $allow;
		}
	}
	
	protected function allowEdit($data = array(), $key = 'id') {
		// Initialise variables.
		$recordId = (int) isset($data[$key]) ? $data[$key] : 0;
		$user = JFactory::getUser();
		$userId = $user->get('id');
		$categoryId = (int) isset($data['catid']) ? $data['catid'] : 0;
		
		// Check general edit permission first.
		if ($user->authorise('core.edit', $this->option.'.category.'.$categoryId)) {
			return true;
		}
		
		// Since there is no asset tracking, revert to the component permissions.
		return parent::allowEdit($data, $key);
	}
}