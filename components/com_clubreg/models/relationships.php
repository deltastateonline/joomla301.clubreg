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
class ClubregModelRelationships extends JModelList
{
	
	public function __construct($config = array())
	{
		if (empty($config['filter_fields'])) {
			$config['filter_fields'] = array(
					'a.payment_id',
					'a.member_id','a.created'					
			);
		}
	
		parent::__construct($config);
		
		//Get configuration
		$app    = JFactory::getApplication();
		$config = JFactory::getConfig();		
		
		$this->setState('limit', $app->getUserStateFromRequest('com_clubreg.limit', 'limit', $config->get('list_limit'), 'uint'));
		$this->setState('limitstart', $app->input->get('limitstart', 0, 'uint'));
		
	}
	public function getRelationships($user_id,$member_id = null){
		
		$db		= $this->getDbo();
		
		
		$paymentList = array();
		
		if(count($paymentList) > 0){
			return $paymentList;
		}else 
			return array();
		
	}
	
	public function getSearchPlayers(){
	
		$db		= $this->getDbo();
		$query	= $db->getQuery(true);
	
	
		// Add the list ordering clause.
		$orderCol	= $this->state->get('list.ordering', 'a.surname');
		$orderDirn	= $this->state->get('list.direction', 'ASC');
	
		$this->getState('com_clubreg.regmember.member_key');
	
		$member_id  = $this->getState('com_clubreg.regmembers.member_id');
	
		$start_value  = $this->getState('com_clubreg.relationships.start_value');	
		$search_value = sprintf('%%%s%%',$this->getState('com_clubreg.relationships.search_value'));
	
		$where_ = array();
	
		$where_[] = sprintf("(a.surname like %s or a.givenname like %s ) ", $db->quote($search_value),$db->quote($search_value));
		$where_[] = sprintf("a.playertype in ('junior','senior') ");  // Only junior and senior Members
			
	
		$all_string[] = "a.*";
		$all_string[] = "b.group_name";
		$all_string[] = "sg.group_name as `subgroup_name`";
	
		$d_var =implode(",", $all_string);
	
		$query->select($d_var);
		$query->from($db->quoteName(CLUB_REGISTEREDMEMBERS_TABLE).' AS a');
		$query->join('LEFT', CLUB_GROUPS_TABLE.' AS b ON a.group = b.group_id');
		$query->join('LEFT', CLUB_GROUPS_TABLE.' AS sg ON a.subgroup = sg.group_id');
	
		foreach($where_ as $a_where){
			$query->where($a_where);
		}
	
		$query->order($db->escape($orderCol.' '.$orderDirn));
	
		$db->setQuery($query, $start_value,30);
		$all_data = $db->loadObjectList();
	
		$clonequery = clone $query;
		$clonequery->clear('select')->clear('order')->clear('limit')->clear('offset')->select('COUNT(*)');
		$db->setQuery($clonequery);
		$something = $db->loadResult();
	
		return 	$all_data;
	}
}