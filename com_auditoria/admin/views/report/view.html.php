<?php

// no direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.view');

class AuditoriaViewReport extends JView
{
    protected $form;
    protected $item;
    protected $state;
    protected $atividades;
    
    public function display($tpl = null)
    {
        // initialise variables.
        $this->form     = $this->get('Form');
        $this->item     = $this->get('Item');
        $this->state    = $this->get('State');
        $this->atividades = $this->get('Atividades');
        $this->canDo    = AuditoriaHelper::getActions();
        
        // check for errors.
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
        $user = JFactory::getUser();
        $userId = $user->get('id');
        $isNew = ($this->item->id == 0);
        $canDo = AuditoriaHelper::getActions($this->item->id);
        JToolBarHelper::title(JText::_('COM_AUDITORIA_PAGE_'.($isNew ? 'ADD_REPORT' : 'EDIT_REPORT')));
        
        // Built the actions for new and existing records.
        
        // From new records, check the create permission.
        if ($isNew) {
            JToolBarHelper::apply('report.apply');
            JToolBarHelper::save('report.save');
            JToolBarHelper::save2new('report.save2new');
            JToolBarHelper::cancel('report.cancel');
        } else {
            if ($canDo->get('core.edit') || ($canDo->get('core.edit.own') && $this->item->created_by == $userId)) {
                JToolBarHelper::apply('report.apply');
                JToolBarHelper::save('report.save');
            }
            JToolBarHelper::cancel('report.cancel', 'JTOOLBAR_CLOSE');
        }
    }
}
