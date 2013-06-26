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


class ClubregViewClubreg extends JViewLegacy
{
	
	public function display($tpl = null)
	{
		ClubRegHelper::addSubmenu('homepage');		
		$cTitle = sprintf("%s",JText::_('COM_CLUBREG'));		
		JToolbarHelper::title($cTitle, 'clubgroups.png');
		$this->sidebar = JHtmlSidebar::render();
		
		parent::display($tpl);
	}
}