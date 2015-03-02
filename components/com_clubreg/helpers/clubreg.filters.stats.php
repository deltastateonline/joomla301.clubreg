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
defined( '_JEXEC' ) or die( 'Restricted access' );
require_once JPATH_COMPONENT.DS.'helpers'.DS.'clubreg.filters.php';
/**
 * 
 * @author omo
 *
 */
class ClubRegFiltersStatsHelper extends ClubRegFiltersHelper{

	protected function getButtons(){?>
	
		<div class="btn-group pull-right">		
			<button class="btn btn-small btn-primary" type="button" onclick="return Joomla.submitbutton('filter');"><?php echo JText::_('CLUBREG_FILTER');?></button>
  		</div>
  		<?php 
	}
	
	protected function getMemberstatus(){
		$tmp_list = array();
		$tmp_list['registered'] = JHTML::_('select.option',  'registered', JText::_( 'COM_CLUBREG_OPTREGISTERED' ) );
		//$tmp_list['approved'] = JHTML::_('select.option',  'approved', JText::_( 'COM_CLUBREG_APPROVED' ) );
		$tmp_list['deleted'] = JHTML::_('select.option',  'deleted', JText::_( 'COM_CLUBREG_DELETED' ) );
	
		return $tmp_list;
	}
	
	
}