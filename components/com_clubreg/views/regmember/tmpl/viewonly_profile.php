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
$headingConfigs = $this->profileConfigs["headings"]; 
	  $itemRenderer = $this->itemRenderer;
	  
	  $member_data = $this->all_data["member_data"];  
	  
	  /** some preprocessing*/
	  $member_data->t_address = "";$t_phone =  array();
	  if($member_data->address){
	  	$member_data->t_address = ucwords($member_data->address)."<br />";
	  }
	  if($member_data->suburb || $member_data->postcode){
	  	$member_data->t_address = $member_data->t_address.ucwords($member_data->suburb)." ";
	  }
	 
	  if($member_data->ausstate){
	  	$member_data->t_address = $member_data->t_address.$member_data->ausstate." ";
	  }	  
	  if($member_data->postcode){
	  	$member_data->t_address = $member_data->t_address.$member_data->postcode;
	  }
	  
	  if($member_data->phoneno){
	  	$t_phone[] = $member_data->phoneno;
	  }
	  if($member_data->mobile){
	  	$t_phone[] = $member_data->mobile;
	  }
	  $member_data->t_phone = $t_phone ;
	  /** some preprocessing*/	  

	 if(isset($this->profileConfigs["headings"]["club"])){ ?>		
		<div class="row-fluid frame-div" style="max-width:97%">
			
			<div class="h21"><?php echo JText::_('COM_CLUBREG_PROFILE_DIVISION'); ?> :&nbsp;&nbsp;
				<a class="btn btn-mini profile-div-button pull-right" rel='<?php echo $member_data->member_id; ?>' href="javascript:void(0);">-</a><br />
			 	
			 </div>	
			<div class="row-striped">
			<div id="profile-division">
				<?php $profile_details =  $headingConfigs["club"]; 
					foreach($profile_details as $akey => $tvalue){ 					
					?>
					<div class="row-fluid">
						<div class="pull-left profile-label"><?php echo $tvalue["label"]?></div>
						<div class="pull-left profile-colon"> :&nbsp;&nbsp;</div>
						<div class="pull-left profile-value"><?php echo $itemRenderer->render($member_data->$akey,$tvalue); ?></div>
					</div>
				<?php }?>
				</div>
			</div>	
		</div>
		<?php }else{ ?>
			No Details
		<?php } ?>