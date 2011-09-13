<?php
// no direct access
defined('_JEXEC') or die;

jimport('joomla.plugin.plugin');

class plgSearchSamuReport extends JPlugin {
	
	public function __construct(& $subject, $config)
	{
		parent::__construct($subject, $config);
		$this->loadLanguage();
	}
	
	function onContentSearchAreas() {
		static $areas = array(
			'reports' => 'PLG_SEARCH_SAMUREPORT_REPORTS'
		);
		return $areas;
	}
	
	function onContentSearch($text, $phrase='', $ordering='', $areas=null) {
		$db 		= JFactory::getDbo();
		$app 		= JFactory::getApplication();
		$user 		= JFactory::getUser();
		$groups		= implode(',', $user->getAuthorisedViewLevels());
		$tag 		= JFactory::getLanguage()->getTag();
		
		require_once JPATH_SITE.'/components/com_samureport/helpers/route.php';
		require_once JPATH_SITE.'/administrator/components/com_search/helpers/search.php';
		
		$searchText = $text;
		if (is_array($areas)) {
			if (!array_intersect($areas, array_keys($this->onContentSearchAreas()))) {
				return array();
			}
		}
		
		$sContent 	= $this->params->get('search_content', 		1);
		$limit 		= $this->params->get('search_limit', 		50);
		
		$nullDate 	= $db->getNullDate();
		$date = JFactory::getDate();
		$now = $date->toMySQL();
		
		$text = trim($text);
		if ($text == '') {
			return array();
		}
		
		$wheres = array();
		switch ($phrase) {
			case 'exact':
				$text = $db->Quote('%'.$db->getEscaped($text, true).'%', false);
				$wheres2 = array();
				$wheres2[] = 'h.name LIKE '.$text;
				$where = '('.implode(') OR (', $wheres2).')';
				break;
			case 'all':
			case 'any':
			default:
				$words = explode(' ', $text);
				$wheres = array();
				foreach ($words as $word) {
					$word = $db->Quote('%'.$db->getEscaped($word, true).'%', false);
					$wheres2 = array();
					$wheres2[] = 'h.name LIKE '.$word;
					$wheres[] = implode(' OR ', $wheres2);
				}
				$where = '('.implode(($phrase == 'all' ? ') AND (' : ') OR ('), $wheres). ')';
				break;
		}
		
		$morder = '';
		switch ($ordering) {
			case 'oldest':
				$order = 'a.created ASC';
				break;
			case 'alpha':
				$order = 'h.name ASC';
				break;
			case 'newest':
				$order = 'a.created DESC';
				break;
			default:
				$order = 'a.created DESC';
				break;				
		}
		
		$rows = array();
		$query = $db->getQuery(true);
		
		// search reports
		if ($sContent && $limit > 0) {
			$query->clear();
			$query->select('a.id AS id, h.name AS title, a.contact_phone AS telephone, a.contact_person AS contacted, a.staff_chief AS boss, a.created');
			$query->from('#__samureport AS a');
			$query->innerJoin('#__hospitals AS h ON h.id = a.hospitalid');
			$query->where('('.$where.')');
			$query->group('a.id');
			$query->order($order);
			
			$db->setQuery($query, 0, $limit);
			$list = $db->loadObjectList();
			$limit -= count($list);
			
			if (isset($list)) {
				foreach ($list as $key => $item) {
					$list[$key]->href = SamuReportHelperRoute::getReportRoute($item->id);
					$list[$key]->text = JText::sprintf('PLG_SEARCH_SAMUREPORT_FIELD_LIST_TEXT', 
										$item->contacted ? $item->contacted : JText::_('PLG_SEARCH_SAMUREPORT_NOT_INFORMED'), 
										$item->telephone ? $item->telephone : JText::_('PLG_SEARCH_SAMUREPORT_NOT_INFORMED'),
										$item->boss ? $item->boss : JText::_('PLG_SEARCH_SAMUREPORT_NOT_INFORMED'));
				}
			}
			$rows[] = $list;						
		}
		
		$results = array();
		if (count($rows)) {
			foreach ($rows as $row) {
				$new_row = array();
				foreach ($row as $key => $report) {
					if (SearchHelper::checkNoHtml($report, $searchText, array('text', 'title'))) {
						$new_row[] = $report;
					}
				}
				$results = array_merge($results, (array) $new_row);
			}
		}
		
		return $results;
	}
}