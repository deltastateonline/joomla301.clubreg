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

class ClubRegViewcommunication extends ClubRegViews
{	
	
	protected function edit_communication(){
	
		$proceed = FALSE;
	
		$app			= JFactory::getApplication();
		$user			= JFactory::getUser();
		
		$current_model = JModelLegacy::getInstance('officialfrn', 'ClubregModel', array('ignore_request' => true));
		$current_model->setState('joomla_id',$user->get('id'));
		
		if($current_model->getPermissions('sendcommunication')){
		
			JModelLegacy::addIncludePath(JPATH_COMPONENT_ADMINISTRATOR.'/models');
			
			$template_id =  $app->input->getInt('template_id', null);
			
			$this->comm_id =  $app->input->getInt('comm_id', null);
			$comm_type =  $app->input->getString('comm_type', "email");
			
			unset($commsModel);
			$commsModel = JModelLegacy::getInstance('communication', 'ClubregModel', array('ignore_request' => false));
			
			$commsModel->setState('com_clubreg.communication.comm_id',$this->comm_id); // use the  in the model
			if($comm_type && empty($this->comm_id))
				$commsModel->setState('com_clubreg.communication.comm_type',$comm_type); // use the  in the model
			
			unset($current_model);
			$current_model = JModelLegacy::getInstance('officialfrn', 'ClubregModel', array('ignore_request' => false));
			$current_model->setState('joomla_id',$user->get('id'));
			$this->allowedGroups = $current_model->getMyGroups();			
			
			if($template_id > 0){
				unset($current_model);
				$current_model = JModelLegacy::getInstance('template', 'ClubregModel', array('ignore_request' => false));
				$current_model->setState("template.template_id",$template_id);
				$this->template_data = $current_model->getItem();		

				if(empty($this->comm_id)){
	
					$commsModel->setState('com_clubreg.communication.comm_subject',$this->template_data->template_subject); // Use the template subject
					$commsModel->setState('com_clubreg.communication.comm_message',$this->template_data->template_text); // use the template text
					
					if($comm_type == "sms"){
						$commsModel->setState('com_clubreg.communication.comm_pmessage',$this->template_data->template_ptext); // use the template plain text
					}
				}
				$commsModel->setState('com_clubreg.communication.template_id',$this->template_data->template_id); // use the template plain text
				
				$commsModel->setState('com_clubreg.communication.template_name',$this->template_data->template_name); // use the template plain text
						
			}			
			
			$this->communicationForm = $commsModel->getForm();		
			$this->selectedGroups = $commsModel->get('com_clubreg.communication.comm_sendto_array');
			$this->comm_title = $commsModel->get('com_clubreg.communication.comm_title');			
			
			if(empty($this->comm_title)){
				$this->comm_title = $commsModel->getState('com_clubreg.communication.template_name');
			}
			
			$this->formbackaction = 'index.php'; // back to list
			
			$proceed = TRUE;
		
		}
		return $proceed;
	}
	
	
}