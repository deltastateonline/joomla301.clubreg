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


/**
	address: "26 laa Street"
	app_created_by: null
	approved: null
	approved_by: null
	as_above: null
	ausstate: null
	created: "2020-06-17 21:11:35"
	created_by: "7"
	dob: "06/07/2020"
	emailaddress: "kekeominu@yahoo.co.uk"
	eoi_id: null
	gender: "male"
	givenname: "Omokhoa"
	group: "2"
	groupleader: "Jimmy"
	groupofficial: null
	guardian: null
	joining_date: "2020-06-17"
	member_id: "210"
	member_key: "h9ujbitlA1"
	member_level: "Amatuer"
	member_status: "registered"
	memberid: "wwee"
	memberlevel: "amatuer"
	mobile: "0413923557"
	parent_id: "0"
	phoneno: ""
	playertype: "senior"
	postal_address: null
	postcode: "4503"
	reg_created_by: "Super User"
	reg_created_date: "17/06/2020"
	reg_group: "Over 35s"
	reg_subgroup: "First Reserve"
	send_news: null
	subgroup: "12"
	suburb: "Kallangur"
	surname: "AGBAGBARA omokhoa"
	tags: "["3"]"
	year_registered: "2020"
 *
 */
class MemberDetails extends Mapper{	
	protected static $mapping = array(
			"emailaddress"=>"emailaddress", 				
			"surname"=>"fullName",			
			"reg_group"=>"group",			
			"reg_subgroup"=>"subgroup",				
			"member_level"=>"memberLevel",
			"joining_date"=>"joiningDate",
			"gender"=>"gender",
			"phoneno"=>"phoneno",
			"send_news"=>"sendNews"	,
			"mobile"=>"mobile",			
			"created"=>"created",
			"reg_created_by"=>"createdBy"
	);	
	
	public static function mapped($input){
		$data = parent::mapped($input);
		$data["sendNews"] = $data["sendNews"]?"Yes":"No";
		return $data;
	}
}