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

class ClubregModelUploadcsv extends JModelForm
{
	
	protected $view_item = 'attachment';

	protected $_item = null;
	
	protected $_context = 'com_clubreg.uploadcsv';
	
	//public $uploaded_data = "";
	
	// import data to this table;
	public function getTable($type = 'Regmember', $prefix = 'ClubregTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}
	
	public function getForm($data = array(), $loadData = true)
	{
		// Get the form.		
		$form = $this->loadForm('com_clubreg.uploadcsv', 'uploadcsv', array('control' => 'jform', 'load_data' => true));		
		if (empty($form)) {
			return false;
		}
		return $form;
	}
	
	protected function loadFormData()
	{
		$data = (array) JFactory::getApplication()->getUserState('com_clubreg.uploadcsv.data', array());
		if (empty($data)) {
				
		}
		$data["member_key"] = $this->getState("com_clubreg.uploadcsv.member_key");
		$data["link_type"] = $this->getState("com_clubreg.uploadcsv.link_type");
		return $data;
	}
	
	protected function getItem($pk = null){
		
	}
	
	/**
	 *
	 * @param object $import_obj
	 * @param array  $imported
	 */
	public function importMember($import_obj){
	
		$imported = FALSE;
		$newMember = $this->getTable();
		$user		= JFactory::getUser();
	
		$created_when = date('Y-m-d H:i:s');
			
		foreach($newMember as $t_key => $t_value){
			if($t_key[0] == "_") continue;
			$newMember->$t_key = $import_obj->$t_key;
		}
	
		$newMember->eoi_id = NULL;
			
		$newMember->created_by =  $user->id;
		$newMember->created = $newMember->approved = $created_when;
		$newMember->member_status = "registered";
		
		$newMember->member_id = null;
	
		if($newMember->store()){
			$imported = $newMember->member_id;
		}
		
		return $imported;

	}
	
	public function duplicate_check($email = NULL , $phone = NULL){
		
		
		$db		= $this->getDbo();
		$query	= $db->getQuery(true);
		
		$all_string[] = "a.member_id, a.surname, a.givenname, a.emailaddress";
		
		$d_var =implode(",", $all_string);
		
		if($email){
			$where_[] = sprintf("a.emailaddress = '%s'",$email);
		}
		
		if($phone){
			$where_[] = sprintf("a.mobile = '%s'",$phone);
		}
		
		
		$a_where = implode("OR ",$where_ );
		
		$query->from($db->quoteName(CLUB_REGISTEREDMEMBERS_TABLE).' AS a');
		
		$query->select($d_var);
		
		$query->where($a_where);
		
		$db->setQuery($query, 0,30);
		$items = $db->loadObjectList();
		
		if(count($items) > 0){
			return TRUE;
		}else{
			return FALSE;
		}
	}
	
	
}