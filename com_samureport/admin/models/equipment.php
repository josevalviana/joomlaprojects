<?php

// No direct access.
defined('_JEXEC') or die;

jimport('joomla.application.component.modeladmin');

class SamuReportModelEquipment extends JModelAdmin
{
	protected $text_prefix = 'COM_SAMUREPORT';

	public function getForm($data = array(), $loadData = true) {
		
		if (empty($data)) {
			$item = $this->getItem();
			$reportId = $item->reportid;
			$equipment = $item->equipment;
		} else {
			$reportId = JArrayHelper::getValue($data, 'reportid');
			$equipment = $item->equipment;
		}
		
		$this->setState('item.reportid', $reportId);
		$this->setState('item.equipment', $equipment);
			
		$form = $this->loadForm('com_samureport.equipment', 'equipment', array('control' => 'jform', 'load_data' => $loadData));
		if (empty($form)) {
			return false;
		}

		return $form;
	}
	
	protected function populateState()
	{
		$app = JFactory::getApplication('administrator');
	
		// Load the User state.
		if (!($pk = (int) JRequest::getInt('id'))) {
			if ($reportId = (int) $app->getUserState('com_samureport.add.equipment.reportid')) {
				$this->setState('report.id', $reportId);
			}
		}
		$this->setState('equipment.id', $pk);
	}

	protected function loadFormData()
	{
		// Check the session for previously entered form data.
		$data = JFactory::getApplication()->getUserState('com_samureport.edit.equipment.data', array());

		if (empty($data)) {
			$data = $this->getItem();
		}

		return $data;
	}

	public function getTable($type = 'Equipment', $prefix = 'SamuReportTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}	
}