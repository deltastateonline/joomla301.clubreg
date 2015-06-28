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
class ClubregControllerUploadcsv extends JControllerLegacy
{
	
	public $sampleF = "";
	
	public function __construct($config = array())
	{		
		require_once JPATH_COMPONENT_ADMINISTRATOR.DS.'helpers'.DS.'clubreg.php';
		require_once JPATH_COMPONENT.DS.'helpers'.DS.'clubreg.uniquekeys.php';
		parent::__construct($config);
				
		$this->uKeyObject = new ClubRegUniqueKeysHelper(10);		
	}	
	
	function startcsv(){
	
		require_once JPATH_COMPONENT.DS.'helpers'.DS.'clubreg.media.php';
	
		JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));	
	
		$member_key_data = new stdClass();
		$return_array = $attachment_data = array();
		$return_array["proceed"] = $return_array["upload_error"] = FALSE;
	
		$app    = JFactory::getApplication();
		$user		= JFactory::getUser();		
		
		unset($current_model);
		$current_model = JModelLegacy::getInstance('officialfrn', 'ClubregModel', array('ignore_request' => true));
		$current_model->setState('joomla_id',$user->get('id'));
		
		
	
		$data = $this->input->post->get('jform', array(), 'array');	
		$file_data =  $this->input->files->get('jform',array(),'array');
		$attachment = $file_data["attachment"];
	
		$return_array["msg"] = array();
		
		$return_array["proceed"] = TRUE;
	
		
		try {
			
			if(!$current_model->getPermissions('manageusers')){				
				throw new Exception(JText::_('CLUBREG_NOTAUTH'));
			}			
			
			if (!ClubRegMediaHelper::canUpload($attachment, $err))
			{
				throw new Exception(JText::_($err));			
				
			}else{
					
				$params = JComponentHelper::getParams('com_clubreg');
				$media_params = JComponentHelper::getParams('com_media');
					
				$folder_path = $params->get("attachment_folder");
				if(!isset($folder_path) || is_null($folder_path)){					
					throw new Exception(JText::_('COM_CLUBREG_MSG_FOLDERNOT_SET'));				
				}					
			}
			
			
			$media_path = $media_params->get('file_path').DS.$folder_path.DS;
			$attachment_data["attachment_location"] = $media_path = sprintf("%s%s%s",$media_path,"csv_upload",DS);
			$media_path = JPATH_ROOT.DS.$media_path;
				
			$return_array["attachment_location"] = $media_path;
			
			
				// Build the appropriate paths
				$file_name = 	"upload.csv";
				$final_dest	= $media_path.$file_name;
				$tmp_src	= $attachment['tmp_name'];
			
				// Move uploaded file
				jimport('joomla.filesystem.file');
				$return_array["proceed"] = JFile::upload($tmp_src, $final_dest);
			
				if($return_array["proceed"]){
					$success_string = JText::_('COM_CLUBREG_MSG_UPLOAD_DOCUMENT');
					$return_array["msg"][] =  $success_string;
			
					require_once(JPATH_COMPONENT.DS."logic".DS."csvupload.php");
					$csv_upload = new CsvUpload($final_dest);
					$return_array["proceed"] = $csv_upload->process();
			
					$return_array["data"] = $csv_upload->get_array();
					$return_array["msg"] =  array_merge($return_array["msg"],$csv_upload->get_message());
					$return_array["show_importform"] = TRUE;
				}else{
					throw new Exception(JText::sprintf('JLIB_FILESYSTEM_ERROR_UPLOAD',$attachment['name']));					
				}			
			
		} catch (Exception $e) {
			
			$return_array["proceed"] = $return_array["show_importform"] =  FALSE;
			$return_array["msg"][] = JText::_($e->getMessage());			
		}
		
		
		
		$uploadCsvView = $this->getView("uploadcsv","html");
		$uploadCsvView->setLayout("start");
		$uploadCsvView->set('return_array', $return_array);	
		
		return parent::display();	
	
	}
	
	public function finishcsv(){
		
		JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));
		
		require_once JPATH_COMPONENT.DS.'helpers'.DS.'clubreg.uniquekeys.php';
		require_once(JPATH_COMPONENT.DS."logic".DS."csvupload.php");
		
		$app    = JFactory::getApplication();
		$user		= JFactory::getUser();
		$return_array = array();
		
		unset($current_model);
		$current_model = JModelLegacy::getInstance('officialfrn', 'ClubregModel', array('ignore_request' => true));
		$current_model->setState('joomla_id',$user->get('id'));		
		
		$params = JComponentHelper::getParams('com_clubreg');
		$media_params = JComponentHelper::getParams('com_media');
			
		$folder_path = $params->get("attachment_folder");
		
		$media_path = $media_params->get('file_path').DS.$folder_path.DS;
		$media_path = sprintf("%s%s%s",$media_path,"csv_upload",DS);
		$media_path = JPATH_ROOT.DS.$media_path;
		
		$file_name = 	"upload.csv";
		$final_dest	= $media_path.$file_name;
		
		$uKeyObject = new ClubRegUniqueKeysHelper(10);
		
		$return_array["msg"] = array();		
		$return_array["proceed"] = TRUE;
		
		try{
			
			if(!$current_model->getPermissions('manageusers')){
				throw new Exception(JText::_('CLUBREG_NOTAUTH'));
			}
			
			if(!LIVE_SITE){
				throw new Exception(JText::_('This feature has been disabled.'));
			}
			
			unset($current_model);
			$current_model = JModelLegacy::getInstance('uploadcsv', 'ClubregModel', array('ignore_request' => true));
		
			$csv_upload = new CsvUpload($final_dest);
			$return_array["proceed"] = $csv_upload->import($current_model,$uKeyObject);			
			$return_array["msg"] =  array_merge($return_array["msg"],$csv_upload->get_message());
			$return_array["show_importform"] =  FALSE;
			
		} catch (Exception $e) {
			$return_array["proceed"] = $return_array["show_importform"] =  FALSE; 
			$return_array["msg"][] = JText::_($e->getMessage());
		}
		
		$uploadCsvView = $this->getView("uploadcsv","html");
		$uploadCsvView->setLayout("start");
		$uploadCsvView->set('return_array', $return_array);	
		
		return parent::display();	
		
	}
	
	
}