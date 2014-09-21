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
class ClubRegFiltersCommunicationsHelper extends ClubRegFiltersHelper
{	
	protected function getButtons($templates,$editAction){		
		?>	
		<div class="btn-group pull-right">	
			
			<a class="btn dropdown-toggle btn-small" data-toggle="dropdown" href="#"><?php echo JText::_('CLUBREG_COMMUNICATIONS_ACTIONS');?><span class="caret"></span></a>
		  <ul class="dropdown-menu">
		  	<?php $t_action = JRoute::_($editAction.'0') ;?>
		    	<li><a href="<?php echo $t_action ?>" data-template_id=0 class="template-action" ><?php echo JText::_('CLUBREG_COMMUNICATIONS_BLANK');?></a></li>
				<?php if(count($templates) > 0){ foreach($templates as $a_template){ 
					$t_action = JRoute::_($editAction.$a_template->value);
					?>
				<li><a href="<?php echo $t_action ?>" data-template_id="<?php echo $a_template->value; ?>" class="template-action"><?php echo JText::_($a_template->text);?></a></li>
				<?php } } ?>				
		  </ul>
  		</div>
  		<?php 
	}
	
	public function renderFilters($filters = array()){?>
				<fieldset class="eoi" >
					<div class="well well-small" style="margin-bottom:5px;">
					<?php $this->getButtons($filters["currentTemplates"],$filters["editAction"]); ?>
						<div class="pull-right" style="padding-right:5px;"><strong><?php echo JText::_('CLUBREG_COMMUNICATIONS_TEMPLATES') ?> : </strong> </div>				
						
					</div>			
				</fieldset>			
				<?php 		
		}
}