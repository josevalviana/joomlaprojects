<?php

// No direct access
defined('_JEXEC') or die('Restricted access');

// import dependency
jimport('joomla.application.component.view');

class VehicleViewVehicles extends JView {
	function display($tpl=null) {
		
		// Get data from the model
		$this->state = $this->get('State');
		$this->items = $this->get('Items');
		$this->pagination = $this->get('Pagination');
		
		// Check for errors.
		if (count($errors = $this->get('Errors'))) {
			JError::raiseError(500, implode('<br />', $errors));
			return false;
		}
		
		parent::display($tpl);
	}
}