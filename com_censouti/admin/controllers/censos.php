<?php
// no direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.controlleradmin');

class CensoUTIControllerCensos extends JControllerAdmin
{
    public function getModel($name = 'Censo', $prefix = 'CensoUTIModel', $config = array('ignore_request' => true))
    {
        $model = parent::getModel($name, $prefix, $config);
        
        return $model;
    }            
}