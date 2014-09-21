<?php
/*------------------------------------------------------------------------
# com_clubreg - Manage Club Member Registrations
# ------------------------------------------------------------------------
# author    Omokhoa Agbagbara
# copyright Copyright (C) 2014 applications.deltastateonline.com. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://applications.deltastateonline.com
# Technical Support:  email - joomla@deltastateonline.com
-------------------------------------------------------------------------*/
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.view');

class ClubRegViewcommunication extends JViewLegacy
{
	function display($tpl = null)
	{
		
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
	
	private function edit(){
	
		$proceed = FALSE;
	
		$app			= JFactory::getApplication();
		$user			= JFactory::getUser();
		
		JModelLegacy::addIncludePath(JPATH_COMPONENT_ADMINISTRATOR.'/models');
		
		$template_id =  $app->input->getInt('template_id', null);
		$communication_key =  $app->input->getString('communication_key', null);
		$communication_id =  $app->input->getInt('comm_id', null);
		
		unset($commsModel);
		$commsModel = JModelLegacy::getInstance('communication', 'ClubregModel', array('ignore_request' => false));
		$commsModel->setState('com_clubreg.communication.communication_key',$communication_key); // use the key in the model
		$commsModel->setState('com_clubreg.communication.comm_id',$communication_id); // use the key in the model
		
		if($template_id > 0){
			unset($current_model);
			$current_model = JModelLegacy::getInstance('template', 'ClubregModel', array('ignore_request' => false));
			$current_model->setState("template.template_id",$template_id);
			$this->template_data = $current_model->getItem();		

			$commsModel->setState('com_clubreg.communication.comm_subject',$this->template_data->template_subject); // Use the template subject
			$commsModel->setState('com_clubreg.communication.comm_message',$this->template_data->template_text); // use the template text
			$commsModel->setState('com_clubreg.communication.comm_pmessage',$this->template_data->template_ptext); // use the template plain text
			
			
		}	
		
		
		$this->communicationForm = $commsModel->getForm();
		
		
		
		
		
		/*
		
		unset($currentModel);
		$currentModel = JModelLegacy::getInstance('communication', 'ClubregModel', array('ignore_request' => false));
		$currentModel->setState('com_clubreg.communication.communication_id',$key_data->pk_id); // use the key in the model
		$currentModel->setState('com_clubreg.communication.template_id',$template_id); // use the key in the model
		
		$this->emergencyForm = $currentModel->getForm();
		
		*/
		//$tmp_filters["currentTemplates"] = $current_model->getCurrentTemplates();
		
		
		return TRUE;
	}
	
	
}