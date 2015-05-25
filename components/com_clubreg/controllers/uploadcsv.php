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
	
		$data = $this->input->post->get('jform', array(), 'array');
	
		$file_data =  $this->input->files->get('jform',array(),'array');
		$attachment = $file_data["attachment"];
	
		$return_array["msg"] = array();		
	
		if (!ClubRegMediaHelper::canUpload($attachment, $err))
		{
			$return_array["msg"][] = JText::_($err);
			$return_array["upload_error"] = TRUE;
		}else{
			
			$return_array["proceed"] = TRUE;
			
			$params = JComponentHelper::getParams('com_clubreg');			
			$media_params = JComponentHelper::getParams('com_media');		
			
			$folder_path = $params->get("attachment_folder");
			if(!isset($folder_path) || is_null($folder_path)){
				$return_array["msg"][] = JText::_('COM_CLUBREG_MSG_FOLDERNOT_SET');
				$return_array["upload_error"] = TRUE;
			}else{
				$media_path = $media_params->get('file_path').DS.$folder_path.DS;
				$attachment_data["attachment_location"] = $media_path = sprintf("%s%s%s",$media_path,"csv_upload",DS);
				$media_path = JPATH_ROOT.DS.$media_path;
				
				$return_array["attachment_location"] = $media_path;
			}	
			
		}	
		
		
		if(!$return_array["upload_error"]){
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
			}		
				
		}	
		
		
		$uploadCsvView = $this->getView("uploadcsv","html");
		$uploadCsvView->setLayout("start");
		$uploadCsvView->set('return_array', $return_array);	
		
		return parent::display();	
	
	}
	
	
}