<?php
defined('_JEXEC') or die;
?>
<table class="adminlist">
	<thead>
	<tr>
		<th class="left"><?php echo JText::_('COM_SAMUREPORT_REPORT_HEADING_STAFF_PROFESSIONAL_LABEL'); ?></th>
		<th class="left"><?php echo JText::_('COM_SAMUREPORT_REPORT_HEADING_STAFF_SPECIALTY_LABEL'); ?></th>
	</tr>
	</thead>
	<?php if (count($this->professionals) > 0) : ?>
	<tbody>
		<?php foreach ($this->professionals as $i => &$professional) : ?>
			<tr class="row<?php echo $i % 2; ?>">
				<td>
					<?php $link = 'index.php?option=com_samureport&amp;task=professional.edit&amp;reportid='.$this->item->id.'&amp;id='. $professional->id.'&amp;tmpl=component&amp;view=professional&amp;layout=modal' ; ?>
					<a class="modal" href="<?php echo $link;?>" rel="{handler: 'iframe', size: {x: 900, y: 550}}" title="<?php echo JText::_('COM_SAMUREPORT_EDIT_PROFESSIONAL_SETTINGS');?>">
						<?php echo JText::sprintf($this->escape($professional->pname)); ?></a>
				</td>
				<td>
					<?php echo $this->escape($professional->spname); ?>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
    <?php else : ?>
    <tbody>
    	<tr>
    		<td>
	  			<?php echo JText::_('COM_SAMUREPORT_REPORT_NO_PROFESSIONALS'); ?>
	  		</td>
	  	</tr>
	</tbody>
	<?php endif; ?>	
	<tfoot>
		<tr>
			<td colspan="1" class="right">
				<?php $link = 'index.php?option=com_samureport&amp;task=professional.add&amp;reportid='.$this->item->id.'&amp;tmpl=component&amp;view=professional&amp;layout=modal' ; ?>
					<a class="modal" href="<?php echo $link;?>" rel="{handler: 'iframe', size: {x: 900, y: 550}}" title="<?php echo JText::_('COM_SAMUREPORT_EDIT_PROFESSIONAL_SETTINGS');?>">
						<?php echo JText::_('COM_SAMUREPORT_REPORT_NEW_PROFESSIONAL'); ?></a>
			</td>
		</tr>
	</tfoot>
</table>