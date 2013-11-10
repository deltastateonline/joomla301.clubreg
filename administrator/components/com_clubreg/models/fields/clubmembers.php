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

class JFormFieldClubmembers extends JFormField
{
	/**
	 * The form field type.
	 *
	 * @var		string
	 * @since	1.6
	 */
	protected $type = 'clubmembers';

	protected function getInput()
	{
		$html = $options =  array();
		$attr = '';
		
		$value = "joomla_id";
		$text = "name";
		
		$group_id	=  $this->form->getValue('group_id');
		
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

		if($group_id > 0 || $this->element['name'] == "group_leader"){	
			$html[] = JHtml::_('select.genericlist', $options,$this->name, trim($attr), $value,$text,$this->value);
		}else{
			$html[] = sprintf("<div class='alert alert-info'>Linked %s will be listed after the %s details are saved.</div>",
					JText::_('COM_CLUBREG_GROUPMEMBERS_LABEL'),JText::_('COM_CLUBREG_GROUPN_LABEL'));
		}		
		
		
		

		return implode($html);
	}
}
