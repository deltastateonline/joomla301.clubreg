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

defined('JPATH_BASE') or die;

class JFormFieldClubgroups extends JFormField
{
	/**
	 * The form field type.
	 *
	 * @var		string
	 * @since	1.6
	 */
	protected $type = 'clubgroups';

	protected function getInput()
	{
		$html = $options =  array();
		$attr = '';
		
		$value = "group_id";
		$text = "group_name";
		
		// Initialize some field attributes.
		$attr .= $this->element['class'] ? ' class="'.(string) $this->element['class'].'"' : '';
		$attr .= ((string) $this->element['disabled'] == 'true') ? ' disabled="disabled"' : '';
		$attr .= $this->element['size'] ? ' size="'.(int) $this->element['size'].'"' : '';

		// Initialize JavaScript field attributes.
		$attr .= $this->element['onchange'] ? ' onchange="'.(string) $this->element['onchange'].'"' : '';
		
		$attr .= $this->element['multiple'] ? 'multiple="multiple"' : '';
		
		$layouttype = ($this->element['layouttype'])?$this->element['layouttype']:false;
		
		if(!$layouttype){
			$layouttype = (string) $this->form->getValue('playertype');
		}
		
		$options = ClubRegHelper::get_group_list($value,$text,$layouttype);
		
		$tmp = JHtml::_('select.option', '-1',	'-Select '.JText::_('COM_CLUBREG_GROUPSN_LABEL').' -', $value, $text);
		
		array_unshift($options,$tmp);		
	
		$html[] = JHtml::_('select.genericlist', $options,$this->name, trim($attr), $value,$text,$this->value);		

		return implode($html);
	}
}
