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

class ClubRegViewContactlist extends ClubRegViews{	

	protected  function list_contactlist(){
		
		JSession::checkToken() or die(JText::_('JINVALID_TOKEN'));
	
		$this->setLayout("list.contactlist");
	
		require_once JPATH_COMPONENT.DS.'helpers'.DS.'clubreg.uniquekeys.php';
		require_once CLUBREG_CONFIGS.'config.contactlists.php';
		require_once JPATH_COMPONENT.DS.'helpers'.DS.'clubreg.rendertables.contactlists.php';
	
		$user		= JFactory::getUser();
		$app			= JFactory::getApplication();
		$Itemid			= $app->input->post->get('Itemid');
	
		$proceed = FALSE;
		if($user->get('id') > 0){
			$proceed = TRUE;
			$key_data = new stdClass();
			unset($current_model);
			$current_model = JModelLegacy::getInstance('regmember', 'ClubregModel', array('ignore_request' => true));
			$this->member_key = $key_data->full_key = $app->input->post->getString('member_key', null);
	
			$this->uKeyObject = new ClubRegUniqueKeysHelper();
	
			$this->uKeyObject->deconstructKey($key_data);
			$this->member_id = $key_data->pk_id;
	
			unset($current_model);
	
			$current_model = JModelLegacy::getInstance('contactlists', 'ClubregModel', array('ignore_request' => true));
			$this->items = $current_model->getContactlists($user->get('id'),$this->member_id);
	
			unset($key_data);
			unset($current_model);
	
			$configObj = new ClubRegContactlistsConfig();
			$contactlistsConfigs =  $configObj->getConfig("contactlists"); // return headings and filters
	
	
			$tmp_filters["filter_heading"] = $contactlistsConfigs["filters"];
			$tmp_filters["group_where"] = $contactlistsConfigs["group_where"];
			$tmp_filters["headings"] = $contactlistsConfigs["headings"];
			$tmp_filters["otherconfigs"] = $contactlistsConfigs["otherconfigs"];
			$this->entity_filters = $tmp_filters;
	
			unset($configObj);
			unset($tmp_filters);
	
		}
	
		return $proceed;
	
		
	}
	
	protected function edit_contactlist(){
	
		JSession::checkToken() or die(JText::_('JINVALID_TOKEN'));
	
		$this->setLayout("form.contactlist");
	
		$user		= JFactory::getUser();
		$app			= JFactory::getApplication();
		$Itemid			= $app->input->post->get('Itemid');
	
		$proceed = FALSE;
		if($user->get('id') > 0){
	
			require_once JPATH_COMPONENT.DS.'helpers'.DS.'clubreg.uniquekeys.php';
	
			$proceed = TRUE;
			$key_data = new stdClass();
			unset($current_model);
			$current_model = JModelLegacy::getInstance('regmember', 'ClubregModel', array('ignore_request' => true));
			$key_data->full_key = $app->input->post->getString('member_key', null);
	
			unset($currentModel);
			$currentModel = JModelLegacy::getInstance('contactlist', 'ClubregModel', array('ignore_request' => false));
			$currentModel->setState('com_clubreg.contactlist.member_key',$key_data->full_key); // use the key in the model
	
			unset($key_data);$key_data = new stdClass();
			$key_data->full_key = $app->input->post->getString('contactlist_key', null);
	
			$uKeyObject = new ClubRegUniqueKeysHelper();
			$uKeyObject->deconstructKey($key_data);
			$currentModel->setState('com_clubreg.contactlist.full_key',$key_data->full_key); // use the key in the model
			$currentModel->setState('com_clubreg.contactlist.contactlist_key',$key_data->string_key); // use the key in the model
			$currentModel->setState('com_clubreg.contactlist.contactlist_id',$key_data->pk_id); // use the key in the model
			
			$this->contactlistForm = $currentModel->getForm();
	
	
		}
	
		return $proceed;
	
	}

}