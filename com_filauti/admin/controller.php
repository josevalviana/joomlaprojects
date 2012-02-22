<?php

// no direct acess
defined('_JEXEC') or die;

jimport('joomla.application.component.controller');

class FilautiController extends JController
{
	protected $default_view = 'pacientes';
	
	public function display($cachable = false, $urlparams = false)
	{
		require_once JPATH_COMPONENT.'/helpers/filauti.php';
		
		// Load the submenu.
		FilaUtiHelper::addSubmenu(JRequest::getCmd('view', 'pacientes'));
		
		$view		= JRequest::getCmd('view', 'pacientes');
		$layout     = JRequest::getCmd('layout', 'pacientes');
		$id         = JRequest::getInt('id');
		
		if ($view == 'paciente' && $layout == 'edit' && !$this->checkEditId('com_filauti.edit.paciente', $id)) {
			// Somehow the person just went to the form - we don't alow that.
			$this->setError(JText::sprintf('JLIB_APPLICATION_ERROR_UNHELD_ID', $id));
			$this->setMessage($this->getError(), 'error');
			$this->setRedirect(JRoute::_('index.php?option=com_filauti&view=pacientes', false));
			
			return false;
		}
		
		parent::display();
		
		return $this;
	}
}