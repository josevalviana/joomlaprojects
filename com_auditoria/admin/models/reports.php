<?php

// no direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.modellist');

class AuditoriaModelReports extends JModelList
{
    public function __construct($config = array())
    {
        if (empty($config['filter_fields'])) {
            $config['filter_fields'] = array(
                'id', 'a.id',
                'hospital', 'a.hospital', 'hospital_name',
                'turno', 'a.turno', 'turno_name',
                'created', 'a.created',
                'created_by', 'a.created_by',
            );
        }
        
        parent::__construct($config);
    }
    
    protected function populateState($ordering = null, $direction = null) {
        $app = JFactory::getApplication();
        $session = JFactory::getSession();
        
        $search = $this->getUserStateFromRequest($this->context.'.filter.search', 'filter_search');
        $this->setState('filter.search', $search);
        
        $hospitalId = $this->getUserStateFromRequest($this->context.'.filter.hospital_id', 'filter_hospital_id');
        $this->setState('filter.hospital_id', $hospitalId);
        
        $turnoId = $this->getUserStateFromRequest($this->context.'.filter.turno_id', 'filter_turno_id');
        $this->setState('filter.turno_id', $turnoId);
        
        $authorId = $app->getUserStateFromRequest($this->context.'.filter.author_id', 'filter_author_id');
        $this->setState('filter.author_id', $authorId);
        
        parent::populateState('a.id', 'asc');
    }
    
    protected function getListQuery() {
        // Create a new query object.
        $db     = $this->getDbo();
        $query  = $db->getQuery(true);
        $user   = JFactory::getUser();
        
        // Select the required field from the table.
        $query->select(
                $this->getState(
                        'list.select',
                        'a.id, a.hospital, a.turno'.
                        ', a.created, a.created_by'
                )
        );
        $query->from('#__auditoria AS a');
        
        // Join over the users for the author.
        $query->select('ua.name AS author_name');
        $query->join('LEFT', '#__users AS ua ON ua.id = a.created_by');
        
        // Join over the hospitals.
        $query->select('h.name AS hospital_name');
        $query->join('LEFT', '#__hospitals AS h ON h.id = a.hospital');
        
        // Join over the turnos.
        $query->select('t.name AS turno_name');
        $query->join('LEFT', '#__hospital_shifts AS t ON t.id = a.turno');
        
        // Filter by author
	$authorId = $this->getState('filter.author_id');
	if (is_numeric($authorId)) {
            $type = $this->getState('filter.author_id.include', true) ? '= ' : '<>';
            $query->where('a.created_by '.$type.(int) $authorId);
	}
        
        // Filter by hospital
        $hospitalId = $this->getState('filter.hospital_id');
        if (is_numeric($hospitalId)) {
            $query->where('a.hospital ='.(int) $hospitalId);
        }
        
        // Filter by turno
        $turnoId = $this->getState('filter.turno_id');
        if (is_numeric($turnoId)) {
            $query->where('a.turno ='.(int) $turnoId);
        }
        
        // Add the list ordering clause.
        $orderCol = $this->state->get('list.ordering');
        $orderDirn = $this->state->get('list.direction');
        
        $query->order($db->getEscaped($orderCol.' '.$orderDirn));
        
        return $query;
    }
    
    public function getAuthors() {
        $db = $this->getDbo();
        $query = $db->getQuery(true);
        
        $query->select('u.id AS value, u.name AS text');
        $query->from('#__users AS u');
        $query->join('RIGHT', '#__auditoria AS a ON a.created_by = u.id');
        $query->group('u.id');
        $query->order('u.name');
        
        // Setup the query
        $db->setQuery($query->__toString());
        
        // Return the result
        return $db->loadObjectList();
    }

}
