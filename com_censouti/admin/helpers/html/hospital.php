<?php
// no direct access
defined('_JEXEC') or die;

/**
 * @package Joomla.Administrator
 * @subpackage com_censouti
 */
abstract class JHtmlHospital
{
	protected static $items = array();
	
	public static function options($config = array())
	{
		$hash = md5(serialize($config));
		
		if (!isset(self::$items[$hash]))
		{
			$config = (array) $config;
			$db = JFactory::getDbo();
			$query = $db->getQuery(true);
			
			$query->select('a.id, a.name');
			$query->from('#__hospitals AS a');
			$query->order('a.name');
			
			$db->setQuery($query);
			$items = $db->loadObjectList();
			
			// Assemble the list options.
			self::$items[$hash] = array();
			
			foreach ($items as &$item)
			{
				self::$items[$hash][] = JHtml::_('select.option', $item->id, $item->name);
			}
			
		}
		
		return self::$items[$hash];
	}
}