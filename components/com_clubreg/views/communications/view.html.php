<?php
/*------------------------------------------------------------------------
# com_clubreg - Manage Club Member Registrations
# ------------------------------------------------------------------------
# author    Omokhoa Agbagbara
# copyright Copyright (C) 2014 applications.deltastateonline.com. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://applications.deltastateonline.com
# Technical Support:  email - joomla@deltastateonline.com
-------------------------------------------------------------------------*/
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.view');

class ClubRegViewcommunications extends JViewLegacy
{
	function display($tpl = null)
	{
		
		$renderer =  $this->getLayout();
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
	private function communications(){		

		global $clubreg_Itemid;
		// must be set groups and year
		$app			= JFactory::getApplication();
		$menu	= $app->getMenu();
		
		$uri = JUri::getInstance();
		$query = $uri->getQuery(true);
		
		if (empty($query['Itemid'])) {
			$menuItem = $menu->getActive();
		} else {
			$menuItem = $menu->getItem($query['Itemid']);
		}	
		
		
		$tmp_filters = array();
		
		$query = $menuItem->query;
		
		require_once JPATH_COMPONENT.DS.'helpers'.DS.'clubreg.filters.communications.php';
		
		JModelLegacy::addIncludePath(JPATH_COMPONENT_ADMINISTRATOR.'/models');
		
		unset($current_model);
		$current_model = JModelLegacy::getInstance('templates', 'ClubregModel', array('ignore_request' => false));	

		$tmp_filters["currentTemplates"] = $current_model->getCurrentTemplates();
		$tmp_filters["editAction"] = sprintf('index.php?option=com_clubreg&view=communication&Itemid=%d&layout=edit&template_id=',$clubreg_Itemid); // back to list
		
		$this->entity_filters =  $tmp_filters;		
		$this->pageTitle = $menuItem->title;
		
		
		
		unset($current_model);
		
		

		/*
		$this->year_default = $query['year'] = $app->input->getString('year', date('Y'));
		
		if(empty($query['year']) or strlen($query['year']) < 3){
			$query['year'] = date('Y');
		}			
		
		JModelLegacy::addIncludePath(JPATH_COMPONENT_ADMINISTRATOR.'/models');
		
		unset($current_model);
		$current_model = JModelLegacy::getInstance('clubgroup', 'ClubregModel', array('ignore_request' => false));
		$current_group = $current_model->getItem($query["groups"]);		
		
		unset($current_model);
		$app->input->set('group_id',$query["groups"]);
		$current_model = JModelLegacy::getInstance('clubgroups', 'ClubregModel', array('ignore_request' => false));
		$all_children = $current_model->getSubGroups();
		
		$all_groups = array("allowed_groups"=>array(),"sub_groups_ids"=>array());
		require_once CLUBREG_CONFIGS.'config.regmembers.php';		
		//$all_groups["allowed_groups"] = array($current_group->group_id);
		
		if(count($all_children['group_children']) > 0 ){
			foreach($all_children['group_children'] as $a_child){
				//$all_groups["sub_groups_ids"][] = $a_child->group_id;
			}		
		 }		 
		 
		$configObj = new ClubRegRegmembersConfig();
		$configObj->setOfficialGroups($all_groups["allowed_groups"]);
		$configObj->setOfficialSubGroups($all_groups["sub_groups_ids"]);
		$regmembersConfigs =  $configObj->getConfig($current_group->group_type); // return headings and filters
		
		// set the filters for the regmember filters
		$app->setUserState('com_clubreg.regmembers.filter.playertype', $current_group->group_type);
		$app->setUserState('com_clubreg.regmembers.filter.member_status','registered');
		$app->setUserState('com_clubreg.regmembers.filter.year_registered',$query['year']);
		$app->setUserState('com_clubreg.regmembers.filter.group',$current_group->group_id);
		
		
		unset($current_model);
		$current_model = JModelLegacy::getInstance('regmembers', 'ClubregModel', array('ignore_request' => true));		
		$current_model->setState('filter.playertype', $current_group->group_type);	
		$current_model->setState('list.ordering', 'sg.group_name,  surname');
		$current_model->setState('list.direction', 'ASC');
		$current_model->setMoreStates($regmembersConfigs["filters"],$all_groups); // set more states			
		
		$this->items		= $current_model->getItems();
		$this->current_group = $current_group;	
		$this->pageTitle = $menuItem->title .' / '.$query['year'];
		unset($current_model);
		
		// reset the filters		
		$app->setUserState('com_clubreg.regmembers.filter.playertype', NULL);
		$app->setUserState('com_clubreg.regmembers.filter.member_status',NULL);
		$app->setUserState('com_clubreg.regmembers.filter.year_registered',NULL);
		$app->setUserState('com_clubreg.regmembers.filter.group',NULL);	
		
		
		unset($current_model);
		$current_model = JModelLegacy::getInstance('officialfrn', 'ClubregModel', array('ignore_request' => true));
		$current_model->setState('joomla_id',$current_group->group_leader);		
		$this->group_leader = $current_model->getDetails();
		
		
		require_once JPATH_COMPONENT.DS.'helpers'.DS.'clubreg.seasons.php';
		$this->year_registered = ClubRegSeasonsHelper::generate_List();
		$this->year_registered_control = array("label"=>JText::_('COM_CLUBREG_SEASON_LABEL'),"control"=>"select.genericlist","other"=>"class='inputbox input-medium communications-season' id='communications_season'");
		
		*/
		return TRUE;
	}	
}