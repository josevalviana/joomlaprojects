<?php
// no direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.controller');

class HospitalsController extends JController {
	public function display($cachable = false, $urlparams = false) {
		$view = JRequest::getCmd('view', 'hospitals');
		$layout = JRequest::getCmd('layout', 'default');
		$id = JRequest::getInt('id');
		
		parent::display();
		
		return $this;
	}
}