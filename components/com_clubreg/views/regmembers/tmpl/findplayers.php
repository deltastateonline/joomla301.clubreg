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

jimport('joomla.html.html.bootstrap');
JHtml::_('behavior.formvalidation');
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
<form action="<?php echo JRoute::_($this->formaction); ?>" method="post" name="findplayerAdminForm" id="findplayerAdminForm" class="form-inline">
	<div class="control-group" id="find-player-div">
		<label class="control-label" for="search_value"><b><?php echo JText::_('COM_CLUBREG_SEARCHPARAMS_LABEL'); ?> :</b></label>  
		<div class="input-append" >		 	
	  		<input type="text" placeholder="<?php echo JText::_('COM_CLUBREG_SEARCHPARAMS_LABEL'); ?>" class="inputbox input-large"  required name="search_value" id="search_value" />
	  		<a href="javascript:void(0);" class="btn btn-findplayer-search"><span class="icon-search"></span></a>
	  	</div>
	  	<span class=""><b><i><?php echo JText::_('COM_CLUBREG_SEARCHPARAMS_TXT');?></i></b></span>	 
	  	<div class="pull-right" id="findplayer_loading" style="width:32px;">&nbsp;</div>
	</div>
	
		
	<input type="<?php echo $in_type; ?>" name="Itemid" value="<?php echo $clubreg_Itemid; ?>" />	
	<input type="<?php echo $in_type; ?>" name="option" value="com_clubreg" />
	
	<input type="<?php echo $in_type; ?>" name="layout" value="<?php echo $this->layout; ?>" />
	<input type="<?php echo $in_type; ?>" name="view" value="regmembers" />
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

<div id="find-player-list">
	<div class="alert alert-success"><?php echo JText::_('COM_CLUBREG_SEARCHPARAMS_DESC')?></div>
</div>
<?php 



$document = JFactory::getDocument();


$document->addScript('https://use.fontawesome.com/9a293d9ea0.js');

ClubregHelper::writeTabAssets($document, "regmembers",array("css"));
ClubregHelper::writeTabAssets($document, "clubreg",array("js"));
ClubregHelper::writeTabAssets($document, "findplayer",array("js","css"));
ClubregHelper::writeTabAssets($document, "common",array("css"));
ClubregHelper::write_footer(); 
?>