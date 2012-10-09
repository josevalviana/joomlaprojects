<?php

// no direct access
defined('_JEXEC') or die;
$user		= JFactory::getUser();
?>
<table class="adminlist">
    <thead>
        <tr>
            <th class="left">
                <?php echo JText::_('COM_AUDITORIA_HEADING_SISREG'); ?>
            </th>                       
            <th>
                <?php echo JText::_('COM_AUDITORIA_HEADING_PACIENTE'); ?>
            </th>
        </tr>
    </thead>
    <?php if (count($this->atividades) > 0) : ?>
    <tbody>
        <?php foreach ($this->atividades as $i => &$atividade) :
            $canEdit = $user->authorise('core.edit', 'com_auditoria.report.'.(int) $this->item->id);
        ?>
            <tr class="row<?php echo $i % 2;?>">
                <td>
                    <?php if ($canEdit): ?>
                    	<?php $link = 'index.php?option=com_auditoria&amp;auditoriaid='. (int) $this->item->id.'&amp;task=atividade.edit&amp;id='.(int) $atividade->id.'&amp;tmpl=component&amp;view=atividade&amp;layout=modal'; ?>
                    	<a class="modal" href="<?php echo $link; ?>" rel="{handler: 'iframe', size: {x: 900, y: 550}}" title="<?php echo JText::_('COM_AUDITORIA_EDIT_ATIVIDADE_SETTINGS'); ?>">
                    	<?php echo $atividade->sisreg; ?></a>
                    <?php else : ?>
                        <?php echo $atividade->sisreg; ?>
                    <?php endif; ?>
                </td>
                <td class="center">
                    <?php echo $atividade->nome; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
    <?php else : ?>
    <tbody>
        <tr>
            <td>
                <?php echo JText::_('COM_AUDITORIA_NO_ATIVIDADES'); ?>
            </td>
        </tr>
    </tbody>
    <?php endif; ?>
    <tfoot>
        <tr>
            <td colspan="2">
                <?php $link = 'index.php?option=com_auditoria&amp;task=atividade.add&amp;auditoriaid='.$this->item->id.'&amp;tmpl=component&amp;view=atividade&amp;layout=modal'; ?>
                <a class="modal" href="<?php echo $link; ?>" rel="{handler: 'iframe', size: {x: 900, y: 550}}" title="<?php echo JText::_('COM_AUDITORIA_EDIT_ATIVIDADE_SETTINGS');?>">
                    <?php echo JText::_('COM_AUDITORIA_ATIVIDADE_NEW'); ?>
                </a>
            </td>
        </tr>
    </tfoot>
</table>
