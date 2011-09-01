<?php
// no direct access.
defined('_JEXEC') or die;

jimport('joomla.application.component.modeladmin');

class SamuReportModelReason extends JModelAdmin {
	public function getTable($type = 'Reason', $prefix = 'SamuReportTable', $config = array()) {
		return JTable::getInstance($type, $prefix, $config);
	}
	
	public function getForm($data = array(), $loadData = true) {
		// get the form
		$form = $this->loadForm('com_samureport.reason', 'reason', array('control' => 'jform', 'load_data' => $loadData));
		if (empty($form)) {
			return false;
		}
		
		return $form;
	}
	
	protected function loadFormData() {
		$data = JFactory::getApplication()->getUserState('com_samureport.edit.reason.data', array());
		
		if (empty($data)) {
			$data = $this->getItem();			
			
			if ($this->getState('reason.id') == 0) {
				$app = JFactory::getApplication();
				$data->set('reportid', JRequest::getInt('reportid', $app->getUserState('com_samureport.add.reason.reportid')));
			}
		}
		
		return $data;
	}
}