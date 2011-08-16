<?php

// no direct access
defined('JPATH_PLATFORM') or die;

abstract class JHtmlShift {
	
	protected static $items = array();
	
	public static function options($config = array()) {
		$hash = md5(serialize($config));
		
		if (!isset(self::$items[$hash])) {
			$config = (array) $config;
			$db		= JFactory::getDbo();
			$query	= $db->getQuery(true);
			
			$query->select('hs.id, hs.name');
			$query->from('#__hospital_shifts AS hs');
			$query->join('RIGHT', '#__samureport AS s ON s.hospitalid = hs.id');
			$query->group('hs.id');
			$query->order('hs.name');
			
			$db->setQuery($query);
			$items = $db->loadObjectList();
			
			// Assemble the list options.
			self::$items[$hash] = array();
			
			foreach ($items as &$item) {
				self::$items[$hash][] = JHtml::_('select.option', $item->id, $item->name);
			}
		}
		return self::$items[$hash];
	}
}