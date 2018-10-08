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
$current_sets = "extradetails";
$playertype = $this->regmemberForm->getField("playertype")->value;
$fieldSets = $this->regmemberForm->getFieldsets();

$numOfCols = 2;
$rowCount = 0;
$bootstrapColWidth = 12 / $numOfCols;
$colClass = "span5";

$rowClass = "row-fluid";

if(isset($fieldSets[$current_sets]->showonly) && preg_match("/$playertype/", $fieldSets[$current_sets]->showonly) ){
		
		ClubRegHelper::writeFieldTextCenter($fieldSets[$current_sets]->description);?>
		<div class="<?php echo $rowClass; ?>">
		<?php $extraDetails = $this->otherValues;
		foreach($this->extradetails as $d_key => $d_value){
		$mtyr = "/monthyear/"?>
				<div class="control-group <?php echo $colClass; ?>">						
					<div class="control-label">
						<label><?php echo $d_value->config_name; ?></label>
					</div>						
					<div class="controls<?php echo preg_match($mtyr, $d_value->params)?" controls-row":"";?>">
						<?php  						
								$registry = new JRegistry($d_value->params);
								$paramArray = $registry->toArray();
								
								$ControlRender = new ClubRegControlsHelper($paramArray);
								$ControlRender->set('configData', $d_value) ;					
								
								if(isset($extraDetails[$d_value->config_short]))
									$ControlRender->set('memberDetails', $extraDetails[$d_value->config_short]) ; // pass details to the object
								
								$ControlRender->render();
								
								unset($paramArray);	unset($ControlRender);	unset($registry);
						?>
					</div>
				</div>
		<?php
				$rowCount++; if($rowCount % $numOfCols == 0) echo '</div><div class="'.$rowClass.'">';		
			}	
		?>
	</div>
<?php  } ?>