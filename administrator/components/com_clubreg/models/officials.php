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

class ClubregModelOfficials extends JModelList{
	
	public function __construct($config = array())
	{
		if (empty($config['filter_fields'])) {
			$config['filter_fields'] = array(
					'a.joomla_id',
					'b.name',
					'b.username',
					'b.email',					
					'a.status'							
			);
		}
	
		parent::__construct($config);
	}	
	
	protected function getListQuery()
	{
		$db		= $this->getDbo();
		$query	= $db->getQuery(true);			
		
		$d_var = " a.joomla_id, a.status, b.name,b.username,b.email, 
		group_concat(DISTINCT  c.group_name order by c.group_name ASC SEPARATOR ', ' ) as leader_of ,
		group_concat(DISTINCT  e.group_name order by e.group_name ASC SEPARATOR ', ' ) as member_of ";
		
		$query->select($d_var);
		$query->from($db->quoteName(CLUB_MEMBERS_TABLE).' AS a');
		
		$query->join('LEFT',  '#__users AS b ON a.joomla_id = b.id');
		$query->join('LEFT',  CLUB_GROUPS_TABLE.' AS c ON a.joomla_id = c.group_leader');		
		$query->join('LEFT',  "(select st.joomla_id, st.group_id from ".CLUB_MEMBERSGROUPS_TABLE.' as st where st.status = 1) as d ON a.joomla_id = d.joomla_id');
		$query->join('LEFT',  CLUB_GROUPS_TABLE.' AS e ON d.group_id = e.group_id');
		
		unset($tmp_value);
		$tmp_value = $this->getState('filter.state');
		if (is_numeric($tmp_value) && $tmp_value != -1 ) {
			$query->where('a.status = '.(int) $tmp_value);
		} else {
			$query->where('(a.status =1 )');
		}

		unset($tmp_value);
		$tmp_value = $this->getState('filter.leaderof');
		if (is_numeric($tmp_value) && $tmp_value != -1 ) {
			$query->where('c.group_id = '.(int) $tmp_value);
		} 
		
		unset($tmp_value);
		$tmp_value = $this->getState('filter.memberof');
		if (is_numeric($tmp_value) && $tmp_value != -1 ) {
			$query->where('d.group_id = '.(int) $tmp_value);
		} 

		unset($tmp_value);
		$tmp_value = $this->getState('filter.search');
		if($tmp_value && strlen($tmp_value) > 3){
			$db->getEscaped( $tmp_value, true );			
			$tmp_value = $db->Quote( '%'.$tmp_value.'%', false );
			
			$query->where(sprintf(' ( b.name LIKE %s or b.username like %s )',
					$tmp_value,$tmp_value));
			
		}	
		
		// Add the list ordering clause.
		$orderCol	= $this->state->get('list.ordering', 'b.name');
		$orderDirn	= $this->state->get('list.direction', 'ASC');
		
		$query->order($db->escape($orderCol.' '.$orderDirn));	
		
		$query->group('d.joomla_id,a.joomla_id');
		
		return $query;		
	}
	
	
	protected function getStoreId($id = '')
	{
		// Compile the store id.
		$id	.= ':'.$this->getState('filter.search');		
		$id	.= ':'.$this->getState('filter.state');	
		return parent::getStoreId($id);
	}
	
	
	protected function populateState($ordering = null, $direction = null)
	{
				
		parent::populateState('b.name', 'asc');
		$app = JFactory::getApplication('administrator');	

		$states[] = array("filter.search","filter_search",NULL);
		$states[] = array("filter.state","filter_state","-1");	
		$states[] = array("filter.memberof","filter_memberof","-1");
		$states[] = array("filter.leaderof","filter_leaderof","-1");
		
		$tmp_value = null;
		foreach($states as $a_state){
			$tmp_value = $this->getUserStateFromRequest($this->context.'.'.$a_state[0], $a_state[1], $a_state[2]);
			$this->setState($a_state[0], $tmp_value);
			
			unset($tmp_value);
		}
		
		// Load the parameters.
		$params = JComponentHelper::getParams('com_clubreg');
		$this->setState('params', $params);	
		
	}
	/**
	 * @desc get the list of users who are not linked
	 * @return Ambigous <mixed, NULL, multitype:unknown mixed >
	 */
	function getlinkedOfficials(){
		
		$items = array();
		$db		= $this->getDbo();
		$query	= $db->getQuery(true);
		
		$d_var = "	a.id, a.name, a.username, a.email, ug.title AS groupname ";
		
		$query->select($d_var);
		$query->from(' #__users AS a');		
		$query->join('INNER',  '#__user_usergroup_map  AS map ON map.user_id = a.id');		
		$query->join('INNER',  '#__usergroups AS ug ON ug.id = map.group_id');
		
		$query->where(sprintf('a.id not in (select joomla_id from %s where status = 1) ',
				CLUB_MEMBERS_TABLE));
		
		$db->setQuery($query);	
		
		try	{
			$items = $db->loadObjectList();
		}
		catch (RuntimeException $e)	{
			JError::raiseWarning(500, $e->getMessage());
		}
		
		return $items;
		
		
		
	}
	
}
