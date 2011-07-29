<?php
// no direct access
defined('_JEXEC') or die;

class HospitalsTableSpecialty extends JTable {
	function __construct(&$_db) {
		parent::__construct('#__specialties', 'id', $_db);
	}
}