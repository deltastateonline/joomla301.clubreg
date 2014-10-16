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

class ClubregModelCommunication extends JModelForm
{
	
	protected $view_item = 'communication';

	protected $_item = null;
	
	protected $_context = 'com_clubreg.communication';
	
	public function getForm($data = array(), $loadData = true)
	{
		// Get the form.		
		$form_name = "";
	
		$form = $this->loadForm('com_clubreg.communication', 'communication', array('control' => 'jform', 'load_data' => true));		
		if (empty($form)) {
			return false;
		}
		return $form;
	}
	
	public function getTable($type = 'Communication', $prefix = 'ClubregTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}
	
	protected function loadFormData()
	{
		$data = (array) JFactory::getApplication()->getUserState('com_clubreg.communication.data', array());		
		
		if (empty($data)) {
			$data = $this->getItem();			
		}
	
		if(empty($data)){
			$data["comm_subject"] =  $this->getState("com_clubreg.communication.comm_subject");
			$data["comm_message"] =  $this->getState("com_clubreg.communication.comm_message");		
			$data["comm_pmessage"] =  $this->getState("com_clubreg.communication.comm_pmessage"); // load plain text message
			$data["template_id"] =  $this->getState("com_clubreg.communication.template_id");
			$data["comm_type"] =  $this->getState("com_clubreg.communication.comm_type");
			$data["comm_groups"] =  "[]";
			
			$this->set("com_clubreg.communication.comm_title",$this->getState("com_clubreg.communication.template_name"));
		}
		
		return $data;
	}
	
	protected function getItem($pk = null){
		$data_ = $row = array();		
		
		$data_["comm_id"] = $this->getState("com_clubreg.communication.comm_id");
		
		if($data_["comm_id"]){
	
			$db = JFactory::getDBO();
			$query	= $db->getQuery(true);		
			
			$d_var = "a.*, tmplt.template_name";
			$query->select($d_var);
			$query->from($db->quoteName(CLUB_SAVEDCOMMS_TABLE).' AS a');
			$query->join('LEFT', $db->quoteName(CLUB_TEMPLATE_TABLE).' AS tmplt ON a.template_id = tmplt.template_id');
		
			$query->where('comm_id = '.$db->quote($data_["comm_id"]));	
		
			$db->setQuery($query);
			$row = $db->loadAssoc();	
			
			if(!json_decode($row["comm_groups"],TRUE)){
				//$row["comm_groups"] = "[".$row["comm_groups"]."]";
			}
	
			$row["comm_sendto"] = ($row["comm_groups"])?json_decode($row["comm_groups"],TRUE):array();			
			$this->set("com_clubreg.communication.comm_sendto_array",$row["comm_sendto"]);
			$this->set("com_clubreg.communication.comm_title",$row["template_name"]);
			$this->setState("com_clubreg.communication.comm_type",$row["comm_type"]);
			
			if(isset($row["comm_type"]) && $row["comm_type"] == "sms"){
				$row["comm_pmessage"] = $row["comm_message"]; // pass the message into the plain text in case
			}
		}
		
		//write_debug($row);
		return $row;
	}
	
	public function save($data){
		
		$communicationTable = $this->getTable();
		$created_when = date('Y-m-d H:i:s');
		
		$communicationTable->bind($data);	
		
		if(!$communicationTable->store()){
			$this->setError($communicationTable->getError());
			return FALSE;
		}else{
			
			$user		= JFactory::getUser();
			$joomla_id = $user->get('id');
			
			$db = JFactory::getDBO();			
			
			$this->set("com_clubreg.communication.comm_id",$communicationTable->comm_id );
			$data["comm_id"] = $communicationTable->comm_id;
			
			$d_qry = sprintf("delete from %s where comm_id = %d and joomla_id = %d",
					CLUB_SAVEDCOMMS_GROUP_TABLE,$data["comm_id"],$joomla_id);
			
			$db->setQuery($d_qry);
			$db->execute();
			
			$comm_groups = json_decode($data["comm_groups"]);
			unset($d_qry);
			
			if(is_array($comm_groups) && count($comm_groups) > 0){
				foreach($comm_groups as $group_id){
				$d_qry = sprintf("insert into %s set comm_id = %s, `group_id`=%s, `joomla_id`=%s
					on duplicate key update `group_id` = values(`group_id`);",
					CLUB_SAVEDCOMMS_GROUP_TABLE,$db->Quote($data["comm_id"]),$db->Quote($group_id),$db->Quote($joomla_id)
					);
				
					$db->setQuery($d_qry);
					$db->execute();
					unset($d_qry);
				}			
			}
		
			return TRUE;
		}		
	}
	public function changeStatus($in_data = array()){
		
		$db = JFactory::getDbo();
		$error_ = 0;
		
		$comm_id = $this->getState("com_clubreg.communication.comm_id");
		
		$user		= JFactory::getUser();
		$joomla_id = $user->get('id');
		$update = array();
		
		if(isset($in_data['status'])){
			$update[] = sprintf(" comm_status = %s",$db->Quote($in_data['status']) );
		}
		
		if(isset($in_data['sent'])){
			$update[] = sprintf(" sent_date = %s ",$db->Quote(date('Y-m-d H:i:s')) );
			$update[] = sprintf(" sent_by = %s",$db->Quote($joomla_id ));
			$update[] = sprintf(" comm_status = %s",$db->Quote($in_data['sent']) );
		}		
		
		if(count($update) > 0 ){
			$update_str = implode(",", $update);
			$d_qry = sprintf("update %s set  %s where comm_id = %s",
					$db->quoteName(CLUB_SAVEDCOMMS_TABLE),$update_str,$db->quote($comm_id));
			
			$db->setQuery($d_qry);	

			jLog::add($d_qry);
	
			try{
				$db->query();
			}
			catch (RuntimeException $e)	{
				$this->setError($e->getMessage());
				$error_++;
			}
		}else{
			$this->setError("Nothing to update!");
			$error_++;
		}
		
		if($error_ > 0){
			return FALSE;
		}else{
			return TRUE;
		}
		
	}
	
}