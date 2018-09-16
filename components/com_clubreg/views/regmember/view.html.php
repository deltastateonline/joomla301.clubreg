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

jimport( 'joomla.application.component.view');

class ClubRegViewregmember extends JViewLegacy
{
	function display($tpl = null)
	{			
		$this->layout  = $renderer =  $this->getLayout();
		$proceed = FALSE;
		 
		if(method_exists($this, $renderer)){
			$proceed =  $this->$renderer();			
		}
		$this->pageTitle = JText::_('COM_CLUBREG_PROFILE');
		if($proceed){
			parent::display($tpl);
		}else{			
			ClubRegUnAuthHelper::unAuthorised();
		}
	}
	
	
	private function viewonly(){		
		$proceed = TRUE;	
		
		$app			= JFactory::getApplication();
		$user			= JFactory::getUser();		
		
		
		$params = JComponentHelper::getParams('com_clubreg');
		$this->profile_divrightedge =  $params->get("profile_divrightedge");	
		$this->profile_tabposition =   $params->get("profile_tabposition");	
		$this->profile_icons =   $params->get("profile_icons");
		
		if(!isset($this->profile_tabposition)){ $this->profile_tabposition = COM_CLUBREG_TABPOSITION; }
		if(!isset($this->profile_divrightedge) || intval($this->profile_divrightedge) < 500){ $this->profile_divrightedge = COM_CLUBREG_DIVRIGHT; }
		if(!isset($this->profile_icons)){$this->profile_icons = 0;}
		
		$current_model = JModelLegacy::getInstance('officialfrn', 'ClubregModel', array('ignore_request' => true));
		$current_model->setState('joomla_id',$user->get('id'));
		
		$app		= JFactory::getApplication();
		$active	= $app->getMenu()->getActive(); // if logged in
		
		if($current_model->getPermissions('uploadfiles') && $current_model->getPermissions('uploadfiles') == "yes"){$this->uploadfiles = TRUE; }
		
		
		
		$this->member_key = $app->input->getString('pk', null);
		$key_data = new stdClass();
		unset($current_model);
		$currentModel = $this->getModel();
		$currentModel->setState('com_clubreg.regmember.member_key',$this->member_key); // use the key in the model
		$key_data->full_key = $this->member_key;
		$currentModel->processKey($key_data);
		
		
		require_once JPATH_COMPONENT.DS.'helpers'.DS.'clubreg.renderItem.php';
		require_once CLUBREG_CONFIGS.'config.profile.php';
		$this->all_data = $this->get("MemberDetails"); // this might be wrong
		
		$this->formbackaction = 'index.php?option=com_clubreg&view=regmembers';
		$this->formeditaction = 'index.php?option=com_clubreg&view=regmember';
		
		$configObj = new ClubRegProfileConfig();		
		$this->profileConfigs =  $configObj->getConfig($currentModel->getState('profile.playertype')); // return headings which hold config details	
			
		$this->itemRenderer = new ClubRegRenderItemHelper(); // used to render individual items
		
		unset($currentModel);
		$currentModel = JModelLegacy::getInstance('note', 'ClubregModel', array('ignore_request' => false));
		$currentModel->setState('com_clubreg.note.member_key',$this->member_key); // use the key in the model
		$currentModel->setState('com_clubreg.note.note_type',"member"); // use the note type in the model
		
		$this->noteForm = $currentModel->getForm();	
		
		unset($currentModel);
		$currentModel = JModelLegacy::getInstance('attachment', 'ClubregModel', array('ignore_request' => false));
		$currentModel->setState('com_clubreg.attachment.member_key',$this->member_key); // use the key in the model
		$currentModel->setState('com_clubreg.attachment.link_type',"member"); // use the note type in the model
		
		$this->attachmentForm = $currentModel->getForm();
		unset($currentModel);
		
		$currentModel = JModelLegacy::getInstance('profilepix', 'ClubregModel', array('ignore_request' => false));
		$currentModel->setState('com_clubreg.profilepix.member_key',$this->member_key); // use the key in the model
		$currentModel->setState('com_clubreg.profilepix.link_type',"profile"); // use the note type in the model
		
		$this->profilepixForm = $currentModel->getForm();
		unset($currentModel);		
		
		$link_type = 'profile';
		$current_model = JModelLegacy::getInstance('attachments', 'ClubregModel', array('ignore_request' => true));
		
		$current_model->setState('com_clubreg.attachments.limit',1); 
		$current_model->setState('com_clubreg.attachments.limitstart',0);
		
		$profile_pixs = $current_model->getAttachments($user->get('id'),$key_data->member_id,$link_type);
		
		if($profile_pixs && is_array($profile_pixs) && count($profile_pixs) > 0){
			$profiles_pix = current($profile_pixs);
			$this->profiles_pix = JURI::base().$profiles_pix->attachment_location.$profiles_pix->attachment_savedfname;
			$this->profiles_pix = str_replace("\\", "/", $this->profiles_pix );
		}else{
			$this->profiles_pix = CLUBREG_ASSETS."/images/clublogo.png";
		}

	
		return $proceed;
	}
	
	private function edit(){
		
		$proceed = FALSE;
		
		$app			= JFactory::getApplication();
		$user			= JFactory::getUser();		
		
		$current_model = JModelLegacy::getInstance('officialfrn', 'ClubregModel', array('ignore_request' => true));
		$current_model->setState('joomla_id',$user->get('id'));
		
		if($current_model->getPermissions('manageusers')){
			
			$proceed = TRUE;
		
			require_once JPATH_COMPONENT.DS.'helpers'.DS.'clubreg.uniquekeys.php';			
			
			$key_data = new stdClass(); $parent_key_data = new stdClass();
			
			$key_data->full_key = $this->member_key = $app->input->getString('pk', null);		
			$this->uKeyObject = new ClubRegUniqueKeysHelper();
			$this->uKeyObject->deconstructKey($key_data);
			
			$this->formbaction = 'index.php?option=com_clubreg&view=regmember'; // back to profile
			$this->formbackaction = 'index.php?option=com_clubreg&view=regmembers'; // back to list
			
			$this->tmpl = $app->input->getString('tmpl', "html");		// determine if you are calling from add child 					
			
			$currentModel = $this->getModel();		
			$currentModel->setState('com_clubreg.regmember.member_key',$key_data->string_key); // use the key in the model		
			$currentModel->setState('com_clubreg.regmember.member_id',$key_data->pk_id); // use the key in the model		
			
			$playertype = $app->input->getString('playertype', null);
			if(isset($playertype)){
				$currentModel->setState('com_clubreg.regmember.playertype',$playertype); // use the key in the model
			}
			
			$parent_key_data->full_key = $app->input->getString('parent_key', null);  // if it is a child
			if(isset($parent_key_data)){			
				$this->uKeyObject->deconstructKey($parent_key_data);			
				$currentModel->setState('com_clubreg.regmember.parent_id',$parent_key_data->pk_id); // use the key in the model
			}		
			
			$this->regmemberForm = $currentModel->getForm();

			
			$params = JComponentHelper::getParams('com_clubreg');
			$this->loademergecy = $params->get("emergency");
			
			if($this->loademergecy){
				unset($currentModel);
				$currentModel = JModelLegacy::getInstance('emergency', 'ClubregModel', array('ignore_request' => false));
				$currentModel->setState('com_clubreg.emergency.member_id',$key_data->pk_id); // use the key in the model
				$currentModel->setState('com_clubreg.emergency.member_key',$key_data->full_key); // use the key in the model
				
				$this->emergencyForm = $currentModel->getForm();				
				
				require_once CLUBREG_ADMINPATH.'/helpers/clubregcontrols.php';
				JForm::addFieldPath(CLUBREG_ADMINPATH.'/models/fields');
				$this->extradetails = ClubRegControlsHelper::configOptions(CLUB_PLAYER_DETAILS); // controls
				
				$this->otherForm = $currentModel->getForm();
				$this->otherValues = $currentModel->get('otherValues');				
			}
			
			
		
		}
		
		return $proceed;
		
	}
		
}