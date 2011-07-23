<?php
// no direct access
defined('_JEXEC') or die('Restricted access');

// import modellist library
jimport('joomla.application.component.modellist');

class VehicleModelVehicles extends JModelList {
	protected function getListQuery() {
		$db = JFactory::getDBO();
		$query = $db->getQuery(true);
		$query->select(
			$this->getState(
				'list.select',
				'a.id, a.name'
			)
		);
		$query->from('#__vehicle AS a');
		
		// add the list ordering clause.
		$query->order($db->getEscaped($this->getState('list.ordering', 'a.name')).' '.$db->getEscaped($this->getState('list.direction', 'ASC')));
		
		return $query;
	}
}