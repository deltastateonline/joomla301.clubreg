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

class ClubregModelTemplates extends JModelList{
	
	public function __construct($config = array())
	{
		if (empty($config['filter_fields'])) {
			$config['filter_fields'] = array(
					'template_id', 'a.template_id',
					'a.template_status','template_status',
					'a.template_name','template_name',
					'a.created','f.name'					
			);
		}
	
		parent::__construct($config);
	}
	
	public function getTemplateConfig(){		
		return ClubRegHelper::configOptions($this->whichConfig);		
	}
	
	
	
	protected function getListQuery()
	{
		$db		= $this->getDbo();
		$query	= $db->getQuery(true);
			
		
		$d_var = "a.template_id,a.template_name,a.template_subject,a.template_text,
		date_format(a.created,'%d/%m/%Y') as created_on,
		(case when( length(a.template_access)=0 or a.template_access = '-1') then '-No Usergroup-' else c.config_name end) as template_access,
		(case when( length(a.template_status)=0 or a.template_status = '-1') then '-Status-' else d.config_name end) as template_status,
		(case when( length(a.template_type)=0 or a.template_type = '-1') then '-Status-' else e.config_name end) as template_type,		
		a.published,
		f.name,
		a.checked_out, a.checked_out_time
		";
		
		$query->select($d_var);
		$query->from($db->quoteName(CLUB_TEMPLATE_TABLE).' AS a');
		
		$query->join('LEFT', CLUB_CONFIG_TABLE. ' AS c ON a.template_access = c.config_short');
		$query->join('LEFT', CLUB_CONFIG_TABLE. ' AS d ON a.template_status = d.config_short');
		$query->join('LEFT', CLUB_CONFIG_TABLE. ' AS e ON a.template_type = e.config_id');
		$query->join('LEFT',  '#__users AS f ON a.created_by = f.id');
		
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
			
			$query->where(sprintf(' (a.template_name like  %s or a.template_subject like %s or a.template_text  like %s ) ',
					$tmp_value,$tmp_value,$tmp_value));
			
		}		
		
		unset($tmp_value);
		$tmp_value = trim($this->getState('filter.templatestatus'));
		
		if($tmp_value && strlen($tmp_value) > 3 && $tmp_value != -1){
			$db->getEscaped( $tmp_value, true );
			$tmp_value = $db->Quote( $tmp_value, false );
			$query->where(sprintf('a.template_status = %s',$tmp_value));
		}
		
		unset($tmp_value);
		$tmp_value = trim($this->getState('filter.templateaccess'));
		
		if($tmp_value && strlen($tmp_value) > 3 && $tmp_value != -1){			
			$db->getEscaped( $tmp_value, true );
			$tmp_value = $db->Quote( $tmp_value, false );			
			$query->where(sprintf('a.template_access = %s',$tmp_value));
		}		
		
		// Add the list ordering clause.
		$orderCol	= $this->state->get('list.ordering', 'ordering');
		$orderDirn	= $this->state->get('list.direction', 'ASC');
		if ($orderCol == 'ordering' || $orderCol == 'category_title') {
			//$orderCol = 'c.title '.$orderDirn.', a.ordering';
		}
		
		$query->order($db->escape($orderCol.' '.$orderDirn));
		
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
				
		parent::populateState('a.template_name', 'asc');
		$app = JFactory::getApplication('administrator');		
	
		// Load the filter state.
		$search = $this->getUserStateFromRequest($this->context.'.filter.search', 'filter_search');
		$this->setState('filter.search', $search);	
		
		$template_status = $this->getUserStateFromRequest($this->context.'.filter.templatestatus', 'template_status', '-1');
		$this->setState('filter.templatestatus', $template_status);
		
		$template_access = $this->getUserStateFromRequest($this->context.'.filter.templateaccess', 'template_access', '-1');
		$this->setState('filter.templateaccess', $template_access);
		
		$tmp_value = $this->getUserStateFromRequest($this->context.'.filter.state', 'filter_state', '-1');
		$this->setState('filter.state', $tmp_value);
		
		unset($tmp_value);
		$tmp_value = $this->getUserStateFromRequest($this->context.'.filter.usergroup', 'user_group', '-1');
		$this->setState('filter.usergroup', $tmp_value);
		
		unset($tmp_value);
		$tmp_value = $this->getUserStateFromRequest($this->context.'.filter.templatetype', 'template_type', '-1');
		$this->setState('filter.templatetype', $tmp_value);
	
		// Load the parameters.
		$params = JComponentHelper::getParams('com_clubreg');
		$this->setState('params', $params);
		// List state information.		
		
	}
	
	public function getCurrentTemplates(){
		
		$options = array();
		$db		= JFactory::getDBO();
		$query	= $db->getQuery(true);
		
		$d_var = " -1 as value, '-".JText::_('COM_CLUBREG_COMMS_TEMPLATES')."-' as text union 
		select '0' as value, '".JText::_('CLUBREG_COMMUNICATIONS_BLANK')."' as text union 
		select a.template_id as value , a.template_name as text ";
		
		$query->select($d_var);
		$query->from($db->quoteName(CLUB_TEMPLATE_TABLE).' AS a');
		
		$query->where('a.published = 1');
		
		$query->order($db->escape('text asc'));
		
		$db->setQuery($query);
		try {
			$options = $db->loadObjectList();
		} catch (RuntimeException $e) {
			JError::raiseWarning(500, $e->getMessage());
		}		
		
		return $options;
	}
	
	
	
}
