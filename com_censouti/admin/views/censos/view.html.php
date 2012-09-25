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
                $canDo  = CensoUTIHelper::getActions($this->state->get('filter.category_id'));
                $user   = JFactory::getUser();                
		JToolBarHelper::title(JText::_('COM_CENSOUTI_CENSOS_TITLE'));
                
                if ($canDo->get('core.create') || (count($user->getAuthorisedCategories('com_censouti', 'core.create'))) > 0) {
                    JToolBarHelper::addNew('censo.add');
                }
				
		if (($canDo->get('core.edit')) || ($canDo->get('core.edit.own'))) {
                    JToolBarHelper::editList('censo.edit');
                }
                
                if ($canDo->get('core.delete')) {                    
                    JToolBarHelper::deleteList('', 'censos.delete');
                    JToolBarHelper::divider();
                }
		
                if ($canDo->get('core.admin')) {
                    JToolBarHelper::preferences('com_censouti');
                    JToolBarHelper::divider();
                }
		
		JToolBarHelper::help('JHELP_CENSOUTI_CENSO_MANAGER');
	}
}