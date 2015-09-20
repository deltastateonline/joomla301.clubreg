<?php
/*------------------------------------------------------------------------
# com_clubreg - Manage Club Member Registrations
# ------------------------------------------------------------------------
# author    Omokhoa Agbagbara
# copyright Copyright (C) 2013 applications.deltastateonline.com. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://app.deltastateonline.com
# Technical Support:  email - joomla@deltastateonline.com
-------------------------------------------------------------------------*/
defined('_JEXEC') or die;

class CsvUpload extends JObject
{
	private $fileName = "";
	
	private $finalArray = array();
	private $headings = array();
	private $required = array("surname","givenname","playertype");
	private $messages = array();
	
	public function __construct($fileName)
	{
		$this->fileName = $fileName;
	}
	
	
	private function validate($headings){
		
		$valid = 0;		
		foreach($this->required as $a_required){			
			if(in_array($a_required, $headings)){
				$valid++;
			}
		}		
		return ($valid >= count($this->required))?TRUE:FALSE;		
	}
	
	public function process(){
		
		$file = fopen($this->fileName,"r");		
		
		$finalArray = array(); 
		$idx = 0;

		while(! feof($file)) {
			$currentRow = fgetcsv($file);
			
			if(is_array($currentRow)){
			
				$currentRow = array_map("trim", $currentRow);
			
				if($idx == 0){
					$currentRow = array_map("strtolower", $currentRow);
					$head = $currentRow;
					
					if(! $this->validate($head)){					
						throw new Exception(JText::_('Not enough required headings found on first line of csv file.<br />Min Required Headers include '.ucwords(implode(', ',$this->required))));
						return FALSE;
					}
					$idx++;
					continue;
				}
				$currentRow = array_combine($head, $currentRow);		
				$finalArray[] = $currentRow;		
				$idx++;
				
			}
		}
		
		$this->messages[] = "Csv file processed and enough headings found.";
		$this->messages[] = "({$idx}) records processed.";
		$this->headings = $head;
		$this->finalArray = $finalArray;
		return TRUE;
		
	}
	
	public function get_array(){		
		return array("heading"=>$this->headings,"data"=>$this->finalArray);
	}
	
	public function get_message(){		
		return $this->messages;
	}
	
	public function import($uploadcsv_model, $uKeyObject = FALSE){
	
		$file = fopen($this->fileName,"r");
	
		$imported_array = array();
		$idx = 0;
		
		$where_['group_parent'] = '0';		
			
		$groups_found = ClubRegGroupHelper::getGroupByFilter($where_);
		$index_groups = array();
		foreach($groups_found as $a_group){
			
			$index_groups["group_name"][strtolower($a_group->group_name)] =  $a_group;
			$index_groups["group_short"][strtolower($a_group->group_short)] =  $a_group;
			$index_groups["group_id"][$a_group->group_id] =  $a_group;			
		}	
	
		while(! feof($file)) {
			$currentRow = fgetcsv($file);
			
			if(is_array($currentRow)){
				
			
				$currentRow = array_map("trim", $currentRow);
		
				if($idx == 0){
					$currentRow = array_map("strtolower", $currentRow);
					$head = $currentRow;
		
					if(! $this->validate($head)){
						throw new Exception(JText::_('Not enough required headings found on first line of csv file.<br />Min Required Headers include '.ucwords(implode(', ',$this->required))));
						return FALSE;
					}
					$idx++;
					continue;
				}			
				$currentRow = array_combine($head, $currentRow);
				
				if(!empty($currentRow["surname"]) && !empty($currentRow["givenname"]) && !empty($currentRow["playertype"])){
				
					if(isset($currentRow["playertype"])){
						$currentRow["playertype"] = strtolower($currentRow["playertype"]);
						
						if(!in_array($currentRow["playertype"], array("junior","senior"))){
							$currentRow["playertype"] = "senior";
						}
					}
				
					if(isset($currentRow["gender"])){
						$currentRow["gender"] = strtolower($currentRow["gender"]);
						if(!in_array($currentRow["gender"], array("male","female"))){
							$currentRow["gender"] = "-1";
						}
					}else{
						$currentRow["gender"] = "-1";
					}
				
					if(!isset($currentRow["year_registered"])){
						$currentRow["year_registered"] = date('Y');
					}else{
						$currentRow["year_registered"] = date('Y',strtotime($currentRow["year_registered"]));
					}

					if(isset($currentRow["dob"])){
						$currentRow["dob"] = str_replace("/", "-", $currentRow["dob"]);
						$currentRow["dob"] = date('Y-m-d',strtotime($currentRow["dob"]));
					}
				
					if(isset($currentRow["group"])){
						$currentRow["group"] = strtolower($currentRow["group"]);
						$found_group = FALSE;
						if(isset($index_groups["group_name"][$currentRow["group"]])){
							$found_group = $index_groups["group_name"][$currentRow["group"]];
						}else if(isset($index_groups["group_short"][$currentRow["group"]])){
							$found_group = $index_groups["group_short"][$currentRow["group"]];
						}else if(isset($index_groups["group_id"][$currentRow["group"]])){
							$found_group = $index_groups["group_id"][$currentRow["group"]];
						}
						
						if(!empty($found_group)){
							$currentRow["group"] = $found_group->group_id;
		
							if(isset($found_group->group_type)){
								$currentRow["playertype"] = $found_group->group_type;
							}					
						}				
						
						// try get group by name
					}else{
						$currentRow["group"] = '-1';
					}
				
					$currentRow = $this->processAKA("phoneno",$currentRow);
					$currentRow = $this->processAKA("emailaddress",$currentRow);
					
					$currentRow["member_key"] =  $uKeyObject->getUniqueKey();			
				
					$upload_object = (object)$currentRow;
					$imported_array[] = $uploadcsv_model->importMember($upload_object);
					
					$idx++;
					
				} // end empty 
			}
		}		
		
		$this->messages[] = "Csv file Imported.";
		$this->messages[] = "(".count($imported_array).") records Imported.";
		$this->messages[] = "New entries can now be accessed from the club management page.";
		$this->headings = array();
		$this->finalArray = array("imported"=>$imported_array);
		return TRUE;
	
	}
	/**
	 * Process column which may be indexed under a different name
	 * @param unknown $csvKey
	 * @param unknown $originalA
	 */
	
	private function processAKA($csvKey, $originalA){
		
		$aka["phoneno"] = array("telephone");
		$aka["emailaddress"] = array("email");
		
		if(isset($aka[$csvKey])){
			foreach($aka[$csvKey] as $an_aka){
				
				if(isset($originalA[$an_aka])){ // is the alias in the csv
					$originalA[$csvKey] = $originalA[$an_aka];   // set the alias to the key we want
					unset($originalA[$an_aka]); // remove the alias
				}
			}
		}
		
		return $originalA;
	}
}