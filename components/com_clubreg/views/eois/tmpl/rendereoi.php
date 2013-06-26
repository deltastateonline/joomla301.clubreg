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
JHtml::_('behavior.framework',true);
global $clubreg_Itemid;
$in_type = "hidden";
$listOrder	= $this->escape($this->state->get('list.ordering'));
?>
<script type="text/javascript">
	Joomla.submitbutton = function(pressbutton)
	{
		var form = document.getElementById('adminForm');	
		
		if(pressbutton == "eois.delete"){
			if(!confirm("Are You sure you want to delete Items")){
				return false;
			}
		}

		if(document.adminForm.layout.value == "exporteois"){
			document.adminForm.target='_blank';
			document.adminForm.action='<?php echo JRoute::_($this->formaction_comp,false); ?>';
		}else{
			document.adminForm.target='';
			document.adminForm.action='<?php echo JRoute::_($this->formaction,false); ?>';
			if(document.adminForm.limitstart){
				document.adminForm.limitstart.value='0';
			}
			if(pressbutton == "eois.register"){
				document.adminForm.task.value= pressbutton;
			}
			if(pressbutton == "eois.delete"){
				document.adminForm.task.value= pressbutton;
			}
			
		}
		form.submit();
	}
	Joomla.orderTable = function()
	{
		table = document.getElementById("sortTable");
		direction = document.getElementById("directionTable");
		order = table.options[table.selectedIndex].value;
		var cForm = document.getElementById('adminForm');
		if (order != '<?php echo $listOrder; ?>')
		{
			dirn = 'asc';
		}
		else
		{
			dirn = direction.options[direction.selectedIndex].value;
		}
		Joomla.tableOrdering(order, dirn, '',cForm);
	}
</script>
<?php ClubregHelper::writePageHeader($this->pageTitle); ?>
<form action="<?php echo JRoute::_($this->formaction); ?>" method="post" name="adminForm" id="adminForm">
<?php 
		$tableFilters = new ClubRegFiltersHelper();
		$tableRender = new ClubRegRenderTablesHelper();
		$tableFilters->renderFilters($this->entity_filters);
		$tableRender->render($this);
		echo $this->pagination->getListFooter();
?>
	<input type="<?= $in_type; ?>" name="Itemid" value="<?= $clubreg_Itemid; ?>" />	
	<input type="<?= $in_type; ?>" name="option" value="com_clubreg" />
	
	<input type="<?= $in_type; ?>" name="layout" value="<?php echo $this->layout; ?>" />
	<input type="<?= $in_type; ?>" name="task" value="" />
	
	<input type="<?= $in_type; ?>" name="boxchecked" value="0" />
	<input type="<?= $in_type; ?>" name="filter_order" id="filter_order" value="<?php echo $this->escape($this->state->get('list.ordering'));; ?>" />
	<input type="<?= $in_type; ?>" name="filter_order_Dir" id="filter_order_Dir" value="<?php echo $this->escape($this->state->get('list.direction')); ?>" />
	<?php echo JHTML::_( 'form.token' ); ?>
</form>
<?php 
ClubregHelper::write_footer();
$document = JFactory::getDocument();
$document->addStyleSheet(CLUBREG_ASSETS.'/css/eois.css?'.time());
$document->addScript(CLUBREG_ASSETS.'/js/eois.js?'.time());
?>