<?php
// no direct access
defined('_JEXEC') or die;

// Access check.
if (!JFactory::getUser()->authorise('core.manage', 'com_censouti')) {
    return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
}

// Register helper class
JLoader::register('CensoUTIHelper', dirname(__FILE__). '/helpers/censouti.php');

// Include dependencies
jimport('joomla.application.component.controller');

$controller = JController::getInstance('CensoUTI');
$controller->execute(JRequest::getCmd('task'));
$controller->redirect();