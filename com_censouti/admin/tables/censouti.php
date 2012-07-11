<?php
// no direct access
defined('_JEXEC') or die;

jimport('joomla.database.table');

class CensoUTITableCensoUTI extends JTable
{
	function __construct(&$db)
	{
		parent::__construct('#__censouti', 'id', $db);
	}
}