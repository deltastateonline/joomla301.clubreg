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

class ClubRegViewOther extends ClubRegViews
{

	
/*	function display($tpl = null)
	{	
		
		$app		= JFactory::getApplication();
		$user		= JFactory::getUser();
		
		$cmp_name 	=  "_other";
		$renderer =  $this->getLayout().$cmp_name;
		
		$proceed = FALSE;
		
		if(method_exists($this, $renderer)){			
			$proceed =  $this->$renderer();			
		}	
		
		if($proceed){
			parent::display($tpl);
		}else{
			ClubRegUnAuthHelper::unAuthorised();
		}
	}
/**
 * 
 * @return boolean
 */
	

	protected  function list_other(){
		
	JSession::checkToken() or die(JText::_('JINVALID_TOKEN'));
	
		$this->setLayout("details.other");
	
		$user		= JFactory::getUser();
		$app			= JFactory::getApplication();
		$Itemid			= $app->input->post->get('Itemid');
	
		$proceed = FALSE;
		if($user->get('id') > 0){
	
			require_once JPATH_COMPONENT.DS.'helpers'.DS.'clubreg.uniquekeys.php';
	
			$proceed = TRUE;
			$key_data = new stdClass();
				
			$key_data->full_key = $app->input->post->getString('member_key', null);
			$this->uKeyObject = new ClubRegUniqueKeysHelper();
			$this->uKeyObject->deconstructKey($key_data);
				
			unset($currentModel);
			$currentModel = JModelLegacy::getInstance('other', 'ClubregModel', array('ignore_request' => false));
			$currentModel->setState('com_clubreg.other.member_id',$key_data->pk_id); // use the key in the model
			$currentModel->setState('com_clubreg.other.member_key',$key_data->full_key); // use the key in the model
			
			require_once CLUBREG_ADMINPATH.'/helpers/clubregControls.php';
			require_once CLUBREG_ADMINPATH.'/helpers/clubregControlsReadonly.php';
			JForm::addFieldPath(CLUBREG_ADMINPATH.'/models/fields');
			$this->extradetails = ClubRegControlsHelper::configOptions(CLUB_PLAYER_DETAILS); // controls				
			
			$this->otherForm = $currentModel->getForm();
			$this->otherValues = $currentModel->get('otherValues');		
			
		}
	
		return $proceed;
	}
	
	protected function edit_other(){
	
		JSession::checkToken() or die(JText::_('JINVALID_TOKEN'));
	
		$this->setLayout("form.other");
	
		$user		= JFactory::getUser();
		$app			= JFactory::getApplication();
		$Itemid			= $app->input->post->get('Itemid');
	
		$proceed = FALSE;
		if($user->get('id') > 0){
	
			require_once JPATH_COMPONENT.DS.'helpers'.DS.'clubreg.uniquekeys.php';
	
			$proceed = TRUE;
			$key_data = new stdClass();
	
			$key_data->full_key = $app->input->post->getString('member_key', null);
			$this->uKeyObject = new ClubRegUniqueKeysHelper();
			$this->uKeyObject->deconstructKey($key_data);
	
			unset($currentModel);
			$currentModel = JModelLegacy::getInstance('other', 'ClubregModel', array('ignore_request' => false));
			$currentModel->setState('com_clubreg.other.member_id',$key_data->pk_id); // use the key in the model
			$currentModel->setState('com_clubreg.other.member_key',$key_data->full_key); // use the key in the model
	
			require_once CLUBREG_ADMINPATH.'/helpers/clubregControls.php';
			JForm::addFieldPath(CLUBREG_ADMINPATH.'/models/fields');
			$this->extradetails = ClubRegControlsHelper::configOptions(CLUB_PLAYER_DETAILS); // controls
	
			$this->otherForm = $currentModel->getForm();
			$this->otherValues = $currentModel->get('otherValues');
	
	
		}
	
		return $proceed;
	
	}
	

}