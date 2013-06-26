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

switch($this->which){
	case "payments":
		$tableRender = new ClubRegRenderTablesPaymentsHelper();
		$this->hide_created = true;
		$tableRender->renderAnItem($this);
	break;
	case "notes":
		$itemControl = $this->itemForm->getField("notes");		
		echo nl2br($itemControl->value);		
	break;
}