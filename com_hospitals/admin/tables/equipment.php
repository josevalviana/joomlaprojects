<?php
// no direct access
defined('_JEXEC') or die;

class HospitalsTableEquipment extends JTable {
	function __construct(&$_db) {
		parent::__construct('#__equipments', 'id', $_db);
	}
}