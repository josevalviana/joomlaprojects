<?php
defined('_JEXEC') or die;
?>
<table class="adminlist">
    <thead>
        <tr>
            <th class="left">
                <?php echo JText::_('JDATE'); ?>
            </th>
            <th class="center">
                <?php echo JText::_('COM_FILAUTI_HEADING_MOD'); ?>
            </th>
            <th class="right">
                <?php echo JText::_('JGRID_HEADING_CREATED_BY'); ?>
            </th>
        </tr>
    </thead>
    <?php if (count($this->mods) > 0) : ?>
    <tbody>
        <?php foreach ($this->mods as $i => &$mod) : ?>
            <tr class="row<?php echo $i %2; ?>">
                <td class="left">
                    <?php $link = 'index.php?option=com_filauti&amp;filaid='. (int) $this->item->id.'&amp;task=mod.edit&amp;id='. (int) $mod->id.'&amp;tmpl=component&amp;view=mod&amp;layout=modal'; ?>
                    <a class="modal" href="<?php echo $link; ?>" rel="{handler: 'iframe', size: {x: 900, y: 550}}" title="<?php echo JText::_('COM_FILAUTI_EDIT_MOD_SETTINGS'); ?>">
                    <?php echo JHtml::_('date', $mod->created, JText::_('DATE_FORMAT_CS1')); ?></a>
                </td>
                <td class="center">
                    <?php (int) $final_score = (int) $mod->respiratory +
                                         (int) $mod->coagulation +
                                         (int) $mod->cardiovascular +
                                         (int) $mod->glasgow +
                                         (int) $mod->liver +
                                         (int) $mod->renal; ?>
                    <?php echo (int) $final_score; ?>
                </td>
                <td class="right">
                    <?php echo $this->escape($mod->author_name); ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
    <?php else : ?>
    <tbody>
        <tr>
            <td>
                <?php echo JText::_('COM_FILAUTI_NO_MODS'); ?>
            </td>
        </tr>
    </tbody>
    <?php endif; ?>
    <tfoot>
        <tr>
            <td colspan="3">
                <?php $link= 'index.php?option=com_filauti&amp;task=mod.add&amp;filaid='.$this->item->id.'&amp;tmpl=component&amp;view=mod&amp;layout=modal'; ?>
                    <a class="modal" href="<?php echo $link; ?>" rel="{handler: 'iframe', size: {x: 900, y: 550}}" title="<?php echo JText::_('COM_FILAUTI_EDIT_MOD_SETTINGS'); ?>">
                        <?php echo JText::_('COM_FILAUTI_PACIENTE_NEW_MOD'); ?></a>
            </td>
        </tr>
    </tfoot>
</table>