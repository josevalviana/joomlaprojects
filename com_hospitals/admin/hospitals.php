<?php
// no direct access
defined('_JEXEC') or die('Restricted access');

// require helper file
JLoader::register('HospitalHelper', dirname(__FILE__) . DS . 'helpers' . DS . 'hospital.php');

// include dependencies
jimport('joomla.application.component.controller');

$controller = JController::getInstance('hospitals');
$controller->execute(JRequest::getCmd('task'));
$controller->redirect();