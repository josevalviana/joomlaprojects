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
		
		// add the list ordering clause.
		$query->order($db->getEscaped($this->getState('list.ordering', 'a.name')).' '.$db->getEscaped($this->getState('list.direction', 'ASC')));
		
		return $query;
	}
}