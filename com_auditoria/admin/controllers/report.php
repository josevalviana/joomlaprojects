<?php

// no direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.controllerform');

class AuditoriaControllerReport extends JControllerForm
{
    protected function allowEdit($data = array(), $key = 'id') 
    {
        // Initialize variables.
        $recordId = (int) isset($data[$key]) ? $data[$key] : 0;
        $user = JFactory::getUser();
        $userId = $user->get('id');
        
        // check for general edit permission first.
        if ($user->authorise('core.edit', 'com_auditoria.report.'.$recordId)) {
            return true;
        }
        
        // fallback on edit.own.
        // first test if the permission is available.
        if ($user->authorise('core.edit.own', 'com_auditoria.report.'.$recordId)) {
            // now test the owner is the user.
            $ownerId = (int) isset($data['created_by']) ? $data['created_by'] : 0;
            if (empty($ownerId) && $recordId) {
                // need to do a lookup from the model
                $record = $this->getModel()->getItem($recordId);
                
                if (empty($record)) {
                    return false;
                }
                
                $ownerId = $record->created_by;
            }
            
            // if the owner matches 'me' then do the test.
            if ($ownerId == $userId) {
                return true;
            }                        
        }
        
        // Since there is no asset tracking, revert to the component permissions.
        return parent::allowEdit($data, $key);
    }
}
