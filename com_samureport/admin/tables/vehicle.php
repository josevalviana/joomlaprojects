<?php

// No direct access
defined('_JEXEC') or die;


class SamuReportTableVehicle extends JTable
{
	public function __construct(& $db)
	{
		parent::__construct('#__samureport_vehicles', 'id', $db);
	}	

}
