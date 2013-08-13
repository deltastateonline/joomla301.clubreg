<?php
/*------------------------------------------------------------------------
 # com_clubreg - Manage Club Member Registrations
# ------------------------------------------------------------------------
# author    Omokhoa Agbagbara
# copyright Copyright (C) 2012 applications.deltastateonline.com. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://applications.deltastateonline.com
# Technical Support:  email - joomla@deltastateonline.com
-------------------------------------------------------------------------*/
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
class ClubRegRegmembersConfig extends JObject
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
			$headings = array(); // will have to use some form of ordering
			$headings["idx"] = array("label"=>JText::_('#'),'csvonly'=>TRUE);
			$headings["surname"] = array("label"=>JText::_('COM_CLUBREG_PLAYERNAME_LABEL'),'csvonly'=>TRUE); // set default values
			
			
			$filterConfig =  $this->$method($headings);					
			$headings["t_created_date"] = array("label"=>JText::_('COM_CLUBREG_REGISTERED_LABEL'),'csvonly'=>TRUE);	
			$headings["member_status"] = array("label"=>JText::_('COM_CLUBREG_MEMBERSTATUS_LABEL'),'transform'=>"ucfirst");
			$filterConfig["headings"] = $headings;
			
			$filterConfig["filters"]["t_created_date"] = array("filter_col"=>"a.`created`","control"=>"date.range", "class"=>"span3");
			$filterConfig["filters"]["member_status"] = array("filter_col"=>"a.`member_status`","control"=>"select.genericlist","def"=>"registered", "class"=>"span3");
			
			$filterConfig["otherconfigs"]["checkboxes"] = array("senior","junior"); // show checkbox in these player type 
			$filterConfig["otherconfigs"]["allowedstatus"] = array("registered"); //  show checkbox in this member status
			
		}		
		return $filterConfig;
		
	}
					 
	private function getGuardian(&$headings = array()){
		$entity_filters = $group_where =  array();
		$class_ = "span3";
		$entity_filters["surname"] = array("filter_col"=>array("a.`surname`","a.givenname"), "class"=>$class_);	
		$entity_filters["gaddress"] = array("filter_col"=>array("a.`address`", "a.`suburb`","a.`postcode`"), "class"=>$class_);		
	//	$entity_filters["year_registered"] = array("filter_col"=>"a.`year_registered`","control"=>"select.genericlist");		
		
		$headings["emailaddress"] = array("label"=>JText::_('JGLOBAL_EMAIL'), "clearfix"=>true);
		$headings["t_phone"] = array("label"=>JText::_('COM_CLUBREG_MOBILE'),"sep"=>"/", "clearfix"=>true);
		$headings["t_address"] = array("label"=>JText::_('COM_CLUBREG_ADDRESS'), "clearfix"=>true);			
		$headings["my_children"] = array("label"=>JText::_('COM_CLUBREG_JUNIOR_LABEL'));	
		$headings["send_news"] = array("label"=>JText::_('COM_CLUBREG_SENDNEWS'), "clearfix"=>true, "transform"=>"sendnews"); 
		
		return array("filters"=>$entity_filters, "group_where"=>$group_where);
	}
	
	private function getSenior(&$headings = array()){
		$entity_filters = $group_where =  array();
		$class_ = "span4";
		$entity_filters["surname"] = array("filter_col"=>array("a.`surname`","a.givenname"), "class"=>$class_);
		$entity_filters["address"] = array("filter_col"=>array("a.`address`", "a.`suburb`","a.`postcode`"), "class"=>$class_);		
		$entity_filters["emailaddress"] = array("filter_col"=>"a.`emailaddress`", "class"=>$class_, "clearfix"=>true);
		
		$class_ = "span3";
		$entity_filters["gender"] = array("filter_col"=>"a.`gender`","control"=>"select.genericlist", "class"=>$class_);
		$entity_filters["group"] = array("filter_col"=>"a.`group`","control"=>"select.genericlist", "class"=>$class_);
		$entity_filters["subgroup"] = array("filter_col"=>"a.`subgroup`","control"=>"select.genericlist", "class"=>$class_);		
		$entity_filters["year_registered"] = array("filter_col"=>"a.`year_registered`","control"=>"select.genericlist", "class"=>$class_,"clearfix"=>true);			
		
		$group_where[] = "a.group_type  = 'senior'";		
		if($this->allowed_groups){
			$group_where["groups"] = $this->allowed_groups;
		}
		if(isset($this->allowed_subgroups)){
			$group_where["subgroups"] = $this->allowed_subgroups;
		}
		
		$headings["emailaddress"] = array("label"=>JText::_('JGLOBAL_EMAIL'), "clearfix"=>true);
		$headings["t_phone"] = array("label"=>JText::_('COM_CLUBREG_MOBILE'),"sep"=>" / ", "clearfix"=>true);
		
		
		$headings["t_address"] = array("label"=>JText::_('COM_CLUBREG_ADDRESS'), "clearfix"=>true);
		$headings["group"] = array("label"=>JText::_('COM_CLUBREG_GROUPN_LABEL'));
		$headings["subgroup"] = array("label"=>JText::_('COM_CLUBREG_SUBGROUPN_LABEL'), "clearfix"=>true);
		$headings["joining_date"] = array("label"=>JText::_('COM_CLUBREG_JOINING_LABEL'), 'transform'=>"clubregdate");
		$headings["year_registered"] = array("label"=>JText::_('COM_CLUBREG_SEASON_LABEL') , "clearfix"=>true);
		$headings["gender"] = array("label"=>JText::_('COM_CLUBREG_GENDER_LABEL'),'transform'=>"ucfirst");
		$headings["send_news"] = array("label"=>JText::_('COM_CLUBREG_SENDNEWS'), "transform"=>"sendnews", "clearfix"=>true); 	
		
		return array("filters"=>$entity_filters, "group_where"=>$group_where);
	}
	private function getJunior(&$headings = array()){
		$entity_filters = $group_where =  array();
		$class_ = "span4";
		$entity_filters["surname"] = array("filter_col"=>array("a.`surname`","a.givenname"), "class"=>$class_);
		$entity_filters["gaddress"] = array("filter_col"=>array("d.`address`", "d.`suburb`","d.`postcode`"), "class"=>$class_ );		
		$entity_filters["gender"] = array("filter_col"=>"a.`gender`","control"=>"select.genericlist", "class"=>$class_,"clearfix"=>true);
		
		$class_ = "span2";
		$entity_filters["group"] = array("filter_col"=>"a.`group`","control"=>"select.genericlist", "class"=>$class_);	
		$entity_filters["subgroup"] = array("filter_col"=>"a.`subgroup`","control"=>"select.genericlist", "class"=>$class_);
		$entity_filters["year_registered"] = array("filter_col"=>"a.`year_registered`","control"=>"select.genericlist", "class"=>$class_);			
		
		$group_where[] = "a.group_type  = 'junior'";	

		if(isset($this->allowed_groups)){
			$group_where["groups"] = $this->allowed_groups;
		}
		
		if(isset($this->allowed_subgroups)){
			$group_where["subgroups"] = $this->allowed_subgroups;
		}
			
		$headings["guardian"] = array("label"=>JText::_('COM_CLUBREG_GUARDIAN_LABEL'),'transform'=>"ucwords", "clearfix"=>true); // one line
		$headings["group"] = array("label"=>JText::_('COM_CLUBREG_GROUPN_LABEL'));
		$headings["subgroup"] = array("label"=>JText::_('COM_CLUBREG_SUBGROUPN_LABEL'), "clearfix"=>true); // two per line
		
		$headings["joining_date"] = array("label"=>JText::_('COM_CLUBREG_JOINING_LABEL'), 'transform'=>"clubregdate"); 
		$headings["year_registered"] = array("label"=>JText::_('COM_CLUBREG_SEASON_LABEL'), "clearfix"=>true); // two per line
		
		$headings["gender"] = array("label"=>JText::_('COM_CLUBREG_GENDER_LABEL'),'transform'=>"ucfirst");
		$headings["dob"] = array("label"=>JText::_('COM_CLUBREG_DOB_LABEL'), "clearfix"=>true); // two per line
		
		$headings["t_address"] = array("label"=>JText::_('COM_CLUBREG_ADDRESS'), "cols" => array("gaddress", "gsuburb","gpostcode"));		
		
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