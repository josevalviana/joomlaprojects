<?php

// No direct access
defined('_JEXEC') or die;


class SamuReportTableVehicle extends JTable
{
	public function __construct(& $db)
	{
		parent::__construct('#__samureport_vehicles', 'id', $db);
	}

	public function store($updateNulls = false)
	{
		$date	= JFactory::getDate();
		$user	= JFactory::getUser();
		if ($this->id) {
			// Existing item
			$this->modified		= $date->toMySQL();
			$this->modified_by	= $user->get('id');
		} else {
			// New newsfeed. A feed created and created_by field can be set by the user,
			// so we don't touch either of these if they are set.
			if (!intval($this->created)) {
			$this->created = $date->toMySQL();
			}
			if (empty($this->created_by)) {
			$this->created_by = $user->get('id');
			}
			}
	
			// Attempt to store the data.
			return parent::store($updateNulls);
	}

}
