<?php
/*------------------------------------------------------------------------
# com_clubreg - Manage Club Member Registrations
# ------------------------------------------------------------------------
# author    Omokhoa Agbagbara
# copyright Copyright (C) 2013 applications.deltastateonline.com. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://applications.deltastateonline.com
# Technical Support:  email - joomla@deltastateonline.com
-------------------------------------------------------------------------*/
defined('_JEXEC') or die;
class ClubregControllerRegmember extends JControllerLegacy
{
	
	public function __construct($config = array())
	{		
		require_once JPATH_COMPONENT_ADMINISTRATOR.DS.'helpers'.DS.'clubreg.php';
		require_once JPATH_COMPONENT.DS.'helpers'.DS.'clubreg.uniquekeys.php';
		parent::__construct($config);
		
		$this->registerTask('savemember', 'savemember');		
		$this->uKeyObject = new ClubRegUniqueKeysHelper(10);
		
	}	

	
	public function savemember(){

		
		JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));
		$app    = JFactory::getApplication();
		$user		= JFactory::getUser();
		
		$return_array["proceed"] =   $return_array["canSave"]  = $isNew = FALSE;
		$data = $this->input->post->get('jform', array(), 'array');
		$key_data = new stdClass();
		
		$key_data->full_key = $this->input->post->get('pk', NULL, 'string');		
		$this->uKeyObject->deconstructKey($key_data);
		
		
		if(strlen($key_data->string_key) < 5){
			$data["member_key"] = $this->uKeyObject->getUniqueKey();
			$return_array["canSave"] = TRUE;
		}

		if($key_data->string_key == $data["member_key"]){
			$return_array["canSave"] = TRUE;
		}
		
		if(intval($key_data->pk_id) == 0 || intval($data["member_id"])== 0){
			$isNew = TRUE;
		}
		
		if($isNew){			
			
			$data["member_key"] = $this->uKeyObject->getUniqueKey();			
			$data["created_by"]  =  $user->id;
			$data["created"]  = date('Y-m-d H:i:s');
			$data["member_status"]  = "registered";
			$data["year_registered"]  = date('Y');
			$data["member_id"]  = null;
			
			$return_array["canSave"] = TRUE;
		}
		
		if($return_array["canSave"]){
			$current_model = JModelLegacy::getInstance('regmember', 'ClubregModel', array('ignore_request' => true));
			$return_array["proceed"] = $current_model->save($data);
			
			if($isNew){
				$return_array["member_id"] = $current_model->get("member_id");
				$return_array["member_key"] = $current_model->get("member_key");
				
				$return_array["pk"] = $this->uKeyObject->constructKey($return_array["member_id"],$return_array["member_key"]);
				$return_array["isnew"] = $isNew;
			}
			
			if(!$return_array["proceed"]){
				$return_array["msg"][] =  $current_model->getError();
			}
		}else{
			$return_array["msg"][] =  JText::_('CLUBREG_NOTAUTH');
		}
		
		
		
		if($return_array["proceed"]){		
			$return_array["msg"][] =  JText::_('COM_CLUBREG_DETAILS_UPDATE');
		}else{
			
				
		}
		
		unset($current_model);unset($key_data);
		echo json_encode($return_array);
		
		unset($return_array);
		$app->close();		
	}
	
	public function savepayment(){
		
		JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));		
		
	
		$app    = JFactory::getApplication();
		$user		= JFactory::getUser();
		
		$proceed = FALSE;
		$data = $this->input->post->get('jform', array(), 'array');		
		
		unset($current_model);
		$key_data = new stdClass();
		$current_model = JModelLegacy::getInstance('regmember', 'ClubregModel', array('ignore_request' => true));
		$key_data->full_key = $data['member_key'];
		$current_model->processKey($key_data);
		$data["member_id"] = $key_data->member_id;		
		$data["created_by"] = $user->get('id');		
		
		unset($current_model);unset($key_data);
		$key_data = new stdClass();
		$current_model = JModelLegacy::getInstance('payment', 'ClubregModel', array('ignore_request' => true));
		$key_data->full_key = $data['payment_key'];
		$this->uKeyObject->deconstructKey($key_data);	
		
		$isNew = FALSE;
		$data["payment_key"] = $key_data->string_key;
		$data["payment_id"] = $key_data->pk_id;
		
		if($key_data->pk_id > 0 && strlen($key_data->string_key) == 0){
			$data["payment_key"] =  $this->uKeyObject->getUniqueKey();
		}else if($key_data->pk_id == 0){
			$data["payment_key"] =  $this->uKeyObject->getUniqueKey();
			$data["payment_id"] = NULL;
			$isNew = TRUE;						
		}
		
		$data["payment_amount"] *= FACTOR; 
		$current_model->setState('com_clubreg.payment.isnew',$isNew);		
		$proceed = $current_model->save($data);
		
		$return_array = array();
		$return_array["proceed"] = $proceed;
		$return_array["isNew"] = $isNew;
		
		if($proceed){
			$return_array["payment_id"] =$current_model->get("payment_id");
		}else{
			$return_array["msg"] =  $current_model->getError();		
		}		
		
		unset($current_model);unset($key_data);
		echo json_encode($return_array);
		
		$app->close();
		
	}
	
	
}