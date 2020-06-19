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

require("mapper.php");
$files = glob(__DIR__ . '/*.php');
foreach ($files as $file) {
	// prevents including file itself	
	if(!preg_match("/mapper.php|allmappers.php/i", $file))
		require($file);
	
}
//exit;