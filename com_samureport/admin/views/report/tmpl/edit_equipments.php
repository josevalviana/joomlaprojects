<?php
defined('_JEXEC') or die;
?>
<table class="adminlist">
	<thead>
	<tr>
		<th>Equipment</th>
	</tr>
	<tbody>
		<?php foreach ($this->equipments as $i => &$equipment) : ?>
			<tr class="row<?php echo $i % 2; ?>">
				<td>
					<?php $link = 'index.php?option=com_samureport&amp;&amp;task=equipment.edit&amp;reportid='.$this->item->id.'&amp;id='. $equipment->id.'&amp;tmpl=component&amp;view=equipment&amp;layout=modal' ; ?>
					<a class="modal" href="<?php echo $link;?>" rel="{handler: 'iframe', size: {x: 900, y: 550}}" title="<?php echo JText::_('COM_SAMUREPORT_EDIT_EQUIPMENT_SETTINGS');?>">
						<?php echo JText::sprintf($this->escape($equipment->name)); ?></a>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>