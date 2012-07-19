<?php

// No direct access
defined('_JEXEC') or die;

class CensoUTIHelper
{
    public static function getActions($censoId = 0)
    {
        $user = JFactory::getUser();
        $result = new JObject;
        
        if (empty($censoId)) {
            $assetName = 'com_censouti';
        } else {
            $assetName = 'com_censouti.censo.'.(int) $censoId;
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
