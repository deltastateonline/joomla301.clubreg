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


class ClubRegViewChildren extends ClubRegViews
{

	protected function list_children(){
	
		JSession::checkToken() or die(JText::_('JINVALID_TOKEN'));
		
		$this->setLayout("list.children");
		require_once JPATH_COMPONENT.DS.'helpers'.DS.'clubreg.uniquekeys.php';
		require_once JPATH_COMPONENT.DS.'helpers'.DS.'clubreg.rendertables.children.php';
		require_once CLUBREG_CONFIGS.'config.profile.php';
		
		$user		= JFactory::getUser();
		$app			= JFactory::getApplication();
		$Itemid			= $app->input->post->get('Itemid');
		
		$proceed = FALSE;
		if($user->get('id') > 0){
			$proceed = TRUE;
			$key_data = new stdClass();
			unset($current_model);
			
			$key_data = new stdClass();
			unset($current_model);
			$current_model = JModelLegacy::getInstance('regmember', 'ClubregModel', array('ignore_request' => true));
			$this->parent_key = $key_data->full_key = $app->input->post->getString('parent_key', null); // parent id
				
			$this->uKeyObject = new ClubRegUniqueKeysHelper();
				
			$this->uKeyObject->deconstructKey($key_data);
			$current_model->member_id = $key_data->pk_id;
			$this->items = $current_model->getJuniorDetails($key_data->pk_id);			
			
			$configObj = new ClubRegProfileConfig();
			$parentConfigs =  $configObj->getConfig("guardian"); // return headings which hold config details			
			$tmp_filters["headings"] = $parentConfigs["headings"]["children_p"];
			
			$this->entity_filters = $tmp_filters;	
			
			unset($current_model);unset($tmp_filters);
		}
		
		return $proceed;
	}

}