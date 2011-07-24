<?php

// no direct access
defined('_JEXEC') or die('Restricted access');

// import joomla modelform library
jimport('joomla.application.component.modeladmin');

class VehicleModelVehicle extends JModelAdmin {
	public function getTable($type = 'Vehicle', $prefix = 'VehicleTable', $config = array()) {
		return JTable::getInstance($type, $prefix, $config);
	}
	
	public function getForm($data = array(), $loadData = true) {
		$form = $this->loadForm('com_vehicle.vehicle', 'vehicle', array('control' => 'jform', 'load_data' => $loadData));
		if (empty($form)) {
			return false;
		}
		return $form;
	}
	
	protected function loadFormData() {
		$data = JFactory::getApplication()->getUserState('com_vehicle.edit.'.$this->getName().'.data', array());
		
		if (empty($data)) {
			$data = $this->getItem();
		}
		return $data;
	}
}