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

class Payments extends JObject
{
	public static function mapping($items){
		
		$all_items = array();
		foreach($items as $item){
			$all_items[] = Payment::mapped($item);
		}
		return $all_items;
	}
	

}
/**
	created: "18/06/2020 20:19:23"
	member_id: "210"
	name: "Super User"
	payment_amount: "12300"
	payment_date: "2020-06-18"
	payment_desc: "Registration Fees"
	payment_id: "90"
	payment_key: "P0hfkGgW4c"
	payment_method: "Cash Payment"
	payment_notes: "some notes"
	payment_season: "2020"
	payment_status: "Cancelled"
	payment_transact_no: "123"
 *
 */
class Payment extends Mapper{	
	protected static $mapping = array(
			"payment_amount"=>"amount", 
			"payment_date"=>"paymentDate", 
			"payment_desc"=>"description",
			"payment_notes"=>"notes",
			"payment_season"=>"season",
			"payment_status"=>"paymentStatus",
			"payment_transact_no"=>"transactionNumber",		
			"created"=>"created",
			"name"=>"createdBy"
	);	
}