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
		<?php echo JHtml::_('grid.sort', 'JSTATUS', 'a.status', $listDirn, $listOrder); ?>
	</th>
	<th>
		<?php echo JHtml::_('grid.sort', JText::_('COM_CLUBREG_SUBMENU_OFFICIALS'), 'b.name', $listDirn, $listOrder); ?>
	</th>
	<th>
		<?php echo JHtml::_('grid.sort', 'Username', 'b.username', $listDirn, $listOrder); ?>
	</th>	
	<th>
		<?php echo JHtml::_('grid.sort', 'Email', 'b.email', $listDirn, $listOrder); ?>
	</th>
	<th>
		<?php echo JText::_('COM_CLUBREG_GROUPLEADER_LABEL');?>
	</th>
	<th>
		<?php echo JText::_('COM_CLUBREG_GROUPMEMBER_LABEL');?>
	</th>
	<th width="1%" class="nowrap hidden-phone">
		<?php echo JHtml::_('grid.sort', 'joomla Id', 'a.joomla_id', $listDirn, $listOrder); ?>
	</th>
</tr>