<?php

// No direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.modeladmin');

require_once JPATH_COMPONENT_ADMINISTRATOR.'/helpers/samureport.php';

class SamuReportModelReport extends JModelAdmin
{
	/**
	 * @var		string	The prefix to use with controller messages.
	 * @since	1.6
	 */
	protected $text_prefix = 'COM_SAMUREPORT';

	protected function canDelete($record)
	{
		if (!empty($record->id)) {
			$user = JFactory::getUser();
			return $user->authorise('core.delete', 'com_samureport.report.'.(int) $record->id);
		}
	}

	public function getTable($type = 'Report', $prefix = 'SamuReportTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}

	public function getForm($data = array(), $loadData = true)
	{
		// Get the form.
		$form = $this->loadForm('com_samureport.report', 'report', array('control' => 'jform', 'load_data' => $loadData));
		if (empty($form)) {
			return false;
		}

		// Determine correct permissions to check.
		if ($id = (int) $this->getState('report.id')) {
			// Existing record. Can only edit in selected categories.
			$form->setFieldAttribute('hospitalid', 'action', 'core.edit');
			// Existing record. Can only edit own articles in selected categories.
			$form->setFieldAttribute('hospitalid', 'action', 'core.edit.own');
		}
		else {
			// New record. Can only create in selected categories.
			$form->setFieldAttribute('hospitalid', 'action', 'core.create');
		}

		return $form;
	}

	protected function loadFormData()
	{
		// Check the session for previously entered form data.
		$data = JFactory::getApplication()->getUserState('com_samureport.edit.report.data', array());

		if (empty($data)) {
			$data = $this->getItem();

			// Prime some default values.
			if ($this->getState('report.id') == 0) {
				$app = JFactory::getApplication();
				$data->set('hospitalid', JRequest::getInt('hospitalid', $app->getUserState('com_samureport.reports.filter.hospital_id')));
			}
		}

		return $data;
	}
	
	public function getEquipments() {
		$db = $this->getDbo();
		$query = $db->getQuery(true);
		
		$query->select('a.id, a.reportid, e.name');
		$query->from('#__samureport_equipments AS a');
		$query->join('RIGHT', '#__equipments AS e ON e.id = a.equipmentid');
		$query->where('a.reportid = '.(int) $this->getState('report.id'));		
		$query->group('a.id');
		$query->order('e.name');
		
		$db->setQuery($query);
		$result = $db->loadObjectList();
		
		if ($error = $db->getError()) {
			$this->setError($error);
			return false;
		}
		
		return $result;
	}
	
	public function getVehicles() {
		$db = $this->getDbo();
		$query = $db->getQuery(true);
	
		$query->select('a.id, a.reportid, v.name, a.quantity');
		$query->from('#__samureport_vehicles AS a');
		$query->join('RIGHT', '#__vehicle AS v ON v.id = a.vehicleid');
		$query->where('a.reportid = '.(int) $this->getState('report.id'));
		$query->group('a.id');
		$query->order('v.name');
	
		$db->setQuery($query);
		$result = $db->loadObjectList();
	
		if ($error = $db->getError()) {
			$this->setError($error);
			return false;
		}
	
		return $result;
	}
	
	public function getProfessionals() {
		$db = $this->getDbo();
		$query = $db->getQuery(true);
	
		$query->select('s.id, s.reportid, p.name AS pname, sp.name AS spname');
		$query->from('#__samureport_staff AS s');
		$query->join('RIGHT', '#__professional AS p ON p.id = s.profid');
		$query->join('RIGHT', '#__specialties AS sp ON sp.id = s.specid');
		$query->where('s.reportid = '.(int) $this->getState('report.id'));
		$query->group('s.id');
		$query->order('p.name');
	
		$db->setQuery($query);
		$result = $db->loadObjectList();
	
		if ($error = $db->getError()) {
			$this->setError($error);
			return false;
		}
	
		return $result;
	}
	
	public function getReasons() {
		$db = $this->getDbo();
		$query = $db->getQuery(true);
	
		$query->select('r.id, r.reportid, pf.name AS pfname, pt.name AS ptname, rr.name AS rrname');
		$query->from('#__samureport_reasons AS r');
		$query->join('RIGHT', '#__professional AS pf ON pf.id = r.proffromid');
		$query->join('RIGHT', '#__professional AS pt ON pt.id = r.proftoid');
		$query->join('RIGHT', '#__replacement_reasons AS rr ON rr.id = r.reasonid');
		$query->where('r.reportid = '.(int) $this->getState('report.id'));
		$query->group('r.id');
		$query->order('pf.name');
	
		$db->setQuery($query);
		$result = $db->loadObjectList();
	
		if ($error = $db->getError()) {
			$this->setError($error);
			return false;
		}
	
		return $result;
	}
	
}