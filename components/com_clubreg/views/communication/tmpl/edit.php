<?php
/*------------------------------------------------------------------------
# com_clubreg - Manage Club Member Registrations
# ------------------------------------------------------------------------
# author    Omokhoa Agbagbara
# copyright Copyright (C) 2014 applications.deltastateonline.com. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://applications.deltastateonline.com
# Technical Support:  email - joomla@deltastateonline.com
-------------------------------------------------------------------------*/

defined( '_JEXEC' ) or die( 'Restricted access' );
JHtml::_('behavior.formvalidation');
global $clubreg_Itemid;
ClubregHelper::writePageHeader(JText::_('COM_CLUBREG_COMM_DETAILS')."- (".$this->comm_title.")");
$in_type = "hidden";
$session = JFactory::getSession();
$back_url = $session->get("com_clubreg.comms.back_url");// save the back url
?>
<style>
<!--
.form-horizontal .control-group {
    margin-bottom: 10px;
    padding-left:5px;
   
}
-->
</style>
<div class="clugreg-div">
<form action="index.php" method="post" name="CommForm" id="comm-form" class="form-validate">	
<div class="tab-divs">		
		<div class="control-group">	
			<div class="control-label">
				<div class='pull-left'><a class='btn btn-mini btn-info sendto-show-groups' title="Add Groups" rel='0'>+</a>&nbsp;&nbsp;</div><div class='pull-left'><?php echo $this->communicationForm->getLabel('comm_sendto'); ?></div>
				<button type="button" class="btn btn-mini pull-right" onclick="return adminForm_back_list.submit();"><?php echo JText::_('COM_CLUBREG_BACK_LIST'); ?></button>
				<?php if(!empty($this->comm_id) && $this->comm_id > 0 ){ ?>&nbsp;
					<button type="submit" id="btSendMsg" class="btn btn-primary btn-mini validate pull-right" style="margin-right:5px;">
						<i class="icon-envelope"></i>
							<span><?php echo JText::_('COM_CLUBREG_COMM_SAVESEND'); ?></span>
					 </button>&nbsp;
				<?php } ?>
				
				<div class='clearfix'></div>
			</div>			
			<div class="controls"><?php echo $this->communicationForm->getInput('comm_sendto'); ?></div>			
		</div>
		<div class="control-group sendto-hide-groups">				
			<div class="control-label"><span style="font-size: 1.1em;font-weight:bold" class="hasTooltip" data-original-title="<strong><?php echo JText::_('COM_CLUBREG_COMM_SENDTO_GROUP')?></strong><br /><?php echo JText::_('COM_CLUBREG_COMM_SENDTO_GROUP_DESC')?>">My Groups</span></div>
			<div style="margin-bottom:3px;" class="sendto-groupbtns">&nbsp;	
			<?php foreach($this->allowedGroups["group_leader"] as $a_group){
					if(!in_array($a_group->group_id, $this->selectedGroups)){?>
					<a class="btn btn-mini" title="click to add" data-groupid='<?php echo $a_group->group_id ;?>'><?php echo $a_group->group_name ;?></a>
			<?php }
			} 
			if(count($this->allowedGroups["sub_groups"])){?>			
			<?php foreach($this->allowedGroups["sub_groups"] as $a_group){
					if(!in_array($a_group->group_id, $this->selectedGroups)){?>
					<a class="btn btn-mini" data-groupid='<?php echo $a_group->group_id ;?>'><?php echo $a_group->group_name ;?></a>
				<?php } 
					}?>
			</div>
			<?php }?>	
		</div>
		<?php foreach($this->communicationForm->getFieldset('communication') as $field){ ?>
			<div class="control-group">					
				<div class="control-label"><?php echo $field->label; ?></div>
				<div class="controls"><?php echo $field->input; ?></div>						
			</div>		
		<?php 		 				
		 }	
		 
		 $comm_type = $this->communicationForm->getValue('comm_type');
		 foreach($this->communicationForm->getFieldset('communication_type') as $field){ 
		 		$show_only = $field->getAttribute('showonly');
		 		
		 		if($show_only == $comm_type){
		 	?>
		 			<div class="control-group">					
		 				<div class="control-label"><?php echo $field->label; ?><?php echo $field->showonly?></div>
		 				<div class="controls"><?php echo $field->input; ?></div>						
		 			</div>		 			
		 		<?php 	
		 		}	 				
		 	}		
		 		 
		 foreach($this->communicationForm->getFieldset('hiddenControls') as $field){ 	
					echo $field->input; 				
		 }		
		 ?>
	<input type="<?php echo $in_type;?>" name="Itemid" value="<?php echo $clubreg_Itemid; ?>" />
	<input type="<?php echo $in_type;?>" name="option" value="com_clubreg" />
	<input type="<?php echo $in_type;?>" name="task" id="clubregTask" value="communication.save" />
	
	
	
	<?php echo JHtml::_('form.token'); ?>		
	<div class="clearfix" ></div>	
		<div class="form-actions">			 
			<button type="submit" class="btn btn-primary validate"><span><?php echo JText::_('COM_CLUBREG_COMM_SAVE'); ?></span></button>			
			<button type="button" class="btn" onclick="return adminForm_back_list.submit();" ><?php echo JText::_('COM_CLUBREG_BACK_LIST'); ?></button>	
			<?php if(!empty($this->comm_id) && $this->comm_id > 0 ){ ?>				
			<button type="submit" class="btn pull-right"><span><?php echo JText::_('COM_CLUBREG_COMM_PREVIEW'); ?></span></button>
			<?php } ?>
		</div>
</div>			
</form>
		<form action="<?php echo JRoute::_($this->formbackaction); ?>" method="post" name="adminForm_back_list" id="adminForm_back_list">			
			<?php if(count($back_url) > 0){
					foreach($back_url as $akey=>$avalue){ ?>
						<input type="<?php echo $in_type; ?>" name="<?php echo $akey?>" value="<?php echo $avalue; ?>" />	
				<?php }
			} ?>
			<input type="<?php echo $in_type; ?>" name="Itemid" value="<?php echo $clubreg_Itemid; ?>" />	
			<input type="<?php echo $in_type; ?>" name="option" value="com_clubreg" />
			<input type="<?php echo $in_type; ?>" name="view" value="communications" />
			<input type="<?php echo $in_type; ?>" name="layout" value="communications" />
		</form>	

</div>
<?php 

$document = JFactory::getDocument();
ClubregHelper::writeTabAssets($document, "common",array("css","js"));
ClubregHelper::writeTabAssets($document, "communication",array("js","css"));
ClubregHelper::writeTabAssets($document, "edit",array("css"));

ClubregHelper::write_footer(); 
 ?>