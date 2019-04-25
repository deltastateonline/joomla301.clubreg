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


class ClubRegViewRelationships extends ClubRegViews
{

	/**
	 * render the list of payments for that member
	 */
	protected function list_relationships(){
	
		JSession::checkToken() or die(JText::_('JINVALID_TOKEN'));
	
		$this->setLayout("list.relationships");
	
		require_once JPATH_COMPONENT.DS.'helpers'.DS.'clubreg.uniquekeys.php';
		require_once CLUBREG_CONFIGS.'config.relationships.php';
		require_once JPATH_COMPONENT.DS.'helpers'.DS.'clubreg.rendertables.relationships.php';
	
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
				
			$current_model = JModelLegacy::getInstance('relationships', 'ClubregModel', array('ignore_request' => true));
			$this->items = $current_model->getRelationships($user->get('id'),$this->member_id);
				
			unset($key_data);
			unset($current_model);
	
			$configObj = new ClubRegRelationshipsConfig();
			$relationshipsConfigs =  $configObj->getConfig("relationships"); // return headings and filters
				
				
			$tmp_filters["filter_heading"] = $relationshipsConfigs["filters"];
			$tmp_filters["group_where"] = $relationshipsConfigs["group_where"];
			$tmp_filters["headings"] = $relationshipsConfigs["headings"];
			$tmp_filters["otherconfigs"] = $relationshipsConfigs["otherconfigs"];
			$this->entity_filters = $tmp_filters;
	
			unset($configObj);
			unset($tmp_filters);
				
		}
	
		return $proceed;
	}
	
	/**
	 * Searching for a club member
	 * @return boolean
	 */
	protected function profiles_relationships(){
		
		JSession::checkToken() or die(JText::_('JINVALID_TOKEN'));
		
		$this->setLayout("list.profiles");		
		
		$user		= JFactory::getUser();
		$app			= JFactory::getApplication();
		$Itemid			= $app->input->post->get('Itemid');
		
		
		$proceed = FALSE;
		if($user->get('id') > 0){
				
			require_once JPATH_COMPONENT.DS.'helpers'.DS.'clubreg.uniquekeys.php';
				
			$proceed = TRUE;
			$key_data = new stdClass();
				
			$this->member_key = $key_data->full_key = $app->input->post->getString('member_key', null);
			$this->uKeyObject = new ClubRegUniqueKeysHelper();
			$this->uKeyObject->deconstructKey($key_data);
				
			$search_value = $app->input->post->getString('search_value', null);
			$start_value = $app->input->post->getString('startList', 0);
				
			$current_model = JModelLegacy::getInstance('relationships', 'ClubregModel', array('ignore_request' => true));
			
			$current_model->setState('com_clubreg.relationships.search_value',$search_value);
			$current_model->setState('com_clubreg.relationships.start_value',$start_value);
			$this->items = $current_model->getSearchPlayers();
				
			$proceed = TRUE;
		}
		
		return $proceed;
		
	}
	
	protected function detail_relationships(){
	
		JSession::checkToken() or die(JText::_('JINVALID_TOKEN'));
	
		$user		= JFactory::getUser();
		$app			= JFactory::getApplication();
		$Itemid			= $app->input->post->get('Itemid');
		
		$this->setLayout("detail.relationships");
	
		$proceed = FALSE;
		if($user->get('id') > 0){
				
			require_once JPATH_COMPONENT.DS.'helpers'.DS.'clubreg.uniquekeys.php';
			require_once CLUBREG_CONFIGS.'config.payments.php';
			require_once JPATH_COMPONENT.DS.'helpers'.DS.'clubreg.rendertables.payments.php';
			$this->uKeyObject = new ClubRegUniqueKeysHelper();
			$key_data = new stdClass();
				
			$this->member_key = $key_data->full_key = $app->input->post->getString('member_key', null);
			$this->uKeyObject->deconstructKey($key_data);
			$this->member_id = $key_data->pk_id;
			unset($key_data);
				
			$key_data = new stdClass();
			$key_data->full_key = $app->input->post->getString('payment_key', null);
			$this->uKeyObject->deconstructKey($key_data);
				
			unset($current_model);
	
			$current_model = JModelLegacy::getInstance('payments', 'ClubregModel', array('ignore_request' => true));
				
			$current_model->setState('com_clubreg.payments.full_key',$key_data->full_key); // use the key in the model
			$current_model->setState('com_clubreg.payments.payment_key',$key_data->string_key); // use the key in the model
			$current_model->setState('com_clubreg.payments.payment_id',$key_data->pk_id); // use the key in the model
				
			$this->items = $current_model->getPayments($user->get('id'),$this->member_id);
				
			$current_model->setState('com_clubreg.payments.full_key',NULL); // use the key in the model
			$current_model->setState('com_clubreg.payments.payment_key',NULL); // use the key in the model
			$current_model->setState('com_clubreg.payments.payment_id',NULL); // use the key in the model
	
			unset($key_data);
			unset($current_model);
				
			$configObj = new ClubRegPaymentsConfig();
			$relationshipsConfigs =  $configObj->getConfig("relationships"); // return headings and filters
	
	
			$tmp_filters["filter_heading"] = $relationshipsConfigs["filters"];
			$tmp_filters["group_where"] = $relationshipsConfigs["group_where"];
			$tmp_filters["headings"] = $relationshipsConfigs["headings"];
			$tmp_filters["otherconfigs"] = $relationshipsConfigs["otherconfigs"];
			$this->entity_filters = $tmp_filters;
				
			unset($configObj);
			unset($tmp_filters);
				
			$proceed = TRUE;
		}
		return $proceed;
	}
	
	protected function edit_relationships(){
	
		JSession::checkToken() or die(JText::_('JINVALID_TOKEN'));
	
		$this->setLayout("form.relationships");
	
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
			$currentModel = JModelLegacy::getInstance('payment', 'ClubregModel', array('ignore_request' => false));
			$currentModel->setState('com_clubreg.payment.member_key',$key_data->full_key); // use the key in the model
	
			unset($key_data);$key_data = new stdClass();
			$key_data->full_key = $app->input->post->getString('payment_key', null);
	
			$uKeyObject = new ClubRegUniqueKeysHelper();
			$uKeyObject->deconstructKey($key_data);
			$currentModel->setState('com_clubreg.payment.full_key',$key_data->full_key); // use the key in the model
			$currentModel->setState('com_clubreg.payment.payment_key',$key_data->string_key); // use the key in the model
			$currentModel->setState('com_clubreg.payment.payment_id',$key_data->pk_id); // use the key in the model
	
			$this->paymentForm = $currentModel->getForm();
		}
	
		return $proceed;
	
	}
}