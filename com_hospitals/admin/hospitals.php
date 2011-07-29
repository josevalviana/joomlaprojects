<?php
// no direct access
defined('_JEXEC') or die('Restricted access');

// require helper file
JLoader::register('HospitalsHelper', dirname(__FILE__) . DS . 'helpers' . DS . 'hospitals.php');

// include dependencies
jimport('joomla.application.component.controller');

$controller = JController::getInstance('hospitals');
$controller->execute(JRequest::getCmd('task'));
$controller->redirect();