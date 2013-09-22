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

require_once("clubreg.tables.php");

class ClubregTableNote extends ClubregTableDefault{
	
	protected $_hex = array();
	
	public function __construct(&$_db)
	{		
		$this->_hex = array("note_key");
		parent::__construct(CLUB_NOTES_TABLE, 'note_id', $_db);		
	}

}