<?php

// no direct access
defined('_JEXEC') or die;

// Import dependencies
jimport('joomla.application.component.view');

class AuditoriaViewReports extends JView
{
    protected $items;
    protected $pagination;
    protected $state;
    protected $authors;
    
    public function display($tpl = null)
    {
        $this->items = $this->get('Items');
        $this->pagination = $this->get('Pagination');
        $this->state = $this->get('State');
        $this->authors = $this->get('Authors');
        
        // Check for errors.
        if (count($errors = $this->get('Errors'))) {
            JError::raiseError(500, implode("\n", $errors));
            return false;
        }
        
        // We don't need toolbar in the modal window
        if ($this->getLayout() !== 'modal') {
            $this->addToolbar();
        }
        
        parent::display($tpl);
    }
    
    protected function addToolbar()
    {
        $canDo  = AuditoriaHelper::getActions();
        $user   = JFactory::getUser();
        JToolBarHelper::title(JText::_('COM_AUDITORIA_REPORTS_TITLE'));
        
        if ($canDo->get('core.create')) {
            JToolBarHelper::addNew('report.add');
        }
        
        if (($canDo->get('core.edit')) || ($canDo->get('core.edit.own'))) {
            JToolBarHelper::editList('report.edit');
        }
        
        if ($canDo->get('core.delete')) {
            JToolBarHelper::deleteList('', 'reports.delete');
            JToolBarHelper::divider();
        }
        
        if ($canDo->get('core.admin')) {
            JToolBarHelper::preferences('com_auditoria');
            JToolBarHelper::divider();
        }
    }
}