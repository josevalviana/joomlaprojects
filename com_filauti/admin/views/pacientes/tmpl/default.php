<?php

defined('_JEXEC') or die;

JHtml::_('behavior.tooltip');
JHtml::_('behavior.multiselect');

$user		= JFactory::getUser();
$userId		= $user->get('id');
$listOrder	= $this->escape($this->state->get('list.ordering'));
$listDirn	= $this->escape($this->state->get('list.direction'));
$saveOrder  = $listOrder == 'a.ordering';
?>
<form action="<?php echo JRoute::_('index.php?option=com_filauti&view=pacientes'); ?>" method="post" name="adminForm" id="adminForm">
</form>