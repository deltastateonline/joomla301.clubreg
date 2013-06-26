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
		parent::__construct($config);
		
		$this->registerTask('delete', 'delete');
		$this->registerTask('resetMemberKey', 'resetMemberKey');
		//$this->registerTask('subedit', 'edit');	
	}	
	


	public function delete(){
		JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));
		$app    = JFactory::getApplication();
		$user		= JFactory::getUser();
		
		$reg_id = $app->input->post->get('cid',array(),'array');		
		
		if($user->get('id') > 0){
			$current_model = JModelLegacy::getInstance('officialfrn', 'ClubregModel', array('ignore_request' => true));
			$current_model->setState('joomla_id',$user->get('id'));
		
			if($current_model->getPermissions('deletereg')){
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
	
	public function resetMemberKey(){
		JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));
		$app    = JFactory::getApplication();
		$user		= JFactory::getUser();	
		
		$reg_id = $app->input->post->get('cid',array(),'array');
		$d_qry = array();
		
		require_once JPATH_COMPONENT.DS.'helpers'.DS.'clubreg.uniquekeys.php';
		$uKeyObject = new ClubRegUniqueKeysHelper(10);
		
		if($user->get('id') > 0){
			$current_model = JModelLegacy::getInstance('officialfrn', 'ClubregModel', array('ignore_request' => true));
			$current_model->setState('joomla_id',$user->get('id'));
		
			if($current_model->getPermissions('deletereg')){
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
}