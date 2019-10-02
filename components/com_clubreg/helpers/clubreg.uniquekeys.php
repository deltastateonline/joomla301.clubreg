<?php
/*------------------------------------------------------------------------
# com_clubreg - Manage Club Member Registrations
# ------------------------------------------------------------------------
# author    Omokhoa Agbagbara
# copyright Copyright (C) 2012 applications.deltastateonline.com. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://applications.deltastateonline.com
# Technical Support:  email - joomla@deltastateonline.com
-------------------------------------------------------------------------*/
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

class ClubRegUniqueKeysHelper extends JObject
{
	private $charlength = 0;
	function __construct($charlength = 10){
		$this->charlength = $charlength;
	}
	public function getUniqueKey(){
		
		$half = $this->charlength * 0.5;	
		$length1 = ceil($half); $length2 = floor($half);
		
		return $this->getStringParts($length1).$this->getStringParts($length2);
	}
	
	private function getStringParts($slength){
		if (phpversion() >= 4.2){  
			mt_srand();
		}else { 
			mt_srand(hexdec(substr(md5(microtime()), - $slength)) & 0x7fffffff); 
		}
		
		$param = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		
		$str = '';
		$string_length = strlen($param) - 1;
		for ($i = 0; $i < $slength; $i ++) {
			$str .= substr($param, mt_rand(0,$string_length), 1);
		}
		return $str;	
	}
	public function constructKey($pk_id,$string_key=""){		
		return  sprintf("%s%s-%s",$pk_id,$string_key,strlen($pk_id));		
	}
	
	
	/**
	 * 	split key by '-', part1 is the data part 2 is the length of the pk
	 *  pk_id is from 0 to part2
	 *  string_key is from part2 to the end
	 * @param unknown $key_data
	 */
	
	public function deconstructKey(&$key_data){
	
		@list($part1,$part2) = preg_split("/-/",  $key_data->full_key); //
	
		@$key_data->pk_id = intval(substr($part1, 0,$part2)); // member_id is x char long
		@$key_data->string_key = trim(substr($part1, $part2)); // member_key is
		
		return $key_data;
	}
	
	public function get_uuid(){
		$uuid =  sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
		
				// 32 bits for "time_low"
				mt_rand(0, 0xffff), mt_rand(0, 0xffff),
		
				// 16 bits for "time_mid"
				mt_rand(0, 0xffff),
		
				// 16 bits for "time_hi_and_version",
				// four most significant bits holds version number 4
				mt_rand(0, 0x0fff) | 0x4000,
		
				// 16 bits, 8 bits for "clk_seq_hi_res",
				// 8 bits for "clk_seq_low",
				// two most significant bits holds zero and one for variant DCE1.1
				mt_rand(0, 0x3fff) | 0x8000,
		
				// 48 bits for "node"
				mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
		);		
		return str_replace("-", "", $uuid);		
	}
}

class ClubRegErrorHelper extends JObject
{	
	static function error_from_model(&$d_model){
	
		$errors	= $d_model->getErrors();
	
		$error_str = array();
		for ($i = 0, $n = count($errors); $i < $n; $i++){
			if ($errors[$i] instanceof Exception)
			{
				$error_str[] = $errors[$i]->getMessage();
			} else {
				$error_str[] = $errors[$i];
			}
		}
	
		return $error_str;
	}
}

class ClubRegRenderHelper extends JObject{
	
	
	static function reformatObject(&$an_item){
		
		$isEmpty = array("0","-1");
		
		$an_item->t_address = "";$t_phone =  array();
		
		$an_item->address = str_replace("-1", "",$an_item->address);
		$an_item->postcode = str_replace("-1", "",$an_item->postcode);
		$an_item->emailaddress = str_replace("-1", "N/A",$an_item->emailaddress);
		
		if($an_item->address){
			$an_item->t_address = ucwords($an_item->address)."<br />";
		}
		$an_item->suburb = str_replace("-1", "",$an_item->suburb);
		
		if($an_item->suburb || $an_item->postcode){
			$an_item->t_address = $an_item->t_address.ucwords($an_item->suburb)." ";
		}
		if($an_item->postcode){
			$an_item->t_address = $an_item->t_address.$an_item->postcode;
		}
		if($an_item->phoneno && !in_array($an_item->phoneno,$isEmpty)){
			$t_phone[] = $an_item->phoneno;
		}
		if($an_item->mobile && !in_array($an_item->mobile,$isEmpty)){
			$t_phone[] = $an_item->mobile;
		}
		$an_item->t_phone = $t_phone ;
		
		
		return $an_item;
	} 
}
