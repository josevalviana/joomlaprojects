<?php
// no direct access
defined('_JEXEC') or die('Restricted access');

// import modellist library
jimport('joomla.application.component.modellist');

class VehicleModelVehicles extends JModelList {
	protected function getListQuery() {
		$db = JFactory::getDBO();
		$query = $db->getQuery(true);
		$query->select('id,name');
		$query->from('#__vehicle');
		return $query;
	}
}