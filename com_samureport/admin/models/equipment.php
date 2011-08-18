<?php
// no direct access.
defined('_JEXEC') or die;

jimport('joomla.application.component.modeladmin');

class SamuReportModelEquipment extends JModelAdmin {
	public function getTable($type = 'Equipment', $prefix = 'SamuReportTable', $config = array()) {
		return JTable::getInstance($type, $prefix, $config);
	}
	
	public function getForm($data = array(), $loadData = true) {
		// get the form
		$form = $this->loadForm('com_samureport.equipment', 'equipment', array('control' => 'jform', 'load_data' => $loadData));
		if (empty($form)) {
			return false;
		}
		
		return $form;
	}
	
	protected function loadFormData() {
		$data = JFactory::getApplication()->getUserState('com_samureport.edit.equipment.data', array());
		
		if (empty($data)) {
			$data = $this->getItem();			
			
			if ($this->getState('equipment.id') == 0) {
				$app = JFactory::getApplication();
				$data->set('reportid', JRequest::getInt('reportid', $app->getUserState('com_samureport.add.equipment.reportid')));
			}
		}
		
		return $data;
	}
}