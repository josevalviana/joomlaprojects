<?php
defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT.'/helpers/html');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
$hasContent = empty($this->item->atividade);
$script = "Joomla.submitbutton = function(task)
        {
                        if (task == 'atividade.cancel' || document.formvalidator.isValid(document.id('atividade-form'))) {";
if ($hasContent) {
    $script .= $this->form->getField('observacao')->save();
}
$script .= "    Joomla.submitform(task, document.getElementById('atividade-form'));
                                if (self != top) {
                                        window.top.setTimeout('window.parent.SqueezeBox.close()', 1000);
                                }
                        } else {
                                alert('".$this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED'))."');
                        }
                }";
JFactory::getDocument()->addScriptDeclaration($script);
?>
<form action="<?php echo JRoute::_('index.php?option=com_auditoria&layout=edit&id='.(int) $this->item->id); ?>" method="post" name="adminForm" id="atividade-form" class="form-validate">
    <div class="width-60 fltlft">
        <fieldset class="adminform">
            <legend><?php echo JText::_('JDETAILS'); ?></legend>
            <ul class="adminformlist">
                
                <li><?php echo $this->form->getLabel('auditoriaid'); ?>
                    <?php echo $this->form->getInput('auditoriaid'); ?></li>
                
                <li><?php echo $this->form->getLabel('sisreg'); ?>
                    <?php echo $this->form->getInput('sisreg'); ?></li>
                
                <li><?php echo $this->form->getLabel('nome'); ?>
                    <?php echo $this->form->getInput('nome'); ?></li>
                
                <li><?php echo $this->form->getLabel('diagnostico'); ?>
                    <?php echo $this->form->getInput('diagnostico'); ?></li>
                
                <?php if ($this->item->id) : ?>
                    <li><?php echo $this->form->getLabel('id'); ?>
				<?php echo $this->form->getInput('id'); ?></li>
                <?php endif; ?>
            </ul>
            <div class="clr"></div>
            <?php echo $this->form->getLabel('observacao'); ?>
            <div class="clr"></div>
            <?php echo $this->form->getInput('observacao'); ?>
        </fieldset>        
    </div>
    <div>
        <input type="hidden" name="task" value="" />
        <input type="hidden" name="cid" value="<?php echo $this->item->id; ?>" />
        <input type="hidden" name="boxchecked" value="1" />
        <?php echo JHtml::_('form.token'); ?>
    </div>
</form>
