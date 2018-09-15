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

class ClubregModelOther extends JModelForm
{
	
	protected $view_item = 'other';

	protected $_item = null;
	
	protected $_context = 'com_clubreg.other';
	
	public function getForm($data = array(), $loadData = true)
	{
		// Get the form.			
		$form = $this->loadForm('com_clubreg.other', 'other', array('control' => 'jform', 'load_data' => true));		
		if (empty($form)) {
			return false;
		}
		return $form;
	}
	
	public function getTable($type = 'Other', $prefix = 'ClubregTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}
	
	protected function loadFormData()
	{
		$data = (array) JFactory::getApplication()->getUserState('com_clubreg.other.data', array());
		//
		if (empty($data)) {
			
		}
		$this->otherValues = $this->getItem();
		$data["member_key"] = $this->getState("com_clubreg.other.member_key");	
		
		return $data;
	}	
	
	
	protected function getItem($pk = null){
		$data_ = array();
		$data_["member_id"] = $this->getState("com_clubreg.other.member_id");
		
		$db = JFactory::getDBO();
		$query	= $db->getQuery(true);	
		
		$d_var = "a.*, a.contact_value as member_value";
		$query->select($d_var);
		$query->from($db->quoteName(CLUB_CONTACT_TABLE).' AS a');
		
		$query->where(' member_id = '.$db->quote($data_["member_id"]));
		$query->where(' contact_type = '.$db->quote('ED'));
				
		$db->setQuery($query);		
		$row = $db->loadObjectList('contact_detail');		
		
		if(count($row) > 0){
			return $row;
		}		
		return array();
	}
	
	public function save($extraDetails,$monthyear){	
		
		$error_ = 0;
		$member_id = $this->getState("com_clubreg.other.member_id");
		$proceed = FALSE;
	
		$monthyear_keys = $div = "";
		$db	= $this->getDbo();
	
		if(count($monthyear) > 0){
			$monthyear_keys = '/';
				
			foreach($monthyear as $amonthyear){ // loop thru month year
				$monthyear_keys .= $div . preg_quote($amonthyear);
				$div = '|';
	
				$month_key = sprintf("%s_month",$amonthyear); $year_key = sprintf("%s_year",$amonthyear);		// generate the month year key
				$member_value = sprintf("%s-%s",$extraDetails[$month_key],$extraDetails[$year_key]); // extra the value from extra details
	
				$d_qry = sprintf("insert into %s set `member_id` = %d ,`contact_detail` = %s ,`contact_type`='ED', `contact_value` = %s on duplicate key update
						contact_value = values(contact_value);
						",CLUB_CONTACT_TABLE,$member_id,$db->Quote($amonthyear),$db->Quote($member_value));		

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
			
			$monthyear_keys .= '/i'; // generate the key for the second array to ignore them
		}
	
		if(count($extraDetails) > 0){
			foreach($extraDetails as $a_key => $a_data){ // loop thru all
				if(preg_match($monthyear_keys, $a_key)){ // ignore month year
					continue ;
				}else{
					// it is in a array, so simple json encode to string and save.
					if(is_array($a_data)){
						$a_data = json_encode($a_data);
					}					
					
					$d_qry = sprintf("insert into %s set `member_id` = %d ,`contact_detail` = %s ,`contact_type`='ED', `contact_value` = %s on duplicate key update
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
					
				} // actual saving
			} // loop
		} // count > 0
		
		if($error_ == 0){
			$proceed = TRUE;
		}
		
		return $proceed;
	}
}