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
$current_sets = "emergency";
$playertype = $this->regmemberForm->getField("playertype")->value;
$fieldSets = $this->regmemberForm->getFieldsets();

$numOfCols = 2;
$rowCount = 0;
$bootstrapColWidth = 12 / $numOfCols;
$colClass = "span5";

$rowClass = "row-fluid";


if(isset($fieldSets[$current_sets]->showonly) && preg_match("/$playertype/", $fieldSets[$current_sets]->showonly) ){		
		ClubRegHelper::writeFieldTextCenter($fieldSets[$current_sets]->description);?>
	<div class="<?php echo $rowClass; ?>"><?php
		 foreach($this->emergencyForm->getFieldset('nextofkin') as $field): ?>
			<div class="control-group <?php echo $colClass; ?>"> 				
					<div class="control-label">
						<?php echo $field->label; ?>
					</div>				
					<div class="controls">
						<?php echo str_replace("jform[em_", "jform[emergency][em_", $field->input); ?>
					</div>
			</div>
		<?php $rowCount++; if($rowCount % $numOfCols == 0) echo '</div><div class="'.$rowClass.'">'; 
		endforeach; ?>
	</div>
<?php } ?>