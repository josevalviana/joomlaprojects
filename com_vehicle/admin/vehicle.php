<?php

// no direct access
defined('_JEXEC') or die('Restricted access');

// include dependencies
jimport('joomla.application.component.controller');

// execute the task
$controller = JController::getInstance('Vehicle');
$controller->execute(JRequest::getVar('task'));
$controller->redirect();