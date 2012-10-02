<?php

defined('_JEXEC') or die;

jimport('joomla.application.component.modeladmin');

require_once JPATH_COMPONENT_ADMINISTRATOR.'/helpers/auditoria.php';

class AuditoriaModelReport extends JModelAdmin
{
    protected $text_prefix = 'COM_AUDITORIA';
    
    public function getTable($type = 'Auditoria', $prefix = 'AuditoriaTable', $config = array())
    {
        return JTable::getInstance($type, $prefix, $config);
    }
    
    public function getForm($data = array(), $loadData = true)
    {
        $form = $this->loadForm('com_auditoria.report', 'report', array('control' => 'jform', 'load_data' => $loadData));
        
        if (empty($form)) {
            return false;
        }
        
        return $form;
    }
    
    protected function loadFormData()
    {
        $data = JFactory::getApplication()->getUserState('com_auditoria.edit.report.data', array());
        
        if (empty($data)) {
            $data = $this->getItem();
            
            if ($this->getState('report.id') == 0) {
                $app = JFactory::getApplication();
            }
        }
        
        return $data;
    }
}