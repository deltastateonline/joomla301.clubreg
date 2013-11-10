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
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

JFormHelper::loadFieldClass('list');

class JFormFieldClubgrouptypes extends JFormFieldList //JFormField
{
	
	protected $type = 'clubgrouptypes';
	
	protected function getOptions()
	{
		$options = array();		
		
		
		$control_which = $this->element['name'];
		$control_label = $this->element['label'];
		
		$options = ClubRegHelper::configOptions('CLUB_GROUPTYPE');		
		
		$tmp = JHtml::_('select.option', '0',	'-Select '.JText::_($control_label).' -', 'value', 'text');	

		array_unshift($options,$tmp);
		// Merge any additional options in the XML definition.
		$options = array_merge(parent::getOptions(), $options);

		return $options;
	}
}
