<?php
/*------------------------------------------------------------------------
# com_clubreg - Manage Club Member Registrations
# ------------------------------------------------------------------------
# author    Omokhoa Agbagbara
# copyright Copyright (C) 2013 applications.deltastateonline.com. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://applications.deltastateonline.com
# Technical Support:  email - joomla@deltastateonline.com
-------------------------------------------------------------------------*/

defined('_JEXEC') or die;


class ClubRegGroupHelper extends JObject
{
	
	public static function getGroupList($where_ = array(),$order_by = NULL){
	
		$options = array();
	
		$db		= JFactory::getDBO();
	
		$where_[] = "published = 1";		
		
		if(empty($order_by)){
			$order_by = ' ORDER BY group_name asc ';
		}
	
		// Build the query for the ordering list.
		$query = 'SELECT *  FROM '.CLUB_GROUPS_TABLE.
				sprintf(" WHERE %s ",implode(" and ",$where_ )) .$order_by ;
	
		$db->setQuery($query);
		
		try {
			$options = $db->loadObjectList();
		} catch (RuntimeException $e) {
			JError::raiseWarning(500, $e->getMessage());
			$options = array();
		}
	
		return $options;
	}
	
	public static function getGroupByPlayerType($playerType = FALSE){
		
		$where_ = array();
		$db		= JFactory::getDBO();
		
		if(empty($playerType)){
			return array();
		}
		$where_[] = sprintf(" group_type = %s",$db->quote($playerType));
		$options = self::getGroupList($where_);
		
	}
	
	public static function getGroupByGroupId($group_id = false){
	
		$where_ = array();
		$db		= JFactory::getDBO();
	
		if(empty($group_id)){
			return array();
		}
		
		if(!is_array($group_id)){
			$group_ids[] = $group_id;
		}else{
			$group_ids = $group_id;
		}
		
		$where_[] = sprintf("group_id in (%s)",implode(",",$group_ids));		
		$options = self::getGroupList($where_);
	
	}
	
	public static function getGroupByFilter($where_clause = false){
		
		$where_ = array();
		$db		= JFactory::getDBO();
		
		foreach($where_clause as $a_where => $where_value){
			
			if(is_array($where_value)){
				$where_[] = sprintf(" %s in (%s)",$a_where, implode(",",$group_ids));
			}else{
				$where_[] = sprintf(" %s = %s",$a_where, $db->quote($where_value));
			}
		}
		
		return self::getGroupList($where_);
		
	}
	
}