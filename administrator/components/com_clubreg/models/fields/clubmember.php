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
define('DS',DIRECTORY_SEPARATOR);
require_once (JPATH_ADMINISTRATOR.DS.'components'.DS.'com_clubreg'.DS.'constants.php');
require_once (JPATH_ADMINISTRATOR.DS.'components'.DS.'com_clubreg'.DS.'helpers'.DS.'clubreg.php');

class JFormFieldClubmember extends JFormField
{
	/**
	 * The form field type.
	 *
	 * @var		string
	 * @since	1.6
	 */
	protected $type = 'clubmember';

	protected function getInput()
	{
		$html = $options =  array();
		$attr = '';
		
		$value = "joomla_id";
		$text = "name";
		
		
		
		// Initialize some field attributes.
		$attr .= $this->element['class'] ? ' class="'.(string) $this->element['class'].'"' : '';
		$attr .= ((string) $this->element['disabled'] == 'true') ? ' disabled="disabled"' : '';
		$attr .= $this->element['size'] ? ' size="'.(int) $this->element['size'].'"' : '';
		
		$attr .= $this->element['multiple'] ? ' multiple="multiple"' : '';

		// Initialize JavaScript field attributes.
		$attr .= $this->element['onchange'] ? ' onchange="'.(string) $this->element['onchange'].'"' : '';
		
		
		$options = ClubRegHelper::get_member_list();
		
		$tmp = JHtml::_('select.option', '-1',	'-Select '.JText::_('COM_CLUBREG_GROUPMEMBERS_LABEL').' -', $value, $text);
		
		array_unshift($options,$tmp);	

		
		$html[] = JHtml::_('select.genericlist', $options,$this->name, trim($attr), $value,$text,$this->value);	
		

		return implode($html);
	}
}
