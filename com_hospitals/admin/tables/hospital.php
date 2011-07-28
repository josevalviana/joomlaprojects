<?php
defined('_JEXEC') or die;

class HospitalsTableHospital extends JTable {
	function __construct(&$_db) {
		parent::__construct('#__hospitals', 'id', $_db);
		$this->created = JFactory::getDate()->toMySQL();
	}
	
	public function store($updateNulls = false) {
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
		
		return parent::store($updateNulls);
	}
}