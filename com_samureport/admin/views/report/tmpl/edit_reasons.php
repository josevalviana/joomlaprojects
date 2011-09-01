<?php
defined('_JEXEC') or die;
?>
<table class="adminlist">
	<thead>
	<tr>
		<th class="left"><?php echo JText::_('COM_SAMUREPORT_REPORT_HEADING_PROF_FROM_LABEL'); ?></th>
		<th class="left"><?php echo JText::_('COM_SAMUREPORT_REPORT_HEADING_PROF_TO_LABEL'); ?></th>
		<th class="right"><?php echo JText::_('COM_SAMUREPORT_REPORT_HEADING_REASON_LABEL'); ?></th>
	</tr>
	</thead>
	<?php if (count($this->reasons) > 0) : ?>
	<tbody>
		<?php foreach ($this->reasons as $i => &$reason) : ?>
			<tr class="row<?php echo $i % 2; ?>">
				<td>
					<?php $link = 'index.php?option=com_samureport&amp;task=reason.edit&amp;reportid='.$this->item->id.'&amp;id='. $reason->id.'&amp;tmpl=component&amp;view=reason&amp;layout=modal' ; ?>
					<a class="modal" href="<?php echo $link;?>" rel="{handler: 'iframe', size: {x: 900, y: 550}}" title="<?php echo JText::_('COM_SAMUREPORT_EDIT_REASON_SETTINGS');?>">
						<?php echo JText::sprintf($this->escape($reason->pfname)); ?></a>
				</td>
				<td>
				    <?php echo $this->escape($reason->ptname); ?>
				</td>
				<td class="right">
					<?php echo $this->escape($reason->rrname); ?>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
    <?php else : ?>
    <tbody>
    	<tr>
    		<td>
	  			<?php echo JText::_('COM_SAMUREPORT_REPORT_NO_REASONS'); ?>
	  		</td>
	  	</tr>
	</tbody>
	<?php endif; ?>	
	<tfoot>
		<tr>
			<td colspan="3">
				<?php $link = 'index.php?option=com_samureport&amp;task=reason.add&amp;reportid='.$this->item->id.'&amp;tmpl=component&amp;view=reason&amp;layout=modal' ; ?>
					<a class="modal" href="<?php echo $link;?>" rel="{handler: 'iframe', size: {x: 900, y: 550}}" title="<?php echo JText::_('COM_SAMUREPORT_EDIT_REASON_SETTINGS');?>">
						<?php echo JText::_('COM_SAMUREPORT_REPORT_NEW_REASON'); ?></a>
			</td>
		</tr>
	</tfoot>
</table>
