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
class ClubRegRegmembersCsvConfig extends JObject
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
				
			$headingConfig = $this->$method($headings);					
			$headings["t_created_date"] = array("label"=>JText::_('COM_CLUBREG_REGISTERED_LABEL'),'csvonly'=>TRUE);	
			$headings["member_status"] = array("label"=>JText::_('COM_CLUBREG_MEMBERSTATUS_LABEL'),'transform'=>"ucfirst");
			
			$filterConfig["headings"] = $headings;					
		}		
		return $filterConfig;
		
	}
					 
	private function getGuardian(&$headings = array()){
				
		
		$headings["emailaddress"] = array("label"=>JText::_('JGLOBAL_EMAIL'), "clearfix"=>true);
		$headings["t_phone"] = array("label"=>JText::_('COM_CLUBREG_MOBILE'),"sep"=>"/", "clearfix"=>true);		
		$headings["t_address"] = array("label"=>JText::_('COM_CLUBREG_ADDRESS'), "clearfix"=>true);		
		$headings["postal_address"] = array("label"=>JText::_('COM_CLUBREG_POSTAL_ADDRESS'), "clearfix"=>true);
		$headings["my_children"] = array("label"=>JText::_('COM_CLUBREG_JUNIOR_LABEL'));		
		$headings["send_news"] = array("label"=>JText::_('COM_CLUBREG_SENDNEWS'), "clearfix"=>true, "transform"=>"sendnews"); 
		
		return TRUE;
	}
	
	private function getSenior(&$headings = array()){
		
		
		
		$headings["emailaddress"] = array("label"=>JText::_('JGLOBAL_EMAIL'), "clearfix"=>true);		
		$headings["t_phone"] = array("label"=>JText::_('COM_CLUBREG_MOBILE'),"sep"=>" / ", "clearfix"=>true);		
		$headings["t_address"] = array("label"=>JText::_('COM_CLUBREG_ADDRESS'), "clearfix"=>true);	
		$headings["postal_address"] = array("label"=>JText::_('COM_CLUBREG_POSTAL_ADDRESS'), "clearfix"=>true);
		$headings["group"] = array("label"=>JText::_('COM_CLUBREG_GROUPN_LABEL'));
		$headings["subgroup"] = array("label"=>JText::_('COM_CLUBREG_SUBGROUPN_LABEL'), "clearfix"=>true);		
		$headings["joining_date"] = array("label"=>JText::_('COM_CLUBREG_JOINING_LABEL'), 'transform'=>"clubregdate");
		$headings["year_registered"] = array("label"=>JText::_('COM_CLUBREG_SEASON_LABEL') , "clearfix"=>true);
		
		$headings["gender"] = array("label"=>JText::_('COM_CLUBREG_GENDER_LABEL'),'transform'=>"ucfirst");
		$headings["memberlevel"] = array("label"=>JText::_('COM_CLUBREG_SKILLLEVEL_LABEL'),'transform'=>"ucfirst", "clearfix"=>true);		
		$headings["send_news"] = array("label"=>JText::_('COM_CLUBREG_SENDNEWS'), "transform"=>"sendnews");		
		$headings["member_status"] = array("label"=>JText::_('COM_CLUBREG_MEMBERSTATUS_LABEL'),'transform'=>"ucfirst");
		
		return TRUE;
	}
	private function getJunior(&$headings = array()){
		
		
		$headings["guardian"] = array("label"=>JText::_('COM_CLUBREG_GUARDIAN_LABEL'),'transform'=>"ucwords", "clearfix"=>true); // one line		
		$headings["t_address"] = array("label"=>JText::_('COM_CLUBREG_ADDRESS'), "cols" => array("gaddress", "gsuburb","gausstate","gpostcode"), "clearfix"=>true);
		
		$headings["postal_address"] = array("label"=>JText::_('COM_CLUBREG_POSTAL_ADDRESS'), "clearfix"=>true );
		
		
		$headings["group"] = array("label"=>JText::_('COM_CLUBREG_GROUPN_LABEL'));
		$headings["subgroup"] = array("label"=>JText::_('COM_CLUBREG_SUBGROUPN_LABEL'), "clearfix"=>true); // two per line		
		
		$headings["joining_date"] = array("label"=>JText::_('COM_CLUBREG_JOINING_LABEL'), 'transform'=>"clubregdate"); 
		$headings["year_registered"] = array("label"=>JText::_('COM_CLUBREG_SEASON_LABEL'), "clearfix"=>true); // two per line
		
		$headings["memberlevel"] = array("label"=>JText::_('COM_CLUBREG_SKILLLEVEL_LABEL'),'transform'=>array("ucfirst","removeUnderscore"));		
		$headings["gender"] = array("label"=>JText::_('COM_CLUBREG_GENDER_LABEL'),'transform'=>"ucfirst");
		
		$headings["dob"] = array("label"=>JText::_('COM_CLUBREG_DOB_LABEL'), "clearfix"=>true); // two per line		
		
		
		
		return TRUE;
	}
	
}