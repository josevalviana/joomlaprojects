<?php
// no direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.controller');

class CensoUTIController extends JController
{
	protected $default_view = 'censos';
	
	public function display($cachabel = false, $urlparams = false)
	{
		$view = JRequest::getCmd('view', 'censos');
		$layout = JRequest::getCmd('layout', 'censos');
		$id = JRequest::getInt('id');
		
		// Check for edit form.
		if ($view == 'censo' && $layout == 'edit' && !$this->checkEditId('com_censouti.edit.censo', $id)) {
			// Somehow the person just went to the form - we don't allow that.
			$this->setError(JText::sprintf('JLIB_APPLICATION_ERROR_UNHELD_ID', $id));
			$this->setMessage($this->getError(), 'error');
			$this->setRedirect(JRoute::_('index.php?option=com_censouti&view=censos', false));
			
			return false;
		}
		
		parent::display();
		
		return $this;
	}
}