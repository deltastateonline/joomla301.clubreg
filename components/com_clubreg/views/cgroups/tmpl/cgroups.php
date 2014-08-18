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
JHtml::_('behavior.formvalidation');
JHTML::_('behavior.calendar');
JHtml::_('behavior.tooltip');
JHtml::_('formbehavior.chosen', 'select');

$uri = JURI::getInstance();
$Itemid = $uri->getVar('Itemid');
ClubregHelper::writePageHeader($this->pageTitle);

global $clubreg_Itemid,$option;

require_once JPATH_COMPONENT.DS.'helpers'.DS.'clubreg.profilethumbs.php';
 
	$params = JComponentHelper::getParams('com_clubreg');
 	$folder_path = $params->get("attachment_folder");
 
 	$media_params = JComponentHelper::getParams('com_media');
 	$full_media_path = $media_params->get('file_path').DS.$folder_path.DS;
 
 	$thumbrenderer = new ClubRegProfileThumbsHelper($full_media_path); 

 	$fkey ="year";
 	$in_type = "hidden";
 	$d_url = sprintf('index.php?option=%s&Itemid=%s&view=cgroups&layout=cgroups&groups=%d',$option,$clubreg_Itemid,$this->current_group->group_id );
 
?>
<form action="<?php echo JRoute::_($d_url); ?>" method="get" name="adminForm" id="adminForm">
<div>
	<div class="pull-right">
	<span style="font-size:1.1em;font-weight:bold;"><?php echo $this->year_registered_control['label']; ?>&nbsp;:&nbsp;</span>
	<?php echo JHtml::_('select.genericlist', $this->year_registered,$fkey, trim($this->year_registered_control['other']), 'value','text',$this->year_default); ?>
	<button class='btn'><i class='icon-search'></i></button>
	</div>	
	<input type="<?php echo $in_type; ?>" name="option" value="com_clubreg" />
	<input type="<?php echo $in_type; ?>" name="view" value="cgroups" />
	<input type="<?php echo $in_type; ?>" name="layout" value="cgroups" />	
  	<input type="<?php echo $in_type; ?>" name="Itemid" value="<?php echo $clubreg_Itemid; ?>" />	
	<input type="<?php echo $in_type; ?>" name="groups" value="<?php echo $this->current_group->group_id; ?>" />
</div>
</form>
<div class="clearfix">&nbsp;</div>
<div style="font-size:1.3em;font-weight:bold;"><?php echo JText::_('CLUBREG_OFFICIALS_PROFILE_LEADER')?></div>
<div class="row cgroup-div" style="margin:7px 5px 7px 10px;">	
	<div style="font-size:1.1em;font-weight:bold;"><?php echo $this->group_leader->official_name?></div>
</div>
<div style="border-bottom:dashed 1px #4E4E4E">&nbsp;</div>
<br />
<div style="font-size:1.3em;font-weight:bold;"><?php echo JText::_('CLUBREG_OFFICIALS_PROFILE_MEMBER')?></div>
<?php  if(count($this->items) <= 0 ){ 	?>
	
	<div class="row cgroup-div" style="margin:7px 5px 7px 10px;">
		<div class="alert alert-error"><h3>No Results</h3></div>
	</div>
	<?php 
}else{
	foreach($this->items as $a_player){  $profile_pix = $thumbrenderer->renderMemberThumb($a_player->member_id,TRUE);	
		$drop_caps = "<span class='introduction'>".substr($a_player->surname,0,1).substr($a_player->givenname,0,1)."</span>";
		//write_debug($a_player);
	?>
	<div class="row cgroup-div" style="margin:7px 5px 7px 10px;">
		<div class="pull-left cgroup-pix"><?php echo ($profile_pix)?$profile_pix:$drop_caps; ?></div>
		<div class="pull-left" style="margin-left:5px;padding-top:5px;">
			<div style="font-size:1.3em;font-weight:bold;"><?php echo ucwords(strtolower($a_player->surname)) ;?></div>	
			<?php if($a_player->subgroup){?><span class='cgroup-subgroup'><?php echo $a_player->subgroup;?></span><?php } ?>		
		</div>
		<div class="clearfix"></div>
	</div>
	<?php
	} 
}
$document = JFactory::getDocument();
$document->addScript('components/com_clubreg/assets/js/cgroups.js?'.time());
$document->addStyleSheet('components/com_clubreg/assets/css/cgroups.css?'.time());
ClubregHelper::write_footer(); ?>