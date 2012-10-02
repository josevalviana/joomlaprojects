<?php

// nenhum acesso direto
defined('_JEXEC') or die;

// Checar acesso.
if (!JFactory::getUser()->authorise('core.manage', 'com_auditoria')) {
    return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
}

// Incluir dependências
jimport('joomla.application.component.controller');

$controller = JController::getInstance('Auditoria');
$controller->execute(JRequest::getCmd('task'));
$controller->redirect();