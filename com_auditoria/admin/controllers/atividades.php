<?php
defined('_JEXEC') or die;

jimport('joomla.application.component.controlleradmin');

class AuditoriaControllerAtividades extends JControllerAdmin
{
    public function getModel($name = 'Atividade', $prefix = 'AuditoriaModel', $config = array('ignore_request' => true)) {
        $model = parent::getModel($name, $prefix, $config);
        
        return $model;
    }
}
?>
