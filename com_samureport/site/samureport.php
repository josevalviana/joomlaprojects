<?php
defined('_JEXEC') or die;

jimport('joomla.application.component.controller');

$controller = JController::getInstance('SamuReport');
$controller->execute(JRequest::getCmd('task'));
$controller->redirect();