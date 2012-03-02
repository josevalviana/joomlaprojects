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