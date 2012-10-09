<?php

// no direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.controllerform');

class AuditoriaControllerAtividade extends JControllerForm
{
    protected $text_prefix = 'COM_AUDITORIA_ATIVIDADE';
    
    function __construct($config = array()) {
        $this->view_list = 'atividades';
        
        parent::__construct($config);
    }
    
    public function add()
    {
        $app = JFactory::getApplication();
        $result = parent::add();
        if (JError::isError($result)) {
            return $result;
        }
        
        $auditoriaId = JRequest::getInt('auditoriaid');
        if (empty($auditoriaId)) {
            $this->setRedirect(JRoute::_('index.php?option='.$this->option.'&view='.$this->view_item.'&layout=edit', false));
            return JError::raiseWarning(500, JText::_('COM_AUDITORIA_ERROR_INVALID_AUDITORIA'));
        }
        
        $app->setUserState('com_auditoria.add.atividade.auditoriaid', $auditoriaId);
    }
}
