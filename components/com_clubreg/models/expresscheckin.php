<?php
/*------------------------------------------------------------------------
# com_clubreg - Manage Club Member Registrations
# ------------------------------------------------------------------------
# author    Omokhoa Agbagbara
# copyright Copyright (C) 2013 applications.deltastateonline.com. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://applications.deltastateonline.com
# Technical Support:  email - joomla@deltastateonline.com
-------------------------------------------------------------------------*/
defined('_JEXEC') or die;
class ClubregModelExpresscheckin extends JModelList
{
	
	public function __construct($config = array())
	{
		if (empty($config['filter_fields'])) {
			$config['filter_fields'] = array(
					'a.member_id',
					'a.surname','a.givenname',
					'a.emailaddress',
					'a.gender'
			);
		}
	
		parent::__construct($config);
		
		//Get configuration
		$app    = JFactory::getApplication();
		$config = JFactory::getConfig();		
		
		$this->setState('limit', $app->getUserStateFromRequest('com_clubreg.limit', 'limit', $config->get('list_limit'), 'uint'));
		$this->setState('limitstart', $app->input->get('limitstart', 0, 'uint'));
		
	}
	
	protected function getListQuery(){
		
		
		$db		= $this->getDbo();
		$query	= $db->getQuery(true);
		
		
		// Add the list ordering clause.
		$orderCol	= $this->state->get('list.ordering', 'a.surname');
		$orderDirn	= $this->state->get('list.direction', 'ASC');
		
		$this->getState('com_clubreg.expresscheckin.member_key');
		
		//$member_id  = $this->getState('com_clubreg.expresscheckin.member_id');
		$search_value = sprintf('%%%s%%',$this->getState('com_clubreg.expresscheckin.search_value'));
		
		$groupIds = $this->getState('com_clubreg.expresscheckin.group_ids');
		
		
		$where_ = array();
		
		$where_[] = sprintf("(a.surname like %s or a.givenname like %s) ", $db->quote($search_value),$db->quote($search_value));
		//$where_[] = sprintf("a.playertype = 'guardian' ");  // Only Eoi Members
		
		if(!empty($groupIds["sub_groups_ids"])){
			$where_[] = sprintf("( a.group in (%s) or  a.subgroup in (%s) )",
					implode(",",$groupIds["allowed_groups"]),
					implode(",",$groupIds["sub_groups_ids"]));  // Only Eoi Members
		}else{
			if(!empty($groupIds["allowed_groups"]))
				$where_[] = sprintf(" a.group in (%s) ",implode(",",$groupIds["allowed_groups"]));  // Only Eoi Members
		}		
		
		$all_string[] = "a.*";
		
		$d_var =implode(",", $all_string);
		
		$query->select($d_var);
		$query->from($db->quoteName(CLUB_REGISTEREDMEMBERS_TABLE).' AS a');
		
		foreach($where_ as $a_where){
			$query->where($a_where);
		}
		
		$query->order($db->escape($orderCol.' '.$orderDirn));
		
		return $query;
		
	}
}