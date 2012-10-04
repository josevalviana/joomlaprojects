<?php

// no direct access.
defined('_JEXEC') or die;

// include the component HTML helpers.
JHtml::addIncludePath(JPATH_COMPONENT.'/helpers/html');

// Load the tooltip behavior.
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
JHtml::_('behavior.keepalive');
?>

<script type="text/javascript">
	Joomla.submitbutton = function(task) {
		if (task == 'report.cancel' || document.formvalidator.isValid(document.id('item-form'))) {
			<?php echo $this->form->getField('intercorrencia')->save(); ?>
			Joomla.submitform(task, document.getElementById('item-form'));
		} else {
			alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED'));?>');
		}
	}
</script>

<form action="<?php echo JRoute::_('index.php?option=com_auditoria&layout=edit&id='.(int) $this->item->id); ?>" method="post" name="adminForm" id="item-form" class="form-validate">
    <div class="width-60 fltlft">
        <fieldset class="adminform">
            <legend><?php echo empty($this->item->id) ? JText::_('COM_AUDITORIA_NEW_REPORT') : JText::sprintf('COM_AUDITORIA_EDIT_REPORT', $this->item->id); ?></legend>
            <ul class="adminformlist">
                <li><?php echo $this->form->getLabel('hospital'); ?>
                <?php echo $this->form->getInput('hospital'); ?></li>
                
                <li><?php echo $this->form->getLabel('turno'); ?>
                <?php echo $this->form->getInput('turno'); ?></li>
                
                <li><?php echo $this->form->getLabel('telefone'); ?>
                <?php echo $this->form->getInput('telefone'); ?></li>
                
                <li><?php echo $this->form->getLabel('id'); ?>
                <?php echo $this->form->getInput('id'); ?></li>
            </ul>
            
            <div class="clr"></div>
            <?php echo $this->form->getLabel('intercorrencia'); ?>
            <div class="clr"></div>
            <?php echo $this->form->getInput('intercorrencia'); ?>
        </fieldset>
    </div>
    
    <div class="width-40 fltrt">
        <?php echo JHtml::_('sliders.start', 'auditoria-sliders-'.$this->item->id, array('useCookie'=>1)); ?>
        
            <?php echo JHtml::_('sliders.panel', JText::_('COM_AUDITORIA_FIELDSET_PUBLISHING'), 'publishing-details'); ?>
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
        <div class="clr"></div>
        
        <?php if (!empty($this->atividades)) : ?>
            <?php echo JHtml::_('sliders.panel',JText::_('COM_AUDITORIA_REPORT_ATIVIDADE_ASSIGNMENT'), 'atividade-options'); ?>
            <fieldset>
                <?php echo $this->loadTemplate('atividades'); ?>
            </fieldset>
        <?php endif; ?>
        
        <?php echo JHtml::_('sliders.end'); ?>
    </div>
    
    <div class="clr"></div>
    <div>
        <input type="hidden" name="task" value="" />
        <input type="hidden" name="return" value="<?php echo JRequest::getCmd('return'); ?>" />
        <?php echo JHtml::_('form.token'); ?>
    </div>
</form>