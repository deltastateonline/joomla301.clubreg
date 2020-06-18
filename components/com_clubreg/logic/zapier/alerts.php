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

class Alerts extends JObject
{
	public static function mapping($items){
		
		$all_items = array();
		foreach($items as $item){
			$all_items[] = Alert::mapped($item);
		}
		return $all_items;
	}
	

}
/**
	alert_date: "17/06/2020"
	alert_id: "53"
	alert_interval: "yearly"
	alert_key: "grIpTS9DWw"
	alert_notes: "so me noe"
	alert_type: "birthday"
	alert_type_name: "Birthday"
	created: "18/06/2020 20:53:06"
	member_id: "210"
	name: "Super User"
 *
 */
class Alert extends Mapper{	
	protected static $mapping = array(
			"alert_date"=>"alertDate", 
			"alert_interval"=>"interval",			
			"alert_notes"=>"notes",
			"alert_type_name"=>"alertType",				
			"created"=>"created",
			"name"=>"createdBy"
	);	
}