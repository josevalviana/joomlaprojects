<?php

defined('_JEXEC') or die;

jimport('joomla.application.component.controllerform');

class FilaUtiControllerEvolucao extends JControllerForm
{
    function __construct($config = array()) 
    {
        $this->view_list = 'evolucoes';
        
        parent::__construct($config);
    }
}
?>
