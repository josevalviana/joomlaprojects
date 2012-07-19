<?php
// no direct access
defined('_JEXEC') or die;

// Include the component HTML helpers.
JHtml::addIncludePath(JPATH_COMPONENT.'/helpers/html');

// Load the tooltip behavior.
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
JHtml::_('behavior.keepalive');
?>

<script type="text/javascript">
	Joomla.submitbutton = function(task) {
		if (task == 'censo.cancel' || document.formvalidator.isValid(document.id('item-form'))) {
			Joomla.submitform(task, document.getElementById('item-form'));
		} else {
			alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED'));?>');
		}
	}
</script>

<form action="<?php echo JRoute::_('index.php?option=com_censouti&layout=edit&id='.(int) $this->item->id); ?>" method="post" name="adminForm" id="item-form" class="form-validate">
    <div class="width-60 fltlft">
        <fieldset class="adminform">
            <legend><?php echo empty($this->item->id) ? JText::_('COM_CENSOUTI_NEW_CENSO') : JText::sprintf('COM_CENSOUTI_EDIT_CENSO', $this->item->id); ?></legend>
            <ul class="adminformlist">
                <li><?php echo $this->form->getLabel('sisreg'); ?>
                <?php echo $this->form->getInput('sisreg'); ?></li>
                
                <li><?php echo $this->form->getLabel('nome'); ?>
                <?php echo $this->form->getInput('nome'); ?></li>
                
                <li><?php echo $this->form->getLabel('hospital_id'); ?>
                <?php echo $this->form->getInput('hospital_id'); ?></li>
                
                <li><?php echo $this->form->getLabel('admissao'); ?>
                <?php echo $this->form->getInput('admissao'); ?></li>
                
                <li><?php echo $this->form->getLabel('leito'); ?>
                <?php echo $this->form->getInput('leito'); ?></li>
                
                <li><?php echo $this->form->getLabel('diagnostico'); ?>
                <?php echo $this->form->getInput('diagnostico'); ?></li>
                
                <li><?php echo $this->form->getLabel('evolucao'); ?>
                <?php echo $this->form->getInput('evolucao'); ?></li>
                
                <li><?php echo $this->form->getLabel('alta'); ?>
                <?php echo $this->form->getInput('alta'); ?></li>
                
                <li><?php echo $this->form->getLabel('dt_alta'); ?>
                <?php echo $this->form->getInput('dt_alta'); ?></li>
                
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