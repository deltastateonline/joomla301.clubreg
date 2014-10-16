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
class ClubregControllerCommunication extends JControllerLegacy
{
	
	public function __construct($config = array())
	{		
		require_once JPATH_COMPONENT_ADMINISTRATOR.DS.'helpers'.DS.'clubreg.php';
		require_once JPATH_COMPONENT.DS.'helpers'.DS.'clubreg.uniquekeys.php';
		parent::__construct($config);
		
		$options = array();
		$options['format'] = '{DATE}\t{TIME}\t{LEVEL}\t{CODE}\t{MESSAGE}';
		$options["text_file"] = 'clubreg.comms.error.php';
		JLog::addLogger($options);
		
		$this->registerTask('save', 'savecommunication');		
		$this->registerTask('send', 'sendcommunication');
		$this->uKeyObject = new ClubRegUniqueKeysHelper(10);
		
	}	
	
	private function handleSaveLogic(){
		
		JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));
		$app    = JFactory::getApplication();
		$user		= JFactory::getUser();	
		
		$template_id	= $this->input->getInt('template_id');
		
		$all_errors = array();
		$comm_id = NULL;
		
		$return_array["canSave"]  = $isNew = FALSE;
		$return_array["proceed"] = TRUE;
		
		$data = $this->input->post->get('jform', array(), 'array');
		$template_id = $data["template_id"];
		
		$key_data = new stdClass();
		
		if(intval($data["comm_id"]) == 0){
			$isNew = TRUE;
		}else{
			$comm_id = $data["comm_id"];
		}
		
		if(isset($data["comm_pmessage"]) && $data["comm_type"] == "sms"){
			$data["comm_message"] = $data["comm_pmessage"];
		}
		
		$current_model = JModelLegacy::getInstance('communication', 'ClubregModel', array('ignore_request' => true));
		$form = $current_model->getForm();
		
		$validate = $current_model->validate($form, $data);
		
		if($validate === FALSE){
			$all_errors = $this->errorFromModel($current_model);
			$return_array["proceed"] = FALSE;			
		}
		
		if(strlen($data["comm_subject"]) < 10){
			$return_array["proceed"] = FALSE;
			$all_errors[] = JText::_('COM_CLUBREG_COMM_SUBJECT_VALID');		
		}
		
		if($return_array["proceed"]){
				
			if($isNew){
				$data["comm_status"] = 1;
				$data["created"] = date("Y-m-d H:i:s");
				$data["created_by"] = $user->id;			
			}
				
			$return_array["proceed"] = $current_model->save($data);
				
			if($return_array["proceed"] == FALSE){
				$all_errors_ = array();
				$all_errors_ = $this->errorFromModel($current_model);
				$all_errors = array_merge($all_errors,$all_errors_);
				JLog::add("Saving to database failed. Add other errors", 'ERROR');
			}else{
				$comm_id = $current_model->get('com_clubreg.communication.comm_id');
			}
		}else{
			$data["comm_sendto"] = ($data["comm_groups"])?json_decode($data["comm_groups"],TRUE):array();
		}
		
		
		
		return array("all_errors"=>$all_errors, "comm_id" => $comm_id, "data"=>$data,'template_id'=>$template_id);
	}

	
	public function savecommunication(){
		
		$app    = JFactory::getApplication();
		$user		= JFactory::getUser();
		
		$Itemid	= $this->input->getInt('Itemid');
		
		
		$return_array = $this->handleSaveLogic();
		$comm_id = $return_array["comm_id"];
		$all_errors = $return_array["all_errors"];
		$data = $return_array["data"];
		$template_id	= $return_array['template_id'];
		
		if($comm_id > 0){
			$url_[] = "comm_id=".$comm_id;
		}
		
		if($template_id){
			$url_[] = "template_id=".$template_id;
		}
		
		$pk_string = "&".implode("&",$url_);		
		
		if(count($all_errors) > 0){	
			$app->setUserState('com_clubreg.communication.data', $data);
			$app->enqueueMessage(implode("<br />",$all_errors), 'warning');	
			
			$redirect_url = JRoute::_('index.php?option=com_clubreg&view=communication&layout=edit&Itemid='.$Itemid.$pk_string, false);
		}else{			
			$app->setUserState('com_clubreg.communication.data', array());
			$app->enqueueMessage(JText::_('COM_CLUBREG_DETAILS_UPDATE'), 'Info');
			$redirect_url = JRoute::_('index.php?option=com_clubreg&view=communication&layout=edit&Itemid='.$Itemid.$pk_string, false);
				
		}
		
		$this->setRedirect($redirect_url);
		return false;
	}
	
	public function sendcommunication(){
		
		$app    = JFactory::getApplication();
		$user		= JFactory::getUser();

		$Itemid	= $this->input->getInt('Itemid');	
		$pk_string = "";
				
		try {			
		
			$current_model = JModelLegacy::getInstance('officialfrn', 'ClubregModel', array('ignore_request' => true));
			$current_model->setState('joomla_id',$user->get('id'));
			
			if(!$current_model->getPermissions('sendcommunication')){
				$data = $this->input->post->get('jform', array(), 'array');
				$all_errors[] = JText::_('CLUBREG_NOTAUTH');
				
				if($data["comm_id"] > 0){
					$url_[] = "comm_id=".$data["comm_id"];
				}
					
				if($data["template_id"]){
					$url_[] = "template_id=".$data["template_id"];
				}
				$pk_string = "&".implode("&",$url_);				
				
				throw new Exception(JText::_('CLUBREG_NOTAUTH'));
			}
		
			$return_array = $this->handleSaveLogic();
			$comm_id = $return_array["comm_id"];
			$all_errors = $return_array["all_errors"];
			$data = $return_array["data"];		
			$template_id	= $return_array['template_id'];
			
			$comm_sendto = ($data["comm_groups"])?json_decode($data["comm_groups"],TRUE):array();
			
			$url_ = $validEmails = array();			
			
			if(is_array($comm_sendto) && count($comm_sendto) > 0){
				unset($current_model);
				//$current_model = JModelLegacy::getInstance('communication', 'ClubregModel', array('ignore_request' => true));
				
				$current_model = JModelLegacy::getInstance('regmembers', 'ClubregModel', array('ignore_request' => true));
				$validEmails = $current_model->getMembersByGroups($comm_sendto);
				
				if(!count($validEmails["emails"]) > 0){
					$all_errors[] = JText::_('COM_CLUBREG_COMMS_VALLIDEMAILS');
					throw new Exception(JText::_('COM_CLUBREG_COMMS_VALLIDEMAILS'));
				}
				$msg_log = array("<br />");
				$sending_['mailfrom'] = $app->get('mailfrom');
				$sending_['fromname'] = $app->get('fromname');
				$sending_['sitename'] = $app->get('sitename');
				
				$sending_["comm_subject"] = $data["comm_subject"];
				$sending_["comm_message"] = $data["comm_message"];	
				
				
				$mail = JFactory::getMailer();
				
				$mail->addRecipient($user->get('email'), $user->get('name'));
				
				for($i = 0 ; $i < count($validEmails["emails"]); $i++){
					$mail->addBCC($validEmails["emails"][$i],$validEmails["names"][$i]);
					$msg_log[] = sprintf(" %s %s",$validEmails["names"][$i],$validEmails["emails"][$i] );
				}
				$sending_["sent_to"] = $msg_log;
				$mail->addReplyTo(array($user->get('email'), $user->get('name')));
				$mail->setSender(array($sending_['mailfrom'], $sending_['fromname']));
				$mail->setSubject($sending_['sitename'] . ': ' . $sending_["comm_subject"]);
				$mail->setBody($sending_["comm_message"]);
				$mail->isHtml();
				$sent = $mail->Send();	
				
				if (!($sent instanceof Exception)){
					
					$final_email = (object)$sending_;
					
					$other_details["primary_id"] = $comm_id;
					$other_details["short_desc"] = "Email_Sent_".time();
					
					ClubRegAuditHelper::saveData($final_email, $other_details);		

					$current_model = JModelLegacy::getInstance('communication', 'ClubregModel', array('ignore_request' => true));
					$current_model->setState('com_clubreg.communication.comm_id',$comm_id);
					$in_data = array("sent" =>SENTSTATUS);
					$current_model->changeStatus($in_data);
					
					
					$app->setUserState('com_clubreg.communication.data', array());
				}
				
			}else{				
				$all_errors[] = "Please select at least one group.";
			}
		
			if($comm_id > 0){
				$url_[] = "comm_id=".$comm_id;
			}
			
			if($template_id){
				$url_[] = "template_id=".$template_id;
			}
			$pk_string = "&".implode("&",$url_);
		
			if(count($all_errors) > 0){
				throw new Exception("Error Processing Request");
				
			}else{			
				JLog::add(JText::_('COM_CLUBREG_COMMS_SENT').implode("<br />",$msg_log ));
			}
			
			
		} catch (Exception $e) {		
			$app->setUserState('com_clubreg.communication.data', $data);
			$app->enqueueMessage(implode("<br />",$all_errors), 'warning');		
		}
		
		$redirect_url = JRoute::_('index.php?option=com_clubreg&view=communication&layout=edit&Itemid='.$Itemid.$pk_string, false);
		$this->setRedirect($redirect_url);
		
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