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
class ClubRegSeasonsHelper extends JObject
{
	
	static function generate_List(){
		$cy = date('Y');$t_array = array();
		$t_object = new stdClass() ; $t_object->value = '-1'; $t_object->text = '-'.JText::_('COM_CLUBREG_SEASON_LABEL').'-';
		$t_array[] = $t_object;
		for($i = $cy -5 ; $i < $cy+5 ; $i++ ){
			$t_object = new stdClass() ; $t_object->value = $i; $t_object->text = $i;
			$t_array[] = $t_object;
		}
		return $t_array;
	
	}
}