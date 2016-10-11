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

?>

<script type="text/javascript">
<!--
	var token = '<?php echo JSession::getFormToken() ;?>';

	Joomla.sbutton = function(pk,playerType)
	{
		var form = document.getElementById('adminForm');		
		document.adminForm.target='_blank';
		document.adminForm.playertype.value= playerType;
		
		document.adminForm.pk.value = pk;
		form.submit();
	}
	
//-->
</script>
<form action="<?php echo JRoute::_($this->formaction); ?>" method="post" name="expresscheckinAdminForm" id="expresscheckinAdminForm" class="form-inline">
	
	<div class="control-group" id="express-checkin-div">
		<label class="control-label" for="search_value"><?php echo JText::_('COM_CLUBREG_PLAYERNAME_LABEL'); ?></label> : 
		<div class="input-append" >		 	
	  		<input type="text" placeholder="<?php echo JText::_('COM_CLUBREG_PLAYERNAME_LABEL'); ?>" class="inputbox input-large"  required name="search_value" id="search_value" />
	  		<a href="javascript:void(0);" class="btn btn-expresscheckin-search"><span class="icon-search"></span></a>
	  	</div>
	  	<?php  $attribs = array("class"=>"inputbox input-small","onchange"=>"expressCheckinDateChanged();"); ?>	  	
	  	<?php  echo JHtml::calendar($this->stats_date, "stats_date", 'stats_date','%d/%m/%Y',$attribs) ?>
	  	
	  	<div class="pull-right" id="expresscheckin_loading" style="width:32px;">&nbsp;</div>
	</div>
	
	<div class="alert alert-info">You can view records of all checkins by accessing the Attendance Reporting menu option</div>
		
	<input type="<?php echo $in_type; ?>" name="Itemid" value="<?php echo $clubreg_Itemid; ?>" />	
	<input type="<?php echo $in_type; ?>" name="option" value="com_clubreg" />
	
	<input type="<?php echo $in_type; ?>" name="layout" value="<?php echo $this->layout; ?>" />
	<input type="<?php echo $in_type; ?>" name="view" value="stats" />
	<input type="<?php echo $in_type; ?>" name="format" value="raw" />
	
	
	<input type="<?php echo $in_type; ?>" name="boxchecked" value="0" />
	<input type="<?php echo $in_type; ?>" name="filter_order" id="filter_order" value="<?php echo $this->escape($this->state->get('list.ordering')); ?>" />
	<input type="<?php echo $in_type; ?>" name="filter_order_Dir" id="filter_order_Dir" value="<?php echo $this->escape($this->state->get('list.direction')); ?>" />
	<?php echo JHTML::_( 'form.token' ); ?>
</form>

<form action="<?php echo JRoute::_($this->formaction_edit); ?>" method="post" name="adminForm" id="adminForm" class="form-inline">
	
	<input type="<?php echo $in_type; ?>" name="Itemid" value="<?php echo $clubreg_Itemid; ?>" />	
	<input type="<?php echo $in_type; ?>" name="option" value="com_clubreg" />
	
	<input type="<?php echo $in_type; ?>" name="layout" value="viewonly" />
	<input type="<?php echo $in_type; ?>" name="view" value="regmember" />	
	<input type="<?php echo $in_type; ?>" name="playertype" value="" />
	<input type="<?php echo $in_type; ?>" name="pk" value="" />
	
	<input type="<?php echo $in_type; ?>" name="boxchecked" value="0" />
	<input type="<?php echo $in_type; ?>" name="filter_order" id="filter_order" value="<?php echo $this->escape($this->state->get('list.ordering')); ?>" />
	<input type="<?php echo $in_type; ?>" name="filter_order_Dir" id="filter_order_Dir" value="<?php echo $this->escape($this->state->get('list.direction')); ?>" />
	<?php echo JHTML::_( 'form.token' ); ?>
</form>

<form action="<?php echo JRoute::_($this->formaction); ?>" method="post" name="expresscheckinForm" id="expresscheckinForm" class="form-inline">
	<input type="<?php echo $in_type; ?>" name="Itemid" value="<?php echo $clubreg_Itemid; ?>" />	
	<input type="<?php echo $in_type; ?>" name="option" value="com_clubreg" />
	<input type="<?php echo $in_type; ?>" name="task" value="stats.savestats" />	
	<input type="<?php echo $in_type; ?>" name="statsform[stats_detail]" id="stats_detail" value="stats_attendance" />	
	<input type="<?php echo $in_type; ?>" name="statsform[pk]" id="pk" value="" />
	<input type="<?php echo $in_type; ?>" name="statsform[stats_value]" id="stats_value" value="" />
	<input type="<?php echo $in_type; ?>" name="statsform[stats_date]" id="stats_date" value="<?php echo $this->stats_date; ?>" />
	<?php echo JHTML::_( 'form.token' ); ?>
</form>

<div id="express-checkin-list">
	<div class="alert alert-success">Search for <?php echo JText::_('COM_CLUBREG_PLAYERNAME_LABEL')?></div>
</div>
<?php 



$document = JFactory::getDocument();
ClubregHelper::writeTabAssets($document, "regmembers",array("css"));
ClubregHelper::writeTabAssets($document, "clubreg",array("js"));
ClubregHelper::writeTabAssets($document, "expresscheckin",array("js","css"));
ClubregHelper::writeTabAssets($document, "common",array("css"));
//ClubregHelper::write_footer(); 
?>