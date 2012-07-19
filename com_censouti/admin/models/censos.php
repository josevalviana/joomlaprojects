<?php
// no direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.modellist');

class CensoUTIModelCensos extends JModelList
{
	public function __construct($config = array())
	{
		if (empty($config['filter_fields'])) {
			$config['filter_fields'] = array(
				'id', 'a.id',
				'sisreg', 'a.sisreg',
				'nome', 'a.nome',
                                'hospital_id', 'a.hospital_id', 'hospital_name',
                                'admissao', 'a.admissao',
                                'evolucao', 'a.evolucao',
                                'alta', 'a.alta',
                                'dt_alta', 'a.dt_alta',
				'created', 'a.created',
				'created_by', 'a.created_by',				
			);
		}
		
		parent::__construct($config);
	}
	
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
		
		$authorId = $this->getUserStateFromRequest($this->context.'.filter.author_id', 'filter_author_id');
		$this->setState('filter.author_id', $authorId);
                
                $alta = $this->getUserStateFromRequest($this->context.'.filter.alta', 'filter_alta');
                $this->setState('filter.alta', $alta);
                
                $evolucao = $this->getUserStateFromRequest($this->context.'.filter.evolucao', 'filter_evolucao');
                $this->setState('filter.evolucao', $evolucao);
                
                $hospitalId = $this->getUserStateFromRequest($this->context.'.filter.hospital_id', 'filter_hospital_id');
                $this->setState('filter.hospital_id', $hospitalId);
		
		// List state information.
		parent::populateState('a.nome', 'asc');
	}
	
	protected function getListQuery()
	{
		// Create a new query object.
		$db = $this->getDbo();
		$query = $db->getQuery(true);
		$user = JFactory::getUser();
		
		// Select the required fields from the table.
		$query->select(
				$this->getState(
						'list.select',
						'a.id, a.sisreg, a.nome, a.hospital_id, a.created, a.created_by,'.
                                                'a.admissao, a.leito, a.diagnostico, a.evolucao, a.alta, a.dt_alta'
				)
		);
		$query->from('#__censouti AS a');
		
		// Join over the users for the author.
		$query->select('ua.name AS author_name');
		$query->join('LEFT', '#__users AS ua ON ua.id = a.created_by');
                
                // Join over the hospitals.
                $query->select('h.name AS hospital_name');
                $query->join('LEFT', '#__hospitals AS h ON h.id = a.hospital_id');
		
		// Filter by author
		$authorId = $this->getState('filter.author_id');
		if (is_numeric($authorId)) {
			$type = $this->getState('filter.author_id.include', true) ? '= ' : '<>';
			$query->where('a.created_by '.$type.(int) $authorId);
		}
                
                // Filter by hospital
                $hospitalId = $this->getState('filter.hospital_id');
                if (is_numeric($hospitalId)) {
                    $query->where('a.hospital_id ='.(int) $hospitalId);
                }
                
                // Filter by alta
                $alta = $this->getState('filter.alta');
                if (is_numeric($alta)) {
                    $query->where('a.alta ='.(int) $alta);
                }
                
                // Filter by evolucao
                $evolucao = $this->getState('filter.evolucao');
                if (is_numeric($evolucao)) {
                    $query->where('a.evolucao ='.(int) $evolucao);
                }
		
		// Filter by search in title.
		$search = $this->getState('filter.search');
		if (!empty($search)) {
			if (stripos($search, 'id:') === 0) {
				$query->where('a.id = '.(int) substr($search, 3));
			}
			else {
				$search = $db->Quote('%'.$db->escape($search, true).'%');
				$query->where('(a.nome LIKE '.$search.')');
			}
		}
		
		// Add the list ordering clause.
		$orderCol 	= $this->state->get('list.ordering', 'a.nome');
		$orderDirn 	= $this->state->get('list.direction', 'asc');
                if ($orderCol == 'hospital_name') {
                    $orderCol = 'h.name';
                }
		
		$query->order($db->escape($orderCol.' '.$orderDirn));
		
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
		$query->join('INNER', '#__censouti AS c ON c.created_by = u.id');
		$query->group('u.id, u.name');
		$query->order('u.name');
		
		// Setup the query
		$db->setQuery($query->__toString());
		
		// Return the result
		return $db->loadObjectList();
	}
}