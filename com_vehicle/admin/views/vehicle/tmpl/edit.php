<?php

// no direct access
defined('_JEXEC') or die('Restricted access');

JHtml::_('behavior.tooltip');
?>
<form action="<?php echo JRoute::_('index.php?option=com_vehicle&layout=edit&id='.(int) $this->item->id); ?>" method="post" name="adminForm" id="vehicle-form">
	<fieldset class="adminform">
		<legend><?php echo empty($this->item->id) ? JText::_('COM_VEHICLE_NEW_VEHICLE') : JText::sprintf('COM_VEHICLE_EDIT_VEHICLE', $this->item->id); ?></legend>
		<ul class="adminformlist">
			<li><?php echo $this->form->getLabel('name'); ?>
			<?php echo $this->form->getInput('name'); ?></li>
		</ul>
	</fieldset>
	<div>
		<input type="hidden" name="task" value="" />
		<?php echo JHtml::_('form.token'); ?>
	</div>
</form>