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

class ClubregModelSettings extends JModelList{
	
	public function __construct($config = array())
	{
		if (empty($config['filter_fields'])) {
			$config['filter_fields'] = array(
					'a.config_id',
					'b.name',
					'a.config_short',
					'a.config_name',	
					'a.published',
					'a.created',
					'a.ordering'		
			);
		}
	
		parent::__construct($config);
	}
	
	public function getSettingsConfig(){		
		return ClubRegHelper::configOptions($this->whichConfig);		
	}	
	
	protected function getListQuery()
	{
		$db		= $this->getDbo();
		$query	= $db->getQuery(true);	
		
		$d_var = "	a.config_id, a.config_name, a.config_short, a.config_text, a.config_type,
					a.which_config, a.config_comments,
					date_format(a.created,'%d/%m/%Y') as created_on,
					a.published,b.name,a.ordering, a.params";
		
		$query->select($d_var);
		$query->from($db->quoteName(CLUB_CONFIG_TABLE).' AS a');
		
		$query->join('LEFT',  '#__users AS b ON a.createdby = b.id');
		
		unset($tmp_value);
		$tmp_value = $this->getState('filter.state');
		if (is_numeric($tmp_value) && $tmp_value != -1 ) {
			$query->where('a.published = '.(int) $tmp_value);
		} else {
			$query->where('(a.published IN (0, 1))');
		}		
		
		$tmp_value = $this->getState('filter.whichConfig');	
			
		if($tmp_value == TOPMOST || is_null($tmp_value) || strlen($tmp_value) == 0 ){
			$tmp_value = TOPMOST;
			$query->where(sprintf("a.which_config = %s",$db->Quote($tmp_value)));
				
			$query->select('group_concat(c.config_name ORDER BY c.config_name ASC SEPARATOR ", ") as children ');
			$query->join('left', CLUB_CONFIG_TABLE.' as c on (a.config_short = c.which_config)');
		
			$query->group('a.config_short');
		
			$this->setState('has_children',true);
			$this->setState('filter.whichConfig',TOPMOST);
		}else{
			$query->where(sprintf("a.which_config = %s",$db->Quote($tmp_value)));
			$this->setState('has_children',false);
		}		
				
		$tmp_value = $this->getState('filter.search');
		if($tmp_value && strlen($tmp_value) > 2){
			$db->getEscaped( $tmp_value, true );			
			$tmp_value = $db->Quote( '%'.$tmp_value.'%', false );
			
			$query->where(sprintf(' (a.config_name like  %s or a.config_short like %s or a.config_text  like %s ) ',
					$tmp_value,$tmp_value,$tmp_value));
			
		}		
		
		// Add the list ordering clause.
		$orderCol	= $this->state->get('list.ordering', 'ordering');
		$orderDirn	= $this->state->get('list.direction', 'ASC');
		
		$query->order($db->escape($orderCol.' '.$orderDirn));	
		
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
				
		parent::populateState('a.config_name', 'asc');
		$app = JFactory::getApplication('administrator');	

		$states[] = array("filter.search","filter_search",NULL);
		$states[] = array("filter.state","filter_state","-1");	
		$states[] = array("filter.whichConfig","which_config",NULL);	
		
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
	
}
