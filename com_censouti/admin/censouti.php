<?php
// no direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.controller');

$controller = JController::getInstance('CensoUTI');
$controller->execute(JRequest::getCmd('task'));
$controller->redirect();