<?php

// no direct access
defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT.'/helpers/html');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.multiselect');

$user		= JFactory::getUser();
$userId		= $user->get('id');
$listOrder	= $this->escape($this->state->get('list.ordering'));
$listDirn	= $this->escape($this->state->get('list.direction'));
?>
<form action="<?php echo JRoute::_('index.php?option=com_samureport&view=reports');?>" method="post" name="adminForm" id="adminForm">
	<fieldset id="filter-bar">
		<div class="filter-search fltlft">
			<label class="filter-search-lbl" for="filter_search"><?php echo JText::_('JSEARCH_FILTER_LABEL'); ?></label>
			<input type="text" name="filter_search" id="filter_search" value="<?php echo $this->escape($this->state->get('filter.search')); ?>" title="<?php echo JText::_('COM_SAMUREPORT_FILTER_SEARCH_DESC'); ?>" />

			<button type="submit" class="btn"><?php echo JText::_('JSEARCH_FILTER_SUBMIT'); ?></button>
			<button type="button" onclick="document.id('filter_search').value='';this.form.submit();"><?php echo JText::_('JSEARCH_FILTER_CLEAR'); ?></button>
		</div>
		<div class="filter-select fltrt">
		
			<select name="filter_hospital_id" class="inputbox" onchange="this.form.submit()">
				<option value=""><?php echo JText::_('COM_SAMUREPORT_SELECT_HOSPITAL'); ?></option>
				<?php echo JHtml::_('select.options', JHtml::_('hospital.options'), 'value', 'text', $this->state->get('filter.hospital_id')); ?>
			</select>
			
			<select name="filter_shift_id" class="inputbox" onchange="this.form.submit()">
				<option value=""><?php echo JText::_('COM_SAMUREPORT_SELECT_SHIFT'); ?></option>
				<?php echo JHtml::_('select.options', JHtml::_('shift.options'), 'value', 'text', $this->state->get('filter.shift_id')); ?>
			</select>

			<select name="filter_author_id" class="inputbox" onchange="this.form.submit()">
				<option value=""><?php echo JText::_('JOPTION_SELECT_AUTHOR');?></option>
				<?php echo JHtml::_('select.options', JHtml::_('author.options'), 'value', 'text', $this->state->get('filter.author_id'));?>
			</select>

		</div>
	</fieldset>
	<div class="clr"> </div>
	
	<table class="adminlist">
		<thead>
			<tr>
				<th width="1%">
					<input type="checkbox" name="checkall-toggle" value="" title="<?php echo JText::_('JGLOBAL_CHECK_ALL'); ?>" onclick="Joomla.checkAll(this)" />
				</th>
				<th>
					<?php echo JHtml::_('grid.sort', 'COM_SAMUREPORT_REPORTS_HEADING_HOSPITAL_NAME', 'hospital_name', $listDirn, $listOrder); ?>
				</th>
				<th width="1%">
					<?php echo JHtml::_('grid.sort', 'COM_SAMUREPORT_REPORTS_HEADING_SHIFT_NAME', 'shift_name', $listDirn, $listOrder); ?>
				</th>
				<th width="10%">
					<?php echo JHtml::_('grid.sort', 'JGRID_HEADING_CREATED_BY', 'a.created_by', $listDirn, $listOrder); ?>
				</th>
				<th width="5%">
					<?php echo JHtml::_('grid.sort', 'JDATE', 'a.created', $listDirn, $listOrder); ?>
				</th>
				<th width="1%" class="nowrap">
					<?php echo JHtml::_('grid.sort', 'JGRID_HEADING_ID', 'a.id', $listDirn, $listOrder); ?>
				</th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<td colspan="6">
					<?php echo $this->pagination->getListFooter(); ?>
				</td>
			</tr>
		</tfoot>
		<tbody>
		<?php foreach ($this->items as $i => $item) :
			$canCreate	= $user->authorise('core.create',		'com_samureport.hospital.'.$item->hospitalid);
			$canEdit	= $user->authorise('core.edit',			'com_samureport.report.'.$item->id);
			$canEditOwn	= $user->authorise('core.edit.own',		'com_samureport.report.'.$item->id) && $item->created_by == $userId;
			?>
			<tr class="row<?php echo $i % 2; ?>">
				<td class="center">
					<?php echo JHtml::_('grid.id', $i, $item->id); ?>
				</td>
				<td>
					<?php if ($canEdit || $canEditOwn) : ?>
						<a href="<?php echo JRoute::_('index.php?option=com_samureport&task=report.edit&id='.$item->id);?>">
							<?php echo $this->escape($item->hospital_name); ?></a>
					<?php else : ?>
						<?php echo $this->escape($item->hospital_name); ?>
					<?php endif; ?>
				</td>
				<td class="center">
					<?php echo $this->escape($item->shift_name); ?>
				</td>
				<td class="center">
					<?php echo $this->escape($item->author_name); ?>
				</td>
				<td class="center nowrap">
					<?php echo JHtml::_('date',$item->created, JText::_('DATE_FORMAT_LC4')); ?>
				</td>
				<td class="center">
					<?php echo (int) $item->id; ?>
				</td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>

	<div>
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>" />
		<input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>" />
		<?php echo JHtml::_('form.token'); ?>
	</div>
</form>
