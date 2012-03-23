<?php
defined('_JEXEC') or die;

jimport('joomla.application.component.controlleradmin');

class FilaUtiControllerEvolucoes extends JControllerAdmin
{
    public function getModel($name = 'Evolucao', $prefix = 'FilaUtiModel', $config = array('ignore_request' => true)) {
        $model = parent::getModel($name, $prefix, $config);
        
        return $model;
    }
}
?>
