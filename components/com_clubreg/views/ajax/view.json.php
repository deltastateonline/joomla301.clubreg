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
			//parent::display($tpl);
		}else{
			ClubRegUnAuthHelper::unAuthorised();
		}
	}
	
	private function mygroups(){
	
		JSession::checkToken() or die(JText::_('JINVALID_TOKEN'));
	
		$user		= JFactory::getUser();
		$app			= JFactory::getApplication();
		$Itemid			= $app->input->post->get('Itemid');
	
		$proceed = FALSE;
		if($user->get('id') > 0){
			
			$current_model = JModelLegacy::getInstance('officialfrn', 'ClubregModel', array('ignore_request' => true));
			$current_model->setState('joomla_id',$user->get('id'));
			
			$group_type			= $app->input->post->get('group_type');			
			$all_groups = $current_model->getMyGroups($group_type);
			
			unset($current_model);			
			
			$tmp[] = JHtml::_('select.option', '-1',	'-Select '.JText::_('COM_CLUBREG_GROUPN_LABEL').' -', "value", "text");
			$save_ids = array();
			foreach($all_groups["allowed_groups_options"] as $a_group){
				if(in_array($a_group->group_id, $save_ids)){
					continue;
				}
				$tmp[] = JHtml::_('select.option', $a_group->group_id,	$a_group->group_name, "value", "text");
				$save_ids[$a_group->group_id] = $a_group->group_id;
			}
				
			
				
			echo json_encode($tmp);
				
			unset($all_groups);
			unset($tmp);
				
			$proceed = TRUE;
		}
		return $proceed;
	}

	
	private function subgroups(){
		
		JSession::checkToken() or die(JText::_('JINVALID_TOKEN'));
		
		$user		= JFactory::getUser();
		$app			= JFactory::getApplication();
		$Itemid			= $app->input->post->get('Itemid');
		
		$proceed = FALSE;
		if($user->get('id') > 0){
			
			$group_id	= $app->input->post->get('group_id');		
			$subgroups = ClubRegHelper::get_subgroup_list("value" ,"text",$group_id);			
			$tmp = JHtml::_('select.option', '-1',	'-Select '.JText::_('COM_CLUBREG_SUBGROUPSN_LABEL').' -', "value", "text");
			
			array_unshift($subgroups,$tmp);
			
			echo json_encode($subgroups);
			
			unset($subgroups);
			unset($tmp);
			
			$proceed = TRUE;
		}		
		return $proceed;		
	}
		
}