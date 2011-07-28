<?php
// no direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.modellist');

class HospitalsModelHospitals extends JModelList {
	public function __construct($config = array()) {
		if (empty($config['filter_fields'])) {
			$config['filter_fields'] = array(
				'id', 'a.id',
				'name', 'a.name',
				'created', 'a.created',
				'created_by', 'a.created_by'
			);
		}
		
		parent::__construct($config);
	}
	
	protected function populateState($ordering = null, $direction = null) {
		$app = JFactory::getApplication();
		
		parent::populateState('a.name', 'asc');
	}
	
	protected function getListQuery() {
		// create a new query object.
		$db = $this->getDbo();
		$query = $db->getQuery(true);
		
		// select the required fields from the table.
		$query->select(
			$this->getState(
				'list.select',
				'a.id, a.name, a.created, a.created_by'
			)
		);
		$query->from('#__hospitals AS a');
		
		$orderCol = $this->state->get('list.ordering');
		$orderDirn = $this->state->get('list.direction');
		
		$query->order($db->getEscaped($orderCol.' '.$orderDirn));
		
		return $query;
	}
}