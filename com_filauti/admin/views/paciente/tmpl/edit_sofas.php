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
                <?php echo JText::_('COM_FILAUTI_HEADING_SOFA'); ?>
            </th>
            <th class="right">
                <?php echo JText::_('JGRID_HEADING_CREATED_BY'); ?>
            </th>
        </tr>
    </thead>
    <?php if (count($this->sofas) > 0) : ?>
    <tbody>
        <?php foreach ($this->sofas as $i => &$sofa) : ?>
            <tr class="row<?php echo $i %2; ?>">
                <td class="left">
                    <?php $link = 'index.php?option=com_filauti&amp;filaid='. (int) $this->item->id.'&amp;task=sofa.edit&amp;id='. (int) $sofa->id.'&amp;tmpl=component&amp;view=sofa&amp;layout=modal'; ?>
                    <a class="modal" href="<?php echo $link; ?>" rel="{handler: 'iframe', size: {x: 900, y: 550}}" title="<?php echo JText::_('COM_FILAUTI_EDIT_SOFA_SETTINGS'); ?>">
                    <?php echo JHtml::_('date', $sofa->created, JText::_('DATE_FORMAT_CS1')); ?></a>
                </td>
                <td class="center">
                    <?php (int) $final_score = (int) $sofa->respiratory +
                                         (int) $sofa->coagulation +
                                         (int) $sofa->cardiovascular +
                                         (int) $sofa->glasgow +
                                         (int) $sofa->liver +
                                         (int) $sofa->renal; ?>
                    <?php echo (int) $final_score; ?>
                </td>
                <td class="right">
                    <?php echo $this->escape($sofa->author_name); ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
    <?php else : ?>
    <tbody>
        <tr>
            <td>
                <?php echo JText::_('COM_FILAUTI_NO_SOFAS'); ?>
            </td>
        </tr>
    </tbody>
    <?php endif; ?>
    <tfoot>
        <tr>
            <td colspan="3">
                <?php $link= 'index.php?option=com_filauti&amp;task=sofa.add&amp;filaid='.$this->item->id.'&amp;tmpl=component&amp;view=sofa&amp;layout=modal'; ?>
                    <a class="modal" href="<?php echo $link; ?>" rel="{handler: 'iframe', size: {x: 900, y: 550}}" title="<?php echo JText::_('COM_FILAUTI_EDIT_SOFA_SETTINGS'); ?>">
                        <?php echo JText::_('COM_FILAUTI_PACIENTE_NEW_SOFA'); ?></a>
            </td>
        </tr>
    </tfoot>
</table>