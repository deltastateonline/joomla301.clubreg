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

class JFormFieldOrdering extends JFormField
{
	/**
	 * The form field type.
	 *
	 * @var		string
	 * @since	1.6
	 */
	protected $type = 'Ordering';

	protected function getInput()
	{
		$html = array();
		$attr = '';

		
		// Initialize some field attributes.
		$attr .= $this->element['class'] ? ' class="'.(string) $this->element['class'].'"' : '';
		$attr .= ((string) $this->element['disabled'] == 'true') ? ' disabled="disabled"' : '';
		$attr .= $this->element['size'] ? ' size="'.(int) $this->element['size'].'"' : '';

		// Initialize JavaScript field attributes.
		$attr .= $this->element['onchange'] ? ' onchange="'.(string) $this->element['onchange'].'"' : '';

		// Get some field values from the form.
		$config_id	= (int) $this->form->getValue('config_id');		
		
		
		$which_config	=  $this->form->getValue('which_config');
		
		// Build the query for the ordering list.
		$query = 'SELECT ordering AS value, config_name AS text' .
				' FROM '.CLUB_CONFIG_TABLE.
				sprintf(" WHERE which_config = '%s'",  $which_config) .
				' ORDER BY ordering';

		
		// Create a read-only list (no name) with a hidden input to store the value.
		if ((string) $this->element['readonly'] == 'true') {
			$html[] = JHtml::_('list.ordering', '', $query, trim($attr), $this->value, $config_id ? 0 : 1);
			$html[] = '<input type="hidden" name="'.$this->name.'" value="'.$this->value.'"/>';
		}
		// Create a regular list.
		else {
			if(!($config_id > 0)){	$html[] = "<div class='alert alert-info'>";}
			$html[] = JHtml::_('list.ordering', $this->name, $query, trim($attr), $this->value, $config_id ? 0 : 1);
			if(!($config_id > 0)){
				$html[] = "</div>";
			}
		}

		return implode($html);
	}
}
