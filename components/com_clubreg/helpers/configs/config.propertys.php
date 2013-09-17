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
class ClubRegPropertysConfig extends JObject
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
	public function getConfig($configType = "propertys"){
		
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
					 

	
	private function getPropertys(&$headings = array()){
		$entity_filters = $group_where =  array();	
		
	//	$headings["property_type"] = array("label"=>JText::_('COM_CLUBREG_PROPERTY_TYPE'),'label_class'=>'reg-label');
					
		$headings["property_make"] = array("label"=>JText::_('COM_CLUBREG_PROPERTY_MAKE'),'label_class'=>'reg-label');		
		$headings["property_model"] = array("label"=>JText::_('COM_CLUBREG_PROPERTY_MODEL'), "clearfix"=>true);
		
		$headings["property_serial"] = array("label"=>JText::_('COM_CLUBREG_PROPERTY_SERIAL'),'label_class'=>'reg-label', "clearfix"=>true);
		$headings["property_checked_in"] = array("label"=>JText::_('COM_CLUBREG_PROPERTY_CHECKOUT'),'label_class'=>'reg-label');
		$headings["property_checked_out"] = array("label"=>JText::_('COM_CLUBREG_PROPERTY_CHECKIN'), "clearfix"=>true);
	
		$headings["property_notes"] = array("label"=>JText::_('COM_CLUBREG_PROPERTY_NOTES'),'transform'=>"nl2br"); // use array
		
		return array("filters"=>$entity_filters, "group_where"=>$group_where);
	}
	
	
}