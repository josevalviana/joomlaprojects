<?php
// no direct access
defined('_JEXEC') or die('Restricted access');

//import dependency
jimport('joomla.database.table');

class VehicleTableVehicle extends JTable {
	function __construct(&$db) {
		parent::__construct('#__vehicle', 'id', $db);
	}
	
	public function store($updateNulls = false) {
		$date = JFactory::getDate();
		$user = JFactory::getUser();
		if ($this->id) {
			// existing item
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
		
		// attempt to store the data
		return parent::store($updateNulls);
	}
}