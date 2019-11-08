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
			require_once CLUBREG_CONFIGS.'regmember.csv.php';
			require_once JPATH_COMPONENT.DS.'helpers'.DS.'clubreg.filters.regmembers.php';			
			require_once JPATH_COMPONENT.DS.'helpers'.DS.'clubreg.exporttable.php';				
				
			$group_type			= $app->input->post->get('playertype');	
			$all_groups = $current_model->getMyGroups($group_type);
	
			unset($current_model);
			$current_model = JModelLegacy::getInstance('regmembers', 'ClubregModel', array('ignore_request' => false));
			
			$this->state		= $current_model->getState();		
			
			$configObj = new ClubRegRegmembersConfig();
			$configObj->setOfficialGroups($all_groups["allowed_groups"]);
			$configObj->setOfficialSubGroups($all_groups["sub_groups_ids"]);
			$regmembersConfigs =  $configObj->getConfig($this->state->get('filter.playertype')); // return headings and filters			
			$current_model->setMoreStates($regmembersConfigs["filters"],$all_groups); // set more states
			
			$this->items		= $current_model->getItems();		

			unset($configObj);
			$configObj = new ClubRegRegmembersCsvConfig();
			$headingConfigs =  $configObj->getConfig($this->state->get('filter.playertype')); // return headings and filters
			unset($configObj);
			
			
			
			$tmp_filters["request_data"] = $this->state;
			$tmp_filters["filter_heading"] = $regmembersConfigs["filters"];	
			$tmp_filters["group_where"] = $regmembersConfigs["group_where"];
			$tmp_filters["headings"] = $headingConfigs["headings"];
			$tmp_filters["otherconfigs"] = $regmembersConfigs["otherconfigs"];
			$this->entity_filters = $tmp_filters;						
			
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
	
	function findplayers(){				
		
		JSession::checkToken('post') or die(JText::_('JINVALID_TOKEN'));
		
		$user		= JFactory::getUser();
		$app			= JFactory::getApplication();
		$this->Itemid			= $app->input->post->get('Itemid');			
		
		$group_breakdown = array();
		
		$this->setLayout("raw.findplayers");
		
		$proceed = FALSE;
		if($user->get('id') > 0){
			$proceed = TRUE;			
			
			$current_model = JModelLegacy::getInstance('officialfrn', 'ClubregModel', array('ignore_request' => true));
			$current_model->setState('joomla_id',$user->get('id'));
			if(!$current_model->getPermissions('manageusers')){
				return FALSE;
			}
			
			require_once CLUBREG_CONFIGS.'regmember.display.php';
			require_once JPATH_COMPONENT.DS.'helpers'.DS.'clubreg.uniquekeys.php';	

			require_once JPATH_COMPONENT.DS.'helpers'.DS.'clubreg.rendertables.findplayers.php';
			
			$current_model = JModelLegacy::getInstance('officialfrn', 'ClubregModel', array('ignore_request' => true));
			$current_model->setState('joomla_id',$user->get('id'));
			$this->allowedGroups = $current_model->getMyGroups();
			
			$all_groups = array("allowed_groups"=>$this->allowedGroups['allowed_groups'],"sub_groups_ids"=>$this->allowedGroups['sub_groups_ids']);
				
			unset($current_model);
			
			$configObj = new ClubRegRegmembersDisplayConfig();
			$headingConfigs["senior"] =  $configObj->getConfig("senior"); // return headings and filters
			$headingConfigs["junior"] =  $configObj->getConfig("junior"); // return headings and filters
			$headingConfigs["guardian"] =  $configObj->getConfig("guardian"); // return headings and filters
			unset($configObj);
			
			
			$key_data = new stdClass();
			
			$search_value = $app->input->post->getString('search_value', null);			
			$current_model = JModelLegacy::getInstance('findplayer', 'ClubregModel', array('ignore_request' => true));
						
			JLog::add("Find Player Search Term - {$search_value}");
			
			$current_model->setState('com_clubreg.findplayer.search_value',trim($search_value));
			$current_model->setState('com_clubreg.findplayer.group_ids',$all_groups);			
			
			$this->items		=  $current_model->getItems();
			$this->pagination	= $current_model->getPagination();	
			$this->headingsConfig = $headingConfigs;
			
			$this->uKeyObject = new ClubRegUniqueKeysHelper();
			
			unset($current_model,$headingConfigs);
			
		}
		return $proceed;
	}
	
}