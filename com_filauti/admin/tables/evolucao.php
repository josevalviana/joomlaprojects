<?php

defined('_JEXEC') or die;

class FilaUtiTableEvolucao extends JTable
{
    function __construct(&$_db)
    {
        parent::__construct('#__filauti_evolucoes', 'id', $_db);
        $this->created = JFactory::getDate()->toMySQL();
        if (empty($this->created_by)) {
            $this->created_by = JFactory::getUser()->get('id');
        }
    }
    
    public function store($updateNulls = false)
    {
        $query = 'UPDATE #__filauti'
        . ' SET prioridade = '. (int) $this->prioridade
        . ' WHERE id = '. (int) $this->filaid
        ;
        $this->_db->setQuery($query);
        $this->_db->query();
        
        return parent::store($updateNulls);
    }
}
?>
