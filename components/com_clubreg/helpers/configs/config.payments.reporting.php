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
class ClubRegPaymentsConfig extends JObject
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
	public function getConfig($configType = "payments"){
		
		$method = 'get'.ucwords($configType);
		$filterConfig = array();		
		if(method_exists($this, $method)){			
			$headings = array(); // will have to use some form of ordering
			//$headings["idx"] = array("label"=>JText::_('#'),'csvonly'=>TRUE);			
			$filterConfig =  $this->$method($headings);						
			$filterConfig["headings"] = $headings;			
			$filterConfig["otherconfigs"] = array();
		}		
		return $filterConfig;
		
	}		
	
	private function getPayments(&$headings = array()){
		$entity_filters = $group_where =  array();	
		$i = 0;
		$headings[$i]["payment_desc"] = array("label"=>JText::_('COM_CLUBREG_PAYMENT_DESCRIPTION'),"class"=>"class='inputbox input-large'"); // use array
		$headings[$i]["payment_method"] = array("label"=>JText::_('COM_CLUBREG_PAYMENT_METHOD'),"class"=>"class='inputbox input-large'");
		$headings[$i]["payment_status"] = array("label"=>JText::_('COM_CLUBREG_PAYMENT_STATUS'), "clearfix"=>true,"class"=>"class='inputbox input-large'");
		$headings[$i]["payment_season"] = array("label"=>JText::_('COM_CLUBREG_PAYMENT_SEASON'),'transform'=>"ucfirst", "clearfix"=>true,"class"=>"class='inputbox input-large'");
		
		$i++;
		
		$headings[$i]["payment_transact_no"] = array("label"=>JText::_('COM_CLUBREG_PAYMENT_TRANSACT'),"class"=>"class='inputbox input-large'");
		$headings[$i]["payment_amount"] = array("label"=>JText::_('COM_CLUBREG_PAYMENT_AMOUNT').'('.CURRENCY.')', "clearfix"=>true,'transform'=>'applyFactor'); // use array
		$headings[$i]["payment_notes"] = array("label"=>JText::_('COM_CLUBREG_PAYMENT_NOTES'),'transform'=>"nl2br","class"=>"class='inputbox input-large'"); // use array
		
		$headings[$i]["hide"] = array("label"=>JText::_(''),"class"=>"class='inputbox input-large'");
		$i++;
		//$headings[$i]["payment_date"] = array("label"=>JText::_('COM_CLUBREG_PAYMENT_DATE'),"class"=>"class='inputbox input-large'");
		$i++;
					
		$entity_filters["payment_desc"] = array("filter_col"=>"pt.`payment_desc`","control"=>"select.genericlist");		
		$entity_filters["payment_method"] = array("filter_col"=>"pt.`payment_method`","control"=>"select.genericlist");
		$entity_filters["payment_status"] = array("filter_col"=>"pt.`payment_status`","control"=>"select.genericlist");
		
		
		$entity_filters["payment_transact_no"] = array("filter_col"=>"pt.`payment_transact_no`","control"=>"text");		
		$entity_filters["payment_amount"] = array("filter_col"=>"pt.`payment_amount`","control"=>"text");	
		$entity_filters["payment_date"] = array("filter_col"=>"pt.`payment_date`","control"=>"date");
		$entity_filters["payment_season"] = array("filter_col"=>"pt.`payment_season`","control"=>"select.genericlist");		
		$entity_filters["payment_notes"] = array("filter_col"=>"pt.`payment_notes`","control"=>"text");
				
		
		require_once CLUBREG_ADMINPATH.'/helpers/clubreg.php';
		require_once JPATH_COMPONENT.DS.'helpers'.DS."clubreg.seasons.php";
		
		ClubRegHelper::setIndex("value"); // force the array to be indexed by the value			
		$tList =  ClubRegHelper::configOptions('club_payment_desc'); // controls		
		array_unshift($tList, new JObject(array("value"=>"-1","text"=>"- ".JText::_('COM_CLUBREG_PAYMENT_DESCRIPTION')." -")));		
		$entity_filters["payment_desc"]["values"] = $tList;
		unset($tList);		
		
		$tList =  ClubRegHelper::configOptions('club_payment_method'); // controls	
		array_unshift($tList, new JObject(array("value"=>"-1","text"=>"- ".JText::_('COM_CLUBREG_PAYMENT_METHOD')." -")));
		$entity_filters["payment_method"]["values"] = $tList;
		unset($tList);
		
		$tList =  ClubRegHelper::configOptions('club_payment_status'); // controls	
		array_unshift($tList, new JObject(array("value"=>"-1","text"=>"- ".JText::_('COM_CLUBREG_PAYMENT_STATUS')." -")));
		$entity_filters["payment_status"]["values"] = $tList;
		unset($tList);
		
		$entity_filters["payment_season"]["values"] =  ClubRegSeasonsHelper::generate_List(); // controls	
			
		unset($tmp_list);
		
					
		return array("filters"=>$entity_filters, "headings"=>$headings);
	}
	
	
}