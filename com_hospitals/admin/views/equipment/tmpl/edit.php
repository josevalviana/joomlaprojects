<?php
// no direct access
defined('_JEXEC') or die;

JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
$canDo = HospitalsHelper::getActions();
?>
<script type="text/javascript">
	Joomla.submitbutton = function(task)
	{
		if (task == 'equipment.cancel' || document.formvalidator.isValid(document.id('equipment-form'))) {
			Joomla.submitform(task, document.getElementById('equipment-form'));
		}
	}
</script>

<form action="<?php echo JRoute::_('index.php?option=com_hospitals&layout=edit&id='.(int) $this->item->id); ?>" method="post" name="adminForm" id="equipment-form" class="form-validate">
	<div class="width-60 fltlft">
		<fieldset class="adminform">
			<legend><?php echo empty($this->item->id) ? JText::_('COM_HOSPITALS_NEW_EQUIPMENT') : JText::sprintf('COM_HOSPITALS_EDIT_EQUIPMENT', $this->item->id); ?></legend>
			<ul class="adminformlist">
				<li><?php echo $this->form->getLabel('name'); ?>
				<?php echo $this->form->getInput('name'); ?>
				
				<li><?php echo $this->form->getLabel('id'); ?>
				<?php echo $this->form->getInput('id'); ?></li>
			</ul>
		</fieldset>
		<input type="hidden" name="task" value="" />
		<?php echo JHtml::_('form.token'); ?>
	</div>
	<div class="clr"></div>
</form>