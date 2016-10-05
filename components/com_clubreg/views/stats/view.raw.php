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


class ClubRegViewstats extends ClubRegViews{
	
	
	protected function expresscheckin_stats(){
		
		JSession::checkToken('post') or die(JText::_('JINVALID_TOKEN'));
		
		$user		= JFactory::getUser();
		$app			= JFactory::getApplication();
		$Itemid			= $app->input->post->get('Itemid');
		
		$group_breakdown = array();
		
		$this->setLayout("raw.expresscheckin");
		
		$proceed = FALSE;
		if($user->get('id') > 0){
			$proceed = TRUE;
			
			require_once JPATH_COMPONENT.DS.'helpers'.DS.'clubreg.uniquekeys.php';			
			
			$current_model = JModelLegacy::getInstance('officialfrn', 'ClubregModel', array('ignore_request' => true));
			$current_model->setState('joomla_id',$user->get('id'));
			$this->allowedGroups = $current_model->getMyGroups();
			
			$all_groups = array("allowed_groups"=>$this->allowedGroups['allowed_groups'],"sub_groups_ids"=>$this->allowedGroups['sub_groups_ids']);
					
			$key_data = new stdClass();
			
			$search_value = $app->input->post->getString('search_value', null);			
			$current_model = JModelLegacy::getInstance('expresscheckin', 'ClubregModel', array('ignore_request' => true));
			
			$current_model->setState('com_clubreg.expresscheckin.search_value',trim($search_value));
			$current_model->setState('com_clubreg.expresscheckin.group_ids',$all_groups);			
			
			$this->items		=  $current_model->getItems();
			$this->pagination	= $current_model->getPagination();		
			
			$this->uKeyObject = new ClubRegUniqueKeysHelper();			
			
		}
		return $proceed;
	}
	
	
	
	
}