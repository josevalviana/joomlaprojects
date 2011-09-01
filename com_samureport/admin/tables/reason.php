<?php

// No direct access
defined('_JEXEC') or die;


class SamuReportTableReason extends JTable
{
	public function __construct(& $db)
	{
		parent::__construct('#__samureport_reasons', 'id', $db);
	}	

}
