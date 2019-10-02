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
class ClubRegRelationshipsConfig extends JObject
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
	public function getConfig($configType = "relationships"){
		
		$method = 'get'.ucwords($configType);
		$filterConfig = array();		
		if(method_exists($this, $method)){			
			$headings = array(); // will have to use some form of ordering
			$headings["idx"] = array("label"=>JText::_('#'),'csvonly'=>TRUE);			
			$filterConfig =  $this->$method($headings);						
			$filterConfig["headings"] = $headings;			
			$filterConfig["otherconfigs"] = array();
		}		
		return $filterConfig;
		
	}
					 

	
	private function getRelationships(&$headings = array()){
		$entity_filters = $group_where =  array();	
		
	
		$headings["relationship_tag"] = array("label"=>JText::_('COM_CLUBREG_PROFILE_RELATION'),"transform"=>array("ucfirst"));
		
		$headings["emailaddress"] = array("label"=>JText::_('JGLOBAL_EMAIL'), "clearfix"=>true);
		$headings["t_phone"] = array("label"=>JText::_('COM_CLUBREG_MOBILE'),"sep"=>" / ", "clearfix"=>true);
		
		
		$headings["t_address"] = array("label"=>JText::_('COM_CLUBREG_ADDRESS'), "clearfix"=>true);
		
		return array("filters"=>$entity_filters, "group_where"=>$group_where);
	}
}