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
/**
	[em_address] => Brendale
    [em_emailaddress] => hell@hotmail.com
    [em_givenname] => Green
    [em_medical] => mice 
girls
    [em_mobile] => 0413923
    [em_surname] => Paul
    [member_key] => 106dM8GQbr0lv-3
 *
 */
class Emergency extends Mapper{	
	protected static $mapping = array(
			"em_address"=>"address", 
			"em_emailaddress"=>"emailaddress",			
			"em_givenname"=>"firstname",
			"em_medical"=>"medicalNotes",				
			"em_mobile"=>"mobileno",
			"em_surname"=>"lastname"
	);	
}