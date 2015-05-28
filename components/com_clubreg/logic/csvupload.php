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
	
	public function __construct($fileName)
	{
		$this->fileName = $fileName;
	}
	
	
	private function validate($headings){
		$required = array("surname","givenname","playertype");
		
		$valid = 0;		
		foreach($required as $a_required){			
			if(in_array($a_required, $headings)){
				$valid++;
			}
		}		
		return ($valid >= count($required))?TRUE:FALSE;		
	}
	
	public function process(){
		
		$file = fopen($this->fileName,"r");		
		
		$finalArray = array();

		while(! feof($file)) {
			$currentRow = fgetcsv($file);
			$currentRow = array_map("trim", $currentRow);
		
			if($idx == 0){
				$currentRow = array_map("strtolower", $currentRow);
				$head = $currentRow;
				
				if(! $this->validate($head)){
					$this->messages[] = "Not enough required headings found on first line of csv file.";
					return FALSE;
				}
				$idx++;
				continue;
			}
			$currentRow = array_combine($head, $currentRow);		
			$finalArray[] = $currentRow;		
			$idx++;
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
}