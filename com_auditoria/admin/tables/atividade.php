<?php

defined('_JEXEC') or die;

class AuditoriaTableAtividade extends JTable
{
    function __construct(&$_db) {
        parent::__construct('#__auditoria_atividades', 'id', $_db);
        $this->created = JFactory::getDate()->toMySQL();        
    }
    
    public function store($updateNulls = true)
    {
        $date = JFactory::getDate();
        $user = JFactory::getUser();
        if ($this->id) {
            $this->modified = $date->toSql();
            $this->modified_by = $user->get('id');
        } else {
            if (!intval($this->created)) {
                $this->created = $date->toSql();
            }
            if (empty($this->created_by)) {
                $this->created_by = $user->get('id');
            }
        }
        
        return parent::store($updateNulls);
    }
}
