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

class ClubregModelProperty extends JModelForm
{
	
	protected $view_item = 'property';

	protected $_item = null;
	
	protected $_context = 'com_clubreg.property';
	
	public function getForm($data = array(), $loadData = true)
	{
		// Get the form.			
		$form = $this->loadForm('com_clubreg.property', 'property', array('control' => 'jform', 'load_data' => true));		
		if (empty($form)) {
			return false;
		}
		return $form;
	}
	
	public function getTable($type = 'Property', $prefix = 'ClubregTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}
	
	protected function loadFormData()
	{
		$data = (array) JFactory::getApplication()->getUserState('com_clubreg.property.data', array());
		//
		if (empty($data)) {
			$data = $this->getItem();			
		}
		
		$data["member_key"] = $this->getState("com_clubreg.property.member_key");	
		$data["property_key"] = $this->getState("com_clubreg.property.full_key");	
		
		return $data;
	}
	
	protected function getItem($pk = null){
		$data_ = array();
		$data_["property_id"] = $this->getState("com_clubreg.property.property_id");
		$data_["property_key"] = $this->getState("com_clubreg.property.property_key");		
		
		$db = JFactory::getDBO();
		$query	= $db->getQuery(true);	
		
		$d_var = "a.*";
		$query->select($d_var);
		$query->from($db->quoteName(CLUB_PROPERTY_TABLE).' AS a');
		
		$query->where(' property_id = '.$db->quote($data_["property_id"]));
		$query->where(' property_key = '.$db->quote($data_["property_key"]));
		
		$db->setQuery($query);
		$row = $db->loadAssoc();
		
		if($row["property_id"] == $data_["property_id"] && $row["property_key"] == $data_["property_key"]){
			return $row;
		}	
		
		return array();
	}	
	
	public function save($data){		
		
		$isNew = $this->getState("com_clubreg.property.isnew");	
		$update_me = FALSE;
		$proceed = FALSE;
		
		$d_form = $this->getForm($data,FALSE);
		
		$validated = $this->validate($d_form, $data);		
		if($validated === false){
			// Get the validation messages.
			$errors	= $this->getErrors();
			// Push up to three validation messages out to the user.
			for ($i = 0, $n = count($errors); $i < $n && $i < 3; $i++)
			{
				if ($errors[$i] instanceof Exception)
				{					
					$this->setError($errors[$i]->getMessage());
				} else {
					$this->setError($errors[$i]);					
				}
			}			
			return $proceed;			
		}
		
		if(!$isNew){
			
			$db = JFactory::getDBO();
			
			$old_rec = $this->getTable();
			$tb_keys = array("property_id"=>$data["property_id"],"property_key"=>$data["property_key"]);
			$old_rec->load($tb_keys);
			
			if($old_rec->property_id == $data["property_id"] && $old_rec->property_key == $data["property_key"]){
				$update_me = TRUE;			
					
				$other_details["short_desc"] = "updated property";
				$other_details["primary_id"] = $data["property_id"];
				ClubRegAuditHelper::saveData($old_rec, $other_details);				
			}else{
				$this->setError(JText::_("COM_CLUBREG_NOUPDATE"));
			}		
			
		}
		
		
		if($isNew || $update_me){
			$propertyTable = $this->getTable();
		
			$propertyTable->bind($data);
			if($isNew){
				$created_when = date('Y-m-d H:i:s');
				$propertyTable->created = $created_when;
			}			
			
			if(!$propertyTable->store()){
				$proceed =  FALSE;
				$this->setError($propertyTable->getError());
			}else{
				$proceed =  TRUE;				
				$this->set("property_id", $propertyTable->property_id);
			}	
		}
		
		return $proceed;
	}
	
}