<?php

defined('_JEXEC') or die;

class FilaUtiTablePaciente extends JTable
{
	function __construct(&$_db)
	{
		parent::__construct('#__filauti', 'id', $_db);
		$this->created = JFactory::getDate()->toMySQL();
	}
	
	public function store($updateNulls = false)
	{
		$date = JFactory::getDate();
		$user = JFactory::getUser();
		
		if ($this->id) {
			$this->modified = $date->toMySQL();
			$this->modified_by = $user->get('id');
		} else {
			if (!intval($this->created)) {
				$this->created = $date->toMySQL();
			}
			if (empty($this->created_by)) {
				$this->created_by = $user->get('id');
			}
		}
		
		// Verify that the sisreg is unique
                // não deve ser único para hospitais com leitos em corredor
		// $table = JTable::getInstance('Paciente', 'FilaUtiTable');
		//if ($table->load(array('sisreg' => $this->sisreg)) && ($table->id != $this->id || $this->id == 0)) {
		//	$this->setError(JText::_('COM_FILAUTI_ERROR_UNIQUE_SISREG'));
		//	return false;
		//}
		
		return parent::store($updateNulls);
	}
        
        function check()
        {                          
            // checa campo obrigatório MORTE ENCEFÁLICA
            if ((int) $this->mencef == 0) {
                $this->setError(JText::sprintf(JText::_('COM_FILAUTI_FIELD_REQUIRED'), JText::_('COM_FILAUTI_FIELD_MENCEF_LABEL')));
                return false;
            }
            
            // checa campo obrigatório HEMODIALISE
            if ((int) $this->hemodialise == 0) {
                $this->setError(JText::sprintf(JText::_('COM_FILAUTI_FIELD_REQUIRED'), JText::_('COM_FILAUTI_FIELD_HEMODIALISE_LABEL')));
                return false;
            }
            
            // checa campo obrigatório ISOLAMENTO
            if ((int) $this->isolamento == 0) {
                $this->setError(JText::sprintf(JText::_('COM_FILAUTI_FIELD_REQUIRED'), JText::_('COM_FILAUTI_FIELD_ISOLAMENTO_LABEL')));
                return false;
            }
            
            // checa campo obrigatório POSOP
            if ((int) $this->posop == 0) {
                $this->setError(JText::sprintf(JText::_('COM_FILAUTI_FIELD_REQUIRED'), JText::_('COM_FILAUTI_FIELD_POSOP_LABEL')));
                return false;
            }
            
            return true;
        }
}