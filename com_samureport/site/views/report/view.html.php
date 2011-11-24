<?php

defined('_JEXEC') or die;

jimport('joomla.application.component.view');

class SamuReportViewReport extends JView {
	protected $item;
	protected $print;
	protected $state;
	
	function display($tpl=null) {
		// Initialise variables.
		$this->item = $this->get('Item');
		
		if (count($errors = $this->get('Errors'))) {
			JError::raiseWarning(500, implode("\n", $errors));
			
			return false;
		}
		
		parent::display($tpl);
	}
}