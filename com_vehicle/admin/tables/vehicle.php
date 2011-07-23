<?php
// no direct access
defined('_JEXEC') or die('Restricted access');

//import dependency
jimport('joomla.database.table');

class VehicleTableVehicle extends JTable {
	function __construct(&$db) {
		parent::__construct('#__vehicle', 'id', $db);
	}
}