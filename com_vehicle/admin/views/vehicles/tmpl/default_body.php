<?php
// no direct access
defined('_JEXEC') or die('Restricted access');
?>
<?php foreach ($this->items as $i => $item): ?>
<tr class="row<?php echo $i % 2; ?>">
	<td>
		<?php echo $item->id; ?>
	</td>
	<td>
		<?php echo JHtml::_('grid.id', $i, $item->id); ?>
	</td>
	<td>
		<?php echo $item->name; ?>
	</td>
</tr>
<?php endforeach; ?>