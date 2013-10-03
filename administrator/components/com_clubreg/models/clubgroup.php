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

class ClubRegModelClubgroup extends JModelAdmin
{
	
	
	protected $text_prefix = 'COM_CLUBREG';
	
	public function publish(&$pks, $value = 1)
	{
		$result = parent::publish($pks, $value);

		// Clean extra cache for newsfeeds
		$this->cleanCache('clubreg_clubgroups');		
		return $result;
	}
	
	public function getTable($type = 'Clubgroup', $prefix = 'ClubregTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}
	
	public function getForm($data = array(), $loadData = true)
	{
		// Get the form.
		$form = $this->loadForm('com_clubreg.clubgroup', 'clubgroup', array('control' => 'jform', 'load_data' => $loadData));
		if (empty($form)) {
			return false;
		}
	
		return $form;
	}
	
	protected function loadFormData()
	{
		$data = JFactory::getApplication()->getUserState('com_clubreg.edit.clubgroup.data', array());
		
		if (empty($data)) {
			$data = $this->getItem();			
		}
		if(intval($data->group_id) == 0){		
			$data->set('group_parent',intval($this->getState('clubgroup.group_parent')));
		}
		
		return $data;
		
	
	}
	protected function populateState()
	{		
		parent::populateState();
		$input = JFactory::getApplication()->input;
		
		$group_id = (int) $input->getInt('group_id');
		$this->setState('clubgroup.group_id', $group_id);
		
		$group_parent = (int) $input->getInt('group_parent');		
		$this->setState('clubgroup.group_parent', $group_parent);			
	}
	/**
	 *  @desc try to prepare the table, before you attempt to store
	 * @see JModelAdmin::prepareTable()
	 */
	protected function prepareTable($table)
	{
	
		$table->group_short = JApplication::stringURLSafe($table->group_short);
	
		if (empty($table->group_short)) {
			$table->group_short = JApplication::stringURLSafe($table->group_name);
		}
		
		$table->group_short = str_replace("-", "_", $table->group_short);
	
		if (empty($table->group_id)) {
			// Set the values
			$user	= JFactory::getUser();
	
			$table->created_by = $user->get('id');
			$table->created = date('Y-m-d H:i:s');
	
			// Set ordering to the last item if not set
			if (empty($table->ordering)) {
				$db = JFactory::getDbo();
				$db->setQuery(sprintf('SELECT MAX(ordering) FROM %s where group_type = %s ',CLUB_GROUPS_TABLE,
						$db->quote($table->group_type)));
				$max = $db->loadResult();
			
				$table->ordering = $max+1;
			}
			
		}
	}
	protected function getMyMembers($group_id){
	
		$db		= $this->getDbo();
		$query	= $db->getQuery(true);
		
		$my_members["group_children"] = array();
		$my_members["group_members"] = array();
		$my_members["group_parent"] = NULL;
	
		$value = "joomla_id";
		$text = "name";
	
		$d_var = "a.joomla_id, b.name";
	
		$query->select($d_var);
		$query->from($db->quoteName(CLUB_MEMBERSGROUPS_TABLE).' AS a');
		$query->join('LEFT',  '#__users AS b ON a.joomla_id = b.id');
		$query->where('a.group_id = '.$group_id);
		$query->where('a.status = 1');
	
		$db->setQuery($query);
		$my_members["group_members"] = $db->loadObjectList();	
		
		
		$group_parent =  (int)$this->getState('clubgroup.group_parent');
		$my_members["group_parent"] = null;
		
		if($group_parent > 0){
			$query	= $db->getQuery(true);
			
			$query->select("group_id, group_type");
			$query->from($db->quoteName(CLUB_GROUPS_TABLE));
			$query->where("group_id = ".$group_parent);
			
			$db->setQuery($query);
			$my_members["group_parent"] = $db->loadObject();
		}else{
			
			$query	= $db->getQuery(true);
				
			$query->select("group_id, group_name,group_type,published,group_parent");
			$query->from($db->quoteName(CLUB_GROUPS_TABLE));
			$query->where("group_parent = ".$group_id);
			$query->order('group_name');
				
			$db->setQuery($query);			
			$my_members["group_children"] = $db->loadObjectList();			
		}
	
		return $my_members;
	
	}
	public function getItem($pk = null){
	
		if ($result = parent::getItem($pk))
		{
			$pk = (!empty($pk)) ? $pk : (int) $this->getState($this->getName() . '.id');
			
			try {
				
				// get all my members				
				$my_members = $this->getMyMembers($pk);				
				$result->group_members = $my_members["group_members"];	
				$result->group_children = $my_members["group_children"];

				if((isset($my_members["group_parent"]) && $pk == 0) || empty($result->group_type)){
					@$result->group_type = $my_members["group_parent"]->group_type;					
				}		
				//write_debug($result);
				unset($my_members);			
				
				JFactory::getApplication()->setUserState('com_clubreg.edit.clubgroup.data', $result);
			}catch (RuntimeException $e)
			{
				JError::raiseWarning(500, $e->getMessage());
			}		
			
		}
		return $result;
	}
	/**
	 * attach some users to a group
	 * @param unknown_type $currentMembers
	 */
	
	public function saveMyMembers($currentMembers){
	
		$group_id = (int)$this->getState('group_id');
		$d_qry = array();		
		
		if(count($currentMembers) > 0 ){
			$d_qry[] = sprintf("update %s set status = 0 where group_id = %d;",CLUB_MEMBERSGROUPS_TABLE,$group_id );
				
			foreach($currentMembers as $a_member){
				$d_qry[] = sprintf("insert into  %s set joomla_id = '%d', group_id = '%d', status = 1
						on duplicate key update status = values(status) ; ",
						CLUB_MEMBERSGROUPS_TABLE,$a_member,$group_id);
			}
				
		}else{
			$d_qry[] = sprintf("update %s set status = 0 where group_id = %d;",CLUB_MEMBERSGROUPS_TABLE,$group_id );
				
		}		
		
		$db	= $this->getDbo();
		$this->batchQuery($d_qry, $db);
	
	}
	private function batchQuery($d_qry,$db){
	
		if(count($d_qry) > 0){
			foreach ($d_qry as $a_qry){
				$db->setQuery($a_qry);
				$db->execute();
			}
		}
	
	}
}