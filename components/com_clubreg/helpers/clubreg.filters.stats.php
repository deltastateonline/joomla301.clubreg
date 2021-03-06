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
 * Render the controls used to filter the stats page
 *
 */
class ClubRegFiltersStatsHelper extends ClubRegFiltersHelper{
	
	protected  $stats_date = NULL;

	protected function getButtons(){  $attribs = array("class"=>"inputbox input-small","onchange"=>"statsDateChanged();"); ?>	
			
		<div class="btn-group pull-right">		
			<button class="btn btn-small btn-primary" type="button" onclick="return Joomla.submitbutton('filter');"><?php echo JText::_('CLUBREG_FILTER');?></button>
  		</div>
  		<?php  echo JHtml::calendar($this->stats_date, "stats_date", 'stats_date','%d/%m/%Y',$attribs) ?>
  		<div class="pull-left" style="margin-left:10px;">
  			<b>Date : </b>&nbsp;	
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