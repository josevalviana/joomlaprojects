<?php

// no direct access
defined('_JEXEC') or die('Restricted access');

// require helper file
JLoader::register('VehicleHelper', dirname(__FILE__) . DS . 'helpers' . DS . 'vehicle.php');

// include dependencies
jimport('joomla.application.component.controller');

// execute the task
$controller = JController::getInstance('Vehicle');
$controller->execute(JRequest::getVar('task'));
$controller->redirect();