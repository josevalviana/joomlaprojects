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
}