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

class ClubregModelAlert extends JModelForm
{
	
	protected $view_item = 'alert';

	protected $_item = null;
	
	protected $_context = 'com_clubreg.alert';
	
	public function getForm($data = array(), $loadData = true)
	{		
		$form = $this->loadForm('com_clubreg.alert', "alert", array('control' => 'jform', 'load_data' => true));		
		if (empty($form)) {
			return false;
		}
		return $form;
	}
	
	public function getTable($type = 'Alert', $prefix = 'ClubregTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}
	
	protected function loadFormData()
	{
		$data = (array) JFactory::getApplication()->getUserState('com_clubreg.alert.data', array());
		//
		if (empty($data)) {
			$data = $this->getItem();			
		}
		
		$data["member_key"] = $this->getState("com_clubreg.alert.member_key");	
		$data["alert_key"] = $this->getState("com_clubreg.alert.full_key");	
		
		return $data;
	}
	
	protected function getItem($pk = null){
		$data_ = array();
		$data_["alert_id"] = $this->getState("com_clubreg.alert.alert_id");
		$data_["alert_key"] = $this->getState("com_clubreg.alert.alert_key");		
		
		$db = JFactory::getDBO();
		$query	= $db->getQuery(true);	
		
		$d_var = "a.*";
		$query->select($d_var);
		$query->from($db->quoteName(CLUB_ALERTS_TABLE).' AS a');
		
		$query->where(' alert_id = '.$db->quote($data_["alert_id"]));
		$query->where(' alert_key = '.$db->quote($data_["alert_key"]));
		
		$db->setQuery($query);
		$row = $db->loadAssoc();
		
		if($row["alert_id"] == $data_["alert_id"] && $row["alert_key"] == $data_["alert_key"]){
			return $row;
		}	
		
		return array("alert_inteval"=>0);
	}	
	
	public function save($data){		
		
		$isNew = $this->getState("com_clubreg.alert.isnew");	
		$update_me = FALSE;
		
		$form = $this->getForm();
		
		$validate = $this->validate($form, $data);
		
		if($validate === FALSE){
			return FALSE;
		}
		
		if(!$isNew){			
			$update_me = TRUE;		
		}
		
		$proceed = FALSE;
		if($isNew || $update_me){
			$alertTable = $this->getTable();
		
			$alertTable->bind($data);
			if($isNew){
				$created_when = date('Y-m-d H:i:s');
				$alertTable->created = $created_when;
			}			
			 if(!$alertTable->store()){
				$proceed =  FALSE;
				$this->setError($alertTable->getError());
			}else{
				$proceed =  TRUE;				
				$this->set("alert_id", $alertTable->alert_id);
			}	
		}
		
		return $proceed;
	}
}