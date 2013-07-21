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

jimport( 'joomla.application.component.view');

class ClubRegViewregmembers extends JViewLegacy
{
	function display($tpl = null)
	{		

		global $mainframe;
		
		$this->layout  = $renderer =  $this->getLayout();
		$proceed = FALSE;		
		
		if(method_exists($this, $renderer)){
			$proceed =  $this->$renderer();			
		}		
		
		if($proceed){
			parent::display($tpl);
		}else{
			ClubRegUnAuthHelper::unAuthorised();
		}
	}
		
	private function exportregmembers(){		
	
		$user		= JFactory::getUser();
		$proceed = FALSE;		
	
		$current_model = JModelLegacy::getInstance('officialfrn', 'ClubregModel', array('ignore_request' => true));
		$current_model->setState('joomla_id',$user->get('id'));		

		$app		= JFactory::getApplication();
		$active	= $app->getMenu()->getActive(); // if logged in

		
		if($current_model->getPermissions('manageusers')){
			$proceed = TRUE;
			
			require_once CLUBREG_CONFIGS.'config.regmembers.php';
			require_once JPATH_COMPONENT.DS.'helpers'.DS.'clubreg.filters.regmembers.php';			
			require_once JPATH_COMPONENT.DS.'helpers'.DS.'clubreg.exporttable.php';		
		
			$all_groups = $current_model->getMyGroups();		
	
			unset($current_model);
			$current_model = JModelLegacy::getInstance('regmembers', 'ClubregModel', array('ignore_request' => false));
			
			$this->state		= $current_model->getState();		
			
			$configObj = new ClubRegRegmembersConfig();
			$configObj->setOfficialGroups($all_groups["allowed_groups"]);
			$regmembersConfigs =  $configObj->getConfig($this->state->get('filter.playertype')); // return headings and filters			
			$current_model->setMoreStates($regmembersConfigs["filters"],$all_groups["allowed_groups"]); // set more states
			
			$this->items		= $current_model->getItems();					
			
			$tmp_filters["request_data"] = $this->state;
			$tmp_filters["filter_heading"] = $regmembersConfigs["filters"];	
			$tmp_filters["group_where"] = $regmembersConfigs["group_where"];
			$tmp_filters["headings"] = $regmembersConfigs["headings"];
			$tmp_filters["otherconfigs"] = $regmembersConfigs["otherconfigs"];
			$this->entity_filters = $tmp_filters;	
			
			unset($configObj);
			unset($tmp_filters);
			
			$basename = "player.export.".time();
			$mimetype = 'text/csv';
			
			$document = JFactory::getDocument();
			$document->setMimeEncoding($mimetype);
			JResponse::setHeader('Content-disposition', 'attachment; filename="'.$basename.'.csv"; creation-date="'.JFactory::getDate()->toRFC822().'"', true);
			
		}
	
		unset($current_model);
	
		return $proceed;
	}
	
}