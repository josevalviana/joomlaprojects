<?php

defined('_JEXEC') or die;

jimport('joomla.application.component.modeladmin');

class FilaUtiModelPaciente extends JModelAdmin
{
	protected $text_prefix = 'COM_FILAUTI';
	
	public function getTable($type = 'Paciente', $prefix = 'FilaUtiTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}
	
	public function getForm($data = array(), $loadData = true)
	{
		$form = $this->loadForm('com_filauti.paciente', 'paciente', array('control' => 'jform', 'load_data' => $loadData));
		if (empty($form)) {
			return false;
		}
		
		return $form;
	}
	
	protected function loadFormData()
	{
		$data = JFactory::getApplication()->getUserState('com_filauti.edit.paciente.data', array());
		
		if (empty($data)) {
			$data = $this->getItem();
			
			if ($this->getState('paciente.id') == 0) {
				$app = JFactory::getApplication();
			}
		}
		
		return $data;
	}
}