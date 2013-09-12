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


class ClubRegViewEmergency extends ClubRegViews
{

	protected function list_emergency(){
		JSession::checkToken() or die(JText::_('JINVALID_TOKEN'));
	
		$this->setLayout("details.emergency");
	
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
			$currentModel = JModelLegacy::getInstance('emergency', 'ClubregModel', array('ignore_request' => false));
			$currentModel->setState('com_clubreg.emergency.member_id',$key_data->pk_id); // use the key in the model
			$currentModel->setState('com_clubreg.emergency.member_key',$key_data->full_key); // use the key in the model
	
			$this->emergencyForm = $currentModel->getForm();
		}
	
		return $proceed;
	}
	
	protected function edit_emergency(){
	
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

}