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


class ClubRegViewPayment extends ClubRegViews
{

	/**
	 * render the list of payments for that member
	 */
	protected function list_payment(){
	
		JSession::checkToken() or die(JText::_('JINVALID_TOKEN'));
	
		$this->setLayout("list.payment");
	
		require_once JPATH_COMPONENT.DS.'helpers'.DS.'clubreg.uniquekeys.php';
		require_once CLUBREG_CONFIGS.'config.payments.php';
		require_once JPATH_COMPONENT.DS.'helpers'.DS.'clubreg.rendertables.payments.php';
	
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
				
			$current_model = JModelLegacy::getInstance('payments', 'ClubregModel', array('ignore_request' => true));
			$this->items = $current_model->getPayments($user->get('id'),$this->member_id);
				
			unset($key_data);
			unset($current_model);
	
			$configObj = new ClubRegPaymentsConfig();
			$paymentsConfigs =  $configObj->getConfig("payments"); // return headings and filters
				
				
			$tmp_filters["filter_heading"] = $paymentsConfigs["filters"];
			$tmp_filters["group_where"] = $paymentsConfigs["group_where"];
			$tmp_filters["headings"] = $paymentsConfigs["headings"];
			$tmp_filters["otherconfigs"] = $paymentsConfigs["otherconfigs"];
			$this->entity_filters = $tmp_filters;
	
			unset($configObj);
			unset($tmp_filters);
				
		}
	
		return $proceed;
	}
	
	protected function detail_payment(){
	
		JSession::checkToken() or die(JText::_('JINVALID_TOKEN'));
	
		$user		= JFactory::getUser();
		$app			= JFactory::getApplication();
		$Itemid			= $app->input->post->get('Itemid');
		
		$this->setLayout("detail.payment");
	
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
			$paymentsConfigs =  $configObj->getConfig("payments"); // return headings and filters
	
	
			$tmp_filters["filter_heading"] = $paymentsConfigs["filters"];
			$tmp_filters["group_where"] = $paymentsConfigs["group_where"];
			$tmp_filters["headings"] = $paymentsConfigs["headings"];
			$tmp_filters["otherconfigs"] = $paymentsConfigs["otherconfigs"];
			$this->entity_filters = $tmp_filters;
				
			unset($configObj);
			unset($tmp_filters);
				
			$proceed = TRUE;
		}
		return $proceed;
	}
	protected function edit_payment(){
	
		JSession::checkToken() or die(JText::_('JINVALID_TOKEN'));
	
		$this->setLayout("form.payment");
	
		$user		= JFactory::getUser();
		$app			= JFactory::getApplication();
		$this->Itemid			= $app->input->post->get('Itemid');
	
		$proceed = FALSE;
		
		if($user->get('id') > 0){
			
			$current_model = JModelLegacy::getInstance('officialfrn', 'ClubregModel', array('ignore_request' => true));
			$current_model->setState('joomla_id',$user->get('id'));
			
			if(!$current_model->getPermissions('manageusers')){
				return FALSE;
			}
	
			require_once JPATH_COMPONENT.DS.'helpers'.DS.'clubreg.uniquekeys.php';
			
			
			$uKeyObject = new ClubRegUniqueKeysHelper();
			$this->uKeyObject = $uKeyObject;
	
			$proceed = TRUE;
			$key_data = new stdClass();
			unset($current_model);
			$current_model = JModelLegacy::getInstance('regmember', 'ClubregModel', array('ignore_request' => true));
			$this->member_key = $key_data->full_key = $app->input->post->getString('member_key', null);
			
			$key_data = $uKeyObject->deconstructKey($key_data);
			$this->member_id = $key_data->pk_id;
	
			unset($currentModel);
			$currentModel = JModelLegacy::getInstance('payment', 'ClubregModel', array('ignore_request' => false));
			$currentModel->setState('com_clubreg.payment.member_key',$key_data->full_key); // use the key in the model
	
			unset($key_data);$key_data = new stdClass();
			$key_data->full_key = $app->input->post->getString('payment_key', null);
	
			
			$uKeyObject->deconstructKey($key_data);
			$currentModel->setState('com_clubreg.payment.full_key',$key_data->full_key); // use the key in the model
			$currentModel->setState('com_clubreg.payment.payment_key',$key_data->string_key); // use the key in the model
			$currentModel->setState('com_clubreg.payment.payment_id',$key_data->pk_id); // use the key in the model
	
			$this->paymentForm = $currentModel->getForm();
			
			
			$this->source = $app->input->post->getString('source', null);
			$this->payments = array();
			if(!empty($this->source)){
				require_once JPATH_COMPONENT.DS.'helpers'.DS.'clubreg.renderItem.php';
				require_once CLUBREG_CONFIGS.'config.payments.php';
				$payments_model = JModelLegacy::getInstance('payments', 'ClubregModel', array('ignore_request' => true));
				$this->payments = $payments_model->getPayments($user->get('id'),$this->member_id);
				
				$configObj = new ClubRegPaymentsConfig();
				$paymentsConfigs =  $configObj->getConfig("payments"); // return headings and filters		
				
				$tmp_filters["headings"] = $paymentsConfigs["headings"];
				
				$this->entity_filters = $tmp_filters;
			}
			
		}
	
		return $proceed;
	
	}
}