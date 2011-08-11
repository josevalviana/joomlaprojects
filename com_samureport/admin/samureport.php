<?php

// no direct access
defined('_JEXEC') or die;

// Access check.
if (!JFactory::getUser()->authorise('core.manage', 'com_samureport')) {
	return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
}

// Include dependencies
jimport('joomla.application.component.controller');

$controller = JController::getInstance('SamuReport');
$controller->execute(JRequest::getCmd('task'));
$controller->redirect();
