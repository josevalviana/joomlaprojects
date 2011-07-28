<?php
// no direct access
defined('_JEXEC') or die('Restricted access');

// include dependencies
jimport('joomla.application.component.controller');

$controller = JController::getInstance('hospitals');
$controller->execute(JRequest::getCmd('task'));
$controller->redirect();