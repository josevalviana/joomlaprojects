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
    
    public function getAtividades()
    {
        $db = $this->getDbo();
        $query = $db->getQuery(true);
        
        $query->select('aa.id, aa.sisreg, aa.nome');
        $query->from('#__auditoria_atividades AS aa');
        $query->where('aa.auditoriaid = '.(int) $this->getState('report.id'));
        
        $db->setQuery($query);
        $result = $db->loadObjectList();
        
        if ($error = $db->getError()) {
            $this->setError($error);
            return false;
        }
        
        return $result;
    }
}