<?php

// no direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.controllerform');

class CensoUTIControllerCenso extends JControllerForm
{
    protected function allowEdit($data = array(), $key = 'id')
    {
        $censoId = (int) isset($data[$key]) ? $data[$key] : 0;
        $user = JFactory::getUser();
        $userId = $user->get('id');
        
        if ($user->authorise('core.edit', 'com_censouti.censo.'. $censoId))
        {
            return true;
        }
        
        if ($user->authorise('core.edit.own', 'com_censouti.censo.' . $censoId))
        {
            $ownerId = (int) isset($data['created_by']) ? $data['created_by'] : 0;
            if (empty($ownerId) && $censoId)
            {
                // Need to do a lookup from the model.
                $censo = $this->getModel()->getItem($censoId);
                
                if (empty($censo))
                {
                    return false;
                }
                
                $ownerId = $censo->created_by;
            }
            
            // If the owner matches 'me' then do the test.
            if ($ownerId == $userId)
            {
                return true;
            }
        }
        
        // Since there is no asset tracking, revert to the component permissions.
        return parent::allowEdit($data, $key);
    }
}
