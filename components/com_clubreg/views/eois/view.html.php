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
		
	private function exporteois(){			
		return $this->rendereoi();
	}
	private function rendereoi(){
	
		$user		= JFactory::getUser();
		$proceed = FALSE;		
	
		$current_model = JModelLegacy::getInstance('officialfrn', 'ClubregModel', array('ignore_request' => true));
		$current_model->setState('joomla_id',$user->get('id'));		
		
		$app		= JFactory::getApplication();
		$active	= $app->getMenu()->getActive(); // if logged in
		
		if($current_model->getPermissions('manageeoi')){
			$proceed = TRUE;
			require_once CLUBREG_CONFIGS.'config.eoi.php';
			
			require_once JPATH_COMPONENT.DS.'helpers'.DS.'clubreg.filters.php';			
			require_once JPATH_COMPONENT.DS.'helpers'.DS.'clubreg.rendertables.php';
			require_once JPATH_COMPONENT.DS.'helpers'.DS.'clubreg.pagination.php';
	
			unset($current_model);
			$current_model = JModelLegacy::getInstance('eois', 'ClubregModel', array('ignore_request' => false));
			
			$this->formaction = 'index.php?option=com_clubreg&view=eois';			
			$this->formaction_comp = 'index.php?option=com_clubreg&view=eois&format=raw';// the csv file
			$this->state		= $current_model->getState();		
			
			$configObj = new ClubRegEoiConfig();
			$eoiConfigs =  $configObj->getConfig($this->state->get('filter.playertype')); // return headings and filters			
			
			$current_model->setMoreStates($eoiConfigs["filters"]); // set more states
			
			$this->items		= $current_model->getItems();
			$this->pagination	= $current_model->getPagination();		
			
			$tmp_filters["request_data"] = $this->state;
			$tmp_filters["filter_heading"] = $eoiConfigs["filters"];	
			$tmp_filters["group_where"] = $eoiConfigs["group_where"];
			$tmp_filters["headings"] = $eoiConfigs["headings"];
			$tmp_filters["otherconfigs"] = $eoiConfigs["otherconfigs"];
			$this->entity_filters = $tmp_filters;	
			
		
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
				'a.surname' => JText::_('COM_CLUBREG_SURNAME_LABEL')." ".JText::_('COM_CLUBREG_GIVENNAME_LABEL'),
				'a.emailaddress' => JText::_('JGLOBAL_EMAIL')
	
	
		);
	}	
}