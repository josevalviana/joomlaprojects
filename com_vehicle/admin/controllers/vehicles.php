<?php

// No direct access.
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.controlleradmin');

/**
 * Vehicles list controller class.
 * 
 * @subpackage	com_vehicle
 * @since 		1.7
 */
class VehicleControllerVehicles extends JControllerAdmin {
	public function getModel($name = 'Vehicle', $prefix = 'VehicleModel', $config = array('ignore_request' => true)) {
		$model = parent::getModel($name, $prefix, $config);
		
		return $model;
	}
}