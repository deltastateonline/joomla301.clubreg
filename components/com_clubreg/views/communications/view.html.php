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
	private function communications(){		

		global $clubreg_Itemid;			
		
		$user			= JFactory::getUser();
		
		$current_model = JModelLegacy::getInstance('officialfrn', 'ClubregModel', array('ignore_request' => true));
		$current_model->setState('joomla_id',$user->get('id'));
		
		if($current_model->getPermissions('sendcommunication')){
		
				$app			= JFactory::getApplication();		
				$menu	= $app->getMenu();
				
				$uri = JUri::getInstance();
				$query = $uri->getQuery(true);
				
				if (empty($query['Itemid'])) {
					$menuItem = $menu->getActive();
				} else {
					$menuItem = $menu->getItem($query['Itemid']);
				}	
				
				$app->setUserState('com_clubreg.communication.data', array());
				
				$tmp_filters = array();
				
				$query = $menuItem->query;
				require_once CLUBREG_CONFIGS.'config.communications.php';
				require_once JPATH_COMPONENT.DS.'helpers'.DS.'clubreg.filters.communications.php';
				require_once JPATH_COMPONENT.DS.'helpers'.DS.'clubreg.rendertables.comms.php';
				require_once JPATH_COMPONENT.DS.'helpers'.DS.'clubreg.pagination.php';
				
				JModelLegacy::addIncludePath(JPATH_COMPONENT_ADMINISTRATOR.'/models');		
				unset($current_model);
				$current_model = JModelLegacy::getInstance('templates', 'ClubregModel', array('ignore_request' => false));	
				$tmp_filters["currentTemplates"] = $current_model->getCurrentTemplates();	
		
				
				unset($current_model);
				$current_model = JModelLegacy::getInstance('officialfrn', 'ClubregModel', array('ignore_request' => false));
				$current_model->setState('joomla_id',$user->get('id'));
				$allowedGroups = $current_model->getMyGroups();
				$all_groups = array("allowed_groups"=>$allowedGroups["group_leader"],"sub_groups"=>$allowedGroups["sub_groups"]);
								
				unset($current_model);
				$current_model = JModelLegacy::getInstance('communications', 'ClubregModel', array('ignore_request' => false));
				$this->state		= $current_model->getState();
				
				$tmp_filters["editAction"] = sprintf('index.php?option=com_clubreg&view=communication&Itemid=%d&layout=edit&template_id=',$clubreg_Itemid); // back to list
				
				
				$configObj = new ClubRegCommsConfig();
				$configObj->setOfficialGroups(array_keys($all_groups["allowed_groups"])); // only groups u are a leader of
				$configObj->setOfficialSubGroups(array_keys($all_groups["sub_groups"])); // only subgroups u are a leader of
					
				$commsConfigs =  $configObj->getConfig("comms"); // return headings and filters
				$current_model->setMoreStates($commsConfigs["filters"],$all_groups); // set more states
				
				$this->items		= $current_model->getItems();
				$this->pagination	= $current_model->getPagination();
						
				$tmp_filters["request_data"] = $this->state;
				$tmp_filters["filter_heading"] = $commsConfigs["filters"];	
				$tmp_filters["group_where"] = $commsConfigs["group_where"];
				$tmp_filters["headings"] = $commsConfigs["headings"];
				$tmp_filters["otherconfigs"] = $commsConfigs["otherconfigs"];		
				
				$this->entity_filters =  $tmp_filters;		
				$this->pageTitle = $menuItem->title;
				
				$this->edit_comms_url = sprintf('index.php?option=com_clubreg&view=communication&Itemid=%d&layout=edit&comm_id=',$clubreg_Itemid); // back to list
				
				
				unset($current_model);
				
				return TRUE;
		}
		
		return FALSE;
	}	
	
	public function getSortFields()
	{
		return array(
				'a.created' => JText::_('COM_CLUBREG_CREATED_LABEL'),
				'a.sent_date' => JText::_('COM_CLUBREG_COMMS_SENTDATE'),
				'template_name' => JText::_('COM_CLUBREG_COMMS_TEMPLATES'),				
	
	
		);
	}
}