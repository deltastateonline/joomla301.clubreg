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

class ClubregModelNote extends JModelForm
{
	
	protected $view_item = 'note';

	protected $_item = null;
	
	protected $_context = 'com_clubreg.note';
	
	public function getForm($data = array(), $loadData = true)
	{
		// Get the form.		
		$form = $this->loadForm('com_clubreg.note', 'note', array('control' => 'jform', 'load_data' => true));		
		if (empty($form)) {
			return false;
		}
		return $form;
	}
	
	public function getTable($type = 'Note', $prefix = 'ClubregTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}
	
	protected function loadFormData()
	{
		$data = (array) JFactory::getApplication()->getUserState('com_clubreg.note.data', array());
		if (empty($data)) {
			$data = $this->getItem();			
		}
		$data["member_key"] = $this->getState("com_clubreg.note.member_key");
		$data["note_type"] = $this->getState("com_clubreg.note.note_type");
		return $data;
	}
	
	protected function getItem($pk = null){
		$data_ = array();		
		
		$data_["note_key"] = $this->getState("com_clubreg.note.note_key");
	
		$db = JFactory::getDBO();
		$query	= $db->getQuery(true);
	
		$d_var = "a.*, hex(note_key) as note_key";
		$query->select($d_var);
		$query->from($db->quoteName(CLUB_NOTES_TABLE).' AS a');
	
		
		$query->where(' hex(note_key) = '.$db->quote($data_["note_key"]));
	
		$db->setQuery($query);
		$row = $db->loadAssoc();
	
		if($row["note_key"] == $data_["note_key"]){
			return $row;
		}
	
		return array();
	}
	
	public function save($data){
		
		$noteTable = $this->getTable();
		$created_when = date('Y-m-d H:i:s');
		
		$noteTable->bind($data);
		$noteTable->created = $created_when;
		
		if(!$noteTable->store()){
			$this->setError($noteTable->getError());
			return FALSE;
		}else{
			return TRUE;
		}		
	}
	public function changeStatus($status){
		
		$db = JFactory::getDbo();
		$error_ = 0;
		
		$note_key = $this->getState("com_clubreg.note.note_key");		
		
		$d_qry = sprintf("update %s set note_status = %s where hex(note_key) = %s",
				$db->quoteName(CLUB_NOTES_TABLE),$db->quote($status), $note_key);
		
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