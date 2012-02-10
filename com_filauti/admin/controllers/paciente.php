<?php

defined('_JEXEC') or die;

jimport('joomla.application.component.controllerform');

class FilaUtiControllerPaciente extends JControllerForm
{
	function __construct($config = array())
	{
		$this->view_list = 'pacientes';
		
		parent::__construct($config);
	}
}