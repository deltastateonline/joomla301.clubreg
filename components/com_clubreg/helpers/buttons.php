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
class ClubRegButtonsHelper extends JObject
{
	/**
	 * 	@todo remove this file
	 * redundant file
	 */
	
		protected function getButtons(){?>
				
				<div class="btn-group pull-right">		
					<button class="btn btn-small btn-primary" type="button" onclick="document.adminForm.layout.value='renderregmembers';return Joomla.submitbutton('filter');"><?php echo JText::_('CLUBREG_FILTER');?></button>
					<button class="btn btn-small" type="button" onclick="return Joomla.addbutton('0-0');"><?php echo JText::_('CLUBREG_ADDNEW');?></button>
					<a class="btn dropdown-toggle btn-small" data-toggle="dropdown" href="#"><?php echo JText::_('CLUBREG_ACTIONS');?><span class="caret"></span></a>
				  <ul class="dropdown-menu">
				    	<li><a href="#" onclick="if (document.adminForm.boxchecked.value==0){alert('<?php echo JText::_('CLUBREG_PLEASE_SELECT'); ?>');}else{Joomla.submitbutton('regmembers.register');}" ><?php echo JText::_('CLUBREG_BATCHUPDATE');?></a></li>
						<li><a href="#" onclick="if (document.adminForm.boxchecked.value==0){alert('<?php echo JText::_('CLUBREG_PLEASE_SELECT'); ?>');}else{Joomla.submitbutton('regmembers.resetMemberKey');}" ><?php echo JText::_('CLUBREG_RESETKEY');?></a></li>
						<?php if(LIVE_SITE){?>
						<li><a href="#" onclick="if (document.adminForm.boxchecked.value==0){alert('<?php echo JText::_('CLUBREG_PLEASE_SELECT'); ?>');}else{Joomla.submitbutton('regmembers.delete');}" ><?php echo JText::_('CLUBREG_DELETE');?></a></li>
						<li><a href="#" onclick="document.adminForm.layout.value='exportregmembers';return Joomla.submitbutton('filter');"><?php echo JText::_('CLUBREG_EXPORT');?></a></li>
				  		<?php } ?>
				  </ul>
		  		</div>
		  		<?php 
			}
}