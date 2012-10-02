<?php

defined('_JEXEC') or die;

jimport('joomla.application.component.controlleradmin');

class AuditoriaControllerReports extends JControllerAdmin
{
    public function getModel($name = 'Report', $prefix = 'AuditoriaModel', $config = array('ignore_request' => true)) {
        $model = parent::getModel($name, $prefix, $config);
        
        return $model;
    }
}