<?php
// no direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.view');

class CensoUTIViewCensos extends JView
{
	protected $pagination;
	
	public function display($tpl = null)
	{
		$this->pagination = $this->get('Pagination');
		
		// Check for errors.
		if (count($errors = $this->get('Errors'))) {
			JError::raiseError(500, implode("\n", $errors));
			return false;
		}
		
		// We don't need toolbar in the modal windows
		if ($this->getLayout() !== 'modal') {
			$this->addToolbar();
		}
		
		parent::display($tpl);
	}
	
	public function addToolbar()
	{
		
	}
}