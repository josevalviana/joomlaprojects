<?php

// no direct access
defined('_JEXEC') or die;

class AuditoriaHelper
{
    public static $extension = 'com_auditoria';
    
    public static function addSubmenu($vName)
    {
        JSubMenuHelper::addEntry(
                JText::_('COM_AUDITORIA_SUBMENU_REPORTS'),
                'index.php?option=com_auditoria&view=reports',
                $vName == 'reports'
        );
    }
    
    public static function getActions($reportId = 0)
    {
        $user = JFactory::getUser();
        $result = new JObject;
        
        if (empty($reportId)) {
            $assetName = 'com_auditoria';
        } else {
            $assetName = 'com_auditoria.report.'.(int) $reportId;
        }
        
        $actions = array(
            'core.admin', 'core.manage', 'core.create', 'core.edit', 'core.edit.own', 'core.delete'
        );
        
        foreach ($actions as $action) {
            $result->set($action, $user->authorise($action, $assetName));
        }
        
        return $result;
    }
}