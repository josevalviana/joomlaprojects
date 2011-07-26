<?php
// no direct access
defined('_JEXEC') or die('Restricted access');

// import modellist library
jimport('joomla.application.component.modellist');

/**
 * Methods supporting a list of vehicles.
 * @author 		Joseval Viana
 * @subpackage	com_vehicle
 *
 */
class VehicleModelVehicles extends JModelList {
	
	/**
	 * Constructor.
	 * 
	 * @param	array	An optional associative array of configuration settings.
	 * @see		JController
	 * @since	1.7
	 */
	public function __construct($config = array()) {
		if (empty($config['filter_fields'])) {
			$config['filter_fields'] = array (
				'id', 'a.id',
				'name', 'a.name',
				'catid', 'a.catid', 'category_title'
			);
		}
		
		parent::__construct($config);
	}
	
	/**
	 * Method to auto-populate the model state.
	 * 
	 * Note. Calling getState in this method will result in recursion.
	 * 
	 * @return	void
	 * @since	1.7
	 */
	protected function populateState($ordering = null, $direction = null) {
		// Initialise variables.
		$app = JFactory::getApplication();
		
		$search = $this->getUserStateFromRequest($this->context.'.filter.search', 'filter_search');
		$this->setState('filter.search', $search);
		
		$categoryId = $this->getUserStateFromRequest($this->context.'.filter.category_id', 'filter_category_id');
		$this->setState('filter.category_id', $categoryId);
		
		// List state information.
		parent::populateState('a.name', 'asc');
	}
	
	/**
	 * Build an SQL query to load the list data.
	 * 
	 * @return	JDatabaseQuery
	 * @since	1.7
	 */
	protected function getListQuery() {
		$db = JFactory::getDBO();
		$query = $db->getQuery(true);
		$query->select(
			$this->getState(
				'list.select',
				'a.id, a.name, a.catid'
			)
		);
		$query->from('#__vehicle AS a');
		
		// Join over the categories.
		$query->select('b.title AS category_title');
		$query->leftJoin('#__categories as b ON b.id = a.catid');
		
		// Filter by a single or group of categories.
		$categoryId = $this->getState('filter.category_id');
		if (is_numeric($categoryId)) {
			$query->where('a.catid = '.(int) $categoryId);
		} else if (is_array($categoryId)) {
			JArrayHelper::toInteger($categoryId);
			$categoryId = implode(',', $categoryId);
			$query->where('a.catid IN ('.$categoryId.')');
		}
		
		// Filter by search in name.
		$search = $this->getState('filter.search');
		if (!empty($search)) {
			if (stripos($search, 'id:') === 0) {
				$query->where('a.id = '.(int) substr($search, 3));
			} else {
				$search = $db->Quote('%'.$db->getEscaped($search, true).'%');
				$query->where('(a.name LIKE '.$search.')');
			}
		}
		
		// add the list ordering clause.
		$query->order($db->getEscaped($this->getState('list.ordering', 'a.name')).' '.$db->getEscaped($this->getState('list.direction', 'ASC')));
		
		return $query;
	}
}