<?php

defined('_JEXEC') or die;

jimport('joomla.application.component.modeladmin');

class FilaUtiModelEvolucao extends JModelAdmin
{
    
    protected $text_prefix = 'COM_FILAUTI';
    
    public function getTable($type = 'Evolucao', $prefix = 'FilaUtiTable', $config = array())
    {
        return JTable::getInstance($type, $prefix, $config);
    }
    
    public function getForm($data = array(), $loadData = true)
    {
        if (empty($data))
        {
            $item = $this->getItem();
            $pacienteId = $item->filaid;
            $evolucao = $item->evolucao;
        } else {
            $pacienteId = JArrayHelper::getValue($data, 'paciente_id');
            $evolucao = JArrayHelper::getValue($data, 'evolucao');
        }
        
        $this->setState('item.paciente_id', $pacienteId);
        $this->setState('item.evolucao', $evolucao);
        
        $form = $this->loadForm('com_filauti.evolucao', 'evolucao', array('control' => 'jform', 'load_data' => $loadData));
        if (empty($form))
        {
            return false;
        }
        
        return $form;
    }
    
    protected function loadFormData()
    {
        $app = JFactory::getApplication();
        
        $data = JFactory::getApplication()->getUserState('com_filautil.edit.evolucao.data', array());
        
        if (empty($data)) {
            $data = $this->getItem();
        }
        
        return $data;
    }
}
?>
