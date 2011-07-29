<?php
// no direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.modeladmin');

class HospitalsModelHospital extends JModelAdmin {
	public function getTable($type = 'Hospital', $prefix = 'HospitalsTable', $config = array()) {
		return JTable::getInstance($type, $prefix, $config);
	}
	
	public function getForm($data = array(), $loadData = true) {
		$form = $this->loadForm('com_hospitals.hospital', 'hospital', array('control' => 'jform', 'load_data' => $loadData));
		if (empty($form)) {
			return false;
		}
		return $form;
	}
	
	public function loadFormData() {
		$data = JFactory::getApplication()->getUserState('com_hospitals.edit.hospital.data', array());
		
		if (empty($data)) {
			$data = $this->getItem();

			if ($this->getState('hospital.id') == 0) {
				$app = JFactory::getApplication();
				$data->set('catid', JRequest::getInt('catid', $app->getUserState('com_hospitals.hospitals.filter.category_id')));
			}
		}
		
		return $data;
	}
}