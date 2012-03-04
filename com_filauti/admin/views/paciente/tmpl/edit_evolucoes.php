<?php

defined('_JEXEC') or die;
?>
<table class="adminlist">
    <thead>
        <tr>
            <th class="left">
                Created
            </th>
            <th class="center">
                Priority
            </th>
            <th class="right">
                Author Name
            </th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($this->evolucoes as $i => &$evolucao) : ?>
            <tr class="row<?php echo $i % 2;?>">               
                <td class="left">
                    <?php $link = 'index.php?option=com_filauti&amp;paciente_id='. (int) $this->item->id.'&amp;task=evolucao.edit&amp;id='.(int) $evolucao->id.'&amp;tmpl=component&amp;view=evolucao&amp;layout=modal'; ?>
                    <a class="modal" href="<?php echo $link; ?>" rel="{handler: 'iframe', size: {x: 900, y: 550}}" title="<?php echo JText::_('COM_FILAUTI_EDIT_EVOLUCAO_SETTINGS'); ?>">
                    <?php echo JHtml::_('date', $evolucao->created, JText::_('DATE_FORMAT_CS1')); ?>
                </td>
                <td class="center">
                    <?php echo $this->escape($evolucao->prioridade); ?>
                </td>
                <td class="right">
                    <?php echo $this->escape($evolucao->author_name); ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>