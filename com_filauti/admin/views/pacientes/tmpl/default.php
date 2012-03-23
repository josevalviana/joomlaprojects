<?php

defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT.'/helpers/html');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.multiselect');

$user		= JFactory::getUser();
$userId		= $user->get('id');
$listOrder	= $this->escape($this->state->get('list.ordering'));
$listDirn	= $this->escape($this->state->get('list.direction'));
$saveOrder  = $listOrder == 'a.ordering';
?>
<form action="<?php echo JRoute::_('index.php?option=com_filauti&view=pacientes'); ?>" method="post" name="adminForm" id="adminForm">
	<fieldset id="filter-bar">
		<div class="filter-search fltlft">
			<label class="filter-search-lbl" for="filter_search"><?php echo JText::_('JSEARCH_FILTER_LABEL'); ?></label>
			<input type="text" name="filter_search" id="filter_search" value="<?php echo $this->escape($this->state->get('filter.search')); ?>" title="<?php echo JText::_('COM_FILAUTI_FILTER_SEARCH_DESC'); ?>" />
			
			<button type="submit" class="btn"><?php echo JText::_('JSEARCH_FILTER_SUBMIT'); ?></button>
			<button type="button" onclick="document.id('filter_search').value='';this.form.submit();"><?php echo JText::_('JSEARCH_FILTER_CLEAR'); ?></button>
		</div>
		<div class="filter-select fltrt">
			<select name="filter_hospfrom_id" class="inputbox" onchange="this.form.submit()">
				<option value=""><?php echo JText::_('COM_FILAUTI_SELECT_HOSPFROM'); ?></option>
				<?php echo JHtml::_('select.options', JHtml::_('hospital.options'), 'value', 'text', $this->state->get('filter.hospfrom_id')); ?>
			</select>
			
			<select name="filter_hospto_id" class="inputbox" onchange="this.form.submit()">
				<option value=""><?php echo JText::_('COM_FILAUTI_SELECT_HOSPTO'); ?></option>
				<?php echo JHtml::_('select.options', JHtml::_('hospital.options'), 'value', 'text', $this->state->get('filter.hospto_id')); ?>
			</select>
			
			<select name="filter_promotoria" class="inputbox" onchange="this.form.submit()">
			    <option value=""><?php echo JText::_('COM_FILAUTI_SELECT_PROMOTORIA'); ?></option>
				<?php echo JHtml::_('select.options', 
									array(JHtml::_('select.option', '0', JText::_('JNO')), JHtml::_('select.option', '1', JText::_('JYES')))
									, 'value', 'text', $this->state->get('filter.promotoria')); ?>
			</select>
                    
                        <select name="filter_prioridade" class="inputbox" onchange="this.form.submit()">
                            <option value=""><?php echo JText::_('COM_FILAUTI_SELECT_PRIORIDADE'); ?></option>
                            <?php echo JHtml::_('select.options',
                                                        array(
                                                            JHtml::_('select.option', '0', JText::_('COM_FILAUTI_NO_PRIORITY')),
                                                            JHtml::_('select.option', '1', JText::_('COM_FILAUTI_PRIORITY_1')),
                                                            JHtml::_('select.option', '2', JText::_('COM_FILAUTI_PRIORITY_2')),
                                                            JHtml::_('select.option', '3', JText::_('COM_FILAUTI_PRIORITY_3')),
                                                            JHtml::_('select.option', '4', JText::_('COM_FILAUTI_PRIORITY_4'))
                                                        ), 'value', 'text', $this->state->get('filter.prioridade')
                                               ); ?>
                        </select>
                    
                        <select name="filter_avc" class="inputbox" onchange="this.form.submit()">
                            <option value=""><?php echo JText::_('COM_FILAUTI_SELECT_AVC'); ?></option>
                            <?php echo JHtml::_('select.options',
                                                        array(
                                                            JHtml::_('select.option', '0', JText::_('COM_FILAUTI_NONE')),
                                                            JHtml::_('select.option', '1', JText::_('COM_FILAUTI_AVC')),
                                                            JHtml::_('select.option', '2', JText::_('COM_FILAUTI_TCE'))
                                                        ), 'value', 'text', $this->state->get('filter.avc')
                                               ); ?>
                        </select>
                    
                        <select name="filter_mencef" class="inputbox" onchange="this.form.submit()">
                            <option value=""><?php echo JText::_('COM_FILAUTI_SELECT_MENCEF'); ?></option>
                            <?php echo JHtml::_('select.options',
                                                        array(
                                                            JHtml::_('select.option', '0', JText::_('COM_FILAUTI_NOT_INFORMED')),
                                                            JHtml::_('select.option', '1', JText::_('COM_FILAUTI_ME_DONOR')),
                                                            JHtml::_('select.option', '2', JText::_('COM_FILAUTI_ME_NOT_DONOR')),
                                                            JHtml::_('select.option', '3', JText::_('JNO'))
                                                        ), 'value', 'text', $this->state->get('filter.mencef')
                                               ); ?>
                        </select>
                    
                        <select name="filter_hemodialise" class="inputbox" onchange="this.form.submit()">
			    <option value=""><?php echo JText::_('COM_FILAUTI_SELECT_HEMODIALISE'); ?></option>
				<?php echo JHtml::_('select.options', 
									array(JHtml::_('select.option', '0', JText::_('JNO')), JHtml::_('select.option', '1', JText::_('JYES')))
									, 'value', 'text', $this->state->get('filter.hemodialise')); ?>
			</select>
                    
                        <select name="filter_isolamento" class="inputbox" onchange="this.form.submit()">
			    <option value=""><?php echo JText::_('COM_FILAUTI_SELECT_ISOLAMENTO'); ?></option>
				<?php echo JHtml::_('select.options', 
									array(JHtml::_('select.option', '0', JText::_('JNO')), JHtml::_('select.option', '1', JText::_('JYES')))
									, 'value', 'text', $this->state->get('filter.isolamento')); ?>
			</select>
                    
                        <select name="filter_posop" class="inputbox" onchange="this.form.submit()">
			    <option value=""><?php echo JText::_('COM_FILAUTI_SELECT_POSOP'); ?></option>
				<?php echo JHtml::_('select.options', 
									array(JHtml::_('select.option', '0', JText::_('JNO')), JHtml::_('select.option', '1', JText::_('JYES')))
									, 'value', 'text', $this->state->get('filter.posop')); ?>
			</select>
                    
			<select name="filter_encerrado" class="inputbox" onchange="this.form.submit()">
			    <option value=""><?php echo JText::_('COM_FILAUTI_SELECT_ENCERRADO'); ?></option>
				<?php echo JHtml::_('select.options', 
									array(JHtml::_('select.option', '0', JText::_('JNO')), JHtml::_('select.option', '1', JText::_('JYES')))
									, 'value', 'text', $this->state->get('filter.encerrado')); ?>
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
				<th width="5%">
					<?php echo JHtml::_('grid.sort', 'COM_FILAUTI_HEADING_SISREG', 'a.sisreg', $listDirn, $listOrder); ?>
				</th>
				<th>
					<?php echo JHtml::_('grid.sort', 'COM_FILAUTI_HEADING_NOME', 'a.nome', $listDirn, $listOrder); ?>
				</th>
				<th>
					<?php echo JHtml::_('grid.sort', 'COM_FILAUTI_HEADING_HOSPTO_NOME', 'a.hospto_name', $listDirn, $listOrder); ?>
				</th>
                                <th width="1%">
                                    <?php echo JHtml::_('grid.sort', 'COM_FILAUTI_HEADING_PRIORIDADE', 'a.prioridade', $listDirn, $listOrder); ?>
                                </th>
				<th width="5%">
					<?php echo JHtml::_('grid.sort', 'COM_FILAUTI_HEADING_PROMOTORIA', 'a.promotoria', $listDirn, $listOrder); ?>
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
				<td colspan="9">
					<?php echo $this->pagination->getListFooter(); ?>
				</td>
			</tr>
		</tfoot>
		<tbody>
		<?php foreach ($this->items as $i => $item) :
			$canEdit = $user->authorise('core.edit', 'com_filauti.paciente.'.$item->id);
			$canEditOwn = $user->authorise('core.edit.own', 'com_filauti.paciente.'.$item->id) && $item->created_by == $userId;
		?>
		<tr class="row<?php echo $i % 2; ?>">
			<td class="center">
				<?php echo JHtml::_('grid.id', $i, $item->id); ?>
			</td>
			<td class="center">
				<?php echo (int) $item->sisreg; ?>
			</td>
			<td>
				<?php if ($canEdit || $canEditOwn) : ?>
					<a href="<?php echo JRoute::_('index.php?option=com_filauti&task=paciente.edit&id='.$item->id); ?>">
						<?php echo $this->escape($item->nome); ?></a>
				<?php else : ?>
					<?php echo $this->escape($item->nome); ?>
				<?php endif; ?>
			</td>			
			<td>
				<?php echo $this->escape($item->hospto_name); ?>
			</td>
                        <td class="center">
                            <?php echo (int) $item->prioridade; ?>
                        </td>
			<td class="center">			
			    <?php echo JText::_($item->promotoria ? 'JYES' : 'JNO'); ?>
			</td>
			<td class="center">
				<?php echo $this->escape($item->author_name); ?>
			</td>			
			<td class="center nowrap">
				<?php echo JHtml::_('date', $item->created, JText::_('DATE_FORMAT_CS1')); ?>
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