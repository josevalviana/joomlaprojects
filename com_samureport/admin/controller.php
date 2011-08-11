<?php
/**
 * @version		$Id: controller.php 20196 2011-01-09 02:40:25Z ian $
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.controller');

/**
 * Component Controller
 *
 * @package		Joomla.Administrator
 * @subpackage	com_content
 */
class SamuReportController extends JController
{

	protected $default_view = 'samureports';

	/**
	 * Method to display a view.
	 *
	 * @param	boolean			If true, the view output will be cached
	 * @param	array			An array of safe url parameters and their variable types, for valid values see {@link JFilterInput::clean()}.
	 *
	 * @return	JController		This object to support chaining.
	 * @since	1.5
	 */
	public function display($cachable = false, $urlparams = false)
	{
		require_once JPATH_COMPONENT.'/helpers/samureport.php';

		// Load the submenu.
		SamuReportHelper::addSubmenu(JRequest::getCmd('view', 'samureports'));

		$view		= JRequest::getCmd('view', 'samureports');
		$layout 	= JRequest::getCmd('layout', 'samureports');
		$id			= JRequest::getInt('id');

		// Check for edit form.
		if ($view == 'samureport' && $layout == 'edit' && !$this->checkEditId('com_samureport.edit.samureport', $id)) {
			// Somehow the person just went to the form - we don't allow that.
			$this->setError(JText::sprintf('JLIB_APPLICATION_ERROR_UNHELD_ID', $id));
			$this->setMessage($this->getError(), 'error');
			$this->setRedirect(JRoute::_('index.php?option=com_samureport&view=samureports', false));

			return false;
		}

		parent::display();

		return $this;
	}
}