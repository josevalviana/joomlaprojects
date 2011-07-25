<?php

// no direct access
defined('_JEXEC') or die('Restricted Access');

// load tooltip behavior
JHtml::_('behavior.tooltip');
JHtml::_('behavior.multiselect');
$listOrder	= $this->escape($this->state->get('list.ordering'));
$listDirn	= $this->escape($this->state->get('list.direction'));
?>
<form action="<?php echo JRoute::_('index.php?option=com_vehicle'); ?>" method="post" name="adminForm">
	<table class="adminlist">
		<thead>
			<tr>
				<th width="1%">
					<input type="checkbox" name="checkall-toggle" value="" title="<?php echo JText::_('JGLOBAL_CHECK_ALL'); ?>" onclick="Joomla.checkAll(this)" />
				</th>
				<th width="20%">
					<?php echo JHtml::_('grid.sort', 'COM_VEHICLE_VEHICLE_HEADING_NAME', 'a.name', $listDirn, $listOrder); ?>
				</th>
				<th width="10%">
					<?php echo JHtml::_('grid.sort', 'JCATEGORY', 'category_title', $listDirn, $listOrder); ?>
				</th>
				<th width="1%">
					<?php echo JHtml::_('grid.sort', 'COM_VEHICLE_VEHICLE_HEADING_ID', 'a.id', $listDirn, $listOrder); ?>
				</th>	
			</tr>
		</thead>		
		<tfoot>
			<tr>
				<td colspan="4"><?php echo $this->pagination->getListFooter(); ?>
			</tr>
		</tfoot>
		<tbody>
			<?php foreach ($this->items as $i => $item): ?>
			<tr class="row<?php echo $i % 2; ?>">
				<td class="center">
					<?php echo JHtml::_('grid.id', $i, $item->id); ?>
				</td>
				<td>
					<?php echo $this->escape($item->name); ?>
				</td>
				<td align="center">
					<?php echo $this->escape($item->category_title); ?>
				</td>
				<td class="center">
					<?php echo (int) $item->id; ?>
				</td>		
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
	<div>
		<input type="hidden" name="task" value=""/>
		<input type="hidden" name="boxchecked" value="0"/>
		<input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>"/>
		<input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>"/>
		<?php  echo JHtml::_('form.token'); ?>
	</div>
</form>