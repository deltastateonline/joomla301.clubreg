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
jimport('joomla.html.html.bootstrap');
//JHtml::_('formbehavior.chosen', 'select');
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

	var selectOneString = "<?php echo JText::_('CLUBREG_PLEASE_SELECT'); ?>";
	var changedPlayertypeString = "<?php echo JText::_('CLUBREG_CHANGEPLAYERTYPE'); ?>";

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
	
</script>
<form action="<?php echo JRoute::_($this->formaction); ?>" method="post" name="adminForm" id="adminForm">
<?php 
		$tableFilters = new ClubRegFiltersStatsHelper();	
		$tableRender = new ClubRegRenderDivsStatsHelper();
		$tableFilters->renderFilters($this->entity_filters);		
		$tableRender->render($this);		
		echo $this->pagination->getListFooter();
		
?>
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

<form action="<?php echo JRoute::_($this->formaction); ?>" method="post" name="statsAdminForm" id="statsAdminForm">

	<input type="<?php echo $in_type; ?>" name="Itemid" value="<?php echo $clubreg_Itemid; ?>" />	
	<input type="<?php echo $in_type; ?>" name="option" value="com_clubreg" />	
	<input type="<?php echo $in_type; ?>" name="task" value="stats.savestats" />
	<input type="<?php echo $in_type; ?>" name="pk" id="pk" value="" />
	<input type="<?php echo $in_type; ?>" name="stat_value" id="stat_value" value="" />
	<input type="<?php echo $in_type; ?>" name="stat_date" id="stat_date" value="" />
	<?php echo JHTML::_( 'form.token' ); ?>
</form>
<?php 


$document = JFactory::getDocument();
ClubregHelper::writeTabAssets($document, "regmembers",array("css"));
ClubregHelper::writeTabAssets($document, "clubreg",array("js"));
ClubregHelper::writeTabAssets($document, "common",array("css"));
ClubregHelper::writeTabAssets($document, "filters_logic",array("js"));
ClubregHelper::writeTabAssets($document, "statslist",array("js",'css'));
ClubregHelper::writeTabAssets($document, "clubreggroups",array("js"));
ClubregHelper::write_footer(); ?>