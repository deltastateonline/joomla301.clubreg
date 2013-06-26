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

//echo "here1";
class ClubregViewClubgroups extends JViewLegacy
{
	protected $form;

	protected $item;

	protected $state;
	
	public function display($tpl = null)
	{	
		
		$this->items = $this->get('SubGroups');	

		echo json_encode($this->items);
		//parent::display($tpl);
	}
}