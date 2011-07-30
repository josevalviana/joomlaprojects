<?php
// no direct access
defined('_JEXEC') or die('Restricted access');

// require helper file
JLoader::register('ProfessionalHelper', dirname(__FILE__) . DS . 'helpers' . DS . 'professional.php');

// include dependencies
jimport('joomla.application.component.controller');

$controller = JController::getInstance('professional');
$controller->execute(JRequest::getCmd('task'));
$controller->redirect();