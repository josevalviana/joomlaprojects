<?php

// No direct access.
defined('_JEXEC') or die;

//JHtml::addIncludePath(JPATH_COMPONENT.'/helpers/html');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
//JHtml::_('behavior.combobox');

$script = "Joomla.submitbutton = function(task)
	{
			if (task == 'vehicle.cancel' || document.formvalidator.isValid(document.id('vehicle-form'))) {
				Joomla.submitform(task, document.getElementById('vehicle-form'));
				if (self != top) {
					window.top.setTimeout('window.parent.SqueezeBox.close()', 1000);
				}
			} else {
				alert('".$this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED'))."');
			}
	}";

JFactory::getDocument()->addScriptDeclaration($script);
?>
<form action="<?php echo JRoute::_('index.php?option=com_samureport&layout=edit&id='.(int) $this->item->id); ?>" method="post" name="adminForm" id="vehicle-form" class="form-validate">
	<div class="width-60 fltlft">
		<fieldset class="adminform">
			<legend><?php echo JText::_('JDETAILS'); ?></legend>
			<ul class="adminformlist">

			<li><?php echo $this->form->getLabel('reportid'); ?>
			<?php echo $this->form->getInput('reportid'); ?></li>

			<li><?php echo $this->form->getLabel('vehicleid'); ?>
			<?php echo $this->form->getInput('vehicleid'); ?></li>
			
			<li><?php echo $this->form->getLabel('quantity'); ?>
			<?php echo $this->form->getInput('quantity'); ?></li>
			
			<?php if ($this->item->id) : ?>
				<li><?php echo $this->form->getLabel('id'); ?>
				<?php echo $this->form->getInput('id'); ?></li>
			<?php endif; ?>
			<div class="clr"></div>
		</fieldset>
	</div>
	<div>
		<input type="hidden" name="task" value="" />
		<?php echo JHtml::_('form.token'); ?>
	</div>
</form>
