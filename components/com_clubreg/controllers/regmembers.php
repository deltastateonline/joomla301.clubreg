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
class ClubregControllerRegmembers extends JControllerLegacy
{
	
	public function __construct($config = array())
	{		
		require_once JPATH_COMPONENT_ADMINISTRATOR.DS.'helpers'.DS.'clubreg.php';
		require_once JPATH_COMPONENT.DS.'helpers'.DS.'clubreg.uniquekeys.php';
		parent::__construct($config);
		
		$this->registerTask('delete', 'delete');
		$this->registerTask('deletemembers', 'deletemembers');
		$this->registerTask('resetMemberKey', 'resetMemberKey');
		$this->registerTask('batchUpdate', 'batchUpdate');	
		
		$this->uKeyObject = new ClubRegUniqueKeysHelper(10);
	}	
	


	public function delete(){
		JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));
		$app    = JFactory::getApplication();
		$user		= JFactory::getUser();
		
		$reg_id = $app->input->post->get('cid',array(),'array');		
		
		if($user->get('id') > 0 ){
			$current_model = JModelLegacy::getInstance('officialfrn', 'ClubregModel', array('ignore_request' => true));
			$current_model->setState('joomla_id',$user->get('id'));
		
			if($current_model->getPermissions('deletereg') && LIVE_SITE){
				if(count($reg_id) > 0 ){
					
					$db = JFactory::getDbo();
					
					$member_ids = implode(",",$reg_id);
					$d_qry = sprintf("update %s set member_status = 'deleted' where member_id in (%s) or parent_id in (%s) ;",CLUB_REGISTEREDMEMBERS_TABLE,$member_ids,$member_ids);
					$db->setQuery( $d_qry );					
				
					$db->query();
					$app->enqueueMessage("Members Deleted");
				}else{					
					JError::raiseWarning( 500, JText::_("COM_CLUBREG_NOTAPPROVED")  );					
				}
			}else{
				JError::raiseWarning( 500, JText::_('CLUBREG_NOTAUTH'));
			}
		}
		
		return parent::display();
	}
	
	public function batchUpdate(){
		
		
		
		JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));
		$app    = JFactory::getApplication();
		$user		= JFactory::getUser();
		
		$reg_ids = $app->input->post->get('cid',array(),'array');
		$batchProperties = $app->input->post->get('batch',array(),'array');
		
		$clubreg_boxes = $app->input->post->get('clubreg_boxes',"",'string');
		
		$return_array["msg"] = array();
		
		$count = 0;
		
		$reg_ids = json_decode($clubreg_boxes);		
		
		if($user->get('id') > 0 ){
			$current_model = JModelLegacy::getInstance('officialfrn', 'ClubregModel', array('ignore_request' => true));
			$current_model->setState('joomla_id',$user->get('id'));
		
			if($current_model->getPermissions('manageusers') && LIVE_SITE && count($reg_ids) > 0){
				
				$default_value = array("-1","");					
					
					foreach($batchProperties as $property_key =>$property_value){
						
						if(in_array($property_value, $default_value)){
							unset($batchProperties[$property_key]);			// remove that option			
						}
					}
					require_once(JPATH_COMPONENT.DS."logic".DS."group.batch.php");					
					$batch_logic = new GroupBatchUpdate($batchProperties);					
					$batchProperties = $batch_logic->processBatchProperties();					
					
					if(count($batchProperties) > 0){
						foreach($reg_ids as $member_id){
							unset($current_model);
							try {								
							
								$current_model = JModelLegacy::getInstance('regmember', 'ClubregModel', array('ignore_request' => false));
								$current_model->setState('com_clubreg.regmember.member_id',$member_id);
								
								$current_model->batchUpdate($batchProperties);
								
								$count++;
							
							} catch (Exception $e) {								
								$return_array["msg"][] =  $e->getMessage();
							}							
						}
					}else{
						JError::raiseWarning( 500, JText::_("COM_CLUBREG_COMM_NOTCOMPLETE_MSG"));
						$app->enqueueMessage("No properties to be updated", 'warning');
					}
				
				
			}else{
				if(LIVE_SITE){
					JError::raiseWarning( 500, JText::_("COM_CLUBREG_COMM_NOTCOMPLETE_MSG"));
				}else{
					JError::raiseWarning( 500, "Batch Updated Disabled, But it works. Trust Me!!");
				}
				
			}
		}else{
			JError::raiseWarning( 500, JText::_('CLUBREG_NOTAUTH'));
		}
		
		if(count($return_array["msg"]) > 0){			
			$app->enqueueMessage(implode("<br />",$return_array["msg"]), 'warning');	
		}
		
		if($count > 0){
			$app->enqueueMessage(JText::_("COM_CLUBREG_DETAILS_UPDATE")." $count Records.", 'info');
		}
		
		return parent::display();
		
	}
	
	public function resetMemberKey(){
		JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));
		$app    = JFactory::getApplication();
		$user		= JFactory::getUser();	
		
		$reg_id = $app->input->post->get('cid',array(),'array');
		$d_qry = array();
		
		require_once JPATH_COMPONENT.DS.'helpers'.DS.'clubreg.uniquekeys.php';
		$uKeyObject = new ClubRegUniqueKeysHelper(10);
		
		if($user->get('id') > 0 ){
			$current_model = JModelLegacy::getInstance('officialfrn', 'ClubregModel', array('ignore_request' => true));
			$current_model->setState('joomla_id',$user->get('id'));
		
			if($current_model->getPermissions('deletereg') && LIVE_SITE){
				if(count($reg_id) > 0 ){
		
					$db = JFactory::getDbo();
					
					foreach($reg_id as $member_id){
						
						unset($current_model);						
						$current_model = JModelLegacy::getInstance('regmember', 'ClubregModel', array('ignore_request' => false));
						$current_model->setState("member_id",$member_id);
						$m_key = $uKeyObject->getUniqueKey();
						$current_model->resetMemberKey($m_key);		
					}	
					
					$app->enqueueMessage("Member Key Reset");
				}else{
					JError::raiseWarning( 500, JText::_("COM_CLUBREG_NOTAPPROVED")  );
				}
			}else{
				JError::raiseWarning( 500, JText::_('CLUBREG_NOTAUTH'));
			}
		}
		
		return parent::display();
	
	}
	
	function deletemembers(){
		
		JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));
		$app    = JFactory::getApplication();
		$user		= JFactory::getUser();
		$key_data = new stdClass();
		
		$return_array = array();
		
		$return_array["proceed"] = TRUE;
		
		if($user->get('id') > 0 ){
			$current_model = JModelLegacy::getInstance('officialfrn', 'ClubregModel', array('ignore_request' => true));
			$current_model->setState('joomla_id',$user->get('id'));			
	
			if($current_model->getPermissions('deletereg') && LIVE_SITE){
				
				$key_data = new stdClass();
				$key_data->full_key = $this->input->post->get('member_key', "", 'string');	
				$this->uKeyObject->deconstructKey($key_data);				
				
				$current_model = JModelLegacy::getInstance('regmember', 'ClubregModel', array('ignore_request' => false));
				$current_model->setState("com_clubreg.regmember.member_id",$key_data->pk_id);
				$current_model->setState("com_clubreg.regmember.member_key",$key_data->string_key);
				
				$proceed = $current_model->deleteMember();
				$return_array["message"][] =  "Member Deleted";				
				
			}else{
				$return_array["proceed"] = FALSE;
				$return_array["errors"] = array(JText::_('CLUBREG_NOTAUTH'));
				$return_array["message"][] =  JText::_('CLUBREG_NOTAUTH');
			}		
		}
		
		echo json_encode($return_array);
		$app->close();
	}
}