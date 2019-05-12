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
		
		//$headings["payment_desc"] = array("label"=>JText::_('COM_CLUBREG_PAYMENT_DESCRIPTION'),'label_class'=>'reg-label'); // use array
		$headings["relationship_tag"] = array("label"=>JText::_('COM_CLUBREG_PROFILE_RELATION'),"transform"=>array("ucfirst"));
		
		$headings["emailaddress"] = array("label"=>JText::_('JGLOBAL_EMAIL'), "clearfix"=>true);
		$headings["t_phone"] = array("label"=>JText::_('COM_CLUBREG_MOBILE'),"sep"=>" / ", "clearfix"=>true);
		
		
		$headings["t_address"] = array("label"=>JText::_('COM_CLUBREG_ADDRESS'), "clearfix"=>true);
		
		
		/* $headings["payment_amount"] = array("label"=>JText::_('COM_CLUBREG_PAYMENT_AMOUNT').'('.CURRENCY.')', "clearfix"=>true,'transform'=>'applyFactor'); // use array
				
		$headings["payment_method"] = array("label"=>JText::_('COM_CLUBREG_PAYMENT_METHOD'),'label_class'=>'reg-label');		
		$headings["payment_status"] = array("label"=>JText::_('COM_CLUBREG_PAYMENT_STATUS'), "clearfix"=>true);
		
		$headings["payment_date"] = array("label"=>JText::_('COM_CLUBREG_PAYMENT_DATE'),'label_class'=>'reg-label');
		$headings["payment_season"] = array("label"=>JText::_('COM_CLUBREG_PAYMENT_SEASON'),'transform'=>"ucfirst", "clearfix"=>true);
	
		$headings["payment_notes"] = array("label"=>JText::_('COM_CLUBREG_PAYMENT_NOTES'),'transform'=>"nl2br",'label_class'=>'reg-label'); // use array */
		
		return array("filters"=>$entity_filters, "group_where"=>$group_where);
	}
	
	
	private function getContactlists(&$headings = array()){
		$entity_filters = $group_where =  array();
	
		$headings["contactlist_sname"] = array("label"=>JText::_('COM_CLUBREG_EM_SNAME'),'label_class'=>'reg-label' , "transform"=>array("ucfirst"));
		$headings["contactlist_fname"] = array("label"=>JText::_('COM_CLUBREG_EM_FNAME'), "clearfix"=>true , "transform"=>array("ucfirst"));
	
		$headings["contactlist_email"] = array("label"=>JText::_('COM_CLUBREG_EM_EMAIL'),'label_class'=>'reg-label', "clearfix"=>true);
		$headings["contactlist_phoneno"] = array("label"=>JText::_('COM_CLUBREG_EM_MOBILE'),'label_class'=>'reg-label');
		$headings["contactlist_notify"] = array("label"=>JText::_('COM_CLUBREG_EM_NOTIFY'), "clearfix"=>true, "transform"=>array("sendnews"));
	
	
		return array("filters"=>$entity_filters, "group_where"=>$group_where);
	}
	
}