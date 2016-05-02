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
 * Render the controls used to filter the stats reporting
 *
 */
class ClubRegFiltersStatsReportingHelper extends ClubRegFiltersHelper{

	protected  $stats_date = NULL;
	protected  $end_date = NULL;

	protected function getButtons(){  $attribs = array("class"=>"inputbox input-small"); ?>
		<div class="btn-group pull-right">		
			<button class="btn btn-small btn-primary" type="button" onclick="return Joomla.submitbutton('filter');"><?php echo JText::_('CLUBREG_FILTER');?></button>
  		</div>
	  		<div class="clearfix"></div>
	  		<div class="row-fluid">  		  		
		  		<div class="control-group span4">
		  			<div class="control-label"><strong>Start Date :</strong></div>
		  			<div class="controls">
		  				<?php  echo JHtml::calendar($this->stats_date, "stats_date", 'stats_date','%d/%m/%Y',$attribs) ?>
		  			</div>
				</div>
				<div class="control-group span4">
		  			<div class="control-label"><strong>End Date :</strong></div>
		  			<div class="controls">
		  				<?php  echo JHtml::calendar($this->end_date, "end_date", 'end_date','%d/%m/%Y',$attribs) ?>
		  			</div>
				</div>
				<div class="control-group span1"></div>
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