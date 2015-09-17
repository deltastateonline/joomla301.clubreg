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
$current_sets = "nextofkin";
$fieldSets = $this->regmemberForm->getFieldsets();
if(isset($fieldSets[$current_sets]->showonly) && preg_match("/$playertype/", $fieldSets[$current_sets]->showonly) ){
		
		ClubRegHelper::writeFieldText($fieldSets[$current_sets]->description);
		?><div style="padding-left:10px;"><?php
	 foreach($this->regmemberForm->getFieldset($current_sets) as $field): ?>
		<div class="control-group "> 				
				<div class="control-label">
					<?php echo $field->label; ?>
				</div>				
				<div class="controls">
					<?php echo $field->input; ?>
				</div>
		</div>
	<?php endforeach; ?>
	</div>
<?php } ?>