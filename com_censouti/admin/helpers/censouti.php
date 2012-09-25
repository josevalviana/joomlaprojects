<?php

// No direct access
defined('_JEXEC') or die;

class CensoUTIHelper
{
    public static $extension = 'com_censouti';
    
    public static function addSubmenu($vName)
    {
        JSubMenuHelper::addEntry(
                JText::_('COM_CENSOUTI_CENSOS'),
                'index.php?option=com_censouti&view=censos',
                $vName == 'censos'
        );
        JSubMenuHelper::addEntry(
                JText::_('COM_CENSOUTI_SUBMENU_CATEGORIES'),
                'index.php?option=com_categories&extension=com_censouti',
                $vName == 'categories'
        );
    }
    
    public static function getActions($categoryId = 0, $censoId = 0)
    {
        $user = JFactory::getUser();
        $result = new JObject;
        
        if (empty($censoId) && empty($categoryId)) {
            $assetName = 'com_censouti';
        } else if (empty($censoId)) {
            $assetName = 'com_censouti.category.'.(int) $categoryId;
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
