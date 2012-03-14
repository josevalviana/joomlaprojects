<?php
defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT.'/helpers/html');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
JHtml::_('behavior.combobox');
$script = "Joomla.submitbutton = function(task)
        {
                        if (task == 'mod.cancel' || document.formvalidator.isValid(document.id('mod-form'))) {";
$script .= "    Joomla.submitform(task, document.getElementById('mod-form'));
                                if (self != top) {
                                        window.top.setTimeout('window.parent.SqueezeBox.close()', 1000);
                                }
                        } else {
                                alert('".$this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED'))."');
                        }
                }";
JFactory::getDocument()->addScriptDeclaration($script);
?>
<form action="<?php echo JRoute::_('index.php?option=com_filauti&layout=edit&id='.(int) $this->item->id); ?>" method="post" name="adminForm" id="mod-form" class="form-validate">
    <div class="width-60 fltlft">
        <fieldset class="adminform">
            <legend><?php echo JText::_('JDETAILS'); ?></legend>
            <ul class="adminformlist">
                
                <li><?php echo $this->form->getLabel('filaid'); ?>
                    <?php echo $this->form->getInput('filaid'); ?></li>
                
                <li><?php echo $this->form->getLabel('respiratory'); ?>
                    <?php echo $this->form->getInput('respiratory'); ?></li>
                
                <li><?php echo $this->form->getLabel('coagulation'); ?>
                    <?php echo $this->form->getInput('coagulation'); ?></li>
                
                <li><?php echo $this->form->getLabel('cardiovascular'); ?>
                    <?php echo $this->form->getInput('cardiovascular'); ?></li>
                
                <li><?php echo $this->form->getLabel('glasgow'); ?>
                    <?php echo $this->form->getInput('glasgow'); ?></li>
                
                <li><?php echo $this->form->getLabel('liver'); ?>
                    <?php echo $this->form->getInput('liver'); ?></li>
                
                <li><?php echo $this->form->getLabel('renal'); ?>
                    <?php echo $this->form->getInput('renal'); ?></li>
                
                <?php if ($this->item->id) : ?>
                    <li><?php echo $this->form->getLabel('id'); ?>
				<?php echo $this->form->getInput('id'); ?></li>
                <?php endif; ?>
            </ul>
        </fieldset>        
    </div>
    <div>
        <input type="hidden" name="task" value="" />
        <input type="hidden" name="cid" value="<?php echo $this->item->id; ?>" />
        <input type="hidden" name="boxchecked" value="1" />
        <?php echo JHtml::_('form.token'); ?>
    </div>
</form>
