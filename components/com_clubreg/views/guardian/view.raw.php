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


class ClubRegViewGuardian extends ClubRegViews
{

	protected function list_guardian(){
		
		JSession::checkToken() or die(JText::_('JINVALID_TOKEN'));
		
		$user		= JFactory::getUser();
		$app			= JFactory::getApplication();
		$Itemid			= $app->input->post->get('Itemid');
		
		$this->setLayout("list.guardian");
		
		$proceed = FALSE;
		if($user->get('id') > 0){
			
			require_once JPATH_COMPONENT.DS.'helpers'.DS.'clubreg.uniquekeys.php';
			
			$proceed = TRUE;
			$key_data = new stdClass();
			
			$this->member_key = $key_data->full_key = $app->input->post->getString('member_key', null);
			$this->uKeyObject = new ClubRegUniqueKeysHelper();
			$this->uKeyObject->deconstructKey($key_data);
			
			$search_value = $app->input->post->getString('search_value', null);
			
			$current_model = JModelLegacy::getInstance('regmembers', 'ClubregModel', array('ignore_request' => true));
			$current_model->setState('com_clubreg.regmembers.member_id',$key_data->pk_id);
			$current_model->setState('com_clubreg.regmembers.search_value',$search_value);
			$this->all_guardians = $current_model->getGuardians();		
			
			$proceed = TRUE;
		}
		
		return $proceed;
		
	}
	
	protected function details_guardian(){
		
		JSession::checkToken() or die(JText::_('JINVALID_TOKEN'));
		
		$this->setLayout("details.guardian");
		
		$user		= JFactory::getUser();
		$app			= JFactory::getApplication();
		$Itemid			= $app->input->post->get('Itemid');
		
		$proceed = FALSE;
		if($user->get('id') > 0){
		
			require_once JPATH_COMPONENT.DS.'helpers'.DS.'clubreg.uniquekeys.php';
		
			$proceed = TRUE;
			$key_data = new stdClass();
		
			$key_data->full_key = $app->input->post->getString('member_key', null);
			$this->uKeyObject = new ClubRegUniqueKeysHelper();
			$this->uKeyObject->deconstructKey($key_data);
			
			$current_model = JModelLegacy::getInstance('regmember', 'ClubregModel', array('ignore_request' => true));
			$current_model->setState('com_clubreg.regmember.member_id',$key_data->pk_id);
			$this->member_data = $current_model->getParentDetails();
			
			require_once JPATH_COMPONENT.DS.'helpers'.DS.'clubreg.renderItem.php';
			require_once CLUBREG_CONFIGS.'config.profile.php';
			$configObj = new ClubRegProfileConfig();
			$this->profileConfigs =  $configObj->getConfig("childguardian"); // return headings which hold config details
			$this->itemRenderer = new ClubRegRenderItemHelper(); // used to render individual items			
		
			unset($currentModel);
			
		}		
		return $proceed;		
	}

}