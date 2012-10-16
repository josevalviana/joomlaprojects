<?php
// no direct access
defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT.'/helpers/html');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.multiselect');

$user 		= JFactory::getUser();
$userId 	= $user->get('id');
$listOrder 	= $this->escape($this->state->get('list.ordering'));
$listDirn 	= $this->escape($this->state->get('list.direction'));
?>
<form action="<?php echo JRoute::_('index.php?option=com_censouti&view=censos'); ?>" method="post" name="adminForm" id="adminForm">
	<fieldset id="filter-bar">
		<div class="filter-search fltlft">
			<label class="filter-search-lbl" for="filter_search"><?php echo JText::_('JSEARCH_FILTER_LABEL'); ?></label>
			<input type="text" name="filter_search" id="filter_search" value="<?php echo $this->escape($this->state->get('filter.search')); ?>" title="<?php echo JText::_('COM_CENSOUTI_FILTER_SEARCH_DESC'); ?>" />
			
			<button type="submit" class="btn"><?php echo JText::_('JSEARCH_FILTER_SUBMIT'); ?></button>
			<button type="button" onclick="document.id('filter_search').value='';this.form.submit();"><?php echo JText::_('JSEARCH_FILTER_CLEAR'); ?></button>
		</div>
		<div class="filter-select fltrt">
			<select name="filter_author_id" class="inputbox" onchange="this.form.submit()">
				<option value=""><?php echo JText::_('JOPTION_SELECT_AUTHOR'); ?></option>
				<?php echo JHtml::_('select.options', $this->authors, 'value', 'text', $this->state->get('filter.author_id')); ?>
			</select>
                    
                    <select name="filter_hospital_id" class="inputbox" onchange="this.form.submit()">
                        <option value=""><?php echo JText::_('COM_CENSOUTI_SELECT_HOSPITAL'); ?></option>
                        <?php echo JHtml::_('select.options', JHtml::_('hospital.options'), 'value','text', $this->state->get('filter.hospital_id'));?>
                    </select>
                    
                    <select name="filter_category_id" class="inputbox" onchange="this.form.submit()">
                        <option value=""><?php echo JText::_('JOPTION_SELECT_CATEGORY'); ?></option>
                        <?php echo JHtml::_('select.options', JHtml::_('category.options', 'com_censouti'), 'value', 'text', $this->state->get('filter.category_id')); ?>
                    </select>
                    
                    <select name="filter_evolucao" class="inputbox" onchange="this.form.submit()">
                        <option value=""><?php echo JText::_('COM_CENSOUTI_SELECT_EVOLUCAO'); ?></option>
                        <?php echo JHtml::_('select.options',
                                array(
                                    JHtml::_('select.option', 0, JText::_('COM_CENSOUTI_EVOLUCAO_OPTION_NOT_INFORMED')),
                                    JHtml::_('select.option', 1, JText::_('COM_CENSOUTI_EVOLUCAO_OPTION_CRITICAL')),
                                    JHtml::_('select.option', 2, JText::_('COM_CENSOUTI_EVOLUCAO_OPTION_REGULAR')),
                                    JHtml::_('select.option', 3, JText::_('COM_CENSOUTI_EVOLUCAO_OPTION_BETTER')),
                                    JHtml::_('select.option', 4, JText::_('COM_CENSOUTI_EVOLUCAO_OPTION_DECEASED')),
                                )
                                , 'value', 'text', $this->state->get('filter.evolucao'));?>
                    </select>
                    
                    <select name="filter_alta" class="inputbox" onchange="this.form.submit()">
                        <option value=""><?php echo JText::_('COM_CENSOUTI_SELECT_ALTA'); ?></option>
                        <?php echo JHtml::_('select.options',
                                array(
                                    JHtml::_('select.option', 0, JText::_('JNO')),
                                    JHtml::_('select.option', 1, JText::_('JYES'))
                                )
                                , 'value', 'text', $this->state->get('filter.alta'));?>
                    </select>
                    
                    <select name="filter_regulado" class="inputbox" onchange="this.form.submit()">
                        <option value=""><?php echo JText::_('COM_CENSOUTI_SELECT_REGULADO'); ?></option>
                        <?php echo JHtml::_('select.options',
                                array(
                                    JHtml::_('select.option', 0, JText::_('JNO')),
                                    JHtml::_('select.option', 1, JText::_('JYES'))
                                )
                                , 'value', 'text', $this->state->get('filter.regulado'));?>
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
				<th width="10%">
					<?php echo JHtml::_('grid.sort', 'COM_CENSOUTI_HEADING_SISREG', 'a.sisreg', $listDirn, $listOrder); ?>
				</th>
				<th>
				    <?php echo JHtml::_('grid.sort', 'COM_CENSOUTI_HEADING_NOME', 'a.nome', $listDirn, $listOrder); ?>
				</th>
                                <th width="10%">
                                    <?php echo JHtml::_('grid.sort', 'COM_CENSOUTI_HEADING_HOSPITAL', 'hospital_name', $listDirn, $listOrder); ?>
                                </th>
                                <th width="10%">
                                    <?php echo JHtml::_('grid.sort', 'JCATEGORY', 'category_title', $listDirn, $listOrder); ?>
                                </th>
                                <th width="5%">
                                    <?php echo JHtml::_('grid.sort', 'COM_CENSOUTI_HEADING_ADMISSAO', 'a.admissao', $listDirn, $listOrder); ?>
                                </th>
                                <th width="1%">
                                    <?php echo JHtml::_('grid.sort', 'COM_CENSOUTI_HEADING_LEITO', 'a.leito', $listDirn, $listOrder); ?>
                                </th>
                                <th width="10%">
                                    <?php echo JHtml::_('grid.sort', 'COM_CENSOUTI_HEADING_DIAGNOSTICO', 'a.diagnostico', $listDirn, $listOrder); ?>
                                </th>
                                <th width="5%">
                                    <?php echo JHtml::_('grid.sort', 'COM_CENSOUTI_HEADING_EVOLUCAO', 'a.evolucao', $listDirn, $listOrder); ?>
                                </th>
                                <th width="1%">
                                    <?php echo JHtml::_('grid.sort', 'COM_CENSOUTI_HEADING_ALTA', 'a.alta', $listDirn, $listOrder); ?>
                                </th>
                                <th width="5%">
                                    <?php echo JHtml::_('grid.sort', 'COM_CENSOUTI_HEADING_DT_ALTA', 'a.dt_alta', $listDirn, $listOrder); ?>
				</th>
                                <th width="1%">
                                    <?php echo JHtml::_('grid.sort', 'COM_CENSOUTI_HEADING_REGULADO', 'a.regulado', $listDirn, $listOrder); ?>
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
				<td colspan="15">
					<?php echo $this->pagination->getListFooter(); ?>
				</td>
			</tr>
		</tfoot>
		<tbody>
		<?php foreach ($this->items as $i => $item) :
                        $canCreate = $user->authorise('core.create',    'com_censouti.category.'.$item->catid);
                        $canEdit = $user->authorise('core.edit',        'com_censouti.censo.'.$item->id);
                        $canEditOwn = $user->authorise('core.edit.own', 'com_censouti.censo.'.$item->id) && $item->created_by == $userId;
		?>
		<tr class="row<?php echo $i % 2; ?>">
			<td class="center">
				<?php echo JHtml::_('grid.id', $i, $item->id); ?>
			</td>
			<td>
				<?php echo $this->escape($item->sisreg); ?>
			</td>
			<td>
                            <?php if ($canEdit || $canEditOwn) : ?>
                                <a href="<?php echo JRoute::_('index.php?option=com_censouti&task=censo.edit&id='.$item->id); ?>"><?php echo $this->escape($item->nome); ?></a>
                            <?php else : ?>
				<?php echo $this->escape($item->nome); ?>
                            <?php endif; ?>
			</td>
                        <td class="center">
                                <?php echo $this->escape($item->hospital_name); ?>
                        </td>
                        <td class="center">
                            <?php echo $this->escape($item->category_title); ?>
                        </td>
                        <td class="center nowrap">
                                <?php echo JHtml::_('date', $item->admissao, JText::_('DATE_FORMAT_LC4'), null); ?>
                        </td>
                        <td class="center">
                                <?php echo $this->escape($item->leito); ?>
                        </td>
                        <td class="center">
                                <?php echo $this->escape($item->diagnostico); ?>
                        </td>
                        <td class="center">
                                <?php
                                    $evolucaoOptions = array(
                                        JText::_('COM_CENSOUTI_EVOLUCAO_OPTION_NOT_INFORMED'),
                                        JText::_('COM_CENSOUTI_EVOLUCAO_OPTION_CRITICAL'),
                                        JText::_('COM_CENSOUTI_EVOLUCAO_OPTION_REGULAR'),
                                        JText::_('COM_CENSOUTI_EVOLUCAO_OPTION_BETTER'),
                                        JText::_('COM_CENSOUTI_EVOLUCAO_OPTION_DECEASED'),
                                    );
                                ?>
                                <?php echo $this->escape($evolucaoOptions[$item->evolucao]); ?>
                        </td>
                        <td class="center">
                                <?php echo ($item->alta == 0) ? JText::_('JNO') : JText::_('JYES'); ?>
                        </td>
                        <td class="center nowrap">
                                <?php if ($item->dt_alta): ?>
                                    <?php echo JHtml::_('date', $item->dt_alta, JText::_('DATE_FORMAT_LC4'), null); ?>
                                <?php endif; ?>
			</td>
                        <td class="center">
                                <?php echo ($item->regulado == 0) ? JText::_('JNO') : JText::_('JYES'); ?>
                        </td>
			<td class="center">
				<?php echo $this->escape($item->author_name); ?>
			</td>
			<td class="center nowrap">
				<?php echo JHtml::_('date', $item->created, JText::_('DATE_FORMAT_LC4')); ?>
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