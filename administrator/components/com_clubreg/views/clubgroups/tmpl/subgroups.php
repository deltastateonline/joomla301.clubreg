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

JHtml::_('behavior.modal');
		$whatAfter = ", onClose:function() { reloadSubgroup() } ";
		$i = 1;
?>
<a href="index.php?option=com_clubreg&view=clubgroup&tmpl=component&task=clubgroup.subedit&group_parent=<?php echo (int) $this->parent_id; ?>&group_id=0&layout=subedit" class="modal"  rel="{handler: 'iframe', size: {x: 600, y: 550} <?php echo $whatAfter;?>}">Add <?php echo JText::_('COM_CLUBREG_SUBGROUPN_LABEL');?></a>

<table class="table table-striped ">
	<thead>
		<tr>
			<th>#</th>
			<th><?php echo JText::_('COM_CLUBREG_SUBGROUPSN_LABEL') ?></th>
			<th><?php echo JText::_('COM_CLUBREG_GROUPTYPE_LABEL'); ?></th>
			<th>Status</th>					
		</tr>
	</thead>
	<tbody>
		<?php foreach($this->items as $agroup){ 
			$link = sprintf("<a href='index.php?option=com_clubreg&view=clubgroup&tmpl=component&task=clubgroup.subedit&group_parent=%d&group_id=%d&layout=subedit' class=\"modal\"  rel=\"{handler: 'iframe', size: {x: 600, y: 550} %s}\">%s</a>",
					$agroup->group_parent,$agroup->group_id,$whatAfter,$agroup->group_name);
		?>
			<tr>
				<td><?php echo $i++; ?></td>
				<td><?php echo  $link ; ?></td>
				<td><?php echo ucwords($agroup->group_type) ; ?><br /><?php echo $agroup->group_leader; ?></td>
				<td><?php echo JHtml::_('jgrid.published', $agroup->published, $i, 'clubgroups.', false);?></td>
			</tr>
		<?php } ?>
	</tbody>
</table>