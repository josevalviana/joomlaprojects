<?php

// nenhum acesso direto
defined('_JEXEC') or die;

// Incluir dependências
jimport('joomla.application.component.controller');

class AuditoriaController extends JController
{
    protected $default_view = 'reports';
    
    public function display($cachable = false, $urlparams = false)
    {
        require_once JPATH_COMPONENT.'/helpers/auditoria.php';
        
        // Ler o submenu
        AuditoriaHelper::addSubmenu(JRequest::getCmd('view', 'reports'));
        
        $view = JRequest::getCmd('view', 'reports');
        $layout = JRequest::getCmd('layout', 'reports');
        $id = JRequest::getInt('id');
        
        // Checar pelo form de edição.
        if ($view == 'report' && $layout == 'edit' && !$this->checkEditId('com_auditoria.edit.report', $id)) {
            // De alguma forma a pessoa passou direto ao form - ação não permitida.
            $this->setError(JText::sprintf('JLIB_APPLICATION_ERROR_UNHELD_ID', $id));
            $this->setMessage($this->getError(), 'error');
            $this->setRedirect(JRoute::_('index.php?option=com_auditoria&view=reports', false));
            
            return false;
        }
        
        parent::display();
        
        return $this;
    }
}