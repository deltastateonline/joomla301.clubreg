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
JHtml::_('behavior.framework',true);

JHTML::_('behavior.calendar');
JHtml::_('behavior.tooltip');

$uri = JURI::getInstance();
$Itemid = $uri->getVar('Itemid');
ClubregHelper::writePageHeader($this->pageTitle);

global $clubreg_Itemid,$option;
$in_type = "hidden";
$listOrder	= $this->escape($this->state->get('list.ordering'));
?>
<script type="text/javascript">
	var token = '<?php echo JSession::getFormToken() ;?>';	


	Joomla.submitbutton = function(pressbutton)
	{
		var form = document.getElementById('adminForm');
		console.log(document.adminForm.layout.value);
		if(document.adminForm.layout.value == "exportpayments"){
			document.adminForm.target='_blank';
			document.adminForm.action='<?php echo $this->formaction_comp ; ?>';
		}else{
			document.adminForm.action='<?php echo JRoute::_($this->formaction, false); ?>';

			document.adminForm.target='';
		}
		form.submit();
	}

	// for editing
	Joomla.sbutton = function(pk)
	{
			var form = document.getElementById('adminForm');
			
			document.adminForm.action='<?php echo JRoute::_($this->formaction_edit); ?>';		
			document.adminForm.target='';
			document.adminForm.playertype.value= '<?php echo $this->state->get('filter.playertype'); ?>';
			document.adminForm.layout.value= 'viewonly';
			
			document.adminForm.pk.value = pk;
	
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
<form action="<?php echo JRoute::_($this->formaction); ?>" method="post" name="adminForm" id="adminForm">
<?php 
		$tableFilters = new ClubRegFiltersPaymentsReportingHelper();		
		$tableRender = new ClubRegRenderTablesPaymentsReportingHelper();		
		
		$tableFilters->renderFilters($this->entity_filters);
		$tableFilters->render_payments_filters($this->entity_filters);
		$tableRender->render($this);		
		echo $this->pagination->getListFooter();
?>
	<input type="<?php echo $in_type; ?>" name="Itemid" value="<?php echo $clubreg_Itemid; ?>" />	
	<input type="<?php echo $in_type; ?>" name="option" value="com_clubreg" />
	
	<input type="<?php echo $in_type; ?>" name="layout" value="<?php echo $this->layout; ?>" />
	<input type="<?php echo $in_type; ?>" name="task" value="" />
	<input type="<?php echo $in_type; ?>" name="pk" value="" />
	
	<input type="<?php echo $in_type; ?>" name="boxchecked" value="0" />
	<input type="<?php echo $in_type; ?>" name="filter_order" id="filter_order" value="<?php echo $this->escape($this->state->get('list.ordering')); ?>" />
	<input type="<?php echo $in_type; ?>" name="filter_order_Dir" id="filter_order_Dir" value="<?php echo $this->escape($this->state->get('list.direction')); ?>" />
	<?php echo JHTML::_( 'form.token' ); ?>
</form>
<?php 


$document = JFactory::getDocument();
ClubregHelper::writeTabAssets($document, "regmembers",array("css"));
ClubregHelper::writeTabAssets($document, "clubreg",array("js"));
ClubregHelper::writeTabAssets($document, "common",array("css"));
ClubregHelper::writeTabAssets($document, "filters_logic",array("js"));
ClubregHelper::writeTabAssets($document, "payments.reporting",array("js"));
ClubregHelper::writeTabAssets($document, "clubreggroups",array("js"));
//ClubregHelper::write_footer(); 
?>