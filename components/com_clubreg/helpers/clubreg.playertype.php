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
		
		$params = JComponentHelper::getParams('com_clubreg');
		$player_types = $params->get("playertype");
		
		if(is_array($player_types) && count($player_types) > 0){

			if(in_array("junior", $player_types)){		
				$t_array['junior'] = JHTML::_('select.option',  'junior', JText::_( 'COM_CLUBREG_PT_JUNIOR' ) );
			}
			if(in_array("senior", $player_types)){
				$t_array['senior'] = JHTML::_('select.option',  'senior', JText::_( 'COM_CLUBREG_PT_SENIOR' ) );
			}
			
			if(in_array("guardian", $player_types)){
				$t_array['guardian'] = JHTML::_('select.option',  'guardian', JText::_( 'COM_CLUBREG_PT_GUARDIAN' ) );
			}
		
		}else{
			$t_array['senior'] = JHTML::_('select.option',  'senior', JText::_( 'COM_CLUBREG_PT_SENIOR' ) );
		}
		
		return $t_array;
	
	}
	
	static function batch_generate_List(){
		$t_array = array();	
	
		$t_array['-1'] = JHTML::_('select.option',  '-1',"-".JText::_( 'COM_CLUBREG_PT' )."-" );
		$t_array['senior'] = JHTML::_('select.option',  'senior', JText::_( 'COM_CLUBREG_PT_SENIOR' ) );
		
	
		return $t_array;
	
	}
}