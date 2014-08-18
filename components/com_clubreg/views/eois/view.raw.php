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

class ClubRegVieweois extends JViewLegacy
{
	function display($tpl = null)
	{		
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
	
	private function exporteois(){	
	
		$user		= JFactory::getUser();
		$proceed = FALSE;		
	
		$current_model = JModelLegacy::getInstance('officialfrn', 'ClubregModel', array('ignore_request' => true));
		$current_model->setState('joomla_id',$user->get('id'));		
		
		if($current_model->getPermissions('manageeoi')){
			$proceed = TRUE;
			require_once CLUBREG_CONFIGS.'config.eoi.php';
			require_once JPATH_COMPONENT.DS.'helpers'.DS.'clubreg.filters.php';			
			require_once JPATH_COMPONENT.DS.'helpers'.DS.'clubreg.exporttable.php';			
	
			unset($current_model);
			$current_model = JModelLegacy::getInstance('eois', 'ClubregModel', array('ignore_request' => false));
			
			$this->state		= $current_model->getState();		
			
			$configObj = new ClubRegEoiConfig();
			$eoiConfigs =  $configObj->getConfig($this->state->get('filter.playertype')); // return headings and filters			
			
			$current_model->setMoreStates($eoiConfigs["filters"]); // set more states
			
			$this->items		= $current_model->getItems();
					
			
			$tmp_filters["request_data"] = $this->state;
			$tmp_filters["filter_heading"] = $eoiConfigs["filters"];	
			$tmp_filters["group_where"] = $eoiConfigs["group_where"];
			$tmp_filters["headings"] = $eoiConfigs["headings"];
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