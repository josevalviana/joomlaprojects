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
            
            $query->select('b.id, b.prioridade, b.created');
            $query->from('#__filauti AS a');
            $query->join('RIGHT', '#__filauti_evolucoes AS b ON b.filaid = a.id AND (b.filaid = '.(int) $this->getState('paciente.id').')');
            
            $query->select('u.name AS author_name');
            $query->join('LEFT', '#__users AS u ON u.id = b.created_by');
            
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