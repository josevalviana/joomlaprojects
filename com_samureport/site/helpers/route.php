<?php
defined('_JEXEC') or die;

jimport('joomla.application.component.helper');

abstract class SamuReportHelperRoute {
	public static function getReportRoute($id) {		
		$link = 'index.php?option=com_samureport&view=report&id='. $id;		
		return $link;
	}
}