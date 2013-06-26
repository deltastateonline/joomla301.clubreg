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

class ClubregModelClubgroups extends JModelList{
	
	public function __construct($config = array())
	{
		if (empty($config['filter_fields'])) {
			$config['filter_fields'] = array(
					'a.group_id',					
					'a.group_name','a.group_short',
					'a.created','f.name'					
			);
		}
	
		parent::__construct($config);
	}
	
	
	protected function getListQuery()
	{
		$db		= $this->getDbo();
		$query	= $db->getQuery(true);
			
		
		$d_var = "a.group_id,a.group_name,a.group_short,
		date_format(a.created,'%d/%m/%Y') as created_on,a.group_type,			
		a.published,
		f.name as group_leadername,
		a.checked_out, a.checked_out_time,
		concat('<ol class=\"intable\">',group_concat(DISTINCT concat('<li>', e.name,'</li>') order by e.name ASC SEPARATOR '' ),'</ol>') as group_members ,
		concat('<ol class=\"intable\">',group_concat(DISTINCT concat('<li>', g.group_name,'</li>') order by g.group_name ASC SEPARATOR '' ),'</ol>') as sub_groups 
		";
		
		$query->select($d_var);
		$query->from($db->quoteName(CLUB_GROUPS_TABLE).' AS a');	
		$query->join('LEFT',  '#__users AS f ON a.group_leader = f.id');
		$query->join('LEFT',  "(select st.joomla_id, st.group_id from ".CLUB_MEMBERSGROUPS_TABLE.' as st where st.status = 1) as d ON a.group_id = d.group_id');
		$query->join('LEFT',  "(select cg.group_id, cg.group_name, cg.group_parent from ".CLUB_GROUPS_TABLE.' as cg where cg.published = 1 and cg.group_parent >0 ) as g ON g.group_parent = a.group_id');
		
		$query->join('LEFT',  '#__users AS e ON d.joomla_id = e.id');
		
		$query->where(' a.group_parent = 0 ');
		
		unset($tmp_value);
		$tmp_value = $this->getState('filter.state');
		if (is_numeric($tmp_value) && $tmp_value != -1 ) {
			$query->where('a.published = '.(int) $tmp_value);
		} else {
			$query->where('(a.published IN (0, 1))');
		}
		
		
		$tmp_value = $this->getState('filter.search');
		echo $tmp_value;
		if($tmp_value && strlen($tmp_value) > 3){
			$db->getEscaped( $tmp_value, true );			
			$tmp_value = $db->Quote( '%'.$tmp_value.'%', false );
			
			$query->where(sprintf(' (a.group_name like  %s or a.group_short like %s ) ',
					$tmp_value,$tmp_value));
			
		}		
		
		unset($tmp_value);
		$tmp_value = trim($this->getState('filter.grouptype'));
		
		if($tmp_value && strlen($tmp_value) > 3 && $tmp_value != -1){
			$db->getEscaped( $tmp_value, true );
			$tmp_value = $db->Quote( $tmp_value, false );
			$query->where(sprintf('a.group_type = %s',$tmp_value));
		}
		
			
		
		// Add the list ordering clause.
		$orderCol	= $this->state->get('list.ordering', 'a.group_name');
		$orderDirn	= $this->state->get('list.direction', 'ASC');
		if ($orderCol == 'a.group_name' || $orderCol == 'category_title') {
			//$orderCol = 'c.title '.$orderDirn.', a.ordering';
		}
		
		$query->order($db->escape($orderCol.' '.$orderDirn));
		
		$query->group('d.group_id,a.group_id');
		
		return $query;
		
		
	}
	
	/*
	protected function getStoreId($id = '')
	{
		// Compile the store id.
		$id	.= ':'.$this->getState('filter.search');
		$id	.= ':'.$this->getState('filter.templatestatus');
		$id	.= ':'.$this->getState('filter.templateaccess');
		$id	.= ':'.$this->getState('filter.templatetype');
		$id	.= ':'.$this->getState('filter.state');
		//$id .= ':'.$this->getState('filter.language');
	
		return parent::getStoreId($id);
	}
	*/
	
	protected function populateState($ordering = null, $direction = null)
	{
				
		parent::populateState('a.group_name', 'asc');
		$app = JFactory::getApplication('administrator');	

		$states[] = array("filter.search","filter_search",NULL);
		$states[] = array("filter.state","filter_state","-1");	
		$states[] = array("filter.grouptype","group_type",NULL);	
		
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
	public function getSubGroups(){
		
		$group_children = array();
		
		$input = JFactory::getApplication()->input;
		
		$group_id = (int) $input->getInt('group_id');
		
		$db		= $this->getDbo();
		$query	= $db->getQuery(true);		
		
		$query->select("a.group_id, a.group_name,a.group_type,a.published,a.group_parent, f.name as group_leader");
		$query->from($db->quoteName(CLUB_GROUPS_TABLE) .' as a ');
		$query->join('LEFT',  '#__users AS f ON a.group_leader = f.id');
		$query->where("a.group_parent = ".$group_id);
		$query->order('a.group_name');		
		try {
		
			$db->setQuery($query);
			$group_children = $db->loadObjectList();
		}catch (RuntimeException $e)
		{
			JError::raiseWarning(500, $e->getMessage());
		}
		
		return $group_children;
	}
	
}
