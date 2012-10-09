<?php

// no direct access.
defined('_JEXEC') or die;
?>
<div class="fltrt">
    <button type="button" onclick="Joomla.submitbutton('atividade.save');">
        <?php echo JText::_('JSAVE'); ?></button>
    <button type="button" onclick="Joomla.submitbutton('atividades.delete');">
		<?php echo JText::_('JTRASH'); ?></button>
    <button type="button" onclick="window.parent.SqueezeBox.close();">
        <?php echo JText::_('JCANCEL'); ?></button>
</div>
<div class="clr"></div>
<?php
$this->setLayout('edit');
echo $this->loadTemplate();
