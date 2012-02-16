<?php

defined('_JEXEC') or die;

JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
JHtml::_('behavior.keepalive');
?>

<script type="text/javascript">
	Joomla.submitbutton = function(task) {
		if (task == 'paciente.cancel' || document.formvalidator.isValid(document.id('item-form'))) {
			Joomla.submitform(task, document.getElementById('item-form'));
		} else {
			alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED')); ?>');
	}
</script>

<form action="<?php echo JRoute::_('index.php?option=com_filauti&layout=edit&id='.(int) $this->item->id); ?>" method="post" name="adminForm" id="item-form" class="form-validate">
	<div class="width-60 fltlft">
		<fieldset class="adminform">
			<legend><?php echo empty($this->item->id) ? JText::_('COM_FILAUTI_NEW_PACIENTE') : JText::sprintf('COM_FILAUTI_EDIT_PACIENTE', $this->item->id); ?></legend>
			<ul class="adminformlist">
			
				<li><?php echo $this->form->getLabel('sisreg'); ?>
				<?php echo $this->form->getInput('sisreg'); ?></li>
			
				<li><?php echo $this->form->getLabel('nome'); ?>
				<?php echo $this->form->getInput('nome'); ?></li>
				
				<li><?php echo $this->form->getLabel('idade'); ?>
				<?php echo $this->form->getInput('idade'); ?>&nbsp;
				<?php echo $this->form->getInput('idade_c'); ?></li>
				
				<li><?php echo $this->form->getLabel('hospfromid'); ?>
				<?php echo $this->form->getInput('hospfromid'); ?></li>
				
				<li><?php echo $this->form->getLabel('hosptoid'); ?>
				<?php echo $this->form->getInput('hosptoid'); ?></li>
				
				<li><?php echo $this->form->getLabel('promotoria'); ?>
				<?php echo $this->form->getInput('promotoria'); ?></li>
								
				<li><?php echo $this->form->getLabel('id'); ?>
				<?php echo $this->form->getInput('id'); ?></li>
				
			</ul>
		</fieldset>
	</div>
	<div>
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="return" value="<?php echo JRequest::getCmd('return'); ?>" />
		<?php echo JHtml::_('form.token'); ?>
	</div>
</form>