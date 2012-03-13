<?php

defined('_JEXEC') or die;

jimport('joomla.application.component.modeladmin');

class FilaUtiModelSofa extends JModelAdmin
{
    
    protected $text_prefix = 'COM_FILAUTI';
    
    public function getTable($type = 'Sofa', $prefix = 'FilaUtiTable', $config = array())
    {
        return JTable::getInstance($type, $prefix, $config);
    }
    
    public function getForm($data = array(), $loadData = true)
    {
        if (empty($data))
        {
            $item = $this->getItem();
            $pacienteId = $item->filaid;
            $sofa = $item->sofa;
        } else {
            $pacienteId = JArrayHelper::getValue($data, 'filaid');
            $sofa = JArrayHelper::getValue($data, 'sofa');
        }
        
        $this->setState('item.filaid', $pacienteId);
        $this->setState('item.sofa', $sofa);
        
        $form = $this->loadForm('com_filauti.sofa', 'sofa', array('control' => 'jform', 'load_data' => $loadData));
        if (empty($form))
        {
            return false;
        }
        
        return $form;
    }
    
    protected function loadFormData()
    {
        $app = JFactory::getApplication();
        
        $data = JFactory::getApplication()->getUserState('com_filautil.edit.sofa.data', array());
        
        if (empty($data)) {
            $data = $this->getItem();
            
            if ($this->getState('sofa.id') == 0) {
                $app = JFactory::getApplication();
                $data->set('filaid', JRequest::getInt('filaid', $app->getUserState('com_filauti.add.sofa.filaid')));
            }
        }
        
        return $data;
    }
}
?>
