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

class ClubRegProfileThumbsHelper extends JObject
{
	private $_thumb_path ;
	
	function __construct($thumb_path){		
		$this->_thumb_path = $thumb_path;		
	}
	
	public function renderMemberThumb($member_id){
		
		$media_path = sprintf("%smber_%s%s",$this->_thumb_path,$member_id,DS);
		$file_path = JPATH_ROOT.DS.$media_path."th".DS."profile.jpg";
		$file_path1 = JPATH_ROOT.DS.$media_path."th".DS."profile.gif";
		$ffound = FALSE;
		
		$image_url = "";
		if(file_exists($file_path)){
			$file_path = str_replace(JPATH_ROOT, "", $file_path);
			$image_url = str_replace("\\", "/", $file_path );
			$ffound = TRUE;
		}
		
		if(file_exists($file_path1)){
			$file_path1 = str_replace(JPATH_ROOT, "", $file_path1);
			$image_url = str_replace("\\", "/", $file_path1 );
			$ffound = TRUE;
		}
		
		$alt = "width='48' hspace='2' ";
		
		if($ffound){
			return JHtml::image(JURI::base().$image_url, "profile",$alt);					  		
		 }
	} 
}