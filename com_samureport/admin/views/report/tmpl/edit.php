<?php

// No direct access.
defined('_JEXEC') or die;

// Load the tooltip behavior.
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
JHtml::_('behavior.keepalive');
JHtml::_('behavior.modal');
?>

<script type="text/javascript">
	Joomla.submitbutton = function(task) {
		if (task == 'report.cancel' || document.formvalidator.isValid(document.id('item-form'))) {
			<?php echo $this->form->getField('misc')->save(); ?>
			Joomla.submitform(task, document.getElementById('item-form'));
		} else {
			alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED'));?>');
		}
	}
</script>

<form action="<?php echo JRoute::_('index.php?option=com_samureport&layout=edit&id='.(int) $this->item->id); ?>" method="post" name="adminForm" id="item-form" class="form-validate">
	<div class="width-60 fltlft">
		<fieldset class="adminform">
			<legend><?php echo empty($this->item->id) ? JText::_('COM_SAMUREPORT_NEW_REPORT') : JText::sprintf('COM_SAMUREPORT_EDIT_REPORT', $this->item->id); ?></legend>
			<ul class="adminformlist">
				<li><?php echo $this->form->getLabel('hospitalid'); ?>
				<?php echo $this->form->getInput('hospitalid'); ?></li>
				
				<li><?php echo $this->form->getLabel('shiftid'); ?>
				<?php echo $this->form->getInput('shiftid'); ?></li>
				
				<li><?php echo $this->form->getLabel('contact_phone'); ?>
				<?php echo $this->form->getInput('contact_phone'); ?></li>
				
				<li><?php echo $this->form->getLabel('contact_person'); ?>
				<?php echo $this->form->getInput('contact_person'); ?></li>
				
				<li><?php echo $this->form->getLabel('staff_chief'); ?>
				<?php echo $this->form->getInput('staff_chief'); ?></li>
				
				<li><?php echo $this->form->getLabel('id'); ?>
				<?php echo $this->form->getInput('id'); ?></li>
			</ul>
			<div class="clr"></div>
			<?php echo $this->form->getLabel('misc'); ?>
			<div class="clr"></div>
			<?php echo $this->form->getInput('misc'); ?>
		</fieldset>
	</div>

	<div class="width-40 fltrt">
		<?php echo JHtml::_('sliders.start','content-sliders-'.$this->item->id, array('useCookie'=>1)); ?>

			<?php echo JHtml::_('sliders.panel',JText::_('COM_SAMUREPORT_FIELDSET_PUBLISHING'), 'publishing-details'); ?>
			<fieldset class="panelform">
				<ul class="adminformlist">
					<li><?php echo $this->form->getLabel('created_by'); ?>
					<?php echo $this->form->getInput('created_by'); ?></li>

					<li><?php echo $this->form->getLabel('created'); ?>
					<?php echo $this->form->getInput('created'); ?></li>

					<?php if ($this->item->modified_by) : ?>
						<li><?php echo $this->form->getLabel('modified_by'); ?>
						<?php echo $this->form->getInput('modified_by'); ?></li>

						<li><?php echo $this->form->getLabel('modified'); ?>
						<?php echo $this->form->getInput('modified'); ?></li>
					<?php endif; ?>
				</ul>
			</fieldset>
						
	<?php if ($this->item->id != 0) : ?>
		<?php echo JHtml::_('sliders.panel',JText::_('COM_SAMUREPORT_FIELDSET_EQUIPMENTS'), 'equipments-details'); ?>
			<fieldset class="equipmentform">
				<?php echo $this->loadTemplate('equipments'); ?>
			</fieldset>
		
		<?php echo JHtml::_('sliders.panel',JText::_('COM_SAMUREPORT_FIELDSET_VEHICLES'), 'vehicles-details'); ?>
			<fieldset class="vehicleform">
				<?php echo $this->loadTemplate('vehicles'); ?>
			</fieldset>
			
		<?php echo JHtml::_('sliders.panel',JText::_('COM_SAMUREPORT_FIELDSET_STAFF'), 'staff-details'); ?>
			<fieldset class="staffform">
				<?php echo $this->loadTemplate('staff'); ?>
			</fieldset>
			
		<?php echo JHtml::_('sliders.panel',JText::_('COM_SAMUREPORT_FIELDSET_REASONS'), 'reasons-details'); ?>
			<fieldset class="reasonform">
				<?php echo $this->loadTemplate('reasons'); ?>
			</fieldset>
	<?php endif; ?>
			
		<?php echo JHtml::_('sliders.end'); ?>
	</div>	
	<div>
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="return" value="<?php echo JRequest::getCmd('return');?>" />
		<?php echo JHtml::_('form.token'); ?>
	</div>
</form>

