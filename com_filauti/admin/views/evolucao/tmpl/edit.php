<?php
defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT.'/helpers/html');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
JHtml::_('behavior.combobox');
$hasContent = empty($this->item->evolucao);
$script = "Joomla.submitbutton = function(task)
        {
                        if (task == 'evolucao.cancel' || document.formvalidator.isValid(document.id('evolucao-form'))) {";
if ($hasContent) {
    $script .= $this->form->getField('misc')->save();
}
$script .= "    Joomla.submitform(task, document.getElementById('evolucao-form'));
                                if (self != top) {
                                        window.top.setTimeout('window.parent.SqueezeBox.close()', 1000);
                                }
                        } else {
                                alert('".$this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED'))."');
                        }
                }";
JFactory::getDocument()->addScriptDeclaration($script);
?>
<form action="<?php echo JRoute::_('index.php?option=com_filauti&layout=edit&id='.(int) $this->item->id); ?>" method="post" name="adminForm" id="evolucao-form" class="form-validate">
    <div class="width-60 fltlft">
        <fieldset class="adminform">
            <legend><?php echo JText::_('JDETAILS'); ?></legend>
            <ul class="adminformlist">
                
                <li><?php echo $this->form->getLabel('filaid'); ?>
                    <?php echo $this->form->getInput('filaid'); ?></li>
                
                <li><?php echo $this->form->getLabel('prioridade'); ?>
                    <?php echo $this->form->getInput('prioridade'); ?></li>
                
                <?php if ($this->item->id) : ?>
                    <li><?php echo $this->form->getLabel('id'); ?>
				<?php echo $this->form->getInput('id'); ?></li>
                <?php endif; ?>
            </ul>
            <div class="clr"></div>
            <?php echo $this->form->getLabel('misc'); ?>
            <div class="clr"></div>
            <?php echo $this->form->getInput('misc'); ?>
        </fieldset>        
    </div>
    
    <div class="width-40 fltrt">
        <?php echo JHtml::_('sliders.start','evolucao-sliders-'.$this->item->id, array('useCookie' => 1)); ?>
            <?php echo JHtml::_('sliders.panel', JText::_('COM_FILAUTI_EVOLUCAO_FIELDSET_INTERROG'), 'interroga-details'); ?>
            <fieldset class="panelform">
                <ul class="adminformlist">
                    <li><?php echo $this->form->getLabel('gcs'); ?>
                    <?php echo $this->form->getInput('gcs'); ?></li>
                    
                    <li><?php echo $this->form->getLabel('tcc'); ?>
                    <?php echo $this->form->getInput('tcc'); ?></li>
                    
                    <li><?php echo $this->form->getLabel('avc'); ?>
                    <?php echo $this->form->getInput('avc'); ?></li>
                    
                    <li><?php echo $this->form->getLabel('convulsao'); ?>
                    <?php echo $this->form->getInput('convulsao'); ?></li>
                    
                    <li><?php echo $this->form->getLabel('mencef'); ?>
                    <?php echo $this->form->getInput('mencef'); ?></li>
                    
                    <li><?php echo $this->form->getLabel('ventilacao'); ?>
                    <?php echo $this->form->getInput('ventilacao'); ?></li>
                    
                    <li><?php echo $this->form->getLabel('arritmia'); ?>
                    <?php echo $this->form->getInput('arritmia'); ?></li>
                    
                    <li><?php echo $this->form->getLabel('iam'); ?>
                    <?php echo $this->form->getInput('iam'); ?></li>
                    
                    <li><?php echo $this->form->getLabel('icc'); ?>
                    <?php echo $this->form->getInput('icc'); ?></li>
                    
                    <li><?php echo $this->form->getLabel('vasoativa'); ?>
                    <?php echo $this->form->getInput('vasoativa'); ?></li>
                    
                    <li><?php echo $this->form->getLabel('hemodialise'); ?>
                    <?php echo $this->form->getInput('hemodialise'); ?></li>
                    
                    <li><?php echo $this->form->getLabel('hepatica'); ?>
                    <?php echo $this->form->getInput('hepatica'); ?></li>
                    
                    <li><?php echo $this->form->getLabel('acidose'); ?>
                    <?php echo $this->form->getInput('acidose'); ?></li>
                    
                    <li><?php echo $this->form->getLabel('sepse'); ?>
                    <?php echo $this->form->getInput('sepse'); ?></li>
                    
                    <li><?php echo $this->form->getLabel('isolamento'); ?>
                    <?php echo $this->form->getInput('isolamento'); ?></li>
                    
                    <li><?php echo $this->form->getLabel('posop'); ?>
                    <?php echo $this->form->getInput('posop'); ?></li>
                    
                    <li><?php echo $this->form->getLabel('monitor'); ?>
                    <?php echo $this->form->getInput('monitor'); ?></li>
                    
                    <li><?php echo $this->form->getLabel('pcr'); ?>
                    <?php echo $this->form->getInput('pcr'); ?></li>
                    
                </ul>
            </fieldset>
            <?php echo JHtml::_('sliders.end'); ?>
    </div>
    <div>
        <input type="hidden" name="task" value="" />
        <input type="hidden" name="cid" value="<?php echo $this->item->id; ?>" />
        <input type="hidden" name="boxchecked" value="1" />
        <?php echo JHtml::_('form.token'); ?>
    </div>
</form>
