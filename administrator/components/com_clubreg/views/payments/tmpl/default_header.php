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
		<?php echo JHtml::_('grid.sort', 'Payment Name', 'a.product_name', $listDirn, $listOrder); ?>
	</th>	
	<th width="15%">
		<?php echo JText::_('Amount'); ?>
	</th>	
	<th width="15%" class="hidden-phone">
		<?php echo JText::_('Valid From - To'); ?>
	</th>	
	<th>
		<?php echo JText::_('Parameters'); ?>
	</th>
	<th width="15%" class="hidden-phone">
		<?php echo JHtml::_('grid.sort', 'Created By', 'b.name', $listDirn, $listOrder); ?>
	</th>	
	<th width="10%" class="hidden-phone">
		<?php echo JHtml::_('grid.sort', 'Created On', 'a.created', $listDirn, $listOrder); ?>
	</th>
	<th width="1%" class="nowrap hidden-phone">
		<?php echo JHtml::_('grid.sort', 'Payment Id', 'a.product_id', $listDirn, $listOrder); ?>
	</th>
</tr>