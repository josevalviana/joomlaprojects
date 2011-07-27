<?php

// no direct access
defined('_JEXEC') or die('Restricted access');

JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
?>
<script type="text/javascript">
	Joomla.submitbutton = function(task)
	{
		if (task == 'vehicle.cancel' || document.formvalidator.isValid(document.id('vehicle-form'))) {
			Joomla.submitform(task, document.getElementById('vehicle-form'));
		} else {
			alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED')); ?>');
		}
</script>
<form action="<?php echo JRoute::_('index.php?option=com_vehicle&layout=edit&id='.(int) $this->item->id); ?>" method="post" name="adminForm" id="vehicle-form" class="form-validate">
  <div class="width-60 fltlft">
	<fieldset class="adminform">
		<legend><?php echo empty($this->item->id) ? JText::_('COM_VEHICLE_NEW_VEHICLE') : JText::sprintf('COM_VEHICLE_EDIT_VEHICLE', $this->item->id); ?></legend>
		<ul class="adminformlist">
			<li><?php echo $this->form->getLabel('name'); ?>
			<?php echo $this->form->getInput('name'); ?></li>
			
			<li><?php echo $this->form->getLabel('catid'); ?>
			<?php echo $this->form->getInput('catid'); ?></li>
			
			<li><?php echo $this->form->getLabel('id'); ?>
			<?php echo $this->form->getInput('id'); ?></li>
		</ul>
	</fieldset>
  </div>
  <div class="width-40 fltrt">
  	<?php echo JHtml::_('sliders.start', 'vehicle-slider'); ?>
  		<?php echo JHtml::_('sliders.panel', JText::_('JGLOBAL_FIELDSET_PUBLISHING'), 'publishing-details'); ?>
  		
  		<fieldset class="panelform">
  			<ul class="adminformlist">
  				<li><?php echo $this->form->getLabel('created_by'); ?>
  				<?php echo $this->form->getInput('created_by'); ?></li>
  				
  				<li><?php echo $this->form->getLabel('created_by_alias'); ?>
  				<?php echo $this->form->getInput('created_by_alias'); ?></li>
  				
  				<li><?php echo $this->form->getLabel('created'); ?>
  				<?php echo $this->form->getInput('created'); ?></li>
  				
  				<?php if ($this->item->modified_by) : ?>
  					<li><?php echo $this->form->getLabel('modified_by'); ?>
  					<?php echo $this->form->getInput('modified_by'); ?></li>
  					
  					<li><?php echo $this->form->getLabel('modified'); ?>
  					<?php echo $this->form->getInput('modified'); ?>
  				<?php endif; ?>
  			</ul>
  		</fieldset>
  		<?php echo JHtml::_('sliders.end'); ?>
  		<input type="hidden" name="task" value="" />
		<?php echo JHtml::_('form.token'); ?>
  </div>
</form>