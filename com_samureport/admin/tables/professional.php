<?php

// No direct access
defined('_JEXEC') or die;


class SamuReportTableProfessional extends JTable
{
	public function __construct(& $db)
	{
		parent::__construct('#__samureport_staff', 'id', $db);
	}	

}
