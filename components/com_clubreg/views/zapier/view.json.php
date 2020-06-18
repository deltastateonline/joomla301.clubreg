<?php
/*------------------------------------------------------------------------
# com_clubreg - Manage Club Member Registrations
# ------------------------------------------------------------------------
# author    Omokhoa Agbagbara
# copyright Copyright (C) 2020 app.deltastateonline.com. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://applications.deltastateonline.com
# Technical Support:  email - joomla@deltastateonline.com
-------------------------------------------------------------------------*/
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

use Joomla\CMS\Response\JsonResponse;
//https://joomla301.local/index.php?option=com_clubreg&view=zapier&layout=view&tmpl=component&format=json
class ClubRegViewZapier extends ClubRegViews
{	
	
	
	protected function view_zapier(){
		
		$proceed = TRUE;	
		JSession::checkToken() or die(JText::_('JINVALID_TOKEN'));
		
		$user		= JFactory::getUser();
		$app		= JFactory::getApplication();
		
		if($user->get('id') > 0){
			
			require_once JPATH_COMPONENT.DS.'helpers'.DS.'clubreg.uniquekeys.php';
			require_once JPATH_COMPONENT.DS.'logic'.DS.'zapier'.DS.'allmappers.php';
			
			$key_data = new stdClass();
			$current_model = JModelLegacy::getInstance('regmember', 'ClubregModel', array('ignore_request' => true));			
			$this->member_key = $key_data->full_key = $app->input->post->getString('member_key', null);	
			
			$current_model->setState('com_clubreg.regmember.member_key',$this->member_key); // use the key in the model			

			$tmp = $current_model->getMemberDetails(); // this might be wrong			
			$this->pagedata["memberDetails"] = MemberDetails::mapped($tmp["member_data"]);			
			
			
			$this->uKeyObject = new ClubRegUniqueKeysHelper();			
			$key_data = $this->uKeyObject->deconstructKey($key_data);	
			$this->member_id = $key_data->pk_id;

			$current_model = JModelLegacy::getInstance('payments', 'ClubregModel', array('ignore_request' => true));
			$this->pagedata["payments"] = Payments::mapping($current_model->getPayments($user->get('id'),$this->member_id));			
			
			unset($currentModel);
			$currentModel = JModelLegacy::getInstance('alerts', 'ClubregModel', array('ignore_request' => false));
			$this->pagedata['alerts'] = Alerts::mapping($currentModel->getAlerts(1,$this->member_id ));			
			
			unset($current_model);
			$note_type =  $link_type =  'member';
			$current_model = JModelLegacy::getInstance('attachments', 'ClubregModel', array('ignore_request' => true));
			$this->pagedata['attachments'] = Attachments::mapping($current_model->getAttachments($user->get('id'),$this->member_id,$link_type));			
			unset($current_model);
			
			$current_model = JModelLegacy::getInstance('notes', 'ClubregModel', array('ignore_request' => true));			
			$this->pagedata['notes'] = Notes::mapping($current_model->getNotes($user->get('id'),$this->member_id,$note_type));
			
			unset($current_model);
			
			$current_model = JModelLegacy::getInstance('relationships', 'ClubregModel', array('ignore_request' => true));
			$this->pagedata['relationships'] = Relationships::mapping($current_model->getRelationships($user->get('id'),$this->member_id));
			
			unset($current_model);
			
			
			if($tmp["member_data"]->playertype == "junior"){
				$current_model = JModelLegacy::getInstance('regmember', 'ClubregModel', array('ignore_request' => true));
				$current_model->setState('com_clubreg.regmember.member_id',$key_data->pk_id);
				$this->pagedata['guardian']=  Guardian::mapped($current_model->getParentDetails());
			
				unset($current_model);
			
				$current_model = JModelLegacy::getInstance('contactlists', 'ClubregModel', array('ignore_request' => true));
				$this->pagedata['contacts'] = Contacts::mapping($current_model->getContactlists($user->get('id'),$this->member_id));
				unset($current_model);
			}			
			
		}
		
		return $proceed;
	}
}