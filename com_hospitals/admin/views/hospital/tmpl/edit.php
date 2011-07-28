<?php
defined('_JEXEC') or die;
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
?>
<script type="text/javascript">
	Joomla.submitbutton = function(task) 
	{
		if (task == 'hospital.cancel' || document.formvalidator.isValid(document.id('hospital-form'))) {
			<?php echo $this->form->getField('misc')->save(); ?>
			Joomla.submitform(task, document.getElementById('hospital-form'));
		} else {
			alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED')); ?>');
		}
	}
</script>
<form action="<?php echo JRoute::_('index.php?option=com_hospitals&layout=edit&id='.(int) $this->item->id); ?>" method="post" name="adminForm" id="hospital-form" class="form-validate">
	<div class="width-60 fltlft">
		<fieldset class="adminform">
			<legend><?php echo empty($this->item->id) ? JText::_('COM_HOSPITALS_NEW_HOSPITAL') : JText::sprintf('COM_HOSPITALS_EDIT_HOSPITAL', $this->item->id); ?></legend>
			<ul class="adminformlist">
				<li><?php echo $this->form->getLabel('name'); ?>
				<?php echo $this->form->getInput('name'); ?></li>
			
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
		<?php echo JHtml::_('sliders.start', 'hospital-slider'); ?>
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
						<?php echo $this->form->getInput('modified'); ?></li>
					<?php endif; ?>
				</ul>
			</fieldset>
			<?php echo JHtml::_('sliders.panel', JText::_('COM_HOSPITALS_HOSPITAL_DETAILS'), 'basic-options'); ?>
			
			<fieldset class="panelform">
				<p><?php echo empty($this->item->id) ? JText::_('COM_HOSPITALS_DETAILS') : JText::sprintf('COM_HOSPITALS_EDIT_DETAILS', $this->item->id); ?></p>
				
				<ul class="adminformlist">				
					<li><?php echo $this->form->getLabel('email_to'); ?>
					<?php echo $this->form->getInput('email_to'); ?></li>
					
					<li><?php echo $this->form->getLabel('address'); ?>
					<?php echo $this->form->getInput('address'); ?></li>
					
					<li><?php echo $this->form->getLabel('suburb'); ?>
					<?php echo $this->form->getInput('suburb'); ?></li>
					
					<li><?php echo $this->form->getLabel('state'); ?>
					<?php echo $this->form->getInput('state'); ?></li>
					
					<li><?php echo $this->form->getLabel('postcode'); ?>
					<?php echo $this->form->getInput('postcode'); ?></li>
					
					<li><?php echo $this->form->getLabel('country'); ?>
					<?php echo $this->form->getInput('country'); ?></li>
					
					<li><?php echo $this->form->getLabel('telephone'); ?>
					<?php echo $this->form->getInput('telephone'); ?></li>
					
					<li><?php echo $this->form->getLabel('fax'); ?>
					<?php echo $this->form->getInput('fax'); ?></li>

					<li><?php echo $this->form->getLabel('webpage'); ?>
					<?php echo $this->form->getInput('webpage'); ?></li>
				</ul>
			</fieldset>
		<?php echo JHtml::_('sliders.end'); ?>
		<input type="hidden" name="task" value="" />
		<?php echo JHtml::_('form.token'); ?>
	</div>
</form>
<div class="clr"></div>