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
}