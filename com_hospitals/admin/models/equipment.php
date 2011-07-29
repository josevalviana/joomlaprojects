<?php
// no direct access.
defined('_JEXEC') or die;

jimport('joomla.application.component.modeladmin');

class HospitalsModelEquipment extends JModelAdmin {
	public function getTable($type = 'Equipment', $prefix = 'HospitalsTable', $config = array()) {
		return JTable::getInstance($type, $prefix, $config);
	}
	
	public function getForm($data = array(), $loadData = true) {
		// get the form
		$form = $this->loadForm('com_hospitals.equipment', 'equipment', array('control' => 'jform', 'load_data' => $loadData));
		if (empty($form)) {
			return false;
		}
		
		return $form;
	}
	
	protected function loadFormData() {
		$data = JFactory::getApplication()->getUserState('com_hospitals.edit.equipment.data', array());
		
		if (empty($data)) {
			$data = $this->getItem();
		}
		
		return $data;
	}
	
	protected function prepareTable(&$table) {
		$table->name = htmlspecialchars_decode($table->name, ENT_QUOTES);
	}
}