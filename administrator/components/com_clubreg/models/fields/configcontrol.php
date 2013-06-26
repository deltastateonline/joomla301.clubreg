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
/**
 * Use this class to generate a drop down list using the config list.
 * This also removes the need to tie the control name to the config short tag.
 * control can be called memberlevel and the config short tag can be called club_player_level 
 *
 */

class JFormFieldConfigcontrol extends JFormFieldList //JFormField
{
	
	protected $type = 'configcontrol';
	/**
	 * if the element attribute 'configwhich' is set then use it
	 * else use the name of the element
	 * @see JFormFieldList::getOptions()
	 */
	
	protected function getOptions()
	{
		$options = array();			
			
		$control_which = 	($this->element['configwhich'])?$this->element['configwhich']:"club_".$this->element['name'];		
		$control_label = $this->element['label'];
		
		$options = ClubRegHelper::configOptions($control_which);		
		
		$tmp = JHtml::_('select.option', '',	'-Select '.JText::_($control_label).' -', 'value', 'text');	

		array_unshift($options,$tmp);
		// Merge any additional options in the XML definition.
		$options = array_merge(parent::getOptions(), $options);

		return $options;
	}
}
