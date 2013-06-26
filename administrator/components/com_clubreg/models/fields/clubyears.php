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

JFormHelper::loadFieldClass('list');

class JFormFieldClubyears extends JFormFieldList //JFormField
{
	
	protected $type = 'clubyears';
	
	protected function getOptions()
	{
		$options = array();		
		
		$control_label = $this->element['label'];
		
		$cy = date('Y');$t_array = array();		
		$options[] = JHtml::_('select.option', '-1',	'-Select '.JText::_($control_label).' -', 'value', 'text');	

		for($i = $cy -5 ; $i < $cy+5 ; $i++ ){			
			$options[] = JHtml::_('select.option', $i,	$i, 'value', 'text');	;
		}
		// Merge any additional options in the XML definition.
		$options = array_merge(parent::getOptions(), $options);

		return $options;
	}
}
