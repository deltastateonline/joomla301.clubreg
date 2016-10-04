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
//-->
</script>
<form action="<?php echo JRoute::_($this->formaction); ?>" method="post" name="adminForm" id="expresscheckin-adminForm" class="form-inline">
	
	<div class="control-group" id="express-checkin-div">
		<label class="control-label" for="<?php echo JText::_('COM_CLUBREG_PLAYERNAME_LABEL'); ?>"><?php echo JText::_('COM_CLUBREG_PLAYERNAME_LABEL'); ?></label> : 
		<div class="input-append" >		 	
	  		<input type="text" placeholder="<?php echo JText::_('COM_CLUBREG_PLAYERNAME_LABEL'); ?>" class="inputbox input-xlarge"  required name="search_value" id="search_value" />
	  		<a href="javascript:void(0);" class="btn"><span class="icon-search"></span ></span></a>
	  	</div>
	</div>
	<input type="<?php echo $in_type; ?>" name="Itemid" value="<?php echo $clubreg_Itemid; ?>" />	
	<input type="<?php echo $in_type; ?>" name="option" value="com_clubreg" />
	
	<input type="<?php echo $in_type; ?>" name="layout" value="<?php echo $this->layout; ?>" />
	<input type="<?php echo $in_type; ?>" name="stats_date" id="stats_date" value="<?php echo $this->stats_date; ?>" />
	<input type="<?php echo $in_type; ?>" name="view" value="stats" />
	<input type="<?php echo $in_type; ?>" name="format" value="json" />
	<input type="<?php echo $in_type; ?>" name="pk" value="" />
	
	<input type="<?php echo $in_type; ?>" name="boxchecked" value="0" />
	<input type="<?php echo $in_type; ?>" name="filter_order" id="filter_order" value="<?php echo $this->escape($this->state->get('list.ordering')); ?>" />
	<input type="<?php echo $in_type; ?>" name="filter_order_Dir" id="filter_order_Dir" value="<?php echo $this->escape($this->state->get('list.direction')); ?>" />
	<?php echo JHTML::_( 'form.token' ); ?>
</form>

<div>
	<?php write_debug($_REQUEST); ?>
</div>
<?php 



$document = JFactory::getDocument();
ClubregHelper::writeTabAssets($document, "regmembers",array("css"));
ClubregHelper::writeTabAssets($document, "clubreg",array("js"));
ClubregHelper::writeTabAssets($document, "expresscheckin",array("js"));
ClubregHelper::writeTabAssets($document, "common",array("css"));
//ClubregHelper::write_footer(); 
?>