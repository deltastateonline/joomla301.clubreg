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

	JHtml::_('behavior.framework');	
	//JHtml::_('behavior.keepalive');

	global $Itemid, $option; 
	$in_type="hidden";
?>
<form action="<?php echo JRoute::_($this->formaction); ?>" method="post" name="adminForm" id="adminForm">
<div class="modal-header pull-right">		
		<button class="btn btn-primary" type="button" href="#" onclick="if (document.adminForm.boxchecked.value==0){alert('Please Select a User to Link');}else{Joomla.submitbutton('officials.link');}">
			<?php echo JText::_('CLUBREG_LINK'); ?>
		</button>
	</div>
<table class="table table-striped table-bordered table-condensed" id="articleList">
	<tr>
		<th>#</th>
		<th>Name</th>
		<th>Email</th>
		<th>Group</th>
	</tr>
<?php
$i = 0;
if(is_array($this->items) && count($this->items) > 0 ){
	foreach($this->items as $an_item){ ?>
		<tr>
			<td nowrap><?php echo $i+1; ?><span class="pull-right"><?php echo JHtml::_('grid.id', $i, $an_item->id); ?></span></td>			
			<td><?= $an_item->name ?></td>
			<td><?= $an_item->email ?></td>
			<td><?= $an_item->groupname ?></td>
		</tr>	
	<?php $i++;
	}
}else{?>

<?php } ?>
</table>
	<input type="<?= $in_type; ?>" name="Itemid" value="<?= $Itemid; ?>" />	
	<input type="<?= $in_type; ?>" name="option" value="com_clubreg" />	
	<input type="<?= $in_type; ?>" name="task" value="link" />
	<input type="<?= $in_type; ?>" name="boxchecked" value="0" />
	<input type="<?= $in_type; ?>" name="tmpl" value="component" />
	<?php echo JHTML::_( 'form.token' ); ?>
</form>