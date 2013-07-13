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

		global $mainframe;
		
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
		
		$this->member_key = $app->input->getString('pk', null);
			
		$currentModel = $this->getModel();
		$currentModel->setState('com_clubreg.regmember.member_key',$this->member_key); // use the key in the model
		
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
		$currentModel->setState('com_clubreg.attachment.attachment_type',"member"); // use the note type in the model
		
		$this->attachmentForm = $currentModel->getForm();
		unset($currentModel);

		
		return $proceed;
	}
	
	private function edit(){
		
		$proceed = TRUE;
		
		$app			= JFactory::getApplication();
		$user			= JFactory::getUser();
		
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
		
		
		return $proceed;
		
	}
		
}