<?php

defined('_JEXEC') or die;

class FilaUtiTableEvolucao extends JTable
{
    function __construct(&$_db)
    {
        parent::__construct('#__filauti_evolucoes', 'id', $_db);
        $this->created = JFactory::getDate()->toMySQL();
    }
}
?>
