<?php

defined('_JEXEC') or die;

jimport('joomla.application.component.controllerform');

class FilaUtiControllerPaciente extends JControllerForm
{
	function __construct($config = array())
	{
		$this->view_list = 'pacientes';
		
		parent::__construct($config);
	}
	
	protected function allowEdit($data = array(), $key = 'id')
	{
		// Initialise variables.
		$recordId = (int) isset($data[$key]) ? $data[$key] : 0;
		$user		= JFactory::getUser();
		$userId		= $user->get('id');
		
		// Check general edit permission first.
		if ($user->authorise('core.edit', 'com_filauti.paciente.'.$recordId)) {
			return true;
		}
		
		// Fallback on edit.own.
		// First test if the permission is available.
		if ($user->authorise('core.edit.own', 'com_filauti.paciente.'.$recordId)) {
			// Now test the owner is the user.
			$ownerId = (int) isset($data['created_by']) ? $data['created_by'] : 0;
			if (empty($ownerId) && $recordId) {
				// Need to do a lookup from the model.
				$record = $this->getModel()->getItem($recordId);
				
				if (empty($record)) {
					return false;
				}
				
				$ownerId = $record->created_by;
			}
			
			// If the owner matches 'me' then do the test.
			if ($ownerId == $userId) {
				return true;
			}
		}
		
		// Since there is no asset tracking, revert to the component permissions.
		return parent::allowEdit($data, $key);
	}
        
        public function encerra() {           
            $app = JFactory::getApplication();
            $context = "$this->option.edit.$this->context";
            $data = JRequest::getVar('jform', array(), 'post', 'array');
            $data['encerrado'] = 1;
            $data['encerramento'] = JFactory::getDate()->toMySQL();
            
            $model = $this->getModel();
            
            // Validate the posted data.
            // Sometimes the form needs some posted data, such as for plugins and modules.
            $form = $model->getForm($data, false);
            
            if (!$form)
            {
		$app->enqueueMessage($model->getError(), 'error');

		return false;
            }
            
            $validData = $model->validate($form, $data);
            
            // Check for validation errors.
	    if ($validData === false)
	    {
                // Get the validation messages.
		$errors = $model->getErrors();
		
                // Push up to three validation messages out to the user.
		for ($i = 0, $n = count($errors); $i < $n && $i < 3; $i++)
		{
                    if (JError::isError($errors[$i]))
                    {
                        $app->enqueueMessage($errors[$i]->getMessage(), 'warning');
                    }
                    else
                    {
			$app->enqueueMessage($errors[$i], 'warning');
                    }
                }
		// Save the data in the session.
		$app->setUserState($context . '.data', $data);

		// Redirect back to the edit screen.
		$this->setRedirect(
			JRoute::_(
				'index.php?option=com_filauti&view=paciente&layout=edit&id=' . (int) $data['id'],
				false
			)
		);

		return false;
            }
            
            // Attempt to save the data.
            if (!$model->save($validData))
            {
                // Save the data in the session.
		$app->setUserState($context . '.data', $validData);

		// Redirect back to the edit screen.
		$this->setError(JText::sprintf('JLIB_APPLICATION_ERROR_SAVE_FAILED', $model->getError()));
		$this->setMessage($this->getError(), 'error');
		$this->setRedirect(
			JRoute::_(
				'index.php?option=com_filauti&view=paciente&layout=edit&id=' . (int) $data['id'],
				false
			)
		);

		return false;
            }
            
            // Redirect to the list screen.
            $this->setRedirect(
                    JRoute::_(
				'index.php?option=com_filauti&view=pacientes',
				false
                    )
            );
        }
}