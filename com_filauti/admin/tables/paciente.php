<?php

defined('_JEXEC') or die;

class FilaUtiTablePaciente extends JTable
{
	function __construct(&$_db)
	{
		parent::__construct('#__filauti', 'id', $_db);
		$this->created = JFactory::getDate()->toMySQL();
	}
}