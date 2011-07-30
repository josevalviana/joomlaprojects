<?php
// no direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.controller');

class ProfessionalController extends JController {
	
	protected $default_view = 'professionals';
	
	public function display($cachable = false, $urlparams = false) {
		
		// load the submenu.
		ProfessionalHelper::addSubmenu(JRequest::getCmd('view', 'professionals'));
		
		$view 	= JRequest::getCmd('view', 'professionals');
		$layout	= JRequest::getCmd('layout', 'default');
		$id 	= JRequest::getInt('id');
		
		// check for edit form.
		if ($view == 'professional' && $layout == 'edit' && !$this->checkEditId('com_professional.edit.professional', $id)) {
			// somehow the person just went to the form - we don't allow that.
			$this->setError(JText::sprintf('JLIB_APPLICATION_ERROR_UNHELD_ID', $id));
			$this->setMessage($this->getError(), 'error');
			$this->setRedirect(JRoute::_('index.php?option=com_professional&view=professionals', false));
			
			return false;
		}
		
		parent::display();
		
		return $this;
		
	}
}