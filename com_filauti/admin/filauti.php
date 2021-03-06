<?php

// no direct access
defined('_JEXEC') or die('Restricted access');

// Access check.
if (!JFactory::getUser()->authorise('core.manage', 'com_filauti')) {
	return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
}

JLoader::register('FilaUtiHelper', dirname(__FILE__) . DS . 'helpers' . DS . 'filauti.php');

// Include dependencies
jimport('joomla.application.component.controller');

$controller = JController::getInstance('Filauti');
$controller->execute(JRequest::getCmd('task'));
$controller->redirect();
