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
					'idade', 'a.idade',
					'idade_c', 'a.idade_c',
					'hospfromid', 'a.hospfromid', 'hospfrom_name',
					'hosptoid', 'a.hosptoid', 'hospto_name',
					'promotoria', 'a.promotoria',
                    'prioridade', 'a.prioridade',
                    'avc', 'a.avc',
                    'mencef', 'a.mencef',
                    'hemodialise', 'a.hemodialise',
                    'isolamento', 'a.isolamento',
                    'posop', 'a.posop',
					'encerrado', 'a.encerrado',
					'encerramento', 'a.encerramento',
                    'sofa', 'a.sofa',
                    'disf', 'a.disf',
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
		
		$hospfromId = $this->getUserStateFromRequest($this->context.'.fiter.hospfrom_id', 'filter_hospfrom_id');
		$this->setState('filter.hospfrom_id', $hospfromId);
		
		$hosptoId = $this->getUserStateFromRequest($this->context.'.filter.hospto_id', 'filter_hospto_id');
		$this->setState('filter.hospto_id', $hosptoId);
                
                $authorId = $this->getUserStateFromRequest($this->context.'.filter.author_id', 'filter_author_id');
                $this->setState('filter.author_id', $authorId);
		
		$promotoria = $this->getUserStateFromRequest($this->context.'.filter.promotoria', 'filter_promotoria');
		$this->setState('filter.promotoria', $promotoria);
                
        $avc = $this->getUserStateFromRequest($this->context.'.filter.avc', 'filter_avc');
        $this->setState('filter.avc', $avc);
                
        $mencef = $this->getUserStateFromRequest($this->context.'.filter.mencef', 'filter_mencef');
        $this->setState('filter.mencef', $mencef);
                
        $hemodialise = $this->getUserStateFromRequest($this->context.'.filter.hemodialise', 'filter_hemodialise');
        $this->setState('filter.hemodialise', $hemodialise);
                
        $isolamento = $this->getUserStateFromRequest($this->context.'.filter.isolamento', 'filter_isolamento');
        $this->setState('filter.isolamento', $isolamento);
                
        $posop = $this->getUserStateFromRequest($this->context.'.filter.posop', 'filter_posop');
        $this->setState('filter.posop', $posop);
		
		$encerrado = $this->getUserStateFromRequest($this->context.'.filter.encerrado', 'filter_encerrado');
		$this->setState('filter.encerrado', $encerrado);
                
        $prioridade = $this->getUserStateFromRequest($this->context.'.filter.prioridade', 'filter_prioridade');
        $this->setState('filter.prioridade', $prioridade);
		
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
				'a.id, a.sisreg, a.nome, a.idade, a.idade_c, a.created, datediff(curdate(), a.created) as t_fila, a.created_by'.
				', a.hospfromid, a.hosptoid, a.cid, a.promotoria, a.encerrado'.
				', a.prioridade, a.avc, a.mencef, a.hemodialise, a.encerramento'.
                ', a.isolamento, a.posop, a.sofa, a.disf'.
				//', timestampdiff(MINUTE, (SELECT convert_tz(max(ev.created), \'UTC\', \'America/Fortaleza\') FROM #__filauti_evolucoes AS ev WHERE ev.filaid = a.id), now()) as t_evolucao'
                                ', datediff(curdate(), (SELECT convert_tz(max(ev.created), \'UTC\', \'America/Fortaleza\') FROM #__filauti_evolucoes AS ev WHERE ev.filaid = a.id)) as t_evolucao'.
                                ', (select count(*) FROM #__filauti_evolucoes fev WHERE fev.filaid = a.id) as evoluido'
			)
		);
		$query->from('#__filauti AS a');
		
		// Join over the users for the author.
		$query->select('ua.name AS author_name');
		$query->join('LEFT', '#__users AS ua ON ua.id = a.created_by');
		
		$query->select('hf.name AS hospfrom_name');
		$query->join('LEFT', '#__hospitals AS hf ON hf.id = a.hospfromid');
		
		$query->select('ht.name AS hospto_name');
		$query->join('LEFT', '#__hospitals AS ht ON ht.id = a.hosptoid');
		
		$hospfromId = $this->getState('filter.hospfrom_id');
		if (is_numeric($hospfromId)) {
			$query->where('a.hospfromId = '.(int) $hospfromId);
		} else if (is_array($hospfromId)) {
			JArrayHelper::toInteger($hospfromId);
			$hospfromId = implode(',', $hospfromId);
			$query->where('a.hospfromid IN ('.$hospfromId.')');
		}
		
		$hosptoId = $this->getState('filter.hospto_id');
		if (is_numeric($hosptoId)) {
			$query->where('a.hosptoId = '.(int) $hosptoId);
		} else if (is_array($hosptoId)) {
			JArrayHelper::toInteger($hosptoId);
			$hosptoId = implode(',', $hosptoId);
			$query->where('a.hosptoid IN ('.$hosptoId.')');
		}
                
                $authorId = $this->getState('filter.author_id');
                if (is_numeric($authorId)) {
                    $type = $this->getState('filter.author_id.include', true) ? '= ' : '<>';
                    $query->where('a.created_by '.$type.(int) $authorId);
                }
		
		$promotoria = $this->getState('filter.promotoria');
		if (is_numeric($promotoria)) {
			$query->where('a.promotoria = '.(int) $promotoria);
		}
		
		$encerrado = $this->getState('filter.encerrado');
		if (is_numeric($encerrado)) {
			$query->where('a.encerrado = '.(int) $encerrado);
		} else {
                        $query->where('a.encerrado = 0');
                }
                
                $prioridade = $this->getState('filter.prioridade');
                if (is_numeric($prioridade)) {
                    $query->where('a.prioridade = '.(int) $prioridade);
                }
                
                $avc = $this->getState('filter.avc');
                if (is_numeric($avc)) {
                    $query->where('a.avc = '.(int) $avc);
                }
                
                $mencef = $this->getState('filter.mencef');
                if (is_numeric($mencef)) {
                    $query->where('a.mencef = '.(int) $mencef);
                }
                
                $hemodialise = $this->getState('filter.hemodialise');
                if (is_numeric($hemodialise)) {
                    $query->where('a.hemodialise = '.(int) $hemodialise);
                }
                
                $isolamento = $this->getState('filter.isolamento');
                if (is_numeric($isolamento)) {
                    $query->where('a.isolamento = '.(int) $isolamento);
                }
                
                $posop = $this->getState('filter.posop');
                if (is_numeric($posop)) {
                    $query->where('a.posop = '.(int) $posop);
                }
		
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
        
        public function getAuthors() {
            // Create a new query object.
            $db = $this->getDbo();
            $query = $db->getQuery(true);
            
            // Construct the query
            $query->select('u.id AS value, u.name AS text');
            $query->from('#__users AS u');
            $query->join('INNER', '#__filauti AS f ON f.created_by = u.id');
            $query->group('u.id');
            $query->order('u.name');
            
            // Setup the query
            $db->setQuery($query->__toString());
            
            // Return the result
            return $db->loadObjectList();
        }              
}