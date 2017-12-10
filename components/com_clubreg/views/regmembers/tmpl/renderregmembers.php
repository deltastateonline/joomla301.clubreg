<?php
/*------------------------------------------------------------------------
# com_clubreg - Manage Club Member Registrations
# ------------------------------------------------------------------------
# author    Omokhoa Agbagbara
# copyright Copyright (C) 2012 applications.deltastateonline.com. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://applications.deltastateonline.com
# Technical Support:  email - joomla@deltastateonline.com
-------------------------------------------------------------------------*/
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );


JHtml::_('behavior.framework',true);
jimport('joomla.html.html.bootstrap');
JHtml::_('behavior.keepalive');

JHtml::_('behavior.formvalidator');
JHTML::_('behavior.calendar');
JHtml::_('behavior.tooltip');


global $clubreg_Itemid;
$in_type = "hidden";
$listOrder	= $this->escape($this->state->get('list.ordering'));
?>
<script type="text/javascript">
	var token = '<?php echo JSession::getFormToken() ;?>';

	var selectOneString = "<?php echo JText::_('CLUBREG_PLEASE_SELECT'); ?>";
	var changedPlayertypeString = "<?php echo JText::_('CLUBREG_CHANGEPLAYERTYPE'); ?>";

	Joomla.submitbutton = function(pressbutton)
	{
		var form = document.getElementById('adminForm');
		
		if(pressbutton == "regmembers.delete"){
			if(!confirm("Are You sure you want to delete Items")){
				return false;
			}
		}

		if(document.adminForm.layout.value == "exportregmembers"){
			document.adminForm.target='_blank';
			document.adminForm.action='<?php echo $this->formaction_comp ; ?>';
		}else{
			document.adminForm.target='';
			document.adminForm.action='<?php echo JRoute::_($this->formaction,false); ?>';
			if(document.adminForm.limitstart){
				document.adminForm.limitstart.value='0';
			}
			if(pressbutton == "regmembers.batchUpdate"){
				document.adminForm.task.value= pressbutton;
			}
			if(pressbutton == "regmembers.delete"){
				document.adminForm.task.value= pressbutton;
			}

			if(pressbutton == "regmembers.resetMemberKey"){
				document.adminForm.task.value= pressbutton;
			}

			if(pressbutton == "regmembers.resetMemberKey"){
				document.adminForm.task.value= pressbutton;
			}
			
		}
		form.submit();
	}

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

	Joomla.addbutton = function(pk)
	{

		var form = document.getElementById('adminForm');	
		document.adminForm.action='<?php echo JRoute::_($this->formaction_edit); ?>';		
		document.adminForm.target='';
		document.adminForm.playertype.value= '<?php echo $this->state->get('filter.playertype'); ?>';
		document.adminForm.layout.value= 'edit';
		
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
<?php ClubregHelper::writePageHeader($this->pageTitle); ?> 
<form action="<?php echo JRoute::_($this->formaction); ?>" method="post" name="adminForm" id="adminForm">
<?php 
		$tableFilters = new ClubRegFiltersRegmembersHelper();	
		$tableRender = new ClubRegRenderDivsRegMembersHelper();
		
		$tableFilters->renderFilters($this->entity_filters);
		$tableFilters->render_batch_filters($this->entity_filters);
		//$tableRender->render($this);
		//echo $this->pagination->getListFooter();
?>


	<input type="<?php echo $in_type; ?>" name="clubreg_boxes" value="" />
	<input type="<?php echo $in_type; ?>" name="Itemid" value="<?php echo $clubreg_Itemid; ?>" />	
	<input type="<?php echo $in_type; ?>" name="option" value="com_clubreg" />
	
	<input type="<?php echo $in_type; ?>" name="layout" value="<?php echo $this->layout; ?>" />
	<input type="<?php echo $in_type; ?>" name="task" value="" />
	<input type="<?php echo $in_type; ?>" name="pk" value="" />
	
	<input type="<?php echo $in_type; ?>" name="boxchecked" value="0" />
	<input type="<?php echo $in_type; ?>" name="filter_order" id="filter_order" value="<?php echo $this->escape($this->state->get('list.ordering'));; ?>" />
	<input type="<?php echo $in_type; ?>" name="filter_order_Dir" id="filter_order_Dir" value="<?php echo $this->escape($this->state->get('list.direction')); ?>" />
	<?php echo JHTML::_( 'form.token' ); ?>
</form>
<?php 

$tableRender->render($this);
echo $this->pagination->getListFooter();


$document = JFactory::getDocument();
$document->addScript('https://use.fontawesome.com/9a293d9ea0.js');

ClubregHelper::writeTabAssets($document, "common",array("css"));
ClubregHelper::writeTabAssets($document, "clubreg",array("js"));
ClubregHelper::writeTabAssets($document, "filters_logic",array("js"));
ClubregHelper::writeTabAssets($document, "clubreggroups",array("js"));
ClubregHelper::writeTabAssets($document, "regmembers",array("css","js"));
ClubregHelper::writeTabAssets($document, "alert",array("js"));
ClubregHelper::write_footer();
?>