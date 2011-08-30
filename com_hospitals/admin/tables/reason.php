<?php
// no direct access
defined('_JEXEC') or die;

class HospitalsTableReason extends JTable {
	function __construct(&$_db) {
		parent::__construct('#__replacement_reasons', 'id', $_db);
	}
}