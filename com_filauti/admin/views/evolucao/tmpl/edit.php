<?php
defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT.'/helpers/html');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
JHtml::_('behavior.combobox');
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
        </fieldset>        
    </div>
    <div>
        <input type="hidden" name="task" value="" />
        <input type="hidden" name="cid" value="<?php echo $this->item->id; ?>" />
        <input type="hidden" name="boxchecked" value="1" />
        <?php echo JHtml::_('form.token'); ?>
    </div>
</form>
