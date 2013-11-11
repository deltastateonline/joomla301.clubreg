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

class ClubRegViewAjax extends JViewLegacy
{

	
	function display($tpl = null)
	{	
		
		$app		= JFactory::getApplication();
		$user		= JFactory::getUser();
		
		$renderer =  $this->getLayout();
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

	private function eoi(){
		
		$user		= JFactory::getUser();		
		$proceed = FALSE;
		
		if($user->get('id') > 0){			
			$current_model = JModelLegacy::getInstance('officialfrn', 'ClubregModel', array('ignore_request' => true));			
			$current_model->setState('joomla_id',$user->get('id'));		
			
			if($current_model->getPermissions('manageeoi') && $current_model->getPermissions('showeoi') ){
				$proceed = TRUE;
				unset($current_model);
				$current_model = JModelLegacy::getInstance('eois', 'ClubregModel', array('ignore_request' => true));
				$this->howmany_senior = $current_model->getUnApproved("senior");
				$this->howmany_guardian = $current_model->getUnApproved("guardian");				
			}
			unset($current_model);
		}
		
		return $proceed;
		
	}
	private function activity(){
		$user		= JFactory::getUser();
		$proceed = FALSE;
		
		if($user->get('id') > 0){				
			$proceed = TRUE;
			unset($current_model);
			$current_model = JModelLegacy::getInstance('activity', 'ClubregModel', array('ignore_request' => true));
			$this->activity = $current_model->getActivityList($user->get('id'));	
			require_once JPATH_COMPONENT.DS.'helpers'.DS.'clubreg.uniquekeys.php';
			$this->uKeyObject = new ClubRegUniqueKeysHelper();
		}		
		return $proceed;
	}	
	
}