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

class Relationships extends JObject
{
	public static function mapping($items){
		
		$all_items = array();
		foreach($items as $item){
			$all_items[] = Relationship::mapped($item);
		}
		return $all_items;
	}
	

}
/**
	address: "Crake Place"
	approved: null
	approved_by: null
	as_above: null
	ausstate: null
	created: "18/06/2020 20:20:36"
	created_by: "7"
	dob: "1970-01-01"
	emailaddress: "green.plan@hotmail.com"
	eoi_id: null
	gender: "male"
	givenname: "Green Plan"
	group: "2"
	joining_date: "2015-11-08"
	member_id: "105"
	member_key: "a0PKllFkaZ"
	member_status: "registered"
	memberid: ""
	memberlevel: "amatuer"
	mobile: "0413256998"
	name: "Super User"
	parent_id: "0"
	phoneno: "0413256998"
	playertype: "senior"
	postal_address: null
	postcode: "4509"
	relationship_tag: "spouse|child"
	send_news: null
	subgroup: "11"
	suburb: "mango hill"
	surname: "Fargo"
	tags: null
	year_registered: "2017"
 *
 */
class Relationship extends Mapper{	
	protected static $mapping = array(
			"emailaddress"=>"emailaddress", 
			"givenname"=>"firstname",			
			"surname"=>"surname",
			"phoneno"=>"phoneno",
			"mobile"=>"mobile",
			"relationship_tag"=>"relationship",
			"created"=>"created",
			"name"=>"createdBy"
	);	
}