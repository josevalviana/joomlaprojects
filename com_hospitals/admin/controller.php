<?php
// no direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.controller');

class HospitalsController extends JController {
	
	protected $default_view = 'hospitals';
	
	public function display($cachable = false, $urlparams = false) {
		
		// load the submenu.
		HospitalsHelper::addSubmenu(JRequest::getCmd('view', 'hospitals'));
		
		$view 	= JRequest::getCmd('view', 'hospitals');
		$layout	= JRequest::getCmd('layout', 'default');
		$id 	= JRequest::getInt('id');
		
		// check for edit form.
		if ($view == 'hospital' && $layout == 'edit' && !$this->checkEditId('com_hospitals.edit.hospital', $id)) {
			// somehow the person just went to the form - we don't allow that.
			$this->setError(JText::sprintf('JLIB_APPLICATION_ERROR_UNHELD_ID', $id));
			$this->setMessage($this->getError(), 'error');
			$this->setRedirect(JRoute::_('index.php?option=com_hospitals&view=hospitals', false));
			
			return false;
		}
		
		parent::display();
		
		return $this;
		
	}
}