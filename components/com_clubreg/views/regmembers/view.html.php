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
		return $this->renderregmembers();
	}
	private function renderregmembers(){
		
	
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
			require_once JPATH_COMPONENT.DS.'helpers'.DS.'clubreg.rendertables.regmembers.php';			
			require_once JPATH_COMPONENT.DS.'helpers'.DS.'clubreg.pagination.php';
			require_once JPATH_COMPONENT.DS.'helpers'.DS.'clubreg.uniquekeys.php';
			
			$group_type			= $app->input->post->get('playertype');	
			if(!isset($group_type)){
				$params = JComponentHelper::getParams('com_clubreg');
				$group_type = $params->get("default_playertype");				
			}
			$all_groups = $current_model->getMyGroups($group_type);
	
			unset($current_model);
			$current_model = JModelLegacy::getInstance('regmembers', 'ClubregModel', array('ignore_request' => false));
			
			$this->formaction = 'index.php?option=com_clubreg&view=regmembers';			
			$this->formaction_comp = 'index.php?option=com_clubreg&view=regmembers&format=raw';// the csv file
			$this->formaction_edit = 'index.php?option=com_clubreg&view=regmember&layout=edit';
			$this->state		= $current_model->getState();		
			
			$configObj = new ClubRegRegmembersConfig();			
			$configObj->setOfficialGroups($all_groups["allowed_groups"]);
			$configObj->setOfficialSubGroups($all_groups["sub_groups_ids"]);
			
			$regmembersConfigs =  $configObj->getConfig($this->state->get('filter.playertype')); // return headings and filters				
			$current_model->setMoreStates($regmembersConfigs["filters"],$all_groups); // set more states
			
			$this->items		= $current_model->getItems();
			$this->pagination	= $current_model->getPagination();		
			
			$tmp_filters["request_data"] = $this->state;
			$tmp_filters["filter_heading"] = $regmembersConfigs["filters"];	
			$tmp_filters["group_where"] = $regmembersConfigs["group_where"];
			$tmp_filters["headings"] = $regmembersConfigs["headings"];
			$tmp_filters["otherconfigs"] = $regmembersConfigs["otherconfigs"];
			$this->entity_filters = $tmp_filters;		
			
			
			$this->uKeyObject = new ClubRegUniqueKeysHelper();		
			
			unset($configObj);
			unset($tmp_filters);
	
		}
		$this->pageTitle = $active->title;
		unset($current_model);
	
		return $proceed;
	}
	public function getSortFields()
	{
		return array(
				'a.created' => JText::_('COM_CLUBREG_CREATED_LABEL'),
				'a.surname' => JText::_('COM_CLUBREG_PLAYERNAME_LABEL'),
				'a.gender' => JText::_('COM_CLUBREG_GENDER_LABEL'),
				'a.emailaddress' => JText::_('JGLOBAL_EMAIL')
	
	
		);
	}	
}