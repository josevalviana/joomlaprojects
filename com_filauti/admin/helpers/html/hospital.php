<?php

defined('JPATH_PLATFORM') or die;

abstract class JHtmlHospital {
	protected static $items = array();
	
	public static function options($config = array()) {
		$hash = md5(serialize($config));
		
		if (!isset(self::$items[$hash])) {
			$config = (array) $config;
			$db = JFactory::getDbo();
			$query = $db->getQuery(true);
			
			$query->select('h.id, h.name');
			$query->from('#__hospitals AS h');
			$query->order('h.name');
			
			$db->setQuery($query);
			$items = $db->loadObjectList();
			
			self::$items[$hash] = array();
			
			foreach ($items as &$item) {
				self::$items[$hash][] = JHtml::_('select.option', $item->id, $item->name);
			}
		}
		
		return self::$items[$hash];
	}
}