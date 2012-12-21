<?php

defined('_JEXEC') or die;

JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
JHtml::_('behavior.keepalive');
JHtml::_('behavior.modal');

$user   = JFactory::getUser();
$userId = $user->get('id');
?>

<script type="text/javascript">
	Joomla.submitbutton = function(task) {
		if (task == 'paciente.cancel' || document.formvalidator.isValid(document.id('item-form'))) {
			Joomla.submitform(task, document.getElementById('item-form'));
		} else {
                        $$('#item-form .modal-value.invalid').each(function(field) {
                            var idReversed = field.id.split("").reverse().join("");
                            var separatorLocation = idReversed.indexOf('_');
                            var name = idReversed.substr(separatorLocation).split("").reverse().join("")+'name';
                            document.id(name).addClass('invalid');
                        });
			alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED')); ?>');
                }
	}
</script>

<form action="<?php echo JRoute::_('index.php?option=com_filauti&layout=edit&id='.(int) $this->item->id); ?>" method="post" name="adminForm" id="item-form" class="form-validate">
	<div class="width-40 fltlft">
		<fieldset class="adminform">
			<legend><?php echo empty($this->item->id) ? JText::_('COM_FILAUTI_NEW_PACIENTE') : JText::sprintf('COM_FILAUTI_EDIT_PACIENTE', $this->item->id); ?></legend>
			<ul class="adminformlist">
			
				<li><?php echo $this->form->getLabel('sisreg'); ?>
				<?php echo $this->form->getInput('sisreg'); ?></li>
							
				<li><?php echo $this->form->getLabel('nome'); ?>
				<?php echo $this->form->getInput('nome'); ?></li>
                                
                                <li><?php echo $this->form->getLabel('sexo'); ?>
				<?php echo $this->form->getInput('sexo'); ?></li>
				
				<li><?php echo $this->form->getLabel('idade'); ?>
				<?php echo $this->form->getInput('idade'); ?>&nbsp;
				<?php echo $this->form->getInput('idade_c'); ?></li>
                                
                                <li><?php echo $this->form->getLabel('solicitante'); ?>
                                <?php echo $this->form->getInput('solicitante'); ?></li>
                                
                                <li><?php echo $this->form->getLabel('crm'); ?>
                                <?php echo $this->form->getInput('crm'); ?></li>
				
				<li><?php echo $this->form->getLabel('munid'); ?>
				<?php echo $this->form->getInput('munid'); ?></li>
				
				<li><?php echo $this->form->getLabel('hospfromid'); ?>
				<?php echo $this->form->getInput('hospfromid'); ?></li>
                                
                                <li><?php echo $this->form->getLabel('local'); ?>
				<?php echo $this->form->getInput('local'); ?></li>
				
				<li><?php echo $this->form->getLabel('hosptoid'); ?>
				<?php echo $this->form->getInput('hosptoid'); ?></li>
				
				<li><?php echo $this->form->getLabel('cid'); ?>
				<?php echo $this->form->getInput('cid'); ?></li>
				
				<li><?php echo $this->form->getLabel('promotoria'); ?>
				<?php echo $this->form->getInput('promotoria'); ?></li>
                                
                                <li><?php echo $this->form->getLabel('avc'); ?>
				<?php echo $this->form->getInput('avc'); ?></li>
                                
                                <li><?php echo $this->form->getLabel('mencef'); ?>
				<?php echo $this->form->getInput('mencef'); ?></li>
                                
                                <li><?php echo $this->form->getLabel('hemodialise'); ?>
				<?php echo $this->form->getInput('hemodialise'); ?></li>
                                
                                <li><?php echo $this->form->getLabel('isolamento'); ?>
				<?php echo $this->form->getInput('isolamento'); ?></li>
                                
                                <li><?php echo $this->form->getLabel('posop'); ?>
                                <?php echo $this->form->getInput('posop'); ?></li>
                                <?php 
                                    $canEdit = $user->authorise('core.edit', 'com_filauti.paciente.'.(int) $this->item->id);
                                    $prioridade = 4;
                                    if ($this->item->prioridade) $prioridade = $this->item->prioridade;
                                    if ($canEdit) : ?>
                                    <li><?php echo $this->form->getLabel('prioridade'); ?>
                                    <?php echo $this->form->getInput('prioridade'); ?></li>                                
                                <?php else : ?>
                                    <input type="hidden" name="jform[prioridade]" value="<?php echo (int) $prioridade; ?>" />
                                <?php endif; ?>
                              								
				<li><?php echo $this->form->getLabel('id'); ?>
				<?php echo $this->form->getInput('id'); ?></li>
				
			</ul>
		</fieldset>
	</div>
	
	<div class="width-60 fltrt">
		<?php echo JHtml::_('sliders.start','filauti-sliders-'.$this->item->id, array('useCookie' => 1)); ?>
		
			<?php echo JHtml::_('sliders.panel', JText::_('COM_FILAUTI_FIELDSET_ENCERRAMENTO'), 'encerramento-details'); ?>
			<fieldset class="panelform">
				<ul class="adminformlist">
				
					<li><?php echo $this->form->getLabel('encerrado'); ?>
					<?php echo $this->form->getInput('encerrado'); ?></li>
                                        
                                        <li><?php echo $this->form->getLabel('motencerra'); ?>
					<?php echo $this->form->getInput('motencerra'); ?></li>
                                        
                                        <?php if ($this->item->encerrado > 0): ?>
				
                                            <li><?php echo $this->form->getLabel('encerramento'); ?>
                                            <?php echo $this->form->getInput('encerramento'); ?></li>
                                            
                                            <li><?php echo $this->form->getLabel('encerra_by'); ?>
                                            <?php echo $this->form->getInput('encerra_by'); ?></li>
                                        
                                        <?php endif; ?>
				</ul>
			</fieldset>
            
                        <?php if ($this->item->id != 0) : ?>
                            <?php echo JHtml::_('sliders.panel', JText::_('COM_FILAUTI_PACIENTE_EVOLUCOES'), 'evolucoes-options'); ?>
                            <fieldset>
                                <?php echo $this->loadTemplate('evolucoes'); ?>
                            </fieldset>
            
                            <?php echo JHtml::_('sliders.panel', JText::_('COM_FILAUTI_PACIENTE_SOFAS'), 'sofas-options'); ?>
                            <fieldset>
                                <?php echo $this->loadTemplate('sofas'); ?>
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