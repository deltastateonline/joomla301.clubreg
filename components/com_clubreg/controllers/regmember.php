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
		
		$return_array = array();
		$return_array["proceed"] =  FALSE;
		$return_array["msg"] = array();
		
		try{
			
			if(!($user->get('id') > 0 )){
				throw new Exception(JText::_('CLUBREG_NOTAUTH'));
			}
			$current_model = JModelLegacy::getInstance('officialfrn', 'ClubregModel', array('ignore_request' => true));
			$current_model->setState('joomla_id',$user->get('id'));
		
			if(!$current_model->getPermissions('manageusers')){
				throw new Exception(JText::_('CLUBREG_NOTAUTH'));
			}
			
			$return_array["canSave"]  = $isNew = FALSE;
			
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
			
			
			if($isNew){ // set some default properties
					
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
					
				if($return_array["proceed"]){
			
					if($isNew){
						$return_array["member_id"] = $current_model->get("member_id");
						$return_array["member_key"] = $current_model->get("member_key");
			
						$return_array["pk"] = $this->uKeyObject->constructKey($return_array["member_id"],$return_array["member_key"]);
						$return_array["isnew"] = $isNew;
					}
			
					unset($current__em_model);
					$emergencyData = isset($data["emergency"])?$data["emergency"]:FALSE;
					if(is_array($emergencyData)){
						$current__em_model = JModelLegacy::getInstance('emergency', 'ClubregModel', array('ignore_request' => true));
						$current__em_model->setState('com_clubreg.emergency.member_id',$current_model->get("member_id") );
						$proceed = $current__em_model->save($emergencyData);
					}
			
				}else{
					$return_array["msg"][] =  $this->errorFromModel($current_model);					
					throw new Exception(JText::_('Not Updated'));
				}
					
			}
			
			$return_array["msg"][] =  JText::_('COM_CLUBREG_DETAILS_UPDATE');
			$return_array["proceed"] =  TRUE;
			
			
		} catch (Exception $e) {
			$return_array["proceed"] =  FALSE; 
			$return_array["msg"][] = JText::_($e->getMessage());
		}
		
		unset($current_model);unset($key_data);
		echo json_encode($return_array);
		
		unset($return_array);
		$app->close();
	}
	
	private function errorFromModel(&$d_model){
	
		$errors	= $d_model->getErrors();
	
		$error_str = array();
		for ($i = 0, $n = count($errors); $i < $n; $i++){
			if ($errors[$i] instanceof Exception){
				$error_str[] = $errors[$i]->getMessage();
			} else {
				$error_str[] = $errors[$i];
			}
		}
	
		return $error_str;
	}
}