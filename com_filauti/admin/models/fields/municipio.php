<?php

defined('JPATH_BASE') or die;

jimport('joomla.html.html');
jimport('joomla.form.formfield');
jimport('joomla.form.helper');
JFormHelper::loadFieldClass('list');

class JFormFieldMunicipio extends JFormFieldList {
	protected $type = 'Municipio';
	
	public function getOptions() {
		$options = array();
		
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		
		$query->select('m.id AS value, CONCAT(m.denominacao, \'/\', uf.sigla) AS text');
		$query->from('#__municipios AS m');
		$query->select('uf.id, uf.sigla');
		$query->join('RIGHT', '#__estados AS uf ON uf.id = m.ufid');
		$query->order('m.denominacao ASC, uf.sigla ASC');
		
		$db->setQuery($query);
		
		$options = $db->loadObjectList();
		
		if ($db->getErrorNum()) {
			JError::raiseWarning(500, $db->getErrorMsg());
		}
		
		array_unshift($options, JHtml::_('select.option', '0', JText::_('COM_FILAUTI_NO_MUNICIPIO')));
		
		return $options;
	}
}