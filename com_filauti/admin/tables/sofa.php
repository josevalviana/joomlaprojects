<?php

defined('_JEXEC') or die;

class FilaUtiTableSofa extends JTable
{
    function __construct(&$_db)
    {
        parent::__construct('#__filauti_sofa', 'id', $_db);
        $this->created = JFactory::getDate()->toMySQL();
        if (empty($this->created_by)) {
            $this->created_by = JFactory::getUser()->get('id');
        }
    }
    
    public function store($updateNulls = false) {
        
        $query = 'UPDATE #__filauti'
		. ' SET sofa = ' . (int) $this->calculaScore()
		. ' WHERE id = ' . (int) $this->filaid
		;
        $this->_db->setQuery($query);
	$this->_db->query();
        
        parent::store($updateNulls);
    }
    
    protected function calculaScore() {
        $score = (int) $this->respiratory + 
                 (int) $this->coagulation +
                 (int) $this->cardiovascular +
                 (int) $this->liver +
                 (int) $this->renal +
                 (int) $this->glasgow;
        return $score;
    }
}
?>
