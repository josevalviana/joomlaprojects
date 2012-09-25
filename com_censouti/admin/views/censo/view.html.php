<?php
// no direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.view');

class CensoUTIViewCenso extends JView
{
    protected $form;
    protected $item;
    protected $state;
    
    public function display($tpl = null)
    {
        $this->form     = $this->get('Form');
        $this->item     = $this->get('Item');
        $this->state    = $this->get('State');
        $this->canDo    = CensoUTIHelper::getActions($this->state->get('filter.category_id'));
        
        if (count($errors = $this->get('Errors'))) {
            JError::raiseError(500, implode("\n", $errors));
            return false;
        }
        
        $this->addToolbar();
        parent::display($tpl);
    }
    
    protected function addToolbar()
    {
        JRequest::setVar('hidemainmenu', true);
        $user       = JFactory::getUser();
        $userId     = $user->get('id');
        $isNew      = ($this->item->id == 0);
        $canDo      = CensoUTIHelper::getActions($this->state->get('filter.category_id'), $this->item->id);
        JToolBarHelper::title(JText::_('COM_CENSOUTI_PAGE_'.($isNew ? 'ADD_CENSO' : 'EDIT_CENSO')));
        
        if ($isNew && $canDo->get('core.create')) {
            JToolBarHelper::apply('censo.apply');
            JToolBarHelper::save('censo.save');
            JToolBarHelper::save2new('censo.save2new');
            JToolBarHelper::save2copy('censo.save2copy');
            JToolBarHelper::cancel('censo.cancel');
        } else {
            if ($canDo->get('core.edit') || ($canDo->get('core.edit.own') && $this->item->created_by == $userId)) {
                JToolBarHelper::apply('censo.apply');
                JToolBarHelper::save('censo.save');
            }
            
            JToolBarHelper::cancel('censo.cancel', 'JTOOLBAR_CLOSE');
        }
        
        JToolBarHelper::divider();
        JToolBarHelper::help('JHELP_CENSOUTI_CENSO_MANAGER_EDIT');
    }
}
