<?php
defined('JPATH_BASE') or die;

jimport('joomla.html.html');
jimport('joomla.form.formfield');
jimport('joomla.form.helper');
JFormHelper::loadFieldClass('list');

class JFormFieldShift extends JFormFieldList {
	protected $type = 'Shift';
	
	public function getOptions() {
		$options = array();
		
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		
		$query->select('id AS value, name AS text');
		$query->from('#__hospital_shifts AS hs');
		$query->order('hs.name');
		
		// Get the options.
		$db->setQuery($query);
		
		$options = $db->loadObjectList();
		
		// Check for a dabase error.
		if ($db->getErrorNum()) {
			JError::raiseWarning(500, $db->getErrorMsg());
		}
		
		// Merge any additional options in the XML definition.
		//$options = array_merge(parent::getOptions(), $options);
		
		array_unshift($options, JHtml::_('select.option', '0', JText::_('COM_HOSPITALS_NO_HOSPITAL_SHIFT')));
		
		return $options;		
	}
}