<?php
/*------------------------------------------------------------------------
# com_clubreg - Manage Club Member Registrations
# ------------------------------------------------------------------------
# author    Omokhoa Agbagbara
# copyright Copyright (C) 2020 applications.deltastateonline.com. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://app.deltastateonline.com
# Technical Support:  email - joomla@deltastateonline.com
-------------------------------------------------------------------------*/
defined('_JEXEC') or die;

class Attachments extends JObject
{
	public static function mapping($items){
		
		$all_items = array();
		foreach($items as $item){
			$all_items[] = Attachment::mapped($item);
		}
		return $all_items;
	}
	

}
/**
	attachment_access_level: null
	attachment_file_type: "application/pdf"
	attachment_fname: "BA Email Handler.pdf"
	attachment_id: "92"
	attachment_key: "jmWeJ6pMvb"
	attachment_location: "images\clubreg\mber_210\"
	attachment_notes: ""
	attachment_parameter_type: null
	attachment_savedfname: "1592475711BA Email Handler.pdf"
	attachment_status: "1"
	attachment_type: "hold_hamless"
	attachment_type_name: "Hold Hamless"
	created: "18/06/2020 20:21:51"
	created_by: "7"
	link_type: "member"
	name: "Super User"
	params: null
	primary_id: "210"
 *
 */
class Attachment extends Mapper{	
	protected static $mapping = array(
			"attachment_file_type"=>"attachmentFileType", 
			"attachment_fname"=>"attachmentFname", 
			"attachment_location"=>"attachmentLocation",
			"attachment_savedfname"=>"attachmentSavedfname",
			"attachment_type_name"=>"attachmentType",			
			"created"=>"created",
			"name"=>"createdBy"
	);	
}