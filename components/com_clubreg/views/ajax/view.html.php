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

class ClubRegViewAjax extends JViewLegacy
{

	
	function display($tpl = null)
	{	
		
		$app		= JFactory::getApplication();
		$user		= JFactory::getUser();
		
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

	private function eoi(){
		
		$user		= JFactory::getUser();		
		$proceed = FALSE;
		
		if($user->get('id') > 0){			
			$current_model = JModelLegacy::getInstance('officialfrn', 'ClubregModel', array('ignore_request' => true));			
			$current_model->setState('joomla_id',$user->get('id'));		
			
			if($current_model->getPermissions('manageeoi')){
				$proceed = TRUE;
				unset($current_model);
				$current_model = JModelLegacy::getInstance('eois', 'ClubregModel', array('ignore_request' => true));
				$this->howmany_senior = $current_model->getUnApproved("senior");
				$this->howmany_guardian = $current_model->getUnApproved("guardian");				
			}
			unset($current_model);
		}
		
		return $proceed;
		
	}
	private function activity(){
		$user		= JFactory::getUser();
		$proceed = FALSE;
		
		if($user->get('id') > 0){				
			$proceed = TRUE;
			unset($current_model);
			$current_model = JModelLegacy::getInstance('activity', 'ClubregModel', array('ignore_request' => true));
			$this->activity = $current_model->getActivityList($user->get('id'));	
			require_once JPATH_COMPONENT.DS.'helpers'.DS.'clubreg.uniquekeys.php';
			$this->uKeyObject = new ClubRegUniqueKeysHelper();
		}		
		return $proceed;
	}	
	/**
	 * Get and render the list of notes
	 */
	private function notes(){
		
		JSession::checkToken() or die(JText::_('JINVALID_TOKEN'));
		
		$this->setLayout("list.notes");
		
		require_once JPATH_COMPONENT.DS.'helpers'.DS.'clubreg.uniquekeys.php';
		
		$user		= JFactory::getUser();
		$app			= JFactory::getApplication();		
		$Itemid			= $app->input->post->get('Itemid');
		
		$proceed = FALSE;
		if($user->get('id') > 0){
			$proceed = TRUE;
			$key_data = new stdClass();
			unset($current_model);
			$current_model = JModelLegacy::getInstance('regmember', 'ClubregModel', array('ignore_request' => true));
			$key_data->full_key = $app->input->post->getString('member_key', null);
			$current_model->processKey($key_data);			
			
			unset($current_model);
			$note_type = $app->input->post->getString('note_type', 'member');
			$current_model = JModelLegacy::getInstance('notes', 'ClubregModel', array('ignore_request' => true));
			$this->notes = $current_model->getNotes($user->get('id'),$key_data->member_id,$note_type);
			$this->uKeyObject = new ClubRegUniqueKeysHelper();
			unset($key_data);
			
			
		}
		return $proceed;		
	}
	/**
	 * render the payment form
	 * @return boolean
	 */
	private function payment(){
		
		JSession::checkToken() or die(JText::_('JINVALID_TOKEN'));
		
		$this->setLayout("form.payment");
		
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
	/**
	 * render the list of payments for that member
	 */
	private function payments(){
		
		JSession::checkToken() or die(JText::_('JINVALID_TOKEN'));
		
		$this->setLayout("list.payments");
		
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
	private function emergency(){
	
		JSession::checkToken() or die(JText::_('JINVALID_TOKEN'));
	
		$user		= JFactory::getUser();
		$app			= JFactory::getApplication();
		$Itemid			= $app->input->post->get('Itemid');
		
		$this->setLayout("form.emergency");
	
		$proceed = FALSE;
		if($user->get('id') > 0){
				
			require_once JPATH_COMPONENT.DS.'helpers'.DS.'clubreg.uniquekeys.php';
				
			$proceed = TRUE;
			$key_data = new stdClass();
			
			$key_data->full_key = $app->input->post->getString('member_key', null);			
			$this->uKeyObject = new ClubRegUniqueKeysHelper();				
			$this->uKeyObject->deconstructKey($key_data);
			
			unset($currentModel);
			$currentModel = JModelLegacy::getInstance('emergency', 'ClubregModel', array('ignore_request' => false));
			$currentModel->setState('com_clubreg.emergency.member_id',$key_data->pk_id); // use the key in the model			
			$currentModel->setState('com_clubreg.emergency.member_key',$key_data->full_key); // use the key in the model
			
			$this->emergencyForm = $currentModel->getForm();
		}
	
		return $proceed;
	
	}
	
	private function other(){
	
		JSession::checkToken() or die(JText::_('JINVALID_TOKEN'));
		
		$this->setLayout("form.other");
	
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
				
			unset($currentModel);
			$currentModel = JModelLegacy::getInstance('other', 'ClubregModel', array('ignore_request' => false));
			$currentModel->setState('com_clubreg.other.member_id',$key_data->pk_id); // use the key in the model
			$currentModel->setState('com_clubreg.other.member_key',$key_data->full_key); // use the key in the model
			
			require_once CLUBREG_ADMINPATH.'/helpers/clubregControls.php';
			JForm::addFieldPath(CLUBREG_ADMINPATH.'/models/fields');
			$this->extradetails = ClubRegControlsHelper::configOptions(CLUB_PLAYER_DETAILS); // controls				
			
			$this->otherForm = $currentModel->getForm();
			$this->otherValues = $currentModel->get('otherValues');
			
			
		}
	
		return $proceed;
	
	}
	
	private function children(){
	
		JSession::checkToken() or die(JText::_('JINVALID_TOKEN'));
		require_once JPATH_COMPONENT.DS.'helpers'.DS.'clubreg.uniquekeys.php';
		require_once JPATH_COMPONENT.DS.'helpers'.DS.'clubreg.rendertables.children.php';
		require_once CLUBREG_CONFIGS.'config.profile.php';
		//require_once JPATH_COMPONENT.DS.'helpers'.DS.'clubreg.rendertables.payments.php';
		
		$user		= JFactory::getUser();
		$app			= JFactory::getApplication();
		$Itemid			= $app->input->post->get('Itemid');
		
		$proceed = FALSE;
		if($user->get('id') > 0){
			$proceed = TRUE;
			$key_data = new stdClass();
			unset($current_model);
			
			$key_data = new stdClass();
			unset($current_model);
			$current_model = JModelLegacy::getInstance('regmember', 'ClubregModel', array('ignore_request' => true));
			$this->parent_key = $key_data->full_key = $app->input->post->getString('parent_key', null); // parent id
				
			$this->uKeyObject = new ClubRegUniqueKeysHelper();
				
			$this->uKeyObject->deconstructKey($key_data);
			$current_model->member_id = $key_data->pk_id;
			$this->items = $current_model->getJuniorDetails($key_data->pk_id);			
			
			$configObj = new ClubRegProfileConfig();
			$parentConfigs =  $configObj->getConfig("guardian"); // return headings which hold config details			
			$tmp_filters["headings"] = $parentConfigs["headings"]["children_p"];
			
			$this->entity_filters = $tmp_filters;	
			
			unset($current_model);unset($tmp_filters);
		}
		
		return $proceed;
	}
	

	
}