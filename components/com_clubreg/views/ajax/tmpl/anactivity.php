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
		echo "<div class='profile-new-div'>";
		$tableRender = new ClubRegRenderTablesPaymentsHelper();
		$this->hide_created = true;
		$tableRender->renderAnItem($this);
		echo "</div >";
	break;
	case "notes":
		$itemControl = $this->itemForm->getField("notes");		
		echo nl2br($itemControl->value);		
	break;
	case "assets":
		echo "<div class='profile-new-div'>";
		$tableRender = new ClubRegRenderTablesPropertysHelper();
		$this->hide_created = true;
		$tableRender->renderAnItem($this);
		echo "</div >";
	break;
	
}