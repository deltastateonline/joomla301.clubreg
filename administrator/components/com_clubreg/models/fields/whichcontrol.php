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

class JFormFieldWhichcontrol extends JFormFieldList //JFormField
{
	
	protected $type = 'whichcontrol';
	
	protected function getOptions()
	{
		$options = array();			
		
		$config_id = (int) $this->form->getValue('config_id');
		$control_which = $this->element['name'];
		$control_label = $this->element['label'];	
		
		$options = ClubRegHelper::configOptions(TOPMOST);		
		
		$tmp = JHtml::_('select.option', TOPMOST,	TOPMOST, 'value', 'text');	

		array_unshift($options,$tmp);
		// Merge any additional options in the XML definition.
		$options = array_merge(parent::getOptions(), $options);

		return $options;
	}
}
