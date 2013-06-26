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

class ClubregModelEoi extends JModelForm
{
	
	protected $view_item = 'eoi';

	protected $_item = null;
	
	protected $_context = 'com_clubreg.eoi';
	
	public function getForm($data = array(), $loadData = true)
	{
		// Get the form.
		$form = $this->loadForm('com_clubreg.eoi', 'eoi', array('control' => 'jform', 'load_data' => true));
		if (empty($form)) {
			return false;
		}
		return $form;
	}
	
	public function getTable($type = 'Eoi', $prefix = 'ClubregTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}
	
	protected function loadFormData()
	{
		$data = (array) JFactory::getApplication()->getUserState('com_clubreg.eoi.data', array());
		if (empty($data)) {
			//$data = $this->getItem();
		}
		return $data;
	}
	public function getTemplate(){
		
		$where[] = "template_name like '%%Expression Of Interest%%'";
		$where[] = " published  = '1'";
		$where[] = "template_access = 'everyone'";
		
		$where_str = sprintf(" where %s",implode(" and ", $where));
		
		$db = JFactory::getDbo();
		$db->setQuery(sprintf('SELECT * FROM %s  %s ',CLUB_TEMPLATE_TABLE,$where_str ));		
		
		return $db->loadObject();
	}
	
	public function getJuniorDetails(){
		return (array) JFactory::getApplication()->getUserState('com_clubreg.eoi.junior.data', array());		 
	}
	public function getJuniorControls(){
		return array("surname", "givenname","dob", "group","gender"); // the only keys we need 
	}

	public function save($data){
		
		$eoiTable = $this->getTable();
		$created_when = date('Y-m-d H:i:s');		
		
		$must_supply = array('surname'=>JText::_('COM_CLUBREG_SURNAME_LABEL'),
				'givenname'=>JText::_('COM_CLUBREG_GIVENNAME_LABEL'),
				'emailaddress'=>JText::_('JGLOBAL_EMAIL'),
				'mobile'=>JText::_('COM_CLUBREG_MOBILE'));
		$at_least = $missing_ = array();
		$data_keys = array_keys($data);
		foreach($must_supply as $a_must => $value){
			$supplied = trim($data[$a_must]);
			if(in_array($a_must, $data_keys) && isset($supplied) && strlen($supplied) > 2 ){
				$at_least[] = true;
			}else{
				$missing_[] = $value;
			}
		}

		if(count($at_least) == count($must_supply)){		
			$eoiTable->bind($data);
			$eoiTable->created = $created_when;
			$eoiTable->member_status = "eoi";
			if($data["playertype"] == "junior"){
				$eoiTable->playertype = "guardian";
			}
			
			$eoiTable->store();
			$proceed = TRUE;
			
			if($data["playertype"] == "junior"){
				$parent_id = $eoiTable->member_id;
				$this->saveJunior($data,$parent_id);
			}			
		}else{
			$missing_str = sprintf("%s. Missing : %s.",JText::_('COM_CLUBREG_NOTENOUGH'), implode(", ",$missing_));
			$this->setError($missing_str);			
			$proceed = FALSE;
		}
		
		return $proceed;
	}
	private function saveJunior($data,$parentId){
		$minControls =  array("surname", "givenname"); // the minimum keys for a junior we need
		$postedControls = $this->getJuniorControls();
			
		
		for($i = 0; $i< CLUB_JUNIORCOUNT; $i++){
		
		$juniorData = $minControlSet  = array();
		$juniorData["parent_id"] = $parentId;
		$juniorData["playertype"] = "junior";
		$juniorData["status"] = "eoi";
			foreach($postedControls as $aControl){
				$idx = sprintf("%s%d",$aControl,$i); // associated index = controlName{i}
				
				if(strlen($data[$idx]) > 0 && $data[$idx] != '-1' ){
					if(in_array($aControl, $minControls)){ $minControlSet[] = true; }
					$juniorData[$aControl] = $data[$idx];
				}		
			}
						
			if(count($minControlSet) == count($minControls)){ 
				
				$eoiTable = $this->getTable();			
				
				$eoiTable->bind($juniorData);
				$eoiTable->created = date('Y-m-d H:i:s');
				$eoiTable->member_status = "eoi";
				$eoiTable->store();	
				
				unset($eoiTable);
			}
			
		}
		return TRUE;
	}

}