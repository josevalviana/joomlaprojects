<?php

// no direct access
defined('_JEXEC') or die;
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
    <tbody>
        <?php foreach ($this->atividades as $i => &$atividade) : ?>
            <tr class="row<?php echo $i % 2;?>">
                <td>                
                    <?php echo $atividade->sisreg; ?>
                </td>
                <td class="center">
                    <?php echo $atividade->nome; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
