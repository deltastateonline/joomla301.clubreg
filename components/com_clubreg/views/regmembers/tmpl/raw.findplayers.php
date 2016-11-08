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
global $clubreg_Itemid;
require_once JPATH_COMPONENT.DS.'helpers'.DS.'clubreg.profilethumbs.php';

write_debug($this->items);
require_once JPATH_COMPONENT.DS.'helpers'.DS.'clubreg.profilethumbs.php';

if(count($this->items)> 0){ $i=1;
	 
	$defaultImg = "<img src='".JURI::base().CLUBREG_ASSETS."/images/clublogo32.png' >";
	foreach($this->items as $an_item){ 
		
		$params = JComponentHelper::getParams('com_clubreg');
		$folder_path = $params->get("attachment_folder");
		
		$media_params = JComponentHelper::getParams('com_media');
		$full_media_path = $media_params->get('file_path').DS.$folder_path.DS;
		
		$thumbrenderer = new ClubRegProfileThumbsHelper($full_media_path);	
		
		$fkey = $this->uKeyObject->constructKey($an_item->member_id,$an_item->member_key);
		
		$an_item->t_address = "";$t_phone =  array();
		
		if($an_item->playertype == "junior"){			
			$an_item->address = $an_item->g_address;
			$an_item->suburb = $an_item->g_suburb;
			$an_item->postcode = $an_item->g_postcode;
		}
		
		if($an_item->address){
			$an_item->t_address = ucwords($an_item->address)."<br />";
		}
		if($an_item->suburb || $an_item->postcode){
			$an_item->t_address = $an_item->t_address.ucwords($an_item->suburb)." ";
		}
		if($an_item->postcode){
			$an_item->t_address = $an_item->t_address.$an_item->postcode;
		}
		if($an_item->phoneno && $an_item->phoneno != "-1"){
			$t_phone[] = $an_item->phoneno;
		}
		if($an_item->mobile && $an_item->mobile != "-1"){
			$t_phone[] = $an_item->mobile;
		}
		$an_item->t_phone = $t_phone ;
		
		$profile_pix = $thumbrenderer->renderMemberThumb($an_item->member_id,FALSE,FALSE);	
			
	
	}
}else{	
	echo ClubRegUnAuthHelper::noResults(); 
}