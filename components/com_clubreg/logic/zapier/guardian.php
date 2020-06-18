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
	address: "unit 3 olsen ave"
	approved: "2013-05-04 06:53:21"
	approved_by: "7"
	as_above: "-1"
	ausstate: null
	created: "2013-05-04 06:53:21"
	created_by: "7"
	dob: "1976-09-17"
	emailaddress: "simple@hotmail.com.au"
	eoi_id: "4"
	gender: "male"
	givenname: "Omokhoa"
	group: "14"
	gsurname: "AGBAGBARA omokhoa"
	joining_date: "2013-07-01"
	member_id: "43"
	member_key: "YNs5fB3e3x"
	member_status: "registered"
	memberid: " 983-0293"
	memberlevel: "elite"
	mobile: "04139034333"
	parent_id: "0"
	phoneno: "0413923557"
	playertype: "senior"
	postal_address: null
	postcode: "4209's"
	reg_created_date: "04/05/2013"
	send_news: "1"
	subgroup: "-1"
	suburb: "labrador gold coast"
	surname: "Agbagbara"
	tags: "["5","8"]"
	year_registered: "2017"
 *
 */
class Guardian extends Mapper{	
	protected static $mapping = array(
			"emailaddress"=>"emailaddress", 				
			"gsurname"=>"fullName",			
			"phoneno"=>"phoneno",
			"mobile"=>"mobile",	
			"send_news"=>"sendNews"	,	
			"created"=>"created"
	);	
}