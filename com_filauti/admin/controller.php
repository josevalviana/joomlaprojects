<?php

// no direct acess
defined('_JEXEC') or die;

jimport('joomla.application.component.controller');

class FilautiController extends JController
{
	protected $default_view = 'pacientes';
	
	public function display($cachable = false, $urlparams = false)
	{
		$view		= JRequest::getCmd('view', 'pacientes');
		$layout     = JRequest::getCmd('layout', 'pacientes');
		$id         = JRequest::getInt('id');
		
		parent::display();
		
		return $this;
	}
}