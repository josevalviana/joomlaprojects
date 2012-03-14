<?php

defined('_JEXEC') or die;

class FilaUtiTableMod extends JTable
{
    function __construct(&$_db)
    {
        parent::__construct('#__filauti_mod', 'id', $_db);
        $this->created = JFactory::getDate()->toMySQL();
        if (empty($this->created_by)) {
            $this->created_by = JFactory::getUser()->get('id');
        }
    }
}
?>
