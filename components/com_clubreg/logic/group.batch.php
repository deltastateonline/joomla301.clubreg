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

class GroupBatchUpdate extends JObject
{
	private $batchProperties = array();
	
	public function __construct($batchProperties)
	{
		$this->batchProperties = $batchProperties;
	}
	
	public function processBatchProperties(){
		
		
		if(isset($this->batchProperties["playertype"])){ // player type has been set
		
			$groups_found = array();
			if(isset($this->batchProperties["group"])){ // new group has been chosen
					
				// make sure that the group is a
				$where_['group_type'] = $this->batchProperties["playertype"];
				$where_['group_id'] = $this->batchProperties["group"];
					
				$groups_found = ClubRegGroupHelper::getGroupByFilter($where_);
			}
		
			if(count($groups_found) <= 0){
				unset($this->batchProperties["playertype"]);
				unset($this->batchProperties["group"]);
			}
		}
			
		// subgroup is set but group not set unset subgroup
		if(isset($this->batchProperties["subgroup"]) && empty($this->batchProperties["group"])){
			unset($this->batchProperties["subgroup"]);
		}
			
		//need to make sure that the subgroup is valid
		if(isset($this->batchProperties["group"])){
		
			$sub_groups_array = $where_ = $groups_found = array();
			$where_['group_parent'] = $this->batchProperties["group"];
			$where_['group_id'] = $this->batchProperties["subgroup"];
			
			$groups_found = ClubRegGroupHelper::getGroupByFilter($where_);
			
			if(count($groups_found) <= 0){
				$this->batchProperties["subgroup"] = "-1";
			}			
		}		
		
		return $this->batchProperties;
	}
}