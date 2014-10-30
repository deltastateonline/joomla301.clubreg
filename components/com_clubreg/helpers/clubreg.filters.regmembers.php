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
class ClubRegFiltersRegmembersHelper extends ClubRegFiltersHelper
{
	
	
	protected function getMemberstatus(){			
		$tmp_list = array();		
		$tmp_list['registered'] = JHTML::_('select.option',  'registered', JText::_( 'COM_CLUBREG_OPTREGISTERED' ) );
		//$tmp_list['approved'] = JHTML::_('select.option',  'approved', JText::_( 'COM_CLUBREG_APPROVED' ) );
		$tmp_list['deleted'] = JHTML::_('select.option',  'deleted', JText::_( 'COM_CLUBREG_DELETED' ) );
		
		return $tmp_list;
	}
	protected function getButtons(){
		/*
		// onclick="if (document.adminForm.boxchecked.value==0){alert('<?php echo JText::_('CLUBREG_PLEASE_SELECT'); ?>');}else{Joomla.submitbutton('regmembers.batchUpdate');}"
	*/	?>
	
		<div class="btn-group pull-right">		
			<button class="btn btn-small btn-primary" type="button" onclick="document.adminForm.layout.value='renderregmembers';return Joomla.submitbutton('filter');"><?php echo JText::_('CLUBREG_FILTER');?></button>
			<button class="btn btn-small" type="button" onclick="return Joomla.addbutton('0-0');"><?php echo JText::_('CLUBREG_ADDNEW');?></button>
			<a class="btn dropdown-toggle btn-small" data-toggle="dropdown" href="#"><?php echo JText::_('CLUBREG_ACTIONS');?><span class="caret"></span></a>
		  <ul class="dropdown-menu">
		    	<li><a href="#" class="show-batch-filters" ><?php echo JText::_('CLUBREG_BATCHUPDATE');?></a></li>
				<?php if(LIVE_SITE){?>
				<li><a href="#" onclick="if (document.adminForm.boxchecked.value==0){alert('<?php echo JText::_('CLUBREG_PLEASE_SELECT'); ?>');}else{Joomla.submitbutton('regmembers.resetMemberKey');}" ><?php echo JText::_('CLUBREG_RESETKEY');?></a></li>
				<li><a href="#" onclick="if (document.adminForm.boxchecked.value==0){alert('<?php echo JText::_('CLUBREG_PLEASE_SELECT'); ?>');}else{Joomla.submitbutton('regmembers.delete');}" ><?php echo JText::_('CLUBREG_DELETE');?></a></li>
				<?php } ?>
				<li><a href="#" onclick="document.adminForm.layout.value='exportregmembers';return Joomla.submitbutton('filter');"><?php echo JText::_('CLUBREG_EXPORT');?></a></li>
		  </ul>
  		</div>
  		<?php 
	}
}