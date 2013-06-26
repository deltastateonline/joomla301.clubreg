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

$member_data = $this->member_data;
/** some preprocessing*/
$member_data->t_address = "";$t_phone =  array();
if($member_data->address){
	$member_data->t_address = ucwords($member_data->address)."<br />";
}
if($member_data->suburb || $member_data->postcode){
	$member_data->t_address = $member_data->t_address.ucwords($member_data->suburb)." ";
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

$itemRenderer = $this->itemRenderer;
?>
	<div class="row-striped ">
	
		<?php foreach($headingConfigs["bio"] as $akey => $tvalue){ ?>
			<div class=row-fluid >
				<div class="pull-left profile-bold reg-label "><?php echo $tvalue["label"]; ?></div>
				<div class="pull-left reg-colon"> :&nbsp;&nbsp;</div>
				<div class="pull-left reg-value"><?php echo $itemRenderer->render($member_data->$akey,$tvalue); ?></div>
				
			</div>		
		<?php } ?>
	</div>
