<?php
defined('_JEXEC') or die;

jimport('joomla.application.component.modellist');

class HospitalsModelSpecialties extends JModelList {
	public function __construct($config = array()) {
		if (empty($config['filter_fields'])) {
			$config['filter_fields'] = array(
				'id', 'a.id',
				'name', 'a.name',
			);
		}
		
		parent::__construct($config);
	}
	
	protected function populateState($ordering = null, $direction = null) {
		// initialise variables.
		$app = JFactory::getApplication('administrator');
		
		// Load the filter state.
		$search = $this->getUserStateFromRequest($this->context.'.filter.search', 'filter_search');
		$this->setState('filter.search', $search);
		
		// List state information.
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
				'a.id AS id,'.
				'a.name AS name'
			)
		);
		
		$query->from('`#__specialties` AS a');
		
		// filter by search in title
		$search = $this->getState('filter.search');
		if (!empty($search)) {
			if (stripos($search, 'id:') === 0) {
				$query->where('a.id = '.(int) substr($search, 3));
			} else {
				$search = $db->Quote('%'.$db->getEscaped($search, true).'%');
				$query->where('a.name LIKE '.$search);
			}
		}
		
		// add the list ordering clause.
		$query->order($db->getEscaped($this->getState('list.ordering', 'a.name')).' '.$db->getEscaped($this->getState('list.direction', 'asc')));
		
		return $query;
	}
}