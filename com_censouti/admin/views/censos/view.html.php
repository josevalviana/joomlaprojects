<?php
// no direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.view');

class CensoUTIViewCensos extends JView
{
	protected $items;
	protected $pagination;
	protected $state;
	
	public function display($tpl = null)
	{
		$this->items 		= $this->get('Items');
		$this->pagination 	= $this->get('Pagination');
		$this->state 		= $this->get('State');
		$this->authors      = $this->get('Authors');
		
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
		JToolBarHelper::title(JText::_('COM_CENSOUTI_CENSOS_TITLE'));
		
		JToolBarHelper::addNew('censo.add');
		
		JToolBarHelper::editList('censo.edit');
		
		JToolBarHelper::deleteList('', 'censos.delete', 'JTOOLBAR_EMPTY_TRASH');
		JToolBarHelper::divider();
		
		JToolBarHelper::preferences('com_censouti');
		JToolBarHelper::divider();
		
		JToolBarHelper::help('JHELP_CENSOUTI_CENSO_MANAGER');
	}
}