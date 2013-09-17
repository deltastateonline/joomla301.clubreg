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


class ClubRegViewProperty extends ClubRegViews
{	
	protected function edit_property(){
	
		JSession::checkToken() or die(JText::_('JINVALID_TOKEN'));
	
		$this->setLayout("form.property");
	
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
			$currentModel = JModelLegacy::getInstance('property', 'ClubregModel', array('ignore_request' => false));
			$currentModel->setState('com_clubreg.property.member_key',$key_data->full_key); // use the key in the model
	
			unset($key_data);$key_data = new stdClass();
			$key_data->full_key = $app->input->post->getString('property_key', null);
	
			$uKeyObject = new ClubRegUniqueKeysHelper();
			$uKeyObject->deconstructKey($key_data);
			$currentModel->setState('com_clubreg.property.full_key',$key_data->full_key); // use the key in the model
			$currentModel->setState('com_clubreg.property.property_key',$key_data->string_key); // use the key in the model
			$currentModel->setState('com_clubreg.property.property_id',$key_data->pk_id); // use the key in the model
			
			$this->propertyForm = $currentModel->getForm();
		}	
		return $proceed;	
	}
	

}