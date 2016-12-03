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

	 if(isset($this->profileConfigs["headings"]["club"])){ ?>		
		<div class="row-fluid frame-div" style="max-width:97%">			
			<div class="h21"><?php echo JText::_('COM_CLUBREG_PROFILE_DIVISION'); ?> :&nbsp;&nbsp;</div>	
			<div class="row-striped">
			<div id="profile-division">
				<?php $profile_details =  $headingConfigs["club"]; 
					foreach($profile_details as $akey => $tvalue){ ?>
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