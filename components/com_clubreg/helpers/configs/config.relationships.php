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
		$headings["payment_transact_no"] = array("label"=>JText::_('COM_CLUBREG_PAYMENT_TRANSACT'),'label_class'=>'reg-label');
		$headings["payment_amount"] = array("label"=>JText::_('COM_CLUBREG_PAYMENT_AMOUNT').'('.CURRENCY.')', "clearfix"=>true,'transform'=>'applyFactor'); // use array
				
		$headings["payment_method"] = array("label"=>JText::_('COM_CLUBREG_PAYMENT_METHOD'),'label_class'=>'reg-label');		
		$headings["payment_status"] = array("label"=>JText::_('COM_CLUBREG_PAYMENT_STATUS'), "clearfix"=>true);
		
		$headings["payment_date"] = array("label"=>JText::_('COM_CLUBREG_PAYMENT_DATE'),'label_class'=>'reg-label');
		$headings["payment_season"] = array("label"=>JText::_('COM_CLUBREG_PAYMENT_SEASON'),'transform'=>"ucfirst", "clearfix"=>true);
	
		$headings["payment_notes"] = array("label"=>JText::_('COM_CLUBREG_PAYMENT_NOTES'),'transform'=>"nl2br",'label_class'=>'reg-label'); // use array
		
		return array("filters"=>$entity_filters, "group_where"=>$group_where);
	}
	
	
}