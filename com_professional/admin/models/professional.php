<?php
// no direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.modeladmin');

class ProfessionalModelProfessional extends JModelAdmin {
	public function getTable($type = 'Professional', $prefix = 'ProfessionalTable', $config = array()) {
		return JTable::getInstance($type, $prefix, $config);
	}
	
	public function getForm($data = array(), $loadData = true) {
		$form = $this->loadForm('com_professional.professional', 'professional', array('control' => 'jform', 'load_data' => $loadData));
		if (empty($form)) {
			return false;
		}
		return $form;
	}
	
	public function loadFormData() {
		$data = JFactory::getApplication()->getUserState('com_professional.edit.professional.data', array());
		
		if (empty($data)) {
			$data = $this->getItem();

			if ($this->getState('professional.id') == 0) {
				$app = JFactory::getApplication();
				$data->set('catid', JRequest::getInt('catid', $app->getUserState('com_professional.professionals.filter.category_id')));
			}
		}
		
		return $data;
	}
}