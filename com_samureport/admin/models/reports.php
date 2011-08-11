<?php

// no direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.modellist');

class SamuReportModelReports extends JModelList
{
	public function __construct($config = array())
	{
		if (empty($config['filter_fields'])) {
			$config['filter_fields'] = array(
				'id', 'a.id',
				'hospitalid', 'a.hospitalid', 'hospital_name',
				'created', 'a.created',
				'created_by', 'a.created_by',
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
	 * @since	1.6
	 */
	protected function populateState($ordering = null, $direction = null)
	{
		// Initialise variables.
		$app = JFactory::getApplication();
		$session = JFactory::getSession();

		// Adjust the context to support modal layouts.
		if ($layout = JRequest::getVar('layout')) {
			$this->context .= '.'.$layout;
		}

		$search = $this->getUserStateFromRequest($this->context.'.filter.search', 'filter_search');
		$this->setState('filter.search', $search);

		$authorId = $app->getUserStateFromRequest($this->context.'.filter.author_id', 'filter_author_id');
		$this->setState('filter.author_id', $authorId);
		
		$hospitalId = $app->getUserStateFromRequest($this->context.'.filter.hospital_id', 'filter_hospital_id');
		$this->setState('filter.hospital_id', $hospitalId);

		// List state information.
		parent::populateState('a.created', 'desc');
	}

	protected function getStoreId($id = '')
	{
		// Compile the store id.
		$id	.= ':'.$this->getState('filter.search');
		$id .= ':'.$this->getState('filter.hospital_id');
		$id	.= ':'.$this->getState('filter.author_id');

		return parent::getStoreId($id);
	}

	protected function getListQuery()
	{
		// Create a new query object.
		$db		= $this->getDbo();
		$query	= $db->getQuery(true);
		$user	= JFactory::getUser();

		// Select the required fields from the table.
		$query->select(
			$this->getState(
				'list.select',
				'a.id, a.hospitalid' .
				', a.created, a.created_by'
			)
		);
		$query->from('#__samureport AS a');
		
		// Join over the hospitals.
		$query->select('h.name AS hospital_name');
		$query->join('LEFT', '#__hospitals AS h ON h.id = a.hospitalid');

		// Join over the users for the author.
		$query->select('ua.name AS author_name');
		$query->join('LEFT', '#__users AS ua ON ua.id = a.created_by');
		
		// Filter by a single or group of hospitals.
		$hospitalId = $this->getState('filter.hospital_id');
		if (is_numeric($hospitalId)) {
			$query->where('a.hospitalid = '.(int) $hospitalId);
		} else if (is_array($hospitalId)) {
			JArrayHelper::toInteger($hospitalId);
			$hospitalId = implode(',', $hospitalId);
			$query->where('a.hospitalid IN ('.$hospitalId.')');
		}

		// Filter by author
		$authorId = $this->getState('filter.author_id');
		if (is_numeric($authorId)) {
			$type = $this->getState('filter.author_id.include', true) ? '= ' : '<>';
			$query->where('a.created_by '.$type.(int) $authorId);
		}

		// Filter by search in title.
		$search = $this->getState('filter.search');
		if (!empty($search)) {
			if (stripos($search, 'id:') === 0) {
				$query->where('a.id = '.(int) substr($search, 3));
			}
			else if (stripos($search, 'author:') === 0) {
				$search = $db->Quote('%'.$db->getEscaped(substr($search, 7), true).'%');
				$query->where('(ua.name LIKE '.$search.' OR ua.username LIKE '.$search.')');
			}
			else if (stripos($search, 'hospital:') === 0) {
				$search = $db->Quote('%'.$db->getEscaped(substr($search, 9), true).'%');
				$query->where('(h.name LIKE '.$search.')');
			}
//			else {
//				$search = $db->Quote('%'.$db->getEscaped($search, true).'%');
//				$query->where('(a.title LIKE '.$search.' OR a.alias LIKE '.$search.')');
//			}
		}

		// Add the list ordering clause.
		$orderCol	= $this->state->get('list.ordering');
		$orderDirn	= $this->state->get('list.direction');
		$query->order($db->getEscaped($orderCol.' '.$orderDirn));

		// echo nl2br(str_replace('#__','jos_',$query));
		return $query;
	}

	public function getAuthors() {
		// Create a new query object.
		$db = $this->getDbo();
		$query = $db->getQuery(true);

		// Construct the query
		$query->select('u.id AS value, u.name AS text');
		$query->from('#__users AS u');
		$query->join('INNER', '#__samureport AS s ON s.created_by = u.id');
		$query->group('u.id');
		$query->order('u.name');

		// Setup the query
		$db->setQuery($query->__toString());

		// Return the result
		return $db->loadObjectList();
	}
	
	public function getHospitals() {
		// Create a new query object.
		$db = $this->getDbo();
		$query = $db->getQuery(true);
		
		// Construct the query
		$query->select('h.id AS value, h.name AS text');
		$query->from('#__hospitals AS h');
		$query->join('INNER', '#__samureport AS s ON s.hospitalid = h.id');
		$query->group('h.id');
		$query->order('h.name');
		
		// Setup the query
		$db->setQuery($query->__toString());
		
		// Return the result
		return $db->loadObjectList();
	}
	
}
