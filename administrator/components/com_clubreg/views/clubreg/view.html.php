<?php
/*------------------------------------------------------------------------
# com_clubreg - Manage Club Member Registrations
# ------------------------------------------------------------------------
# author    Omokhoa Agbagbara
# copyright Copyright (C) 2013 applications.deltastateonline.com. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://applications.deltastateonline.com
# Technical Support:  email - joomla@deltastateonline.com
-------------------------------------------------------------------------*/

defined('_JEXEC') or die;


class ClubregViewClubreg extends JViewLegacy
{
	public function display(){
		
		$this->layout  =$nLayout = $this->getLayout();
		$proceed = FALSE;
		
		if(method_exists($this, $nLayout)){
			ClubRegHelper::addSubmenu($nLayout);
			$proceed =  $this->$nLayout();
		}else{
			ClubRegHelper::addSubmenu("homepage");
		}	 
		
		$cTitle = sprintf("%s",JText::_('COM_CLUBREG'));
		JToolbarHelper::title($cTitle, 'clubgroups.png');
		
		$this->sidebar = JHtmlSidebar::render();
		
		$this->pageTitle = JText::_('COM_CLUBREG_PROFILE');		
		parent::display($tpl);
		
		
	}
	
	public function validateapp($tpl = null){	
		
		$this->componentTables = array(
				array("comtable"=>"`#__clubreg_attachments`"),
				array("comtable"=>"`#__clubreg_configs`"),
				array("comtable"=>"`#__clubreg_contact_details`"),
				array("comtable"=>"`#__clubreg_details_audit`"),
				array("comtable"=>"`#__clubreg_eoimembers`"),
				array("comtable"=>"`#__clubreg_groups`"),
				array("comtable"=>"`#__clubreg_notes`"),
				array("comtable"=>"`#__clubreg_payments`"),
				array("comtable"=>"`#__clubreg_payments_setup`"),
				array("comtable"=>"`#__clubreg_property_sheet`"),
				array("comtable"=>"`#__clubreg_registeredmembers`"),
				array("comtable"=>"`#__clubreg_saved_comms`"),
				array("comtable"=>"`#__clubreg_stats_details`"),
				array("comtable"=>"`#__clubreg_tags`"),
				array("comtable"=>"`#__clubreg_tags_players`"),
				array("comtable"=>"`#__clubreg_teammembers`"),
				array("comtable"=>"`#__clubreg_teammembers_details`"),
				array("comtable"=>"`#__clubreg_teammembers_groups`"),
				array("comtable"=>"`#__clubreg_templates`"),
				array("comtable"=>"`#__clubreg_saved_comms_groups`"),
				array("comtable"=>"`#__clubreg_contactlist`")				
		);	
		
		usort($this->componentTables, function($a,$b){
			return strnatcmp($a["comtable"], $b["comtable"]);
		});
		$howmany = count($this->componentTables);
		
		for($i = 0; $i < $howmany; $i++)		{
			$this->componentTables[$i]["tablestatus"] = $this->validateTable($this->componentTables[$i]["comtable"]);
		}
	}
	
	private function validateTable($tableName){
		
		try {
			$db = JFactory::getDbo();
			$db->setQuery(sprintf('SELECT * FROM %s limit 1',$tableName));
			$allData = $db->loadResult();			
			return TRUE;			
		} catch (Exception $e) {
			return FALSE;
		}

	}
}