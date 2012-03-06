<?php

defined('_JEXEC') or die;

jimport('joomla.application.component.controllerform');

class FilaUtiControllerEvolucao extends JControllerForm
{
    protected $text_prefix = 'COM_FILAUTI_EVOLUCAO';
    
    function __construct($config = array()) 
    {
        $this->view_list = 'evolucoes';
        
        parent::__construct($config);
    }
    
    public function add()
    {
        $app = JFactory::getApplication();
        $result = parent::add();
        if (JError::isError($result)) {
            return $result;
        }
        
        $pacienteId = JRequest::getInt('filaid');
        if (empty($pacienteId)) {
            $this->setRedirect(JRoute::_('index.php?option='.$this->option.'&view='.$this->view_item.'&layout=edit', false));
            return JError::raiseWarning(500, JText::_('COM_MODULES_ERROR_INVALID_EXTENSION'));
        }
        
        $app->setUserState('com_filauti.add.evolucao.filaid', $pacienteId);
    }
}
?>
