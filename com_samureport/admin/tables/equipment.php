<?php

// No direct access
defined('_JEXEC') or die;


class SamuReportTableEquipment extends JTable
{
	public function __construct(& $db)
	{
		parent::__construct('#__samureport_equipments', 'id', $db);
	}	

}
