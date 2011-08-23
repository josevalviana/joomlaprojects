<?php
defined('_JEXEC') or die;
?>
<table class="adminlist">
	<thead>
	<tr>
		<th class="left"><?php echo JText::_('COM_SAMUREPORT_REPORT_HEADING_VEHICLES_LABEL'); ?></th>
		<th class="right"><?php echo JText::_('COM_SAMUREPORT_REPORT_HEADING_QUANTITY_LABEL')?></th>
	</tr>
	</thead>
	<?php if (count($this->vehicles) > 0) : ?>
	<tbody>
		<?php foreach ($this->vehicles as $i => &$vehicle) : ?>
			<tr class="row<?php echo $i % 2; ?>">
				<td>
					<?php $link = 'index.php?option=com_samureport&amp;task=vehicle.edit&amp;reportid='.$this->item->id.'&amp;id='. $vehicle->id.'&amp;tmpl=component&amp;view=vehicle&amp;layout=modal' ; ?>
					<a class="modal" href="<?php echo $link;?>" rel="{handler: 'iframe', size: {x: 900, y: 550}}" title="<?php echo JText::_('COM_SAMUREPORT_EDIT_EQUIPMENT_SETTINGS');?>">
						<?php echo JText::sprintf($this->escape($vehicle->name)); ?></a>
				</td>
				<td class="right">
					<?php echo $this->escape($vehicle->quantity); ?>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
    <?php else : ?>
    <tbody>
    	<tr>
    		<td>
	  			<?php echo JText::_('COM_SAMUREPORT_REPORT_NO_VEHICLES'); ?>
	  		</td>
	  	</tr>
	</tbody>
	<?php endif; ?>	
	<tfoot>
		<tr>
			<td colspan="2">
				<?php $link = 'index.php?option=com_samureport&amp;task=vehicle.add&amp;reportid='.$this->item->id.'&amp;tmpl=component&amp;view=vehicle&amp;layout=modal' ; ?>
					<a class="modal" href="<?php echo $link;?>" rel="{handler: 'iframe', size: {x: 900, y: 550}}" title="<?php echo JText::_('COM_SAMUREPORT_EDIT_VEHICLE_SETTINGS');?>">
						<?php echo JText::_('COM_SAMUREPORT_REPORT_NEW_VEHICLE'); ?></a>
			</td>
		</tr>
	</tfoot>
</table>
