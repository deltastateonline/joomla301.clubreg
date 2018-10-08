<?php
/*------------------------------------------------------------------------
# com_clubreg - Manage Club Member Registrations
# ------------------------------------------------------------------------
# author    Omokhoa Agbagbara
# copyright Copyright (C) 2013 applications.deltastateonline.com. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://applications.deltastateonline.com
# Technical Support:  email - joomla@deltastateonline.com
-------------------------------------------------------------------------*/
defined('_JEXEC') or die;

$current_sets = "contactDetails"; 

$numOfCols = 2;
$rowCount = 0;
$bootstrapColWidth = 12 / $numOfCols;
$colClass = "span5";

$rowClass = "row-fluid";				
if(isset($this->fieldSets[$current_sets]->showonly) && preg_match("/$playertype/", $this->fieldSets[$current_sets]->showonly) ){ ?>
			
<?php ClubRegHelper::writeFieldTextCenter($this->fieldSets[$current_sets]->description);?>
<div class="<?php echo $rowClass; ?>">
<?php 
	foreach($this->regmemberForm->getFieldset($current_sets) as $field): ?>	
		<div class="control-group <?php echo $colClass?>"> 				
				<div class="control-label">
					<?php echo $field->label; ?>
				</div>				
				<div class="controls">
					<?php echo $field->input; ?>
				</div>
		</div>
	<?php $rowCount++; if($rowCount % $numOfCols == 0) echo '</div><div class="'.$rowClass.'">';
	endforeach; ?>
</div>
	
<?php } 