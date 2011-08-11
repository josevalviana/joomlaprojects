<?php

// No direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.modeladmin');

require_once JPATH_COMPONENT_ADMINISTRATOR.'/helpers/samureport.php';

class SamuReportModelReport extends JModelAdmin
{
	/**
	 * @var		string	The prefix to use with controller messages.
	 * @since	1.6
	 */
	protected $text_prefix = 'COM_SAMUREPORT';

	protected function canDelete($record)
	{
		if (!empty($record->id)) {
			$user = JFactory::getUser();
			return $user->authorise('core.delete', 'com_samureport.report.'.(int) $record->id);
		}
	}

	public function getTable($type = 'Report', $prefix = 'SamuReportTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}

	public function getForm($data = array(), $loadData = true)
	{
		// Get the form.
		$form = $this->loadForm('com_samureport.report', 'report', array('control' => 'jform', 'load_data' => $loadData));
		if (empty($form)) {
			return false;
		}

		// Determine correct permissions to check.
		if ($id = (int) $this->getState('report.id')) {
			// Existing record. Can only edit in selected categories.
			$form->setFieldAttribute('hospitalid', 'action', 'core.edit');
			// Existing record. Can only edit own articles in selected categories.
			$form->setFieldAttribute('hospitalid', 'action', 'core.edit.own');
		}
		else {
			// New record. Can only create in selected categories.
			$form->setFieldAttribute('hospitalid', 'action', 'core.create');
		}

		return $form;
	}

	protected function loadFormData()
	{
		// Check the session for previously entered form data.
		$data = JFactory::getApplication()->getUserState('com_samureport.edit.report.data', array());

		if (empty($data)) {
			$data = $this->getItem();

			// Prime some default values.
			if ($this->getState('report.id') == 0) {
				$app = JFactory::getApplication();
				$data->set('hospitalid', JRequest::getInt('hospitalid', $app->getUserState('com_samureport.reports.filter.hospital_id')));
			}
		}

		return $data;
	}

}