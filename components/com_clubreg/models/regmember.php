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

class ClubregModelRegmember extends JModelForm
{
	
	protected $view_item = 'regmember';

	protected $_item = null;
	
	protected $_context = 'com_clubreg.regmember';
	
	public function getTable($type = 'Regmember', $prefix = 'ClubregTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}
	
	public function getForm($data = array(), $loadData = true)
	{
		// Get the form.
		$form = $this->loadForm('com_clubreg.regmember', 'regmember', array('control' => 'jform', 'load_data' => true));
		if (empty($form)) {
			return false;
		}
		return $form;
	}
	
	protected function loadFormData()
	{
		$data = (array) JFactory::getApplication()->getUserState('com_clubreg.regmember.data', array());
		if (empty($data)) {
			$data = $this->getItem();
		}
		if(empty($data)){
			$data["playertype"] =  $this->getState("com_clubreg.regmember.playertype");
			$data["parent_id"] =  $this->getState("com_clubreg.regmember.parent_id");
		}
		return $data;
	}
	
	protected function getItem($pk = null){
		
		global $overRide;
		
		$data_ = array();
		$data_["member_id"] = $this->getState("com_clubreg.regmember.member_id");
		$data_["member_key"] = $this->getState("com_clubreg.regmember.member_key");
	
		$db = JFactory::getDBO();
		$query	= $db->getQuery(true);
		
		$where_[] = sprintf(" a.member_id = '%d'", $data_["member_id"])	;
		
		if($data_["member_key"] && $overRide ){
			$where_[] = sprintf(" a.member_key = %s", $db->quote($data_["member_key"]))	;
		}	

		$db		= $this->getDbo();
		$query	= $db->getQuery(true);
		
		$all_string = array();
		$all_string[] = "a.*";
		
		$d_var = implode(",", $all_string);
		$query->select($d_var);
		$query->from($db->quoteName(CLUB_REGISTEREDMEMBERS_TABLE).' AS a');
			
		foreach($where_ as $a_where){
			$query->where($a_where);
		}
		
		$db->setQuery($query);
		$row = $db->loadAssoc();
		
		return $row;		
	}
	/**
	 * 
	 * @param object $eoidata
	 * @param array  $approved
	 * @param object $uKeyObject
	 */
	public function registerMember($eoidata,&$approved=array(),$uKeyObject){
		
		$newMember = $this->getTable();
		$user		= JFactory::getUser();
		
		$created_when = date('Y-m-d H:i:s');
		
		
		foreach($newMember as $t_key => $t_value){
			if($t_key[0] == "_") continue;
			$newMember->$t_key = $eoidata->$t_key;
		}
		
		$newMember->eoi_id = $eoidata->member_id;
			
		$newMember->created_by = $newMember->approved_by = $user->id;
		$newMember->created = $newMember->approved = $created_when;
		$newMember->member_status = "registered";
		$newMember->year_registered = date('Y');
		$newMember->member_id = null;		
		
		if($newMember->store()){
			$approved[] = $eoidata->member_id;
		}
		
		if($eoidata->playertype == "guardian"){
			$parent_id = $newMember->member_id;
			$this->registerJunior($newMember,$approved,$uKeyObject,$parent_id);
		}		
	}
	/**
	 * 	get the children of guardian eois and register them
	 * 
	 * @param object $eoidata
	 * @param array $approved
	 * @param object $uKeyObject
	 * @param integer $parent_id
	 */
	function registerJunior($parentdata,&$approved,$uKeyObject,$parent_id){
		
		$db		= JFactory::getDbo();
		
		$user		= JFactory::getUser();
		
		$created_when = date('Y-m-d H:i:s');
		
		$d_qry = sprintf("select a.* from %s as a  where a.parent_id = %d ",CLUB_EOIMEMBERS_TABLE,$parentdata->eoi_id);
		$db->setQuery($d_qry);
		$all_children = $db->loadObjectList();
		
		if(count($all_children) > 0 ){
			
			foreach($all_children as $a_child){
				$newMember = $this->getTable();
				foreach($newMember as $t_key => $t_value){
					if($t_key[0] == "_") continue;
					$newMember->$t_key = $a_child->$t_key;
				}
				$newMember->eoi_id = $a_child->member_id;
					
				$newMember->created_by = $newMember->approved_by = $user->id;
				$newMember->created = $newMember->approved = $created_when;
				$newMember->member_status = "registered";
				$newMember->member_id = null;
				$newMember->year_registered = date('Y');
				
				$newMember->parent_id = $parentdata->member_id;
				$newMember->member_key = $uKeyObject->getUniqueKey();
					
				if($newMember->store()){
					$approved[] = $a_child->member_id;
				}				
				
				unset($newMember);
			}
			
		}
		
	}
	
	function getParentDetails(){
		
		$data_ = array();
		$data_["member_id"] = $this->getState("com_clubreg.regmember.member_id");	
		
		$db = JFactory::getDBO();
		$query	= $db->getQuery(true);
		
		$where_[] = sprintf(" a.member_id = '%d'", $data_["member_id"])	;		
		
		$db		= $this->getDbo();
		$query	= $db->getQuery(true);
		
		$all_string = array();
		$all_string[] = "parentt.*";
		$all_string["member_name"] = "concat(UCASE(parentt.`surname`),' ' ,LCASE(parentt.`givenname`)) as gsurname";
		$all_string["reg_created_date"] = "date_format(parentt.created,'%d/%m/%Y') as reg_created_date";
		//$all_string["reg_created_by"] = "user_reg.name as `reg_created_by`";
		
		$d_var = implode(",", $all_string);
		$query->select($d_var);
		$query->from($db->quoteName(CLUB_REGISTEREDMEMBERS_TABLE).' AS a');
		$query->join('LEFT', $db->quoteName(CLUB_REGISTEREDMEMBERS_TABLE).' AS parentt ON a.parent_id = parentt.member_id');
			
		foreach($where_ as $a_where){
			$query->where($a_where);
		}
		
		$db->setQuery($query);
		$row = $db->loadObject();	
		
		return $row;
		
	}
	
	function getMemberDetails(){
		global $overRide;
		
		$where_ = array();
		$key_data = new stdClass();		
		$key_data->full_key = $this->getState('com_clubreg.regmember.member_key');		
		$this->processKey($key_data);
		
		$where_[] = sprintf(" a.member_id = '%d'", $key_data->member_id)	;
		
		if($key_data->member_key && $overRide ){
			$where_[] = sprintf(" a.member_key = '%s'", $key_data->member_key)	;
		}
	
		
		$db		= $this->getDbo();
		$query	= $db->getQuery(true);
		
		$all_string = array();
		$all_string[] = "a.*";
		
		$all_string["member_name"] = "concat(UCASE(a.`surname`),' ' ,LCASE(a.`givenname`)) as surname";
		$all_string["reg_created_date"] = "date_format(a.created,'%d/%m/%Y') as reg_created_date";
		$all_string["reg_group"] = "b.group_name as `reg_group`";
		$all_string["reg_subgroup"] = "sg.group_name as `reg_subgroup`";
		$all_string["reg_created_by"] = "user_reg.name as `reg_created_by`";
		$all_string["app_created_by"] = "user_approved.name as `app_created_by`";
		
		$all_string["dob"] = " (if(a.dob = '0000-00-00' , '-' , date_format(a.dob,'%d/%m/%Y'))) as dob";
		$all_string["gender"] = " (if(a.gender = '-1' , '' , a.gender)) as gender";
		
		$all_string["groupleader"] = "group_leader.name as `groupleader`";
		$all_string["member_level"] = "mlevel.config_name as member_level";
		
		
		$all_string["guardian"] = "concat(parentt.`surname`,' ' ,parentt.`givenname`) as guardian";
		$all_string["gaddress"] = "if(a.playertype='junior',parentt.`address`,a.`address`) as address";
		$all_string["gsuburb"] = "if(a.playertype='junior',parentt.`suburb`,a.`suburb`)  as suburb";
		$all_string["gpostcode"] = "if(a.playertype='junior',parentt.`postcode`,a.`postcode`) as postcode";
		
		$all_string["gmobile"] = "if(a.playertype='junior',parentt.`mobile`,a.`mobile`) as mobile";
		$all_string["gphones"] = "if(a.playertype='junior',parentt.`phoneno`,a.`phoneno`) as phoneno";
		$all_string["gemail"] = "if(a.playertype='junior',parentt.`emailaddress`,a.`emailaddress`) as emailaddress";
		
		
		
		$d_var = implode(",", $all_string);
		$query->select($d_var);		
		$query->from($db->quoteName(CLUB_REGISTEREDMEMBERS_TABLE).' AS a');
		$query->join('LEFT', $db->quoteName(CLUB_REGISTEREDMEMBERS_TABLE).' AS parentt ON a.parent_id = parentt.member_id');
		$query->join('LEFT', $db->quoteName(CLUB_GROUPS_TABLE).' AS b ON a.group = b.group_id');
		$query->join('LEFT', $db->quoteName(CLUB_GROUPS_TABLE).' AS sg ON a.subgroup = sg.group_id');
		$query->join('LEFT', '#__users AS user_reg ON a.created_by = user_reg.id');
		$query->join('LEFT', '#__users AS user_approved ON a.approved_by = user_approved.id');
		$query->join('LEFT', '#__users AS group_leader ON b.group_leader = group_leader.id');
		$query->join('LEFT', $db->quoteName(CLUB_CONFIG_TABLE).' as  mlevel ON a.memberlevel = mlevel.config_short');
		
		foreach($where_ as $a_where){
			$query->where($a_where);
		}
		
		$db->setQuery($query);		
		$member_data = $db->loadObject();
		
		if(!isset($member_data)){
			return FALSE;
		}
		
		$this->state->set('profile.playertype', $member_data->playertype); // set the value to get the heading config 
		
		$member_data->groupofficial = "find some";
		
		$return_data = array();
		$return_data["member_data"] = $member_data;
		
	/*	if($member_data->playertype == "guardian"){			
			$return_data["children"] = $this->getJuniorDetails($member_data->member_id);
		}*/
		return $return_data;
		
	}
	public function getJuniorDetails($parent_id, $member_id = NULL){
		$where_ = array();
		$where_[] = sprintf(" a.parent_id = '%d'", $parent_id)	;
		
		if($member_id){
			$where_[] = sprintf(" a.member_id = '%d'", $member_id)	;
		}
		
		$db		= $this->getDbo();
		$query	= $db->getQuery(true);
		
		$all_string = array();
		$all_string[] = "a.*";
		
		$all_string["member_name"] = "concat(UCASE(a.`surname`),' ' ,LCASE(a.`givenname`)) as surname";
		$all_string["reg_created_date"] = "date_format(a.created,'%d/%m/%Y') as reg_created_date";
		$all_string["reg_group"] = "b.group_name as `reg_group`";
		$all_string["reg_subgroup"] = "sg.group_name as `reg_subgroup`";
		$all_string["reg_created_by"] = "user_reg.name as `reg_created_by`";
		$all_string["app_created_by"] = "user_approved.name as `app_created_by`";
		$all_string["member_level"] = "mlevel.config_name as member_level";
		
		$all_string["dob"] = " (if(a.dob = '0000-00-00' , '-' , date_format(a.dob,'%d/%m/%Y'))) as dob";
		$all_string["gender"] = " (if(a.gender = '-1' , '' , a.gender)) as gender";
		
		$all_string["groupleader"] = "group_leader.name as `groupleader`";
		
		$d_var = implode(",", $all_string);
		$query->select($d_var);
		$query->from($db->quoteName(CLUB_REGISTEREDMEMBERS_TABLE).' AS a');		
		$query->join('LEFT', $db->quoteName(CLUB_GROUPS_TABLE).' AS b ON a.group = b.group_id');
		$query->join('LEFT', $db->quoteName(CLUB_GROUPS_TABLE).' AS sg ON a.subgroup = sg.group_id');
		$query->join('LEFT', '#__users AS user_reg ON a.created_by = user_reg.id');
		$query->join('LEFT', '#__users AS user_approved ON a.approved_by = user_approved.id');
		$query->join('LEFT', '#__users AS group_leader ON b.group_leader = group_leader.id');
		$query->join('LEFT', $db->quoteName(CLUB_CONFIG_TABLE).' as  mlevel ON a.memberlevel = mlevel.config_short');
		
		foreach($where_ as $a_where){
			$query->where($a_where);
		}
		
		$db->setQuery($query);
		$children_data = $db->loadObjectList();
		
		return $children_data;
	}
	public function resetMemberKey($member_key){
		
		$db		= $this->getDbo();
		$current_table = $this->getTable();
		
		$current_table->member_id = $this->state->get("member_id");		
		$current_table->member_key = $member_key;
		$current_table->store();
	}
	public function processKey(&$key_data){
		
		list($part1,$part2) = preg_split("/-/",  $key_data->full_key); //
		
		$key_data->member_id = substr($part1, 0,$part2); // member_id is x char long
		$key_data->member_key = substr($part1, $part2); // member_key is 
	}
	
	public function save($data){
	
		$memberTable = $this->getTable();	
	
		$memberTable->bind($data);
	
		if(!$memberTable->store()){
			$this->setError($memberTable->getError());
			return FALSE;
		}else{
			$this->set("member_id",$memberTable->get("member_id"));
			$this->set("member_key",$memberTable->get("member_key"));
			return TRUE;
		}
	}
	
	public function changeProperty($property , $value){	
		
		$current_table = $this->getTable();		
		$current_table->member_id = $this->getState('com_clubreg.regmember.member_id');	
		$current_table->$property = $value;			
	
		if(!$current_table->store()){
			$this->setError($current_table->getError());
			return FALSE;
		}else{
			
			return TRUE;
		}
	}
}