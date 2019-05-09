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
class ClubregControllerRelationships extends JControllerLegacy
{
	
	public function __construct($config = array())
	{		
		require_once JPATH_COMPONENT_ADMINISTRATOR.DS.'helpers'.DS.'clubreg.php';
		require_once JPATH_COMPONENT.DS.'helpers'.DS.'clubreg.uniquekeys.php';
		parent::__construct($config);
		/* $this->registerTask('deletenote', 'processnote');		
		$this->registerTask('locknote', 'processnote');
		$this->registerTask('savenote', 'savenote');
		
		$this->registerTask('savepayment', 'savepayment');
		$this->registerTask('saveemergency', 'saveemergency');
		$this->registerTask('saveother', 'saveother');		
		$this->registerTask('assignguardian', 'assignguardian');
		
		$this->registerTask('saveattachment', 'saveattachment');
		$this->registerTask('deleteattachment', 'processattachment');
		$this->registerTask('lockattachment', 'processattachment');	
		
		$this->registerTask('saveproperty', 'saveproperty');
		
		$this->registerTask('savecontactlist', 'savecontactlist');	
		$this->registerTask('deletecontactlist', 'processcontactlist'); */
		
		$this->uKeyObject = new ClubRegUniqueKeysHelper(10);
		
	}	
	/**
	 * member_id   -> relationship_id
	 *             -> relationship_id
	 *             -> relationship_id
	 */
	public function saverelationships(){

		
		JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));
		$app    = JFactory::getApplication();
		$user		= JFactory::getUser();
		$return_array = $data = array();		
		$proceed = TRUE;		
		
		
		try {
		   
		
		
		    $data["relationship_tag"] = $app->input->post->getString('relationship_value', NULL);	
    		
		    if(!in_array($data["relationship_tag"], array('spouse','child','parent'))){
    		    throw new Exception(JText::_('COM_CLUBREG_NOUPDATE'));
    		}
    		
    		// constant
    		$key_data = new stdClass();
    		$key_data->full_key = $app->input->post->getString('member_key', NULL);	
    		$this->uKeyObject->deconstructKey($key_data);
    		
    		$data["member_key"] = $key_data->string_key;
    		$data["member_id"] = $key_data->pk_id;
    		
    		//variable
    		$key_data = new stdClass();
    		$key_data->full_key = $app->input->post->getString('relationship_key', NULL);
    		$this->uKeyObject->deconstructKey($key_data);
    		
    		$data["relationship_key"] = $key_data->string_key;
    		$data["member2_id"] = $key_data->pk_id;
    		
    		$data["created_by"] = $user->get('id');	
    		
    		unset($current_model);
    		$current_model = JModelLegacy::getInstance('relationship', 'ClubregModel', array('ignore_request' => true));
    		$isNew = TRUE;
    		$current_model->setState('com_clubreg.relationship.isnew',$isNew);	
    		$return_array["proceed"] = $current_model->save($data);
    		
    		$return_array = $data;
    		
    		$this->error_from_model($current_model);
    		
    		/* unset($current_model);
    		$current_model = JModelLegacy::getInstance('regmember', 'ClubregModel', array('ignore_request' => true));
    		$key_data->full_key = $data['member_key'];
    		$current_model->processKey($key_data);
    		$data["primary_id"] = $key_data->member_id;		
    		$data["note_key"] =  FALSE;
    		$data["created_by"] = $user->get('id');
    		if(!isset($data["note_status"])){
    			$data["note_status"] = '0';
    		}
    		
    		
    		
    		
    		
    		unset($current_model);
    		$current_model = JModelLegacy::getInstance('note', 'ClubregModel', array('ignore_request' => true));
    		$proceed = $current_model->save($data);
    		if($proceed){
    			$return_array["msg"] = "Notes Added."; 
    		}else{
    			$return_array["msg"] = $this->error_from_model($current_model);
    		}
    		 */
    		
    		$return_array["proceed"] = $proceed;
    		
		} catch (Exception $e) {
		    
		    $return_array["proceed"] =   FALSE;
		    $return_array["msg"][] = JText::_($e->getMessage());
		}
    		
		
		echo json_encode($return_array); 
		
		$app->close();
		
	}
	
	
	
	function error_from_model(&$d_model){
		
		$errors	= $d_model->getErrors();
		
		$error_str = array();
		for ($i = 0, $n = count($errors); $i < $n; $i++)
		{
			if ($errors[$i] instanceof Exception)
			{
				$error_str[] = $errors[$i]->getMessage();
			} else {
				$error_str[] = $errors[$i];
			}
		}
		
		return $error_str;
	}
	
}