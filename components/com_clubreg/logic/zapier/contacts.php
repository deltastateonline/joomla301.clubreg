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

class Contacts extends JObject
{
	public static function mapping($items){
		
		$all_items = array();
		foreach($items as $item){
			$all_items[] = Contact::mapped($item);
		}
		return $all_items;
	}
	

}
/**
	contactlist_email: "joomla@deltastateonline.com"
	contactlist_fname: "Latifah"
	contactlist_id: "55"
	contactlist_key: "QHrDl5k4z5"
	contactlist_notify: "1"
	contactlist_phoneno: "0413958777"
	contactlist_sname: "queen"
	created: "16/01/2016 19:42:20"
	member_id: "63"
	name: "Super User"
 *
 */
class Contact extends Mapper{	
	protected static $mapping = array(
			"contactlist_email"=>"emailaddress", 
			"contactlist_fname"=>"firstname",			
			"contactlist_phoneno"=>"phoneno",
			"contactlist_sname"=>"lastname",
			"contactlist_notify"=>"canNotify"	,			
			"created"=>"created",
			"name"=>"createdBy",
	);	
	
	public static function mapped($input){		
		$data = parent::mapped($input);
		$data["canNotify"] = $data["canNotify"]?"Yes":"No";		
		return $data;
	}
}