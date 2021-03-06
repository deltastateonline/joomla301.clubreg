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
global $clubreg_Itemid;

if(count($this->items)> 0){		

	$tableRender = new ClubRegRenderDivsFindplayersHelper();
	$tableRender->set("Itemid",$this->Itemid);
	$tableRender->set("searchTags",$this->searchTags);
	$tableRender->render($this);
	
}else{	
	echo ClubRegUnAuthHelper::noResults(); 
}