<?php
defined('_JEXEC') or die;

jimport('joomla.application.component.modellist');

class SamuReportModelEquipments extends JModelList {
	public function __construct($config = array()) {
		if (empty($config['filter_fields'])) {
			$config['filter_fields'] = array(
				'id', 'a.id',
				'reportid', 'a.reportid',
				'equipmentid', 'a.equipmentid', 'equipment_title'
			);
		}
		
		parent::__construct($config);
	}
	
	protected function populateState($ordering = null, $direction = null) {
		// initialise variables.
		$app = JFactory::getApplication('administrator');
		
		if ($layout = JRequest::getVar('layout')) {
			$this->context .= '.'.$layout;
		}
		
		// Load the filter state.
		$search = $this->getUserStateFromRequest($this->context.'.filter.search', 'filter_search');
		$this->setState('filter.search', $search);
		
		$equipmentId = $this->getUserStateFromRequest($this->context.'.filter.equipment_id', 'filter_equipment_id');
		$this->setState('filter.equipment_id', $equipmentId);
		
		// List state information.
		parent::populateState('a.reportid', 'asc');
	}
	
	protected function getListQuery() {
		// create a new query object.
		$db = $this->getDbo();
		$query = $db->getQuery(true);
		
		// select the required fields from the table.
		$query->select(
			$this->getState(
				'list.select',
				'a.id AS id,'.
				'a.reportid, a.equipmentid'
			)
		);		
		$query->from('`#__samureport_equipments` AS a');
		
		$query->select('b.name AS equipment_title');
		$query->leftJoin('#__equipments AS b ON b.id = a.equipmentid');
		
		$equipmentId = $this->getState('filter.equipment_id');
		if (is_numeric($equipmentId)) {
			$query->where('a.equipmentid = '.(int) $equipmentId);
		} else if (is_array($equipmentId)) {
			JArrayHelper::toInteger($equipmentId);
			$equipmentId = implode(',', $equipmentId);
			$query->where('a.equipmentid IN ('.$equipmentId.')');
		}
		
		// filter by search in title
		$search = $this->getState('filter.search');
		if (!empty($search)) {
			if (stripos($search, 'id:') === 0) {
				$query->where('a.id = '.(int) substr($search, 3));
			}
		}
		
		$orderCol = $this->state->get('list.ordering');
		$orderDirn = $this->state->get('list.direction');
		
		// add the list ordering clause.
		$query->order($db->getEscaped($orderCol.' '.$orderDirn));
		
		return $query;
	}
}