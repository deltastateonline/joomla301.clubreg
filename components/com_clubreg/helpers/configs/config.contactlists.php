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
class ClubRegContactlistsConfig extends JObject
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
	public function getConfig($configType = "contactlists"){
		
		$method = 'get'.ucwords($configType);
		$filterConfig = array();		
		if(method_exists($this, $method)){			
			$headings = array(); // will have to use some form of ordering
			$headings["idx"] = array("label"=>JText::_('#'),'csvonly'=>FALSE);			
			$filterConfig =  $this->$method($headings);						
			$filterConfig["headings"] = $headings;			
			$filterConfig["otherconfigs"] = array();
		}		
		return $filterConfig;
		
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