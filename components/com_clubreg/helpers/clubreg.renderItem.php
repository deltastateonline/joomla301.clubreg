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
/**
 * render single item also hold the value tranformers
 * @author omo
 *
 */
class ClubRegRenderItemHelper extends JObject
{
	/**
	 *  render an item based on config settings
	 * @param mixed $value
	 * @param array $config
	 */
	public function render($value,$config){
		if( is_array($value)) {
			$config["sep"] = isset($config["sep"])?$config["sep"]:"<br />";
			return  implode($config["sep"],$value);
		}else {
			if(isset($config["transform"])){
				$value = call_user_func($config["transform"],$value);
			}
			return $value;
		}
	}
}

function sendnews($value){	
	$send_news = array("-1"=>JText::_('JNO'),"0"=>JText::_('JNO'),"1"=>JText::_('JYES'));	
	echo isset($send_news[$value])?$send_news[$value]:JText::_('JNO');
}
function applyFactor($value){	
	return number_format($value/FACTOR,2, '.', ',');
}
function clubregdate($value){
	
	$zero_pattern = "/0000/";
	if(!preg_match($zero_pattern, $value) && isset($value)){
		$dates = preg_split("/-/", $value);
		echo sprintf("%s/%s/%s", $dates[2],$dates[1],$dates[0]);
	}
}