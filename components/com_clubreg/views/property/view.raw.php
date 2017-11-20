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

	/**
	 * render the list of property for that member
	 */
	protected function list_property(){
	
		JSession::checkToken() or die(JText::_('JINVALID_TOKEN'));
	
		$this->setLayout("list.property");
	
		require_once JPATH_COMPONENT.DS.'helpers'.DS.'clubreg.uniquekeys.php';
		require_once CLUBREG_CONFIGS.'config.propertys.php';
		require_once JPATH_COMPONENT.DS.'helpers'.DS.'clubreg.rendertables.propertys.php';
	
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
	
			$current_model = JModelLegacy::getInstance('propertys', 'ClubregModel', array('ignore_request' => true));
			$this->items = $current_model->getPropertys($user->get('id'),$this->member_id);
	
			unset($key_data);
			unset($current_model);
	
			$configObj = new ClubRegPropertysConfig();
			$propertysConfigs =  $configObj->getConfig("propertys"); // return headings and filters
	
	
			$tmp_filters["filter_heading"] = $propertysConfigs["filters"];
			$tmp_filters["group_where"] = $propertysConfigs["group_where"];
			$tmp_filters["headings"] = $propertysConfigs["headings"];
			$tmp_filters["otherconfigs"] = $propertysConfigs["otherconfigs"];
			$this->entity_filters = $tmp_filters;
	
			unset($configObj);
			unset($tmp_filters);
	
		}
	
		return $proceed;
	}
	protected function detail_property(){
	
		JSession::checkToken() or die(JText::_('JINVALID_TOKEN'));
	
		$user		= JFactory::getUser();
		$app			= JFactory::getApplication();
		$Itemid			= $app->input->post->get('Itemid');
	
		$this->setLayout("detail.property");
	
		$proceed = FALSE;
		if($user->get('id') > 0){
	
			require_once JPATH_COMPONENT.DS.'helpers'.DS.'clubreg.uniquekeys.php';
			require_once CLUBREG_CONFIGS.'config.propertys.php';
			require_once JPATH_COMPONENT.DS.'helpers'.DS.'clubreg.rendertables.propertys.php';
			$this->uKeyObject = new ClubRegUniqueKeysHelper();
			$key_data = new stdClass();
	
			$this->member_key = $key_data->full_key = $app->input->post->getString('member_key', null);
			$this->uKeyObject->deconstructKey($key_data);
			$this->member_id = $key_data->pk_id;
			unset($key_data);
	
			$key_data = new stdClass();
			$key_data->full_key = $app->input->post->getString('property_key', null);
			$this->uKeyObject->deconstructKey($key_data);
	
			unset($current_model);
	
			$current_model = JModelLegacy::getInstance('propertys', 'ClubregModel', array('ignore_request' => true));
	
			$current_model->setState('com_clubreg.propertys.full_key',$key_data->full_key); // use the key in the model
			$current_model->setState('com_clubreg.propertys.property_key',$key_data->string_key); // use the key in the model
			$current_model->setState('com_clubreg.propertys.property_id',$key_data->pk_id); // use the key in the model
	
			$this->items = $current_model->getPropertys($user->get('id'),$this->member_id);
	
			$current_model->setState('com_clubreg.propertys.full_key',NULL); // use the key in the model
			$current_model->setState('com_clubreg.propertys.property_key',NULL); // use the key in the model
			$current_model->setState('com_clubreg.propertys.property_id',NULL); // use the key in the model
	
			unset($key_data);
			unset($current_model);
	
			$configObj = new ClubRegPropertysConfig();
			$propertysConfigs =  $configObj->getConfig("propertys"); // return headings and filters
	
	
			$tmp_filters["filter_heading"] = $propertysConfigs["filters"];
			$tmp_filters["group_where"] = $propertysConfigs["group_where"];
			$tmp_filters["headings"] = $propertysConfigs["headings"];
			$tmp_filters["otherconfigs"] = $propertysConfigs["otherconfigs"];
			$this->entity_filters = $tmp_filters;
	
			unset($configObj);
			unset($tmp_filters);
	
			$proceed = TRUE;
		}
		return $proceed;
	}
	
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