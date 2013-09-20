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

class ClubRegModelOfficial extends JModelAdmin
{
	
	
	protected $text_prefix = 'COM_CLUBREG';
	/**
	 * Link and Unlink joomla users from the club reg component
	 * @param unknown_type $pks
	 * @param unknown_type $value
	 */
	
	public function link(&$pks, $value = 1)
	{
		
		$d_qry = array();
		if(count($pks) > 0){
			
			$db		= $this->getDbo();
			foreach($pks as $a_link){
				if($a_link > 0 ){
					$query_str = sprintf("insert into %s set joomla_id = '%d', status = '%d'
							on duplicate key  update status = values(status) ;\n ",CLUB_MEMBERS_TABLE,$a_link,$value );
					
					$db->setQuery($query_str);
					$db->execute();					
				}
			}			
		}		
		// Clean extra cache for officials
		$this->cleanCache('clubreg_officials');		
		return TRUE;
	}	
	public function getTable($type = 'Official', $prefix = 'ClubregTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}
	
	public function getForm($data = array(), $loadData = true)
	{
		// Get the form.
		$form = $this->loadForm('com_clubreg.official', 'official', array('control' => 'jform', 'load_data' => $loadData));
		if (empty($form)) {
			return false;
		}
	
		return $form;
	}
	
	protected function loadFormData()
	{
		$data = JFactory::getApplication()->getUserState('com_clubreg.edit.official.data', array());
		
	
		if (empty($data)) {
			$data = $this->getItem();		
		}
	
		return $data;
		
	
	}
	protected function populateState()
	{
		
		parent::populateState();
		$input = JFactory::getApplication()->input;
		
		$joomla_id = (int) $input->getInt('joomla_id');
		$this->setState('official.joomla_id', $joomla_id);		
		$this->setState('official.activeTab',$input->cookie->getString("activeTab"));
		
	}
	/**
	 *  @desc try to prepare the table, before you attempt to store
	 * @see JModelAdmin::prepareTable()
	 */
	protected function prepareTable($table)
	{		
		
	}
	
	protected function getMyGroups($joomla_id){
		
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
		
		$db->setQuery($query);
		$my_groups["group_member"] = $db->loadObjectList();
		
		
		$query	= $db->getQuery(true);		
		$d_var = "a.group_id, a.group_name";
		
		$query->select($d_var);
		$query->from($db->quoteName(CLUB_GROUPS_TABLE).' AS a');
		
		$query->where('a.group_leader = '.$joomla_id);
		
		$db->setQuery($query);
		$my_groups["group_leader"]  = $db->loadObjectList();
		
		return $my_groups;
		
	}
	protected function getMyExtraDetails($joomla_id){
		$db		= $this->getDbo();
		$query	= $db->getQuery(true);
		
		$d_var = " * ";
		
		$query->select($d_var);
		$query->from($db->quoteName(CLUB_MEMBERSDETAILS_TABLE).' AS a');		
		$query->where('a.joomla_id = '.$joomla_id);
		
		$db->setQuery($query);
		return  $db->loadObjectList("member_detail");
		
	}
	public function getItem($pk = null){
		
		if ($result = parent::getItem($pk))
		{
			$pk = (!empty($pk)) ? $pk : (int) $this->getState($this->getName() . '.id');			
			
			$d_var = " a.name as official_name, a.username as official_username, a.email as official_email ";
			
			$db		= $this->getDbo();
			$query	= $db->getQuery(true);
			
			$query->select($d_var);
			$query->from($db->quoteName('#__users').' AS a');
			$query->where('a.id = '.$pk);
			
			$db->setQuery($query);		
			
			try
			{
				$joomla_data = $db->loadObject();
				$result->official_name  	= $joomla_data->official_name;
				$result->official_username  = $joomla_data->official_username;
				$result->official_email 	= $joomla_data->official_email;
				if($pk){
					$my_groups = $this->getMyGroups($pk);
					
					$result->group_leader = $my_groups["group_leader"];
					$result->group_member = $my_groups["group_member"];					
					$result->extraDetails = $this->getMyExtraDetails($pk);
					unset($my_groups);			
				}
				
				JFactory::getApplication()->setUserState('com_clubreg.edit.official.data', $result);				
				
			}
			catch (RuntimeException $e)
			{
				JError::raiseWarning(500, $e->getMessage());
			}			
		
		}
		return $result;
	}
	public function makeMeLeader($currentGroups){
		
		$joomla_id = (int)$this->getState('joomla_id');	
		$d_qry = array();
		
		if(count($currentGroups) > 0 ){
			$d_qry[] = sprintf("update %s set group_leader = '0' where group_leader = '%d' and group_parent = 0 ",CLUB_GROUPS_TABLE,$joomla_id );
			
			$d_qry[] = sprintf("update %s set group_leader = '%s' where group_id in (%s)",CLUB_GROUPS_TABLE,$joomla_id, implode(",",$currentGroups) );
			
		}else{
			$d_qry[] = sprintf("update %s set group_leader = '0' where group_leader = '%d' and group_parent = 0 ",CLUB_GROUPS_TABLE,$joomla_id );
		}		
		
		$db		= $this->getDbo();		
		$this->batchQuery($d_qry, $db);
		
	}
	/**
	 *  attach a user to some groups
	 * @param unknown_type $currentGroups
	 */
	public function makeMeMember($currentGroups){
		
		$joomla_id = (int)$this->getState('joomla_id');
		$d_qry = array();
		
		if(count($currentGroups) > 0 ){
			$d_qry[] = sprintf("update %s set status = 0 where joomla_id = %d;",CLUB_MEMBERSGROUPS_TABLE,$joomla_id );
			
			foreach($currentGroups as $a_group){
				$d_qry[] = sprintf("insert into  %s set joomla_id = '%d', group_id = '%d', status = 1
						on duplicate key update status = values(status) ; ",
						CLUB_MEMBERSGROUPS_TABLE,$joomla_id,$a_group);
			}
			
		}else{
			$d_qry[] = sprintf("update %s set status = 0 where joomla_id = %d;",CLUB_MEMBERSGROUPS_TABLE,$joomla_id );
			
		}
		
		$db		= $this->getDbo();
		$this->batchQuery($d_qry, $db);
	
	}
	public function saveExtraDetails($extraDetails,$monthyear){
		
		$joomla_id = (int)$this->getState('joomla_id');
		$d_qry = array();
		
		$monthyear_keys = $div = "";		
		$db	= $this->getDbo();
		
		if(count($monthyear) > 0){
			$monthyear_keys = '/';
			
			foreach($monthyear as $amonthyear){ // loop thru month year
				$monthyear_keys .= $div . preg_quote($amonthyear);
				$div = '|';				
				
				$month_key = sprintf("%s_month",$amonthyear); $year_key = sprintf("%s_year",$amonthyear);		// generate the month year key		
				$member_value = sprintf("%s-%s",$extraDetails[$month_key],$extraDetails[$year_key]); // extra the value from extra details  
				
				$d_qry[] = sprintf("insert into %s set joomla_id = %s, `member_detail`=%s, `member_value`=%s
						on duplicate key update `member_value` = values(`member_value`);",
						CLUB_MEMBERSDETAILS_TABLE,$joomla_id,$db->Quote($amonthyear), $db->Quote($member_value));
				
			}
			$monthyear_keys .= '/i'; // generate the key for the second array to ignore them
		}		
		
		if(count($extraDetails) > 0){
			foreach($extraDetails as $akey => $adetail){ // loop thru all
				if(preg_match($monthyear_keys, $akey)){ // ignore month year
					continue ;
				}else{					
					$d_qry[] = sprintf("insert into %s set joomla_id = %s, `member_detail`=%s, `member_value`=%s
							on duplicate key update `member_value` = values(`member_value`);",
							CLUB_MEMBERSDETAILS_TABLE,$joomla_id,$db->Quote($akey), $db->Quote($adetail));					
				}
			}
		}		
		
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