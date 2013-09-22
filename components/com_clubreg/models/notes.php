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
class ClubregModelNotes extends JModelList
{
	
	public function __construct($config = array())
	{
		if (empty($config['filter_fields'])) {
			$config['filter_fields'] = array(
					'a.note_key',
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
	public function getNotes($user_id,$primary_id,$note_type='member'){
		
		$where_[] = sprintf(" primary_id = %d",$primary_id) ;
		$where_[] = sprintf(" ( note_status in (0) or a.created_by = %d  )",$user_id) ;
		$where_[] = sprintf("  note_status != 99 ") ;
		$where_[] = sprintf("  note_type = '%s' ",$note_type) ;
		
		$where_str = implode(" and ", $where_);
		
		$db		= $this->getDbo();
		$query	= $db->getQuery(true);
		
		$all_string[] = " hex(`note_key`) as note_key, `primary_id`, `notes`,  `note_status`, `note_type`";
		$all_string[] = "date_format(a.created, '%d/%m/%Y %H:%i:%s') as created, user_reg.name ";
		
		$d_var = implode(",", $all_string);
		$query->select($d_var);
		$query->from($db->quoteName(CLUB_NOTES_TABLE).' AS a');
		$query->join('LEFT', '#__users AS user_reg ON a.created_by = user_reg.id');			
		
		foreach($where_ as $a_where){
			$query->where($a_where);
		}		
		
		$query->order('a.created desc');
		
		$db->setQuery($query);
			
		try {
			$notesList = $db->loadObjectList();
			return $notesList;
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	 
			return array();
		
	}
}