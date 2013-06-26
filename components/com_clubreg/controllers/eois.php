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
class ClubregControllerEois extends JControllerLegacy
{
	
	public function __construct($config = array())
	{		
		require_once JPATH_COMPONENT_ADMINISTRATOR.DS.'helpers'.DS.'clubreg.php';
		parent::__construct($config);
		$this->registerTask('register', 'register');
		$this->registerTask('delete', 'delete');
		//$this->registerTask('subedit', 'edit');	
	}	
	

	public function register(){
		
		JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));
		$app    = JFactory::getApplication();
		$user		= JFactory::getUser();
		
		$eoi_id = $app->input->post->get('cid',array(),'array'); 
		$player_type =   $app->input->post->getString("player_type","");
		
		require_once JPATH_COMPONENT.DS.'helpers'.DS.'clubreg.uniquekeys.php';		
		$uKeyObject = new ClubRegUniqueKeysHelper(10);		
		
		if($user->get('id') > 0){
			$current_model = JModelLegacy::getInstance('officialfrn', 'ClubregModel', array('ignore_request' => true));
			$current_model->setState('joomla_id',$user->get('id'));
		
			if($current_model->getPermissions('manageeoi')){
		
				if(count($eoi_id) > 0 ){
					
					$db = JFactory::getDbo();
					$created_when = date('Y-m-d H:i:s');
					$allowed_status = "'eoi'";
					$member_ids = implode(",",$eoi_id);
					$d_qry = sprintf("select a.* from %s as a
							where a.member_id in (%s) and member_status in (%s)",CLUB_EOIMEMBERS_TABLE,$member_ids,$allowed_status);
					$db->setQuery($d_qry);
					$all_eois = $db->loadObjectList();
					$approved = array();
					if(count($all_eois) > 0){
						foreach($all_eois as $an_eoi){							
							$current_model = JModelLegacy::getInstance('regmember', 'ClubregModel', array('ignore_request' => true));
							$an_eoi->member_key = $uKeyObject->getUniqueKey();
							$current_model->registerMember($an_eoi,$approved,$uKeyObject);							
							unset($current_model);
						}
						
						unset($uKeyObject);
						$howmany = count($approved);
						
						if($howmany > 0){
							$member_ids = implode(",",$approved);
							$d_qry = sprintf("update %s set member_status = 'approved', approved ='%s', approved_by ='%d' where member_id in (%s) or parent_id in (%s) ;",
									CLUB_EOIMEMBERS_TABLE,$created_when,$user->get('id'), $member_ids,$member_ids);
							$db->setQuery( $d_qry );
							$db->query();
							
							unset($approved);
							
							$app->enqueueMessage($howmany."&nbsp;". JText::_("COM_CLUBREG_REGISTERED") );
						}						
					}else{
						JError::raiseWarning( 500, JText::_("COM_CLUBREG_NOTAPPROVED") );
					}
						
								
				}else{					
					JError::raiseWarning( 500, JText::_("COM_CLUBREG_NOTAPPROVED") );					
				}
			}
		}
		
		return parent::display();
		
		
	}
	public function delete(){
		JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));
		$app    = JFactory::getApplication();
		$user		= JFactory::getUser();
		
		$eoi_id =  $app->input->post->get('cid',array(),'array');  
		
		if($user->get('id') > 0){
			$current_model = JModelLegacy::getInstance('officialfrn', 'ClubregModel', array('ignore_request' => true));
			$current_model->setState('joomla_id',$user->get('id'));
		
			if($current_model->getPermissions('manageeoi')){
				if(count($eoi_id) > 0 ){
					
					$db = JFactory::getDbo();
					
					$member_ids = implode(",",$eoi_id);
					$d_qry = sprintf("update %s set member_status = 'deleted' where member_id in (%s) or parent_id in (%s) ;",CLUB_EOIMEMBERS_TABLE,$member_ids,$member_ids);
					$db->setQuery( $d_qry );
				
					$db->query();
					$app->enqueueMessage("EOI Members Deleted");
				}else{					
					JError::raiseWarning( 500, JText::_("COM_CLUBREG_NOTAPPROVED")  );					
				}
			}else{
				JError::raiseWarning( 500, JText::_('CLUBREG_NOTAUTH'));
			}
		}
		
		return parent::display();
	}
	
}