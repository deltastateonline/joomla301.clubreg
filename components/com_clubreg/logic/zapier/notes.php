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

class Notes extends JObject
{
	public static function mapping($items){		
		$all_items = array();
		foreach($items as $item){
			$all_items[] = Note::mapped($item);
		}
		return $all_items;
	}
	

}
/**
	[note_key] => 6EBE3DC199B34CAE8988C08ED4799198
    [primary_id] => 210
    [notes] => private note
    [note_status] => 1
    [note_type] => member
    [created] => 18/06/2020 20:22:18
    [name] => Super User
 *
 */
class Note extends Mapper{	
	protected static $mapping = array("note_key"=>"noteKey", "name"=>"createdBy", "notes"=>"note","created"=>"created");	
}