<?php

defined('_JEXEC') or die;

jimport('joomla.application.component.view');

class FilaUtiViewEvolucao extends JView
{
    protected $form;
    protected $item;
    protected $state;
    
    public function display($tpl = null)
    {
        $this->form     = $this->get('Form');
        $this->item     = $this->get('Item');
        $this->state    = $this->get('State');
        
        // Check for errors.
        if (count($errors = $this->get('Errors'))) {
            JError::raiseError(500, implode("\n", $errors));
            return false;
        }
        
        $this->addToolbar();
        parent::display($tpl);
    }
    
    protected function addToolbar()
    {
        
    }
}
?>
