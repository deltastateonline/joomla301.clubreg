<?php 
$listOrder	= $this->escape($this->state->get('list.ordering'));
$listDirn	= $this->escape($this->state->get('list.direction'));
?>

<tr>
	<th width="1%" class="nowrap center hidden-phone">
		<?php echo JHtml::_('grid.sort', '<i class="icon-menu-2"></i>', 'a.ordering', $listDirn, $listOrder, null, 'asc', 'JGRID_HEADING_ORDERING'); ?>
	</th>
	<th width="1%" class="hidden-phone">
		<input type="checkbox" name="checkall-toggle" value="" title="<?php echo JText::_('JGLOBAL_CHECK_ALL'); ?>" onclick="Joomla.checkAll(this)" />
	</th>
	<th width="5%" class="center">
		<?php echo JHtml::_('grid.sort', 'JSTATUS', 'a.published', $listDirn, $listOrder); ?>
	</th>
	<th>
		<?php echo JHtml::_('grid.sort', 'Template Name', 'a.template_name', $listDirn, $listOrder); ?>
	</th>	
	<th width="15%" class="hidden-phone">
		<?php echo JHtml::_('grid.sort', 'Created By', 'f.name', $listDirn, $listOrder); ?>
	</th>
	<th width="10%" class="hidden-phone">
		<?php echo JText::_('Template Status'); ?>
	</th>
	<th width="10%" class="hidden-phone">
		<?php echo JText::_('Template Access'); ?>
	</th>
	<th width="10%" class="hidden-phone">
		<?php echo JText::_('Template Type');?>
	</th>
	<th width="10%" class="hidden-phone">
		<?php echo JHtml::_('grid.sort', 'Created On', 'a.created', $listDirn, $listOrder); ?>
	</th>
	<th width="1%" class="nowrap hidden-phone">
		<?php echo JHtml::_('grid.sort', 'Template Id', 'a.template_id', $listDirn, $listOrder); ?>
	</th>
</tr>