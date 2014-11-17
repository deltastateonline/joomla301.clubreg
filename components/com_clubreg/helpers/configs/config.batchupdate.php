<?php
/*------------------------------------------------------------------------
 # com_clubreg - Manage Club Member Registrations
# ------------------------------------------------------------------------
# author    Omokhoa Agbagbara
# copyright Copyright (C) 2014 app.deltastateonline.com. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://app.deltastateonline.com
# Technical Support:  email - joomla@deltastateonline.com
-------------------------------------------------------------------------*/
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
class ClubRegRegmembersBatchConfig extends JObject
{
	/**
	 * @desc
	 * 		array index for the headings array
	 * 				label     => Label to render
	 * 				csvonly	  => Render this label in csv file only
	 * 				transform => apply a simple string function to the values
	 * 				cols 	  =>
	 * @param string $playerType
	 */
	public function getConfig($playerType){
		
		$method = 'get'.ucwords($playerType);
		$filterConfig = array();		
		if(method_exists($this, $method)){			
			$filterConfig =  $this->$method($headings);			
		}		
		return $filterConfig;
		
	}
					 
	private function getGuardian(&$headings = array()){		
		return array("filters"=>array(), "group_where"=>array());
	}
	
	private function getSenior(&$headings = array()){
		$entity_filters = $group_where =  array();	
		
		$class_ = "span4";
		$entity_filters["gender"] = array("filter_col"=>"a.`gender`","control"=>"select.genericlist", "class"=>$class_);
		$entity_filters["group"] = array("filter_col"=>"a.`group`","control"=>"select.genericlist", "class"=>$class_);
		$entity_filters["subgroup"] = array("filter_col"=>"a.`subgroup`","control"=>"select.genericlist", "class"=>$class_, "clearfix"=>true);		
		
		$class_ = "span4";
		$entity_filters["year_registered"] = array("filter_col"=>"a.`year_registered`","control"=>"select.genericlist", "class"=>$class_);			
		$entity_filters["memberlevel"] = array("filter_col"=>"a.`memberlevel`","control"=>"select.genericlist", "class"=>$class_);
		
		$group_where[] = "a.group_type  = 'senior'";		
		if($this->allowed_groups){
			$group_where["groups"] = $this->allowed_groups;
		}
		if(isset($this->allowed_subgroups)){
			$group_where["subgroups"] = $this->allowed_subgroups;
		}
		
		
		return array("filters"=>$entity_filters, "group_where"=>$group_where);
	}
	private function getJunior(&$headings = array()){
		$entity_filters = $group_where =  array();
		
		$class_ = "span4";
		$entity_filters["playertype"] = array("filter_col"=>"a.`playertype`","control"=>"select.genericlist", "class"=>$class_);						
		$entity_filters["group"] = array("filter_col"=>"a.`group`","control"=>"select.genericlist", "class"=>$class_);	
		$entity_filters["subgroup"] = array("filter_col"=>"a.`subgroup`","control"=>"select.genericlist", "class"=>$class_ ,"clearfix"=>true);
		
		$class_ = "span4";
		$entity_filters["memberlevel"] = array("filter_col"=>"a.`memberlevel`","control"=>"select.genericlist", "class"=>$class_);
		$entity_filters["gender"] = array("filter_col"=>"a.`gender`","control"=>"select.genericlist", "class"=>$class_ );
		
		$group_where[] = "a.group_type  = 'junior'";	

		if(isset($this->allowed_groups)){
			$group_where["groups"] = $this->allowed_groups;
		}
		
		if(isset($this->allowed_subgroups)){
			$group_where["subgroups"] = $this->allowed_subgroups;
		}
			
			
		return array("filters"=>$entity_filters, "group_where"=>$group_where);
	}
	/**
	 * 
	 * @param unknown_type $allowed_groups
	 */
	public function setOfficialGroups($allowed_groups){	
		
		if(count($allowed_groups) > 0){
			$this->allowed_groups = sprintf(" a.group_id in (%s)",implode(",",$allowed_groups )); // for filters			
		}
		
	}
	
	public function setOfficialSubGroups($allowed_groups){		
		if(count($allowed_groups) > 0){
			$this->allowed_subgroups = sprintf(" a.group_id in (%s)",implode(",",$allowed_groups )); // for filters
		}	
	}	
}