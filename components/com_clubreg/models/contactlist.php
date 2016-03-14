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

class ClubregModelContactlist extends JModelForm
{
	
	protected $view_item = 'contactlist';

	protected $_item = null;
	
	protected $_context = 'com_clubreg.contactlist';
	
	public function getForm($data = array(), $loadData = true)
	{
		// Get the form.			
		$form = $this->loadForm('com_clubreg.contactlist', 'contactlist', array('control' => 'jform', 'load_data' => true));		
		if (empty($form)) {
			return false;
		}
		return $form;
	}
	
	public function getTable($type = 'contactlist', $prefix = 'ClubregTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}
	
	protected function loadFormData()
	{
		$data = (array) JFactory::getApplication()->getUserState('com_clubreg.contactlist.data', array());
		//
		if (empty($data)) {
			$data = $this->getItem();			
		}
		
		$data["member_key"] = $this->getState("com_clubreg.contactlist.member_key");	
		$data["contactlist_key"] = $this->getState("com_clubreg.contactlist.full_key");	
		
		return $data;
	}
	
	protected function getItem($pk = null){
		$data_ = array();
		$data_["contactlist_id"] =  $this->getState("com_clubreg.contactlist.contactlist_id");
		$data_["contactlist_key"] = $this->getState("com_clubreg.contactlist.contactlist_key");		
		
		$db = JFactory::getDBO();
		$query	= $db->getQuery(true);	
		
		$d_var = "a.*";
		$query->select($d_var);
		$query->from($db->quoteName(CLUB_CONTACTLIST_TABLE).' AS a');
		
		$query->where(' contactlist_id = '.$db->quote($data_["contactlist_id"]));
		$query->where(' contactlist_key = '.$db->quote($data_["contactlist_key"]));
		
		$db->setQuery($query);
		$row = $db->loadAssoc();
		
		if($row["contactlist_id"] == $data_["contactlist_id"] && $row["contactlist_key"] == $data_["contactlist_key"]){
			return $row;
		}	
		
		return array();
	}	
	
	public function save($data){		
		
		$isNew = $this->getState("com_clubreg.contactlist.isnew");	
		$update_me = FALSE;
		$proceed = FALSE;
		
		$d_form = $this->getForm($data,FALSE);
		
		$validated = $this->validate($d_form, $data);		
		if($validated === false){
			// Get the validation messages.			
			return $validated;			
		}
		
		if(!$isNew){			
			$update_me = TRUE;			
		}
		
		
		if($isNew || $update_me){
			$contactlistTable = $this->getTable();
			
			if(empty($data["contactlist_notify"])){
				$data["contactlist_notify"] = '0';
			}		
		
			$contactlistTable->bind($data);
			if($isNew){
				$created_when = date('Y-m-d H:i:s');
				$contactlistTable->created = $created_when;
			}			
			
			if(!$contactlistTable->store()){
				$proceed =  FALSE;
				$this->setError($contactlistTable->getError());
			}else{
				$proceed =  TRUE;				
				$this->set("contactlist_id", $contactlistTable->contactlist_id);
			}	
		}
		
		return $proceed;
	}
	
	public function changeStatus($status){
	
		$db = JFactory::getDbo();
		$error_ = 0;
	
		$contactlist_id = $this->getState("com_clubreg.contactlist.contactlist_id");
		$contactlist_key = $this->getState("com_clubreg.contactlist.contactlist_key");
	
		$d_qry = sprintf("update %s set contactlist_status = %s where contactlist_id = %s and contactlist_key = %s",
				$db->quoteName(CLUB_CONTACTLIST_TABLE),$db->quote($status), $db->quote($contactlist_id),$db->quote($contactlist_key));
	
		$db->setQuery($d_qry);
		try
		{
			$db->query();
		}
		catch (RuntimeException $e)
		{
			$this->setError($e->getMessage());
			$error_++;
		}
	
		if($error_ > 0){
			return FALSE;
		}else{
			return TRUE;
		}
	
	}
	
}