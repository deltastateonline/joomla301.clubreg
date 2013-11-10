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

class JFormFieldClubordering extends JFormField
{
	/**
	 * The form field type.
	 *
	 * @var		string
	 * @since	1.6
	 */
	protected $type = 'Clubordering';
	
	
	protected function getOptions()
	{
		$options = array();
	
		$template_id = (int) $this->form->getValue('ordering');
		$control_which = $this->element['name'];
		$control_label = $this->element['label'];		
	
		//$options = ClubRegHelper::configOptions($control_which);
	
		$tmp = JHtml::_('select.option', '-1',	'-Select '.$control_label.' -', 'value', 'text');
	
		array_unshift($options,$tmp);
		// Merge any additional options in the XML definition.
		$options = array_merge(parent::getOptions(), $options);
	
		return $options;
	}
	
	
}