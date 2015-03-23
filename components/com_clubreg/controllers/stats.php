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
class ClubregControllerStats extends JControllerLegacy
{
	
	public function __construct($config = array())
	{		
		require_once JPATH_COMPONENT_ADMINISTRATOR.DS.'helpers'.DS.'clubreg.php';
		require_once JPATH_COMPONENT.DS.'helpers'.DS.'clubreg.uniquekeys.php';
		parent::__construct($config);
		
		$this->registerTask('savestats', 'savestats');
		$this->registerTask('getstats', 'getstats');
		
		$this->uKeyObject = new ClubRegUniqueKeysHelper(10);
		
	}	
	
	public function savestats(){

		
		JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));
		$app    = JFactory::getApplication();
		$user		= JFactory::getUser();
		
		$member_key_data = new stdClass();
		$return_array =  array();
		$all_errors = array();
		
		$statsData = $this->input->post->get('statsform', array(), 'array');
		$return_array["proceed"] =  FALSE;
		
		$key_data = new stdClass();		
		$key_data->full_key = $statsData["pk"];
		$this->uKeyObject->deconstructKey($key_data);
		
		$statsData['member_key'] = $key_data->string_key;
		$statsData['member_id'] = $key_data->pk_id;		
		
		unset($current_model);		
		$current_model = JModelLegacy::getInstance('regmemberstats', 'ClubregModel', array('ignore_request' => true));		
		
		$return_array["proceed"] = $current_model->save($statsData);
		$return_array["pk"] =$statsData["pk"];
		
		if($return_array["proceed"]){			
			$return_array["message"][] = JText::_('COM_CLUBREG_DETAILS_UPDATE');
		}else{			
			$all_errors_ = array();
			$all_errors_ = $this->error_from_model($current_model);
			$all_errors = array_merge($all_errors,$all_errors_);		
				
			$return_array["errors"] = $all_errors;			
			$return_array["message"][] =  JText::_('COM_CLUBREG_NOUPDATE');				
		}		
		echo json_encode($return_array);
		$app->close();				
	}
	
	function getstats(){
		
		JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));
		$app    = JFactory::getApplication();
		$user		= JFactory::getUser();
		
		$return_array =  array();
		$all_errors = array();
		
		$input_ids = array();
		
		$member_ids = $this->input->post->get('member_ids', array(), 'array');
		$stats_date = $this->input->post->get('stats_date', JHtml::date('now','Y-m-d'),'string');
			
		foreach($member_ids as $member_key){
			
			$key_data = new stdClass();
			$key_data->full_key = $member_key;
			$this->uKeyObject->deconstructKey($key_data);	
			
			$input_ids[$key_data->pk_id] = $member_key;	
			
		}
		
		$current_model = JModelLegacy::getInstance('regmemberstats', 'ClubregModel', array('ignore_request' => true));
		$stats_array = $current_model->getStats($input_ids,$stats_date);
		
		if($stats_array === FALSE){
			$return_array["proceed"] =  $stats_array;
			
			$all_errors_ = array();
			$all_errors_ = $this->error_from_model($current_model);
			$all_errors = array_merge($all_errors,$all_errors_);
			
			$return_array["errors"] = $all_errors;
			$return_array["message"][] =  JText::_('COM_CLUBREG_NOUPDATE');			
			
		}else{
			$final_array = array();
			foreach($input_ids as $a_key => $a_value){				
				$final_array[$a_value] = isset($stats_array[$a_key])?$stats_array[$a_key]->stats_value:NULL;		// need to return all the sent input so that we can reset the page		
			}
			
			$return_array["statsProfile"] = $final_array;
			$return_array["proceed"] =  TRUE;
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
				$error_str['warning'][] = $errors[$i]->getMessage();
			} else {
				$error_str['warning'][] = $errors[$i];
			}
		}
		
		return $error_str;
	}
	
}