<?php
// no direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.modellist');

class ProfessionalModelProfessionals extends JModelList {
	public function __construct($config = array()) {
		if (empty($config['filter_fields'])) {
			$config['filter_fields'] = array(
				'id', 'a.id',
				'name', 'a.name',
				'catid', 'a.catid', 'category_title',
				'user_id', 'a.user_id',
				'created', 'a.created',
				'created_by', 'a.created_by',
				'ul.name', 'linked_user',
			);
		}
		
		parent::__construct($config);
	}
	
	protected function populateState($ordering = null, $direction = null) {
		$app = JFactory::getApplication();
		
		if ($layout = JRequest::getVar('layout')) {
			$this->context .= '.'.$layout;
		}
		
		$search = $this->getUserStateFromRequest($this->context.'.filter.search', 'filter_search');
		$this->setState('filter.search', $search);
		
		$categoryId = $this->getUserStateFromRequest($this->context.'.filter.category_id', 'filter_category_id');
		$this->setState('filter.category_id', $categoryId);
		
		// list state information.
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
				'a.id, a.name, a.catid, a.user_id, a.created, a.created_by'
			)
		);
		$query->from('#__professional AS a');
		
		// join over the users for the linked user.
		$query->select('ul.name AS linked_user');
		$query->leftJoin('#__users AS ul ON ul.id = a.user_id');
		
		// join over the categories.
		$query->select('b.title AS category_title');
		$query->leftJoin('#__categories AS b ON b.id = a.catid');
		
		// filter by a single or group of categories.
		$categoryId = $this->getState('filter.category_id');
		if (is_numeric($categoryId)) {
			$query->where('a.catid = '.(int) $categoryId);
		} else if (is_array($categoryId)) {
			JArrayHelper::toInteger($categoryId);
			$categoryId = implode(',', $categoryId);
			$query->where('a.catid IN ('.$categoryId.')');
		}
		
		// filter by search in name.
		$search = $this->getState('filter.search');
		if (!empty($search)) {
			if (stripos($search, 'id:') === 0) {
				$query->where('a.id = '.(int) substr($search, 3));
			} else {
				$search = $db->quote('%'.$db->getEscaped($search, true).'%');
				$query->where('(a.name LIKE '.$search.')');
			}
		}
		
		$orderCol = $this->state->get('list.ordering');
		$orderDirn = $this->state->get('list.direction');
		
		$query->order($db->getEscaped($orderCol.' '.$orderDirn));
		
		//echo nl2br(str_replace('#__','jos_',$query));
		return $query;
	}
}