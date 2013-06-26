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

class ClubregModelEmergency extends JModelForm
{
	
	protected $view_item = 'emergency';

	protected $_item = null;
	
	protected $_context = 'com_clubreg.emergency';
	
	public function getForm($data = array(), $loadData = true)
	{
		// Get the form.			
		$form = $this->loadForm('com_clubreg.emergency', 'emergency', array('control' => 'jform', 'load_data' => true));		
		if (empty($form)) {
			return false;
		}
		return $form;
	}
	
	public function getTable($type = 'Emergency', $prefix = 'ClubregTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}
	
	protected function loadFormData()
	{
		$data = (array) JFactory::getApplication()->getUserState('com_clubreg.emergency.data', array());
		//
		if (empty($data)) {
			$data = $this->getItem();			
		}
		
		$data["member_key"] = $this->getState("com_clubreg.emergency.member_key");	
		
		return $data;
	}
	
	protected function getItem($pk = null){
		$data_ = array();
		$data_["member_id"] = $this->getState("com_clubreg.emergency.member_id");
		
		$db = JFactory::getDBO();
		$query	= $db->getQuery(true);	
		
		$d_var = "a.*";
		$query->select($d_var);
		$query->from($db->quoteName(CLUB_CONTACT_TABLE).' AS a');
		
		$query->where(' member_id = '.$db->quote($data_["member_id"]));
		$query->where(' contact_type = '.$db->quote('EM'));
				
		$db->setQuery($query);
		$row = $db->loadAssocList('contact_detail','contact_value');		
		
		if(count($row) > 0){
			return $row;
		}		
		return array();
	}
	
	public function save($data){		
		
		$member_id = $this->getState("com_clubreg.emergency.member_id");	
		$proceed = FALSE;
		$ignore = array("member_id","member_key");
		$db = JFactory::getDBO();
		$error_ = 0;
		if($member_id > 0 ){
			foreach($data as $a_key =>$a_data){
				if(in_array($a_key, $ignore)){
					continue;
				}
				
				$d_qry = sprintf("insert into %s set `member_id` = %d ,`contact_detail` = %s ,`contact_type`='EM', `contact_value` = %s on duplicate key update
						contact_value = values(contact_value);
						",CLUB_CONTACT_TABLE,$member_id,$db->Quote($a_key),$db->Quote($a_data));
				
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
			}
		}
		
		
		if($error_ == 0){
			$proceed = TRUE;
		}
		
		return $proceed;
	}
}