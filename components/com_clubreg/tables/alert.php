<?php
/*------------------------------------------------------------------------
# com_clubreg - Manage Club Member Registrations
# ------------------------------------------------------------------------
# author    Omokhoa Agbagbara
# copyright Copyright (C) 2013 applications.deltastateonline.com. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://applications.deltastateonline.com
# Technical Support:  email - joomla@deltastateonline.com
-------------------------------------------------------------------------*/

defined('_JEXEC') or die;

class ClubregTableAlert extends JTable{

	
	public function __construct(&$_db)
	{
		parent::__construct(CLUB_PAYMENTS_TABLE, 'alert_id', $_db);		
		JTableObserverAudit::createObserver($this, array('typeAlias' => 'com_clubreg.alert'));
	}
}