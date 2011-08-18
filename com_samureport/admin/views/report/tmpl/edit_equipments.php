<?php
defined('_JEXEC') or die;
?>
<table class="adminlist">
	<thead>
	<tr>
		<th class="left"><?php echo JText::_('COM_SAMUREPORT_REPORT_HEADING_EQUIPMENTS_LABEL'); ?></th>
	</tr>
	</thead>
	<?php if (count($this->equipments) > 0) : ?>
	<tbody>
		<?php foreach ($this->equipments as $i => &$equipment) : ?>
			<tr class="row<?php echo $i % 2; ?>">
				<td>
					<?php $link = 'index.php?option=com_samureport&amp;task=equipment.edit&amp;reportid='.$this->item->id.'&amp;id='. $equipment->id.'&amp;tmpl=component&amp;view=equipment&amp;layout=modal' ; ?>
					<a class="modal" href="<?php echo $link;?>" rel="{handler: 'iframe', size: {x: 900, y: 550}}" title="<?php echo JText::_('COM_SAMUREPORT_EDIT_EQUIPMENT_SETTINGS');?>">
						<?php echo JText::sprintf($this->escape($equipment->name)); ?></a>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
    <?php else : ?>
    <tbody>
    	<tr>
    		<td>
	  			<?php echo JText::_('COM_SAMUREPORT_REPORT_NO_EQUIPMENTS'); ?>
	  		</td>
	  	</tr>
	</tbody>
	<?php endif; ?>	
	<tfoot>
		<tr>
			<td colspan="1" class="right">
				<?php $link = 'index.php?option=com_samureport&amp;task=equipment.add&amp;reportid='.$this->item->id.'&amp;tmpl=component&amp;view=equipment&amp;layout=modal' ; ?>
					<a class="modal" href="<?php echo $link;?>" rel="{handler: 'iframe', size: {x: 900, y: 550}}" title="<?php echo JText::_('COM_SAMUREPORT_EDIT_EQUIPMENT_SETTINGS');?>">
						<?php echo JText::_('COM_SAMUREPORT_REPORT_NEW_EQUIPMENT'); ?></a>
			</td>
		</tr>
	</tfoot>
</table>
