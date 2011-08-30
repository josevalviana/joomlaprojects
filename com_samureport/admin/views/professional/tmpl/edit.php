<?php

// No direct access.
defined('_JEXEC') or die;

//JHtml::addIncludePath(JPATH_COMPONENT.'/helpers/html');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
//JHtml::_('behavior.combobox');

$script = "Joomla.submitbutton = function(task)
	{
			if (task == 'professional.cancel' || document.formvalidator.isValid(document.id('professional-form'))) {
				Joomla.submitform(task, document.getElementById('professional-form'));
				if (self != top) {
					window.top.setTimeout('window.parent.SqueezeBox.close()', 1000);
				}
			} else {
				alert('".$this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED'))."');
			}
	}";

JFactory::getDocument()->addScriptDeclaration($script);
?>
<form action="<?php echo JRoute::_('index.php?option=com_samureport&layout=edit&id='.(int) $this->item->id); ?>" method="post" name="adminForm" id="professional-form" class="form-validate">
	<div class="width-60 fltlft">
		<fieldset class="adminform">
			<legend><?php echo JText::_('JDETAILS'); ?></legend>
			<ul class="adminformlist">

			<li><?php echo $this->form->getLabel('reportid'); ?>
			<?php echo $this->form->getInput('reportid'); ?></li>

			<li><?php echo $this->form->getLabel('profid'); ?>
			<?php echo $this->form->getInput('profid'); ?></li>
			
			<li><?php echo $this->form->getLabel('specid'); ?>
			<?php echo $this->form->getInput('specid'); ?></li>
			
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
