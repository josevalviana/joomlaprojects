<?php

defined('_JEXEC') or die;

jimport('joomla.application.component.modeladmin');

class FilaUtiModelPaciente extends JModelAdmin
{
	protected $text_prefix = 'COM_FILAUTI';
        
        public function getEvolucoes()
        {
            $db = $this->getDbo();
            $query = $db->getQuery(true);
            
            $query->select('a.id, a.ventilacao, a.vasoativa, a.ira, a.hepatica, a.created, u.name AS author_name');
            $query->from('#__filauti_evolucoes AS a');
            $query->join('LEFT', '#__users AS u ON u.id = a.created_by');
            $query->where('a.filaid = '.(int) $this->getState('paciente.id'));
            $query->group('a.id');
            $query->order('a.created ASC');
            
            $db->setQuery($query);
            $result = $db->loadObjectList();
            
            if ($error = $db->getError()) {
                $this->setError($error);
                return false;
            }
            
            return $result;
        }
        
        public function getSofas()
        {
            $db = $this->getDbo();
            $query = $db->getQuery(true);
            
            $query->select('a.id, a.respiratory, a.coagulation, a.cardiovascular, a.glasgow, a.liver, a.renal, a.created, u.name AS author_name');
            $query->from('#__filauti_sofa AS a');
            $query->join('LEFT', '#__users AS u ON u.id = a.created_by');
            $query->where('a.filaid = '.(int) $this->getState('paciente.id'));
            $query->group('a.id');
            $query->order('a.created ASC');
            
            $db->setQuery($query);
            $result = $db->loadObjectList();
            
            if ($error = $db->getError()) {
                $this->setError($error);
                return false;
            }
            
            return $result;
        }
	
	public function getTable($type = 'Paciente', $prefix = 'FilaUtiTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}
	
	public function getForm($data = array(), $loadData = true)
	{
		$form = $this->loadForm('com_filauti.paciente', 'paciente', array('control' => 'jform', 'load_data' => $loadData));
		if (empty($form)) {
			return false;
		}
		
		return $form;
	}
	
	protected function loadFormData()
	{
		$data = JFactory::getApplication()->getUserState('com_filauti.edit.paciente.data', array());
		
		if (empty($data)) {
			$data = $this->getItem();
			
			if ($this->getState('paciente.id') == 0) {
				$app = JFactory::getApplication();
			}
		}
		
		return $data;
	}
        
        public function encerra($pk)
        {
            $user = JFactory::getUser();
            $query = 'UPDATE #__filauti'
                    .' SET encerra_by = '. (int) $user->get('id')
                    .' WHERE id = ' . (int) $pk;
            $this->_db->setQuery($query);
            $this->_db->query();
            
            return true;
        }
        
        public function reabre(&$pks)
	{
		$pks = (array) $pks;

		foreach ($pks as $i => $pk)
		{
                    $query = 'UPDATE #__filauti'
                       . ' SET encerrado = 0, '
                       . ' motencerra = 0, '
                       . ' encerramento = \'0000-00-00 00:00:00\', '
                       . ' encerra_by = 0'
                       . ' WHERE id = '. (int) $pk;
                    $this->_db->setQuery($query);
                    if (!$this->_db->query()) {
                        $this->_db->setError($this->_db->getError());
                    }
		}

		return true;
	}
}