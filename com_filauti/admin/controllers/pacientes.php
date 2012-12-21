<?php

defined('_JEXEC') or die;

jimport('joomla.application.component.controlleradmin');

class FilaUtiControllerPacientes extends JControllerAdmin
{
	public function getModel($name = 'Paciente', $prefix = 'FilaUtiModel', $config = array('ignore_request' => true)) {
		$model = parent::getModel($name, $prefix, $config);
		
		return $model;
	}
        
        public function reabre()
	{
		// Check for request forgeries
		JSession::checkToken() or die(JText::_('JINVALID_TOKEN'));

		// Get items to reopen from the request.
		$cid = JFactory::getApplication()->input->get('cid', array(), 'array');

		if (!is_array($cid) || count($cid) < 1)
		{
			JLog::add(JText::_($this->text_prefix . '_NO_ITEM_SELECTED'), JLog::WARNING, 'jerror');
		}
		else
		{
			// Get the model.
			$model = $this->getModel();

			// Make sure the item ids are integers
			jimport('joomla.utilities.arrayhelper');
			JArrayHelper::toInteger($cid);

			// Reopen the requests.
			if ($model->reabre($cid))
			{
				$this->setMessage(JText::plural($this->text_prefix . '_N_ITEMS_REABERTOS', count($cid)));
			}
			else
			{
				$this->setMessage($model->getError());
			}
		}

		$this->setRedirect(JRoute::_('index.php?option=' . $this->option . '&view=' . $this->view_list, false));
	}
}