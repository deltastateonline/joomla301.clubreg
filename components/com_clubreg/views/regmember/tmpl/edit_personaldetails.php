<?php
$current_sets = "personalDetails";


$numOfCols = 2;
$rowCount = 0;
$bootstrapColWidth = 12 / $numOfCols;
$colClass = "span5";

$rowClass = "row-fluid";

if(isset($this->fieldSets[$current_sets]->showonly) && preg_match("/$playertype/", $this->fieldSets[$current_sets]->showonly) ){ ?>
	
	<?php ClubRegHelper::writeFieldTextCenter($this->fieldSets[$current_sets]->description); ?>
	<div class="<?php echo $rowClass; ?>">
		<?php
			 foreach($this->regmemberForm->getFieldset($current_sets) as $field): ?>
				<div class="control-group <?php echo $colClass; ?>"> 				
						<div class="control-label">
							<?php echo $field->label; ?>
						</div>				
						<div class="controls">
							<?php echo $field->input; ?>
						</div>
				</div>
			<?php 
			$rowCount++; if($rowCount % $numOfCols == 0) echo '</div><div class="'.$rowClass.'">';
			endforeach; ?>
	</div>		
<?php } ?>	