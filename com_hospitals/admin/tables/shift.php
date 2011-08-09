<?php
// no direct access
defined('_JEXEC') or die;

class HospitalsTableShift extends JTable {
	function __construct(&$_db) {
		parent::__construct('#__hospital_shifts', 'id', $_db);
	}
}