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


class ClubRegViewreporting extends ClubRegViews
{
	protected function exportpayments_reporting (){
		
		
		$user		= JFactory::getUser();
		$proceed = FALSE;
		
		unset($current_model);
		
		$current_model = JModelLegacy::getInstance('officialfrn', 'ClubregModel', array('ignore_request' => true));
		$current_model->setState('joomla_id',$user->get('id'));
		
		$app		= JFactory::getApplication();
		$active	= $app->getMenu()->getActive(); // if logged in
		
		if($current_model->getPermissions('manageusers')){
			$proceed = TRUE;
			
			require_once CLUBREG_CONFIGS.'config.regmembers.php'; // used this
			require_once CLUBREG_CONFIGS.'payments.csv.php';
		
			
			require_once CLUBREG_CONFIGS.'config.payments.reporting.php'; // get the filters to render
				
			require_once JPATH_COMPONENT.DS.'helpers'.DS.'clubreg.filters.payments.reporting.php';
			require_once JPATH_COMPONENT.DS.'helpers'.DS.'clubreg.rendertables.payments.reporting.php';
			require_once JPATH_COMPONENT.DS.'helpers'.DS.'clubreg.pagination.php';
			require_once JPATH_COMPONENT.DS.'helpers'.DS.'clubreg.uniquekeys.php';
			
			require_once JPATH_COMPONENT.DS.'helpers'.DS.'clubreg.exporttable.php'; // used to render
				
			$group_type			= $app->input->post->get('playertype');
			$subgroup			= (int) $app->input->post->get('subgroup');		
				
			if(!isset($group_type)){
				$params = JComponentHelper::getParams('com_clubreg');
				$group_type = $params->get("default_playertype");
			}
			$all_groups = $current_model->getMyGroups($group_type);
				
			if(is_array($all_groups["sub_groups_ids"]) && $subgroup > 0){
				$all_groups["sub_groups_ids"][] = $subgroup;
			}
			
			unset($current_model);
			$current_model = JModelLegacy::getInstance('paymentreporting', 'ClubregModel', array('ignore_request' => false));
				
			$this->formaction = 'index.php?option=com_clubreg&view=reporting';
			$this->formaction_edit = 'index.php?option=com_clubreg&view=regmember&layout=viewonly';	
			$this->formaction_comp = 'index.php?option=com_clubreg&view=reporting&format=raw';// the csv file
				
			$this->state		= $current_model->getState();
				
			$configObj = new ClubRegRegmembersConfig();
			$configObj->setOfficialGroups($all_groups["allowed_groups"]);
			$configObj->setOfficialSubGroups($all_groups["sub_groups_ids"]);
				
			$regmembersConfigs =  $configObj->getConfig($this->state->get('filter.playertype')); // return headings and filters
				
			unset($configObj);
			
			//get the headings to display from  the display configs
			$configObj = new ClubRegPaymentsDisplayConfig();
			$headingConfigs =  $configObj->getConfig($this->state->get('filter.playertype')); // return headings and filters
			unset($configObj);
						
			$configObj = new ClubRegPaymentsConfig();
			$paymentsConfigs =  $configObj->getConfig("Payments"); // return headings and filters		
			// combine the member filters with the payment filters
			$all_filters = array_merge($regmembersConfigs["filters"],$paymentsConfigs["filters"]);
			$current_model->setMoreStates($all_filters,$all_groups); // set more states					
			
	
			$current_model->setState('list.limit', '');
			
			$this->items		= $current_model->getItems();			
			
			$tmp_filters["headings"] = $headingConfigs["headings"];	

			
				
			$this->entity_filters = $tmp_filters;
				
			$this->uKeyObject = new ClubRegUniqueKeysHelper();
			
			unset($tmp_filters);
			
			$basename = "payment.export.".time();
			$mimetype = 'text/csv';
				
			$document = JFactory::getDocument();
			$document->setMimeEncoding($mimetype);
			JResponse::setHeader('Content-disposition', 'attachment; filename="'.$basename.'.csv"; creation-date="'.JFactory::getDate()->toRFC822().'"', true);
			
				
			
		}
		
		$this->pageTitle = $active->title;
		
		return $proceed;
		
	}
}