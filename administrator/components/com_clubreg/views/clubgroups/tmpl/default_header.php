<?php
/*------------------------------------------------------------------------
# com_clubreg - Manage Club Member Registrations
# ------------------------------------------------------------------------
# author    Omokhoa Agbagbara
# copyright Copyright (C) 2013 applications.deltastateonline.com. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://applications.deltastateonline.com
# Technical Support:  email - joomla@deltastateonline.com
-------------------------------------------------------------------------*/

defined('_JEXEC') or die;
$listOrder	= $this->escape($this->state->get('list.ordering'));
$listDirn	= $this->escape($this->state->get('list.direction'));
?>

<tr>
	<th width="1%" class="hidden-phone">
		<input type="checkbox" name="checkall-toggle" value="" title="<?php echo JText::_('JGLOBAL_CHECK_ALL'); ?>" onclick="Joomla.checkAll(this)" />
	</th>
	<th width="5%" class="center">
		<?php echo JHtml::_('grid.sort', 'JSTATUS', 'a.published', $listDirn, $listOrder); ?>
	</th>
	<th>
		<?php echo JHtml::_('grid.sort', JText::_('COM_CLUBREG_GROUPN_LABEL'), 'a.group_name', $listDirn, $listOrder); ?>
	</th>
	<th>
		<?php echo JText::_('COM_CLUBREG_GROUPTYPE_LABEL'); ?>
	</th>
	<th>
		<?php echo JHtml::_('grid.sort', JText::_('COM_CLUBREG_GROUPLEADER_LABEL'), 'f.name', $listDirn, $listOrder); ?>
	</th>	
	<th>
		<?php echo JText::_('COM_CLUBREG_GROUPMEMBER_LABEL'); ?>
	</th>
	<th>
		<?php echo JText::_('COM_CLUBREG_SUBGROUPSN_LABEL'); ?>
	</th>	
	<th width="1%" class="nowrap hidden-phone">
		<?php echo JHtml::_('grid.sort', JText::_('COM_CLUBREG_GROUPN_LABEL').' Id', 'a.group_id', $listDirn, $listOrder); ?>
	</th>
</tr>