<?php
/*------------------------------------------------------------------------
# com_clubreg - Manage Club Member Registrations
# ------------------------------------------------------------------------
# author    Omokhoa Agbagbara
# copyright Copyright (C) 2012 applications.deltastateonline.com. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://applications.deltastateonline.com
# Technical Support:  email - joomla@deltastateonline.com
-------------------------------------------------------------------------*/
// no direct access
/**
 * @desc Generate the list of player types
 */
defined( '_JEXEC' ) or die( 'Restricted access' );
class ClubRegPlayertypeHelper extends JObject
{
	
	static function generate_List(){
		$t_array = array();
		//$t_array['-1'] = JHTML::_('select.option',  '','-'.JText::_('COM_CLUBREG_PT').'-' );
		$t_array['junior'] = JHTML::_('select.option',  'junior', JText::_( 'COM_CLUBREG_PT_JUNIOR' ) );
		$t_array['senior'] = JHTML::_('select.option',  'senior', JText::_( 'COM_CLUBREG_PT_SENIOR' ) );
		$t_array['guardian'] = JHTML::_('select.option',  'guardian', JText::_( 'COM_CLUBREG_PT_GUARDIAN' ) );
		
		return $t_array;
	
	}
}