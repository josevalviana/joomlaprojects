<?php

defined('_JEXEC') or die;

jimport('joomla.application.component.modeladmin');

class AuditoriaModelAtividade extends JModelAdmin
{
    
    protected $text_prefix = 'COM_FILAUTI';
    
    public function getTable($type = 'Atividade', $prefix = 'AuditoriaTable', $config = array())
    {
        return JTable::getInstance($type, $prefix, $config);
    }
    
    public function getForm($data = array(), $loadData = true)
    {
        if (empty($data))
        {
            $item = $this->getItem();
            $auditoriaId = $item->auditoriaid;
        } else {            
            $auditoriaId = JArrayHelper::getValue($data, 'auditoriaid');
        }
        
        $this->setState('item.auditoriaid', $auditoriaId);
        
        $form = $this->loadForm('com_auditoria.atividade', 'atividade', array('control' => 'jform', 'load_data' => $loadData));
        
        if (empty($form)) {
            return false;
        }
        
        return $form;
    }
    
    protected function loadFormData()
    {
        $app = JFactory::getApplication();
        
        $data = JFactory::getApplication()->getUserState('com_auditoria.edit.atividade.data', array());
        
        if (empty($data)) {
            $data = $this->getItem();
            
            if ($this->getState('atividade.id') == 0) {
                $app = JFactory::getApplication();
                $data->set('auditoriaid', JRequest::getInt('auditoriaid', $app->getUserState('com_auditoria.add.atividade.auditoriaid')));
            }
        }
        
        return $data;
    }
}
?>
