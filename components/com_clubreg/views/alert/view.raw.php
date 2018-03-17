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


class ClubRegViewAlert extends ClubRegViews
{	
	
	protected function edit_alert(){
	
		JSession::checkToken() or die(JText::_('JINVALID_TOKEN'));
	
		$user		= JFactory::getUser();
		$app			= JFactory::getApplication();
		$Itemid			= $app->input->post->get('Itemid');
		$formType	= "";
		
		$source_page = $app->input->post->getString('source_page', null);
		
		$this->setLayout("form.alert");
		
		$proceed = FALSE;
		if($user->get('id') > 0){
		
			require_once JPATH_COMPONENT.DS.'helpers'.DS.'clubreg.uniquekeys.php';
		
			$proceed = TRUE;
			$key_data = new stdClass();
			unset($current_model);
			$current_model = JModelLegacy::getInstance('regmember', 'ClubregModel', array('ignore_request' => true));
			$this->member_key =  $key_data->full_key = $app->input->post->getString('member_key', null);
		
			$uKeyObject = new ClubRegUniqueKeysHelper();
			$uKeyObject->deconstructKey($key_data);
			$this->member_id = $key_data->pk_id;
			
			$this->uKeyObject = $uKeyObject;
			
			
			unset($currentModel);
			$currentModel = JModelLegacy::getInstance('alert', 'ClubregModel', array('ignore_request' => false));
			
			
			$currentModel->setState('com_clubreg.alert.member_key',$key_data->full_key); // use the key in the model
			
			$this->member_key = $key_data->full_key;
		
			unset($key_data);$key_data = new stdClass();
			$key_data->full_key = $app->input->post->getString('alert_key', null);
		
			$uKeyObject = new ClubRegUniqueKeysHelper();
			$uKeyObject->deconstructKey($key_data);
			$currentModel->setState('com_clubreg.alert.full_key',$key_data->full_key); // use the key in the model
			$currentModel->setState('com_clubreg.alert.alert_key',$key_data->string_key); // use the key in the model
			$currentModel->setState('com_clubreg.alert.alert_id',$key_data->pk_id); // use the key in the model
			
			$currentModel->setState('com_clubreg.alert.form_type',$formType); // use the key in the model		
					
			$this->alertForm = $currentModel->getForm();	

			
		 	unset($currentModel);
			$currentModel = JModelLegacy::getInstance('alerts', 'ClubregModel', array('ignore_request' => false));
			$this->alerts = $currentModel->getAlerts(1,$this->member_id ); 
				
			
			
		}
		
		return $proceed;
	}
}