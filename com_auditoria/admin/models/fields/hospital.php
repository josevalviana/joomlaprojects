<?php

defined('JPATH_BASE') or die;

jimport('joomla.html.html');
jimport('joomla.form.formfield');
jimport('joomla.form.helper');
JFormHelper::loadFieldClass('list');

class JFormFieldHospital extends JFormFieldList
{
    protected $type = 'Hospital';
    
    public function getOptions()
    {
        $options = array();
        
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        
        $query->select('id AS value, name AS text');
        $query->from('#__hospitals AS h');
        $query->order('h.name');
        
        $db->setQuery($query);
        
        $options = $db->loadObjectList();
        
        if ($db->getErrorNum()) {
            JError::raiseWarning(500, $db->getErrorMsg());
        }
        
        array_unshift($options, JHtml::_('select.option', '0', JText::_('COM_AUDITORIA_NO_HOSPITAL')));
        
        return $options;
        
    }
}
