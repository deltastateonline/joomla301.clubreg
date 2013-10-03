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

class ClubRegViewOfficial extends JViewLegacy
{

	
	function display($tpl = null)
	{	
		$this->_display();
	}
	
	function _display($tpl = null){		

		global $mainframe;
		
		$app		= JFactory::getApplication();
		$user		= JFactory::getUser();
		$dispatcher = JEventDispatcher::getInstance();
		$state		= $this->get('State');
		
		
		// Get the parameters
		$params = JComponentHelper::getParams('com_clubreg');		
		$renderer =  $this->getLayout();				
		$current_model = JModelLegacy::getInstance('officialfrn', 'ClubregModel', array('ignore_request' => true)); 	
		
		$active	= $app->getMenu()->getActive(); // if logged in		
		
		$proceed =FALSE;
		
		$this->member_id = NULL;		
		$this->extradetails = array();
		$this->canedit = FALSE;
		
		$this->Itemid = $app->getUserState('com_clubreg.edit.official.Itemid');		
		
		if(isset($active->query)){ // routed thru the menu object
			
			if(isset($active->query['id']) && $active->query['id'] == '-1' && $user->id > 0 && $active->access > 1){ // there is a link but the id is set to -1
				$this->member_id = $user->id;
				$renderer = ($renderer == "edit")?"edit":"readonly";
				$proceed = TRUE;
				$this->canedit = TRUE;		
				
			}else{ // standard menu link
				
				$this->member_id = $active->query['id'];
				if($this->member_id > 0){
					$renderer = "readonly";
					$proceed = TRUE;
				}
			}
			
			
			if($proceed){
			
				$current_model->setState('joomla_id',$this->member_id);
				$this->official_details = $current_model->getDetails();
				unset($current_model);
				
				if($this->official_details->status == 1){ // ie official has been linked					
					require_once CLUBREG_ADMINPATH.'helpers/clubregcontrols.php';					
					$this->extradetails = ClubRegControlsHelper::configOptions(CLUB_MEMBER_WHICH);
				}else{
					$renderer = NULL;
				}
		
			}			
			
		}else{
			$renderer = NULL;
		}	
		
		$this->setLayout($renderer);		
		
		if(method_exists($this, $renderer)){
			$this->$renderer();
			parent::display($tpl);
		}else{
			ClubRegUnAuthHelper::unAuthorised();
		}					
	}
	
	private function edit(){
		JForm::addFieldPath(CLUBREG_ADMINPATH.'/models/fields');	
		return;
	}
	
	
	private function readonly(){		
		require_once CLUBREG_ADMINPATH.'helpers/clubregcontrolsreadonly.php';		
		
		$app		= JFactory::getApplication();
		$active	= $app->getMenu()->getActive(); // if logged in
		
		$session = JFactory::getSession();
		$session->set("com_clubreg.cancel_profile", $active->link);// save the back url	
		$this->formaction_edit = 'index.php?option=com_clubreg&view=regmember';
		return;
	}
	
}