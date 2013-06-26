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
class ClubRegEoiConfig extends JObject
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
			
			$class_ = isset($filterConfig["class_"])?$filterConfig["class_"]:"span3";			
					
			$filterConfig["filters"]["t_created_date"] = array("filter_col"=>"a.`created`","control"=>"date.range", "class"=>$class_);
			$filterConfig["filters"]["member_status"] = array("filter_col"=>"a.`member_status`","control"=>"select.genericlist","def"=>"eoi", "class"=>$class_);
			
			$filterConfig["otherconfigs"]["checkboxes"] = array("senior","guardian");
			$filterConfig["otherconfigs"]["allowedstatus"] = array("eoi");
			
		}
		
		return $filterConfig;
		
	}
					 
	private function getGuardian(&$headings = array()){
		$class_ = "span4";
		$entity_filters = $group_where =  array();
		$entity_filters["surname"] = array("filter_col"=>array("a.`surname`","a.givenname"), "class"=>$class_);	
		$entity_filters["gaddress"] = array("filter_col"=>array("a.`address`", "a.`suburb`","a.`postcode`"), "class"=>$class_);		
		$entity_filters["year_registered"] = array("filter_col"=>"a.`year_registered`","control"=>"select.genericlist", "class"=>$class_,"clearfix"=>true);		
	
		
		$headings["emailaddress"] = array("label"=>JText::_('JGLOBAL_EMAIL'));
		$headings["t_phone"] = array("label"=>JText::_('COM_CLUBREG_MOBILE'),"sep"=>"/", "clearfix"=>true);
		$headings["t_address"] = array("label"=>JText::_('COM_CLUBREG_ADDRESS'));
		$headings["send_news"] = array("label"=>JText::_('COM_CLUBREG_SENDNEWS'), "clearfix"=>true, "transform"=>"sendnews"); // use array
		
		$headings["my_children"] = array("label"=>JText::_('COM_CLUBREG_JUNIOR_LABEL'));		
		
		$class_ = "span4";
		return array("filters"=>$entity_filters, "group_where"=>$group_where,"class_"=>$class_);
	}
	
	private function getSenior(&$headings = array()){
		$entity_filters = $group_where =  array();
		$class_ = "span4";
		$entity_filters["surname"] = array("filter_col"=>array("a.`surname`","a.givenname"), "class"=>$class_);
		$entity_filters["address"] = array("filter_col"=>array("a.`address`", "a.`suburb`","a.`postcode`"), "class"=>$class_);		
		$entity_filters["emailaddress"] = array("filter_col"=>"a.`emailaddress`", "class"=>$class_,"clearfix"=>true);
		
		$entity_filters["gender"] = array("filter_col"=>"a.`gender`","control"=>"select.genericlist", "class"=>$class_);
		$entity_filters["group"] = array("filter_col"=>"a.`group`","control"=>"select.genericlist", "class"=>$class_);
		$entity_filters["year_registered"] = array("filter_col"=>"a.`year_registered`","control"=>"select.genericlist", "class"=>$class_,"clearfix"=>true);		
		
		
		$group_where[] = "group_type  = 'senior'";		
		
		$headings["emailaddress"] = array("label"=>JText::_('JGLOBAL_EMAIL'));
		$headings["t_phone"] = array("label"=>JText::_('COM_CLUBREG_MOBILE'),"sep"=>" / ", "clearfix"=>true);
		$headings["t_address"] = array("label"=>JText::_('COM_CLUBREG_ADDRESS'), "clearfix"=>true);
		$headings["group"] = array("label"=>JText::_('COM_CLUBREG_GROUPN_LABEL'));
		$headings["gender"] = array("label"=>JText::_('COM_CLUBREG_GENDER_LABEL'),'transform'=>"ucfirst", "clearfix"=>true);
		$headings["send_news"] = array("label"=>JText::_('COM_CLUBREG_SENDNEWS'), "transform"=>"sendnews"); // use array		
		
		return array("filters"=>$entity_filters, "group_where"=>$group_where,"class_"=>$class_);
	}
	private function getJunior(&$headings = array()){
		$entity_filters = $group_where =  array();
		$class_ = "span4";
		$entity_filters["surname"] = array("filter_col"=>array("a.`surname`","a.givenname"), "class"=>$class_);
		$entity_filters["gaddress"] = array("filter_col"=>array("d.`address`", "d.`suburb`","d.`postcode`"), "class"=>$class_);
		$entity_filters["gender"] = array("filter_col"=>"a.`gender`","control"=>"select.genericlist", "class"=>$class_,"clearfix"=>true);
		
		$class_ = "span3";
		$entity_filters["group"] = array("filter_col"=>"a.`group`","control"=>"select.genericlist", "class"=>$class_);	
		
		$entity_filters["year_registered"] = array("filter_col"=>"a.`year_registered`","control"=>"select.genericlist", "class"=>$class_);			
		
		$group_where[] = "group_type  = 'junior'";		
			
		$headings["guardian"] = array("label"=>JText::_('COM_CLUBREG_GUARDIAN_LABEL'),'transform'=>"ucwords");
		$headings["group"] = array("label"=>JText::_('COM_CLUBREG_GROUPN_LABEL'), "clearfix"=>true);
		$headings["gender"] = array("label"=>JText::_('COM_CLUBREG_GENDER_LABEL'),'transform'=>"ucfirst");
		$headings["dob"] = array("label"=>JText::_('COM_CLUBREG_DOB_LABEL'), "clearfix"=>true);
		$headings["t_address"] = array("label"=>JText::_('COM_CLUBREG_ADDRESS'), "cols" => array("gaddress", "gsuburb","gpostcode"));		
		
		return array("filters"=>$entity_filters, "group_where"=>$group_where,"class_"=>$class_);
	}
	
}