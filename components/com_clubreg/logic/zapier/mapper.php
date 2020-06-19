<?php
/*------------------------------------------------------------------------
# com_clubreg - Manage Club Member Registrations
# ------------------------------------------------------------------------
# author    Omokhoa Agbagbara
# copyright Copyright (C) 2020 applications.deltastateonline.com. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://app.deltastateonline.com
# Technical Support:  email - joomla@deltastateonline.com
-------------------------------------------------------------------------*/
defined('_JEXEC') or die;

class Mapper extends JObject{
	
	
	protected static $mapping = array();
	
	public static function mapped($input){
		
		$data = [];
		$class = get_called_class();		
		foreach($class::$mapping as $k=>$v){
			$data[$v] = $input->$k;			
		}		
		return $data;
	}
}