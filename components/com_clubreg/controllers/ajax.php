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
class ClubregControllerAjax extends JControllerLegacy
{
	
	public function __construct($config = array())
	{		
		require_once JPATH_COMPONENT_ADMINISTRATOR.DS.'helpers'.DS.'clubreg.php';
		require_once JPATH_COMPONENT.DS.'helpers'.DS.'clubreg.uniquekeys.php';
		parent::__construct($config);
		$this->registerTask('deletenote', 'processnote');		
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
		
		
		$this->uKeyObject = new ClubRegUniqueKeysHelper(10);
		
	}	
	
	public function savenote(){

		
		JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));
		$app    = JFactory::getApplication();
		$user		= JFactory::getUser();
		
		$proceed = TRUE;
		$data = $this->input->post->get('jform', array(), 'array');
		$key_data = new stdClass();
		
		unset($current_model);
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
			$return_array["msg"] =  $current_model->getError();
		}
		$return_array["proceed"] = $proceed;
		echo json_encode($return_array);
		
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
			$return_array["msg"][] = JText::_('COM_CLUBREG_DETAILS_UPDATE');
		}else{
			$return_array["msg"] =  $current_model->getError();
			
		}
		
		
		unset($current_model);unset($key_data);
		echo json_encode($return_array);
		
		$app->close();
		
	}
	public function saveemergency(){
		
		JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));
		
		
		$app    = JFactory::getApplication();
		$user		= JFactory::getUser();
		
		$proceed = FALSE;
		$data = $this->input->post->get('jform', array(), 'array');
		
		unset($current_model);
		$key_data = new stdClass();
		$current_model = JModelLegacy::getInstance('regmember', 'ClubregModel', array('ignore_request' => true));
		$key_data->full_key = $data['member_key'];	
		
		$this->uKeyObject->deconstructKey($key_data);
		
		
		unset($current_model);		
		$current_model = JModelLegacy::getInstance('emergency', 'ClubregModel', array('ignore_request' => true));
		$current_model->setState('com_clubreg.emergency.member_id',$key_data->pk_id);
		$proceed = $current_model->save($data);
				
		$return_array = array();
		$return_array["proceed"] = $proceed;	

		if($proceed){
			$return_array["msg"][] =  JText::_('COM_CLUBREG_DETAILS_UPDATE');
		}else{
			$return_array["msg"] =  $current_model->getError();				
		}		
		unset($current_model);unset($key_data);
		echo json_encode($return_array);
		
		$app->close();
		
	}	
	
	function saveother(){
	
		JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));
	
	
		$app    = JFactory::getApplication();
		$user		= JFactory::getUser();
		
		$return_array = array();
		$return_array["proceed"] = FALSE;
		
		$data = $this->input->post->get('jform', array(), 'array');		
		$extraDetails = $this->input->post->get('extraDetails', array(), 'array');
		$monthyears = $this->input->post->get('monthyear', array(), 'array');		
	
		unset($current_model);
		$key_data = new stdClass();
		$current_model = JModelLegacy::getInstance('regmember', 'ClubregModel', array('ignore_request' => true));
		$key_data->full_key = $data['member_key'];
	
		$this->uKeyObject->deconstructKey($key_data);	
	
		unset($current_model);
		$current_model = JModelLegacy::getInstance('other', 'ClubregModel', array('ignore_request' => true));
		$current_model->setState('com_clubreg.other.member_id',$key_data->pk_id);
		$return_array["proceed"] =  $current_model->save($extraDetails,$monthyears);		
	
		if($return_array["proceed"]){
			$return_array["msg"][] = JText::_('COM_CLUBREG_DETAILS_UPDATE');
		}else{
			$return_array["msg"] =  $current_model->getError();	
		}
	
	
		unset($current_model);unset($key_data);
		echo json_encode($return_array);
	
		$app->close();
	
	}
	
	function assignguardian(){
		
		JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));
		
		$member_key_data = new stdClass();
		$parent_key_data = new stdClass();
		
		$return_array = array();
		$return_array["proceed"] = FALSE;
		
		$app    = JFactory::getApplication();
		$user		= JFactory::getUser();		
		
		$member_key_data->full_key = $this->input->post->get('member_key', NULL, 'string');
		$this->uKeyObject->deconstructKey($member_key_data);
		
		$parent_key_data->full_key = $this->input->post->get('parent_key', NULL, 'string');
		$this->uKeyObject->deconstructKey($parent_key_data);
		
		
		$current_model = JModelLegacy::getInstance('regmember', 'ClubregModel', array('ignore_request' => true));
		$current_model->setState('com_clubreg.regmember.member_id',$member_key_data->pk_id);
		
		$return_array["proceed"] = $current_model->changeProperty("parent_id",intval($parent_key_data->pk_id));
		
		if($return_array["proceed"]){
			$return_array["msg"][] = JText::_('COM_CLUBREG_DETAILS_UPDATE');		
		}else{
			$return_array["msg"] =  $current_model->getError();
		}
		unset($current_model);unset($key_data);
		echo json_encode($return_array);
		
		$app->close();
		
	}
	
	public function saveattachment(){
		
		require_once JPATH_COMPONENT.DS.'helpers'.DS.'clubreg.media.php';	
		
		
		JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));
		
		$member_key_data = new stdClass();
		$return_array = $attachment_data = array();
		$return_array["proceed"] = $return_array["upload_error"] = FALSE;
		
		$app    = JFactory::getApplication();
		$user		= JFactory::getUser();
		
		$data = $this->input->post->get('jform', array(), 'array');
	
		
		$member_key_data->full_key = $data["member_key"];
		$this->uKeyObject->deconstructKey($member_key_data);
		
		$file_data =  $this->input->files->get('jform',array(),'array');
		$attachment = $file_data["attachment"];		
		
		
		$return_array["msg"] = array();
		
		if (!ClubRegMediaHelper::canUpload($attachment, $err))
		{
			$return_array["msg"][] = JText::_($err);
			$return_array["upload_error"] = TRUE;
		}
		
		require_once CLUBREG_ADMINPATH.'/helpers/clubreg.php';
		
		ClubRegHelper::setIndex("value"); // force the array to be indexed by the value
		$document_type = ClubRegHelper::configOptions(CLUB_DOCUMENTS_WHICH); // controls
		
		if(!strlen(trim($data["document_type"]))> 0 && count($document_type)> 0 && !in_array($data["document_type"], array_keys($document_type))){
			$return_array["msg"][] = JText::_('COM_CLUBREG_MSG_DOCTYPENOT_SET');
			$return_array["upload_error"] = TRUE;
		}
		
		$params = JComponentHelper::getParams('com_clubreg');
		//$config		= JFactory::getConfig();
		
		$media_params = JComponentHelper::getParams('com_media');		
		
		$folder_path = $params->get("attachment_folder");
		if(!isset($folder_path) || is_null($folder_path)){			
			$return_array["msg"][] = JText::_('COM_CLUBREG_MSG_FOLDERNOT_SET');
			$return_array["upload_error"] = TRUE;			
		}else{			
			$media_path = $media_params->get('file_path').DS.$folder_path.DS;
			$attachment_data["attachment_location"] = $media_path = sprintf("%smber_%s%s",$media_path,$member_key_data->pk_id,DS);			
			$media_path = JPATH_ROOT.DS.$media_path;
		}		
		
		if(!$return_array["upload_error"]){			
			// Build the appropriate paths	
			$file_name = 	time(). JFile::makeSafe($attachment['name']);
			$final_dest	= $media_path.$file_name;
			$tmp_src	= $attachment['tmp_name'];
			$profile_name = "profile.".JFile::getExt($attachment['name']);; 
			
			// Move uploaded file
			jimport('joomla.filesystem.file');
			$return_array["proceed"] = JFile::upload($tmp_src, $final_dest);
			
			if($return_array["proceed"]){
				
				if($data["link_type"] == "profile"){
					$media_path_th = $media_path.DS.'th';
					jimport('joomla.filesystem.folder');					
					JFolder::create($media_path_th);
					
					
					jimport('joomla.filesystem.image');
					$JImage = new JImage($final_dest);
					
					try{						
						$image = $JImage->resize(64, 64, true, JImage::SCALE_INSIDE);
						$image->toFile($media_path_th.DS.$profile_name);						
					}
					catch (Exception $e){
						$return_array["msg"][] =  JText::_('COM_CLUBREG_MSG_CREATE_THUMBNAIL');
					}
					
				}
				
				$current_model = JModelLegacy::getInstance('attachment', 'ClubregModel', array('ignore_request' => true));
				$attachment_data["attachment_fname"] = $attachment['name'];
				$attachment_data["attachment_savedfname"] = $file_name;
				
				$attachment_data["attachment_key"] = $this->uKeyObject->getUniqueKey();
				$attachment_data["primary_id"] = $member_key_data->pk_id;
				$attachment_data["created_by"] = $user->get("id");
				$attachment_data["attachment_status"] = 1;
				$attachment_data["link_type"] = $data["link_type"];
				
				$attachment_data["attachment_type"] = $data["document_type"];
				$attachment_data["attachment_notes"] = $data["attnotes"];	
				$attachment_data["attachment_file_type"] = $attachment["type"];			
				
				$return_array["proceed"] = $current_model->save($attachment_data);
				
				if(!$return_array["proceed"]){
					$return_array["msg"][] =  $current_model->getError();
				}else{
					$return_array["msg"][] =  JText::_('COM_CLUBREG_DETAILS_UPDATE');
				}
				
			}
			
			
		}
		
		echo json_encode($return_array);
		
		$app->close();
	}
	public function processattachment(){
	
		JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));
		$app    = JFactory::getApplication();
		$user		= JFactory::getUser();
		$key_data = new stdClass();
		
		$c_task = $this->getTask();		
	
		$return_array = array();
		$return_array["proceed"] = FALSE;
	
		$key_data->full_key = $app->input->post->getString('attachment_key', NULL);
		$this->uKeyObject->deconstructKey($key_data);
	
		if($key_data->pk_id > 0 && strlen($key_data->string_key) > 0){
			unset($current_model);
			$current_model = JModelLegacy::getInstance('attachment', 'ClubregModel', array('ignore_request' => true));
			$current_model->setState('com_clubreg.attachment.attachment_id',$key_data->pk_id);
			$current_model->setState('com_clubreg.attachment.attachment_key',$key_data->string_key);
			
			if(in_array($c_task,array("lockattachment","deleteattachment"))){
				
				switch($c_task){
					case "lockattachment":
						$n_status = 2;
						$return_array["msg"] = JText::_("COM_CLUBREG_PROFILE_PRIVATE_RESPONSE");
					break;
					case "deleteattachment":
						$n_status = 99;
						$return_array["msg"] = JText::_("COM_CLUBREG_PROFILE_DELETE_RESPONSE");
					break;
					default:
						$n_status = 1;
					break;
				}
				
				$return_array["proceed"] = $current_model->changeStatus($n_status);
			}
				
			if($return_array["proceed"]){
				$return_array["attachment_id"] = $key_data->pk_id;				
			}else{
				$return_array["msg"] =  $current_model->getError();
			}
		}
	
		echo json_encode($return_array);
		$app->close();	
	}
	
	public function processnote(){
		
		JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));
		$app    = JFactory::getApplication();
		$user		= JFactory::getUser();
		$key_data = new stdClass();
		
		$c_task = $this->getTask();
		
		$return_array = array();
		$return_array["proceed"] = FALSE;
		$key_data->note_key = $app->input->post->getString('note_key', NULL);		
		
		if(strlen($key_data->note_key) > 0){
			unset($current_model);
			$current_model = JModelLegacy::getInstance('note', 'ClubregModel', array('ignore_request' => true));
			$current_model->setState('com_clubreg.note.note_key',$key_data->note_key);			
			
			if(in_array($c_task,array("locknote","deletenote"))){
			
				switch($c_task){
					case "locknote":
						$n_status = 1;
						$return_array["msg"] = JText::_("COM_CLUBREG_PROFILE_PRIVATE_RESPONSE");
						break;
					case "deletenote":
						$n_status = 99;
						$return_array["msg"] = JText::_("COM_CLUBREG_PROFILE_DELETE_RESPONSE");
						break;
					default:
						$n_status = 0;
					break;
				}
			
				$return_array["proceed"] = $current_model->changeStatus($n_status);
			}	
		
			if(!$return_array["proceed"]){
				$return_array["msg"] = $this->error_from_model($current_model);	 
			}
		}
		
		echo json_encode($return_array);
		$app->close();
		
	}
	
	public function saveproperty(){
	
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
		$current_model = JModelLegacy::getInstance('property', 'ClubregModel', array('ignore_request' => true));
		$key_data->full_key = $data['property_key'];
		$this->uKeyObject->deconstructKey($key_data);
	
		$isNew = FALSE;
		$data["property_key"] = $key_data->string_key;
		$data["property_id"] = $key_data->pk_id;
	
		if($key_data->pk_id > 0 && strlen($key_data->string_key) == 0){
			$data["property_key"] =  $this->uKeyObject->getUniqueKey();
		}else if($key_data->pk_id == 0){
			$data["property_key"] =  $this->uKeyObject->getUniqueKey();
			$data["property_id"] = NULL;
			$isNew = TRUE;
		}
	
		
		$current_model->setState('com_clubreg.property.isnew',$isNew);
		$proceed = $current_model->save($data);
	
		$return_array = array();
		$return_array["proceed"] = $proceed;		
	
		if($proceed){
			$return_array["isNew"] = $isNew;
			$return_array["property_id"] =$current_model->get("property_id");
			$return_array["msg"][] = JText::_('COM_CLUBREG_DETAILS_UPDATE');
		}else{
			$return_array["msg"] = $this->error_from_model($current_model);				
		}
			
		unset($current_model);unset($key_data);
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