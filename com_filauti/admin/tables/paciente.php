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
		
		if (!$this->id) {
			if (!intval($this->created)) {
				$this->created = $date->toMySQL();
			}
			if (empty($this->created_by)) {
				$this->created_by = $user->get('id');
			}
		}
		
		return parent::store($updateNulls);
	}
}