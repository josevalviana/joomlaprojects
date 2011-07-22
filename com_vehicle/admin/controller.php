<?php

// no direct access
defined('_JEXEC') or die('Restricted access');

// import dependency
jimport('joomla.application.component.controller');

class VehicleController extends JController {
	function display($cachable = false) {
		JRequest::setVar('view', JRequest::getCmd('view', 'Vehicles'));
		
		parent::display($cachable);
	}
}