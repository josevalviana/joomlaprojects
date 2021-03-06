<?php

defined('_JEXEC') or die;

jimport('joomla.application.component.modeladmin');

require_once JPATH_COMPONENT_ADMINISTRATOR.'/helpers/censouti.php';

class CensoUTIModelCenso extends JModelAdmin
{
    protected $text_prefix = 'COM_CENSOUTI';
    
    public function getTable($type = 'CensoUTI', $prefix = 'CensoUTITable', $config = array())
    {
        return JTable::getInstance($type, $prefix, $config);
    }
    
    public function getForm($data = array(), $loadData = true)
    {
        $form = $this->loadForm('com_censouti.censo', 'censo', array('control' => 'jform', 'load_data' => $loadData));
        if (empty($form)) {
            return false;
        }
        
        if ($id = (int) $this->getState('censo.id')) {
            // Existing record. Can only edit in selected categories.
            $form->setFieldAttribute('catid', 'action', 'core.edit');
            // Existing record. Can only edit own censos in selected categories.
            $form->setFieldAttribute('catid', 'action', 'core.edit.own');
        } else {
            $form->setFieldAttribute('catid', 'action', 'core.create');
        }
        
        return $form;
    }
    
    protected function canDelete($censo)
    {
        if (!empty($censo->id)) {
            $user = JFactory::getUser();
            return $user->authorise('core.delete', 'com_censouti.censo.'.(int) $censo->id);
        }
    }
    
    protected function loadFormData()
    {
        $data = JFactory::getApplication()->getUserState('com_censouti.edit.censo.data', array());
        
        if (empty($data)) {
            $data = $this->getItem();
            
            // Prime some default values.
            if ($this->getState('censo.id' == 0)) {
                $app = JFactory::getApplication();
                $data->set('catid', JRequest::getInt('catid', $app->getUserState('com_censouti.censos.filter.category_id')));
            }                        
        }
        return $data;
    }
}