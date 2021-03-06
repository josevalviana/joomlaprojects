<?php

// No direct access
defined('_JEXEC') or die('Restricted access');

// import dependency
jimport('joomla.form.helper');
JFormHelper::loadFieldClass('list');

/**
 * Form field class for the Joomla Framework.
 * 
 * @package		Joomla.Administrator
 * @subpackage	com_vehicle
 * @author		Joseval Viana
 * @since		1.7
 */
class JFormFieldVehicle extends JFormFieldList {
	
	/**
	 * 
	 * The form field type
	 * @var	    string
	 * @since	1.7
	 */
	protected $type = 'Vehicle';
	
	/**
	 * Method to get the field options.
	 * 
	 * @return	array	The field option objects.
	 * @since	1.7
	 */
	protected function getOptions() {
		
		// initialize variables.
		$options = array();
		
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select('a.id, a.name, b.title as category, a.catid');
		$query->from('#__vehicle AS a');
		$query->leftJoin('#__categories as b ON a.catid = b.id');
		
		$vehicles = $db->loadObjectList();
		
		if ($vehicles) {
			foreach($vehicles as $vehicle) {
				$options[] = JHtml::_('select.option', $vehicle->id, $vehicle->name . ($vehicle->catid ? ' (' . $vehicle->category . ')': ''));
			}
		}
		$options = array_merge(parent::getOptions(), $options);
		return $options;
	}
}