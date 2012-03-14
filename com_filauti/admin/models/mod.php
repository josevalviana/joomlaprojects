<?php

defined('_JEXEC') or die;

jimport('joomla.application.component.modeladmin');

class FilaUtiModelMod extends JModelAdmin
{
    
    protected $text_prefix = 'COM_FILAUTI';
    
    public function getTable($type = 'Mod', $prefix = 'FilaUtiTable', $config = array())
    {
        return JTable::getInstance($type, $prefix, $config);
    }
    
    public function getForm($data = array(), $loadData = true)
    {
        if (empty($data))
        {
            $item = $this->getItem();
            $pacienteId = $item->filaid;
            $mod = $item->mod;
        } else {
            $pacienteId = JArrayHelper::getValue($data, 'filaid');
            $mod = JArrayHelper::getValue($data, 'mod');
        }
        
        $this->setState('item.filaid', $pacienteId);
        $this->setState('item.mod', $mod);
        
        $form = $this->loadForm('com_filauti.mod', 'mod', array('control' => 'jform', 'load_data' => $loadData));
        if (empty($form))
        {
            return false;
        }
        
        return $form;
    }
    
    protected function loadFormData()
    {
        $app = JFactory::getApplication();
        
        $data = JFactory::getApplication()->getUserState('com_filautil.edit.mod.data', array());
        
        if (empty($data)) {
            $data = $this->getItem();
            
            if ($this->getState('mod.id') == 0) {
                $app = JFactory::getApplication();
                $data->set('filaid', JRequest::getInt('filaid', $app->getUserState('com_filauti.add.mod.filaid')));
            }
        }
        
        return $data;
    }
}
?>
