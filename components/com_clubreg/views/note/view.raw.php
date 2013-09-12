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


class ClubRegViewNote extends ClubRegViews
{

	protected function list_note(){
		
		JSession::checkToken() or die(JText::_('JINVALID_TOKEN'));
		
		$this->setLayout("list.note");
		
		require_once JPATH_COMPONENT.DS.'helpers'.DS.'clubreg.uniquekeys.php';
		
		$user		= JFactory::getUser();
		$app			= JFactory::getApplication();		
		$Itemid			= $app->input->post->get('Itemid');
		
		$proceed = FALSE;
		if($user->get('id') > 0){
			$proceed = TRUE;
			$key_data = new stdClass();
			unset($current_model);
			$current_model = JModelLegacy::getInstance('regmember', 'ClubregModel', array('ignore_request' => true));
			$key_data->full_key = $app->input->post->getString('member_key', null);
			$current_model->processKey($key_data);			
			
			unset($current_model);
			$note_type = $app->input->post->getString('note_type', 'member');
			$current_model = JModelLegacy::getInstance('notes', 'ClubregModel', array('ignore_request' => true));
			$this->notes = $current_model->getNotes($user->get('id'),$key_data->member_id,$note_type);
			$this->uKeyObject = new ClubRegUniqueKeysHelper();
			unset($key_data);			
		}
		return $proceed;		
	}

}