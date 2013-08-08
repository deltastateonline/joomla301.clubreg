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

class ClubregModelOfficialfrn extends JModelForm
{
	
	protected $view_item = 'officialfrn';

	protected $_item = null;
	
	protected $_context = 'com_clubreg.officialfrn';
	
	public function getForm($data = array(), $loadData = true)
	{
		// Get the form.		
		$form = $this->loadForm('com_clubreg.officialfrn', 'officialfrn', array('control' => 'jform', 'load_data' => true));		
		if (empty($form)) {
			return false;
		}
		return $form;
	}
	
	
	protected function loadFormData()
	{
		//$data = (array) JFactory::getApplication()->getUserState('com_clubreg.officialfrn.data', array());
		if (empty($data)) {
			//$data = $this->getItem();
		}
		return $data;
	}
	public function getDetails(){
		
		$joomla_id = $this->getState("joomla_id");	
		
		require_once (JPATH_ADMINISTRATOR.DS.'components'.DS.'com_clubreg'.DS.'models'.DS.'official.php');
		$officialAdmin = new ClubRegModelOfficial();
		$results = $officialAdmin->getItem($joomla_id);
		unset($officialAdmin);
		return $results;
	}
	
	public function saveExtraDetails($extraDetails,$monthyear){
		require_once (JPATH_ADMINISTRATOR.DS.'components'.DS.'com_clubreg'.DS.'models'.DS.'official.php');
		$joomla_id = (int)$this->getState("joomla_id");
		
		if($joomla_id > 0){
			$officialAdmin = new ClubRegModelOfficial();
			$officialAdmin->setState('joomla_id',$joomla_id);
			$officialAdmin->saveExtraDetails($extraDetails, $monthyear);
			unset($officialAdmin);
		}
		
		$this->setState('joomla_id',NULL);
	}
	public function getPermissions($permission){		
		
		$db = JFactory::getDbo();
		
		
		$joomla_id = (int)$this->getState("joomla_id");
		$d_var = "a.joomla_id, a.status, a.params";
		
		$query	= $db->getQuery(true);		
		
		$query->select($d_var);
		$query->from($db->quoteName(CLUB_MEMBERS_TABLE).' AS a');
		
		$query->where('a.joomla_id = '.$joomla_id);
		$query->where('a.status = 1');	
		
		$db->setQuery($query);
		$userPermission = $db->loadObject();	
		
		$registry = isset($userPermission->params)?new JRegistry($userPermission->params):new JObject();
		
		$proceed = FALSE;
		
		
		
		if($registry->get($permission)){			
			if($registry->get($permission) == "yes"){
				$proceed = TRUE;
			}
		}	
		
		return $proceed;		
	}
	
	
	public function getMyGroups($group_type = null){
		
		$joomla_id = (int)$this->getState("joomla_id");
	
		$db		= $this->getDbo();
		$query	= $db->getQuery(true);
	
		$value = "group_id";
		$text = "group_name";
	
		$d_var = "a.group_id, b.group_name";
	
		$query->select($d_var);
		$query->from($db->quoteName(CLUB_MEMBERSGROUPS_TABLE).' AS a');
		$query->join('LEFT',  CLUB_GROUPS_TABLE.' AS b ON a.group_id = b.group_id');
		$query->where('a.joomla_id = '.$joomla_id);
		$query->where('a.status = 1');
		$query->where('b.group_parent = 0');
		$query->where('b.published = 1 ');
		if(isset($group_type)){
			$query->where('b.group_type =  '. $db->quote($group_type));
		}
	
		$db->setQuery($query);
		$my_groups["group_member"] = $db->loadObjectList("group_id");		
		
		
	
		$query	= $db->getQuery(true);
		$d_var = "a.group_id, a.group_name";
	
		$query->select($d_var);
		$query->from($db->quoteName(CLUB_GROUPS_TABLE).' AS a');
	
		$query->where('a.group_leader in (0, '.$joomla_id.")");
		$query->where('a.group_parent = 0');
		$query->where('a.published = 1 ');
		if(isset($group_type)){
			$query->where('a.group_type =  '. $db->quote($group_type));
		}
	
		$db->setQuery($query);
		$my_groups["group_leader"]  = $db->loadObjectList("group_id");		
		
		@$allowed_groups = array_merge(array_keys($my_groups["group_member"]),array_keys($my_groups["group_leader"]), array(-1));
	
		$my_groups["allowed_groups"] = $allowed_groups;
		
		$my_groups["allowed_groups_options"] =  array_merge($my_groups["group_member"],$my_groups["group_leader"]);
		
		$query	= $db->getQuery(true);		
		$d_var = "a.group_id, a.group_name";
		
		$query->select($d_var);
		$query->from($db->quoteName(CLUB_GROUPS_TABLE).' AS a');
		
		$query->where('a.group_leader in ('.$joomla_id.")");		
		$query->where('a.group_parent > 0 ');
		$query->where('a.published = 1 ');
		if(isset($group_type)){
			$query->where('a.group_type =  '. $db->quote($group_type));
		}
		
		$db->setQuery($query);
		$sub_groups  = $db->loadObjectList("group_id");	
		
		$my_groups["sub_groups_ids"] = array_keys($sub_groups);
		$my_groups["sub_groups"] = $sub_groups;
		
		return $my_groups;
	
	}
}