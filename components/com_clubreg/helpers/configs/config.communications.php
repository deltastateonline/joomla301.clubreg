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
class ClubRegCommsConfig extends JObject
{
	
	
	public function getConfig($commType){
	
		$method = 'get'.ucwords($commType);
		$filterConfig = array();
		if(method_exists($this, $method)){
			$headings = array(); // will have to use some form of ordering
			$headings["idx"] = array("label"=>JText::_('#'),'csvonly'=>TRUE);
			$headings["template_name"] = array("label"=>JText::_('COM_CLUBREG_COMMS_TEMPLATES'),'csvonly'=>TRUE); // set default values
						
			$filterConfig =  $this->$method($headings);
			$headings["t_created_date"] = array("label"=>JText::_('COM_CLUBREG_REGISTERED_LABEL'),'csvonly'=>TRUE);
			$headings["comm_status"] = array("label"=>JText::_('COM_CLUBREG_COMMSTATUS_LABEL'),'transform'=>"ucfirst");
			$headings["added_groups"] = array("label"=>JText::_('COM_CLUBREG_COMMADDEDGROUPS_LABEL'),'transform'=>"ucfirst");
			$filterConfig["headings"] = $headings;
				
			$filterConfig["filters"]["t_created_date"] = array("filter_col"=>"a.`created`","control"=>"date.range", "class"=>"span3");
			//$filterConfig["filters"]["member_status"] = array("filter_col"=>"a.`member_status`","control"=>"select.genericlist","def"=>"registered", "class"=>"span3");
				
			$filterConfig["otherconfigs"]["checkboxes"] = array("senior","junior"); // show checkbox in these player type
			$filterConfig["otherconfigs"]["allowedstatus"] = array("1"); //  show checkbox in this member status
				
		}
		return $filterConfig;
	
	}
	
	private function getComms(&$headings = array()){
		
		$entity_filters = $group_where = NULL;
		
		$class_ = "span4";
		
		$entity_filters["comm_subject"] = array("filter_col"=>array("a.`comm_subject`", "a.`comm_message`"), "class"=>$class_);
		$entity_filters["comm_status"] = array("filter_col"=>"a.`comm_status`","control"=>"select.genericlist", "class"=>$class_,"clearfix"=>true,"def"=>'0');
		$entity_filters["template_id"] = array("filter_col"=>"a.`template_id`","control"=>"select.genericlist", "class"=>$class_);
		$entity_filters["added_groups"] = array("filter_col"=>"s.`group_id`","control"=>"select.genericlist", "class"=>$class_,"clearfix"=>true);
		
		
		//$headings["added_groups"] = array("label"=>JText::_('COM_CLUBREG_COMMADDEDGROUPS_LABEL'));
		$class_ = "span3";
		//$entity_filters["group"] = array("filter_col"=>"a.`group`","control"=>"select.genericlist", "class"=>$class_);
		//$entity_filters["subgroup"] = array("filter_col"=>"a.`subgroup`","control"=>"select.genericlist", "class"=>$class_);
		if($this->allowed_groups){
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