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


class ClubRegViewAttachment extends ClubRegViews
{

	protected function list_attachment(){
	
		JSession::checkToken() or die(JText::_('JINVALID_TOKEN'));
		
		$this->setLayout("list.attachments");
	
		require_once JPATH_COMPONENT.DS.'helpers'.DS.'clubreg.uniquekeys.php';
	
		$user		= JFactory::getUser();
		$app			= JFactory::getApplication();
		$Itemid			= $app->input->post->get('Itemid');
	
		$proceed = FALSE;
		if($user->get('id') > 0){
			$proceed = TRUE;
			$key_data = new stdClass();
			unset($current_model);
			$current_model = JModelLegacy::getInstance('regmember', 'ClubregModel', array('ignore_request' => true));
			$key_data->full_key = $app->input->post->getString('member_key', null);
			$current_model->processKey($key_data);
	
			unset($current_model);
			$link_type = $app->input->post->getString('link_type', 'member');
			$current_model = JModelLegacy::getInstance('attachments', 'ClubregModel', array('ignore_request' => true));
			$this->attachments = $current_model->getAttachments($user->get('id'),$key_data->member_id,$link_type);				
			
			$this->uKeyObject = new ClubRegUniqueKeysHelper();
			unset($key_data);
	
	
		}
		return $proceed;
	}
	protected function view_attachment(){
	
		//JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));
		$proceed = FALSE;
		require_once JPATH_COMPONENT.DS.'helpers'.DS.'clubreg.uniquekeys.php';
	
		$key_data = new stdClass();
		$return_array = array();
	
	
		$app    = JFactory::getApplication();
		$user		= JFactory::getUser();
	
		$this->uKeyObject = new ClubRegUniqueKeysHelper();
		$key_data->full_key = $app->input->get->getString('attachment_key', 'member');
	
		$this->uKeyObject->deconstructKey($key_data);
	
		$current_model = JModelLegacy::getInstance('attachment', 'ClubregModel', array('ignore_request' => true));
		$current_model->setState('com_clubreg.attachment.attachment_id',$key_data->pk_id);
		$current_model->setState('com_clubreg.attachment.attachment_key',$key_data->string_key);
	
		$attachment = $current_model->getAttachment();
	
		if(count($attachment) && $attachment["attachment_id"] == $key_data->pk_id){
	
			//$proceed = TRUE;
			$mimetype = isset($attachment["attachment_file_type"])?$attachment["attachment_file_type"]:'application/octet-stream';
			$filename = $attachment["attachment_location"].$attachment["attachment_savedfname"];
	
	
			$disp_type = preg_match("/image/",$mimetype)?"attachment":"attachment";
	
			$fp = fopen($filename, "rb");
			while(!feof($fp))
			{
				//reset time limit for big files
				set_time_limit(0);
				print(fread($fp, 1024*8));
			}
	
			fclose($fp);
	
			$filename = $attachment["attachment_fname"];
			JResponse::setHeader('Content-Type', $mimetype);
			JResponse::setHeader('Content-disposition', $disp_type.'; filename="'.$filename.'"; creation-date="'.JFactory::getDate()->toRFC822().'"', true);
	
		}	
		return $proceed;	
	}

}