<?php

// No direct access.
defined('_JEXEC') or die;

//JHtml::addIncludePath(JPATH_COMPONENT.'/helpers/html');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
//JHtml::_('behavior.combobox');

$script = "Joomla.submitbutton = function(task)
	{
			if (task == 'reason.cancel' || document.formvalidator.isValid(document.id('reason-form'))) {
				Joomla.submitform(task, document.getElementById('reason-form'));
				if (self != top) {
					window.top.setTimeout('window.parent.SqueezeBox.close()', 1000);
				}
			} else {
				alert('".$this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED'))."');
			}
	}";

JFactory::getDocument()->addScriptDeclaration($script);
?>
<form action="<?php echo JRoute::_('index.php?option=com_samureport&layout=edit&id='.(int) $this->item->id); ?>" method="post" name="adminForm" id="reason-form" class="form-validate">
	<div class="width-60 fltlft">
		<fieldset class="adminform">
			<legend><?php echo JText::_('JDETAILS'); ?></legend>
			<ul class="adminformlist">
			<li><?php echo $this->form->getLabel('reportid'); ?>
			<?php echo $this->form->getInput('reportid'); ?></li>

			<li><?php echo $this->form->getLabel('proffromid'); ?>
			<?php echo $this->form->getInput('proffromid'); ?></li>
			
			<li><?php echo $this->form->getLabel('proftoid'); ?>
			<?php echo $this->form->getInput('proftoid'); ?></li>
			
			<li><?php echo $this->form->getLabel('reasonid'); ?>
			<?php echo $this->form->getInput('reasonid'); ?></li>
			
			<?php if ($this->item->id) : ?>
				<li><?php echo $this->form->getLabel('id'); ?>
				<?php echo $this->form->getInput('id'); ?></li>
			<?php endif; ?>
			</ul>
			<div class="clr"></div>
		</fieldset>
	</div>
	<div>
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="cid" value="<?php echo $this->item->id; ?>" />
		<input type="hidden" name="boxchecked" value="1" />
		<?php echo JHtml::_('form.token'); ?>
	</div>
</form>
