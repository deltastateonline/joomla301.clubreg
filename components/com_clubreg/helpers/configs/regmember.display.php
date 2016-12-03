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
class ClubRegRegmembersDisplayConfig extends JObject
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
				
			$headingConfig = $this->$method($headings);					
			$headings[$headingConfig[lastIndex]]["t_created_date"] = array("label"=>JText::_('COM_CLUBREG_REGISTERED_LABEL'),'csvonly'=>TRUE);	
			
			$filterConfig["headings"] = $headings;					
		}		
		return $filterConfig;
		
	}
					 
	private function getGuardian(&$headings = array()){
				
		$i= 0;
		$headings[$i]["emailaddress"] = array("label"=>JText::_('JGLOBAL_EMAIL'), "clearfix"=>true);
		$headings[$i]["t_phone"] = array("label"=>JText::_('COM_CLUBREG_MOBILE'),"sep"=>"/", "clearfix"=>true);
		$i++;
		$headings[$i]["t_address"] = array("label"=>JText::_('COM_CLUBREG_ADDRESS'), "clearfix"=>true);		
		$headings[$i]["postal_address"] = array("label"=>JText::_('COM_CLUBREG_POSTAL_ADDRESS'), "clearfix"=>true,'transform'=>"nl2br" );
		$i++;		
		$headings[$i]["my_children"] = array("label"=>JText::_('COM_CLUBREG_JUNIOR_LABEL'));	
		$i++;
		$headings[$i]["send_news"] = array("label"=>JText::_('COM_CLUBREG_SENDNEWS'), "clearfix"=>true, "transform"=>"sendnews"); 
		$headings[$i]["member_status"] = array("label"=>JText::_('COM_CLUBREG_MEMBERSTATUS_LABEL'),'transform'=>"ucfirst");
		$i++;
		return array("lastIndex"=>$i);
	}
	
	private function getSenior(&$headings = array()){
		
		$i= 0;
		
		$headings[$i]["emailaddress"] = array("label"=>JText::_('JGLOBAL_EMAIL'), "clearfix"=>true);
		$i++;
		$headings[$i]["t_phone"] = array("label"=>JText::_('COM_CLUBREG_MOBILE'),"sep"=>" / ", "clearfix"=>true);
		$i++;
		
		$headings[$i]["t_address"] = array("label"=>JText::_('COM_CLUBREG_ADDRESS'), "clearfix"=>true);		
		$headings[$i]["postal_address"] = array("label"=>JText::_('COM_CLUBREG_POSTAL_ADDRESS'), "clearfix"=>true,'transform'=>"nl2br" );
		$i++;
		$headings[$i]["group"] = array("label"=>JText::_('COM_CLUBREG_GROUPN_LABEL'));
		$headings[$i]["subgroup"] = array("label"=>JText::_('COM_CLUBREG_SUBGROUPN_LABEL'), "clearfix"=>true);
		$i++;
		$headings[$i]["joining_date"] = array("label"=>JText::_('COM_CLUBREG_JOINING_LABEL'), 'transform'=>"clubregdate");
		$headings[$i]["year_registered"] = array("label"=>JText::_('COM_CLUBREG_SEASON_LABEL') , "clearfix"=>true);
		$i++;
		$headings[$i]["gender"] = array("label"=>JText::_('COM_CLUBREG_GENDER_LABEL'),'transform'=>"ucfirst");
		$headings[$i]["memberlevel"] = array("label"=>JText::_('COM_CLUBREG_SKILLLEVEL_LABEL'),'transform'=>"ucfirst", "clearfix"=>true);
		$i++;
		$headings[$i]["send_news"] = array("label"=>JText::_('COM_CLUBREG_SENDNEWS'), "transform"=>"sendnews");		
		$headings[$i]["member_status"] = array("label"=>JText::_('COM_CLUBREG_MEMBERSTATUS_LABEL'),'transform'=>"ucfirst");
		$i++;
		return array("lastIndex"=>$i);
	}
	private function getJunior(&$headings = array()){
		
		$i= 0;
		$headings[$i]["guardian"] = array("label"=>JText::_('COM_CLUBREG_GUARDIAN_LABEL'),'transform'=>"ucwords", "clearfix"=>true); // one line
		$i++;
		$headings[$i]["t_address"] = array("label"=>JText::_('COM_CLUBREG_ADDRESS'), "cols" => array("gaddress", "gsuburb","gausstate","gpostcode"), "clearfix"=>true);
		$headings[$i]["postal_address"] = array("label"=>JText::_('COM_CLUBREG_POSTAL_ADDRESS'), "clearfix"=>true,'transform'=>"nl2br" );
		
		$i++;
		$headings[$i]["group"] = array("label"=>JText::_('COM_CLUBREG_GROUPN_LABEL'));
		$headings[$i]["subgroup"] = array("label"=>JText::_('COM_CLUBREG_SUBGROUPN_LABEL'), "clearfix"=>true); // two per line		
		$i++;
		$headings[$i]["joining_date"] = array("label"=>JText::_('COM_CLUBREG_JOINING_LABEL'), 'transform'=>"clubregdate"); 
		$headings[$i]["year_registered"] = array("label"=>JText::_('COM_CLUBREG_SEASON_LABEL'), "clearfix"=>true); // two per line
		$i++;
		$headings[$i]["memberlevel"] = array("label"=>JText::_('COM_CLUBREG_SKILLLEVEL_LABEL'),'transform'=>array("ucfirst","removeUnderscore"));		
		$headings[$i]["gender"] = array("label"=>JText::_('COM_CLUBREG_GENDER_LABEL'),'transform'=>"ucfirst");
		$i++;
		$headings[$i]["dob"] = array("label"=>JText::_('COM_CLUBREG_DOB_LABEL'), "clearfix"=>true); // two per line		
		$headings[$i]["member_status"] = array("label"=>JText::_('COM_CLUBREG_MEMBERSTATUS_LABEL'),'transform'=>"ucfirst");
		$i++;
		
		return array("lastIndex"=>$i);
	}
	
}