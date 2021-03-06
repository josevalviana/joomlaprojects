<?php

defined('_JEXEC') or die;
$user		= JFactory::getUser();
?>
<table class="adminlist">
    <thead>
        <tr>
            <th class="left">
                <?php echo JText::_('JDATE'); ?>
            </th>
            <th class="center">
                <?php echo JText::_('COM_FILAUTI_DISFUNCOES'); ?>
            </th>
            <th class="right">
                <?php echo JText::_('JGRID_HEADING_CREATED_BY'); ?>
            </th>
        </tr>
    </thead>
    <?php if (count($this->evolucoes) > 0) : ?>
    <tbody>
        <?php foreach ($this->evolucoes as $i => &$evolucao) :
        	$canEdit = $user->authorise('core.edit', 'com_filauti.paciente.'. (int) $this->item->id);
        ?>
            <tr class="row<?php echo $i % 2;?>">               
                <td class="left">
                    <?php if ($canEdit): ?>
                    	<?php $link = 'index.php?option=com_filauti&amp;filaid='. (int) $this->item->id.'&amp;task=evolucao.edit&amp;id='.(int) $evolucao->id.'&amp;tmpl=component&amp;view=evolucao&amp;layout=modal'; ?>
                    	<a class="modal" href="<?php echo $link; ?>" rel="{handler: 'iframe', size: {x: 900, y: 550}}" title="<?php echo JText::_('COM_FILAUTI_EDIT_EVOLUCAO_SETTINGS'); ?>">
                    	<?php echo JHtml::_('date', $evolucao->created, JText::_('DATE_FORMAT_CS1')); ?></a>
                    <?php else : ?>
                        <?php echo JHtml::_('date', $evolucao->created, JText::_('DATE_FORMAT_CS1')); ?>
                    <?php endif; ?>
                </td>
                <td class="center">
                    <?php (int) $final_score = (int) $evolucao->ventilacao +
                                         (int) $evolucao->hepatica +
                                         (int) $evolucao->vasoativa +
                                         (int) $evolucao->ira; ?>
                    <?php echo (int) $final_score; ?>
                </td>
                <td class="right">
                    <?php echo $this->escape($evolucao->author_name); ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
    <?php else : ?>
    <tbody>
        <tr>
            <td>
                <?php echo JText::_('COM_FILAUTI_NO_EVOLUCOES'); ?>
            </td>
        </tr>
    </tbody>
    <?php endif; ?>
    <tfoot>
        <tr>
            <td colspan="3">
                <?php $link = 'index.php?option=com_filauti&amp;task=evolucao.add&amp;filaid='.$this->item->id.'&amp;tmpl=component&amp;view=evolucao&amp;layout=modal' ; ?>
					<a class="modal" href="<?php echo $link;?>" rel="{handler: 'iframe', size: {x: 900, y: 550}}" title="<?php echo JText::_('COM_FILAUTI_EDIT_EVOLUCAO_SETTINGS');?>">
						<?php echo JText::_('COM_FILAUTI_PACIENTE_NEW_EVOLUCAO'); ?></a>
            </td>
        </tr>
    </tfoot>
</table>