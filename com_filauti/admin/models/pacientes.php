<?php

defined('_JEXEC') or die;

jimport('joomla.application.component.modellist');

class FilaUtiModelPacientes extends JModelList
{
	
	public function __construct($config = array()) {
		if (empty($config['filter_fields'])) {
			$config['filter_fields'] = array (
					'id', 'a.id',
					'sisreg', 'a.sisreg',
					'nome', 'a.nome',
					'created', 'a.created',
					'created_by', 'a.created_by',
			);
		}	
		parent::__construct($config);
	}
	
	protected function populateState($ordering = null, $direction = null)
	{
		$app = JFactory::getApplication();
		$session = JFactory::getSession();
		
		if ($layout = JRequest::getVar('layout')) {
			$this->context .= '.'.$layout;
		}
		
		$search = $this->getUserStateFromRequest($this->context.'.filter.search', 'filter_search');
		$this->setState('filter.search', $search);
		
		$sisreg = $this->getUserStateFromRequest($this->context.'.filter.sisreg', 'filter_sisreg');
		$this->setState('filter.sisreg', $sisreg);
		
		parent::populateState('a.nome', 'asc');
	}
	
	protected function getListQuery()
	{
		$db 	= $this->getDbo();
		$query 	= $db->getQuery(true);
		$user 	= JFactory::getUser();
		
		$query->select(
			$this->getState(
				'list.select',
				'a.id, a.sisreg, a.nome, a.created, a.created_by'
			)
		);
		$query->from('#__filauti AS a');
		
		// Join over the users for the author.
		$query->select('ua.name AS author_name');
		$query->join('LEFT', '#__users AS ua ON ua.id = a.created_by');
		
		$search = $this->getState('filter.search');
		if (!empty($search)) {
			if (stripos($search, 'id:') === 0) {
				$query->where('a.id = '.(int) substr($search, 3));
			}
			else if (stripos($search, 'sisreg:') === 0) {
				$query->where('a.sisreg = '.(int) substr($search, 7));
			}
			else {
				$search = $db->Quote('%'.$db->escape($search, true).'%');
				$query->where('(a.nome LIKE '.$search.')');
			}			
		}
		
		$orderCol = $this->state->get('list.ordering');
		$orderDirn = $this->state->get('list.direction');
		$query->order($db->getEscaped($orderCol.' '.$orderDirn));
			
		return $query;		
	}
}