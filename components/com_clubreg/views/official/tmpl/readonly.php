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

global $clubreg_Itemid;
$rel_string = array("Itemid"=>$clubreg_Itemid);


?>
<div class="profile <?php echo $this->pageclass_sfx?>">
<?php 
$renderTab["group"] = $renderTab["dashboard"] = FALSE;
if($this->canedit){
	$renderTab["dashboard"] = TRUE;
?>
<div class="btn-group pull-right" >
<button class="btn"><?php echo JText::_('CLUBREG_OFFICIALS_PROFILE_LINKS'); ?></button>
	<button class="btn dropdown-toggle" data-toggle="dropdown">
    	<span class="caret"></span>
	</button>
	<ul class="dropdown-menu">
		<li><a href="<?php echo JRoute::_('index.php?option=com_clubreg&task=official.edit&user_id='.(int) $this->member_id);?>">
				<span class="icon-user"></span><?php echo JText::_('CLUBREG_EDIT_PROFILE'); ?></a>
		</li>
		<?php //ClubRegButtonsHelper::writeButtons($this->member_id) ?>
	</ul>
</div>
<div class="clearfix"></div>
<?php } 
	/*
	 * 
	 * class="btn-toolbar pull-right"
	 * */
	$myGroups = $this->official_details->group_member; // group_name
	$myLeaders = $this->official_details->group_leader;
	if(count($myGroups) > 0 || count($myLeaders)> 0){ $renderTab["group"] = TRUE; }
?>
<fieldset id="users-profile-core">
	<legend>
		<?php echo JText::_('CLUBREG_OFFICIALS_PROFILE_DESC'), " - ",$this->official_details->official_name; ?>
	</legend>
	
	<div class="tabbable tabs-top">
		<ul class="nav nav-tabs">
			<li class="active"><a href="#tabDetails" data-toggle="tab"><?php echo JText::_('CLUBREG_OFFICIALS_PROFILE_DETAILS') ?></a></li>
			<?php  if($renderTab["group"]){ ?><li><a href="#tabGroups" data-toggle="tab"><?php echo JText::_('CLUBREG_OFFICIALS_PROFILE_GROUP') ?></a></li><?php } ?>
			<?php  if($renderTab["dashboard"]){ ?><li><a href="#tabDashboard" data-toggle="tab"><?php echo JText::_('CLUBREG_OFFICIALS_PROFILE_DASHBOARD') ?></a></li><?php } ?>
			
		</ul>
	<div class="tab-content">
		
		<?php 
		
		
		$joomla_details = $this->official_details->extraDetails;
	if(count($this->extradetails) > 0){	?>
		<div class="tab-pane active" id="tabDetails">
			<dl class="dl-horizontal">
			<?php 
			foreach($this->extradetails as $a_detail){ 	$a_detail->config_short;?>
				<dt>
					<?php echo $a_detail->config_name; ?> :
				</dt>
				<dd class="well well-small">
					<?php 
					$registry = new JRegistry($a_detail->params);
					$paramArray = $registry->toArray();
			
					$ControlRender = new ClubRegControlsReadonlyHelper($paramArray);
					$ControlRender->set('configData', $a_detail) ;
					
					if(isset($joomla_details[$a_detail->config_short])){ 				
						$ControlRender->set('memberDetails',$joomla_details[$a_detail->config_short]);							
					}
					$ControlRender->render($paramArray);
					?>
				</dd>		
				<?php 
				unset($registry);unset($ControlRender);unset($paramArray);
			}?>
		<?php ?>
			</dl>
		</div>
<?php 	} if($renderTab["group"]){  ?>
			<div class="tab-pane" id="tabGroups">
			<?php if(count($myLeaders) > 0 ){ ?>
				<div class="alert alert-info"><img alt="" src="components/com_clubreg/assets/images/groups.png" align=middle hspace=3 width=24><strong><?php echo JText::_('CLUBREG_OFFICIALS_PROFILE_LEADER'); ?></strong></div>
					<div class="well well-large">
						<ol>
						<?php foreach($myLeaders as $aGroup){?>
							<li><?php echo $aGroup->group_name ?></li>
						<?php } ?>
						</ol>
					</div>
			<?php }?>
			<?php if(count($myGroups) > 0 ){ ?>
				<div class="alert alert-info"><img alt="" src="components/com_clubreg/assets/images/groups.png" align=middle hspace=3 width=24><strong><?php echo JText::_('CLUBREG_OFFICIALS_PROFILE_MEMBER'); ?></strong></div>
					<div class="well well-large">
						<ol>
						<?php foreach($myGroups as $aGroup){?>
							<li><?php echo $aGroup->group_name ?></li>
						<?php } ?>
						</ol>
					</div>
			<?php }?>
			</div>
		<?php } // render group tab 
		if($renderTab["dashboard"]){  ?>
			<div class="tab-pane" id="tabDashboard">
				<div class="alert alert-info"><img alt="" src="components/com_clubreg/assets/images/groups.png" align=middle hspace=3 width=24><strong><?php echo JText::_('CLUBREG_OFFICIALS_PROFILE_EOI'); ?></strong></div>
				<div class="loading1" id="profileEoi" rel=<?php echo json_encode($rel_string)?>></div>				
				
				<div class="alert alert-info"><img alt="" src="components/com_clubreg/assets/images/groups.png" align=middle hspace=3 width=24><strong><?php echo JText::_('CLUBREG_OFFICIALS_PROFILE_ACTIVITY'); ?></strong></div>
				<div class="loading1" id="profileActivity" rel=<?php echo json_encode($rel_string)?>></div>
				
			</div>
		<?php }  ?>
	</div>
</div>
</fieldset>
</div>
<?php 
$document = JFactory::getDocument();
//$document->addStyleSheet(CLUBREG_ASSETS.'/css/common.css?'.time());
ClubregHelper::writeTabAssets($document, "common",array("css"));
ClubregHelper::writeTabAssets($document, "official");
ClubregHelper::write_footer(); ?>