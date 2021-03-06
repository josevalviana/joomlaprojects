<?php

// no direct access
defined('_JEXEC') or die('Restricted access');

// import joomla modelform library
jimport('joomla.application.component.modeladmin');

class VehicleModelVehicle extends JModelAdmin {
	
	protected function canDelete($record) {
		if (!empty($record->id)) {
			$user = JFactory::getUser();			
			return $user->authorise('core.delete', 'com_vehicle.category.'.(int) $record->catid);
		}
	}
	
	protected function canEditState($record) {
		if (!empty($record->catid)) {
			$user = JFactory::getUser();
			return $user->authorise('core.edit.state', 'com_vehicle.category.'.(int) $record->catid);
		} else {
			return parent::canEditState($record);
		}
	}
	
	public function getTable($type = 'Vehicle', $prefix = 'VehicleTable', $config = array()) {
		return JTable::getInstance($type, $prefix, $config);
	}
	
	public function getForm($data = array(), $loadData = true) {
		jimport('joomla.form.form');
		JForm::addFieldPath('JPATH_ADMINISTRATOR/components/com_users/models/fields');
		
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
			
			// Prime some default values.
			if ($this->getState('vehicle.id') == 0) {
				$app = JFactory::getApplication();
				$data->set('catid', JRequest::getInt('catid', $app->getUserState('com_vehicle.vehicles.filter.category_id')));
			}
		}
		return $data;
	}
}