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

class ClubregModelPayments extends JModelList{
	
	public function __construct($config = array())
	{
		if (empty($config['filter_fields'])) {
			$config['filter_fields'] = array(
					'a.product_id',
					'b.name',
					'a.product_name',					
					'a.published',
					'a.created',				
			);
		}
	
		parent::__construct($config);
	}	
	
	protected function getListQuery()
	{
		$db		= $this->getDbo();
		$query	= $db->getQuery(true);	
		
		$d_var = "	a.product_id, a.product_name, a.product_desc, a.product_amount,					
					date_format(a.created,'%d/%m/%Y') as created_on,
					date_format(a.validfrom,'%d/%m/%Y') as validfrom_str,
					date_format(a.validto,'%d/%m/%Y') as validto_str,					
					a.published,b.name, a.params";
		
		$query->select($d_var);
		$query->from($db->quoteName(CLUB_PAYMENTS_SETUP_TABLE).' AS a');
		
		$query->join('LEFT',  '#__users AS b ON a.createdby = b.id');
		
		unset($tmp_value);
		$tmp_value = $this->getState('filter.state');
		if (is_numeric($tmp_value) && $tmp_value != -1 ) {
			$query->where('a.published = '.(int) $tmp_value);
		} else {
			$query->where('(a.published IN (0, 1))');
		}				
				
		$tmp_value = $this->getState('filter.search');
		if($tmp_value && strlen($tmp_value) > 3){
			$db->getEscaped( $tmp_value, true );			
			$tmp_value = $db->Quote( '%'.$tmp_value.'%', false );
			
			$query->where(sprintf(' a.product_desc like  %s  or a.product_name like %s ',
					$tmp_value,$tmp_value));
			
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
				
		parent::populateState('a.product_desc', 'asc');
		$app = JFactory::getApplication('administrator');	

		$states[] = array("filter.search","filter_search",NULL);
		$states[] = array("filter.state","filter_state","-1");	
	
		
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
