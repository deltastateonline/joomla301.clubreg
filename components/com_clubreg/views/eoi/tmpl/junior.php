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
jimport('joomla.html.html.bootstrap');
JHtml::_('behavior.formvalidation');
JHTML::_('behavior.calendar');
JHtml::_('behavior.tooltip');
JHtml::_('formbehavior.chosen', 'select');

$uri = JURI::getInstance();
$Itemid = $uri->getVar('Itemid');

?>
<form action="<?php echo JRoute::_('index.php')?> " method="post" name="adminForm" id="eoi-form" class="form-validate form-horizontal">
<fieldset class="well">
<legend><?php echo JText::_('COM_CLUBREG_EOIFORM_LABEL'); ?>:: <?php echo JText::_('COM_CLUBREG_GUARDIAN_LABEL')?></legend>
<div class="row-fluid">
		<?php foreach($this->form->getFieldset('guardian') as $field): ?>
			<div class="control-group"> 
				<?php if (!$field->hidden): ?>
					<div class="control-label">
						<?php echo $field->label; ?>
					</div>
				<?php endif;  ?>
				<div class="controls">
					<?php echo $field->input; ?>
				</div>
			</div>
		<?php endforeach; ?>
</div>
</fieldset>
<?php 
$juniorDetails = $this->juniorDetails; // get junior details stored in session
$junior_field = $this->juniorControls; // the only keys we need
$howmany = CLUB_JUNIORCOUNT;

$rm = array("jform_","_counter",); // extra string to remove

for($i = 0 ; $i<$howmany; $i++){ ?>
<fieldset class="well">
<legend style="margin-bottom:3px"><?php echo JText::_('COM_CLUBREG_JUNIOR_LABEL')," ",$i+1; ?> </legend>
	<?php $cl_ = array("span5","span5"); $j=0;	
	
	foreach($this->form->getFieldset('junior') as $field){	
		
		$fieldKey = sprintf("%s%d",str_replace($rm, "", $field->id),$i); // get the field key in the data aray		
		$value = isset($juniorDetails[$fieldKey])?$juniorDetails[$fieldKey]:""; // all the data is in jform[controlName{i}] which is extracted into data as controlName{i}
				
		$nameOnly = str_replace("jform_", "", $field->id); //  remove the jform_ from the id generated in the xml
				
		if($j == 0 ){?><div class="span12"><?php } ?>		
		<div class="<?php echo $cl_[$j]; ?>">
			<?php if (!$field->hidden): ?>					
					<?php echo str_replace("_counter", $i, $field->label); ?>								
			<?php endif;  ?>				
			<?php if($field->name == "jform[dob_counter]"){ // for dob, individual ids and name are need because of id for jquery
				$format = '%Y-%m-%d'; $name = str_replace("_counter", $i, $field->name);  $id= str_replace("_counter", $i, $field->id);	
				
				if(strlen(trim($value)) ==  10 ){
					$t = explode("/",$value);
					$value = sprintf("%s-%s-%s",$t[2],$t[1],$t[0]);
				}else{
					$value = "";
				}				
							
				echo JHTML::_('calendar', $value, $name, $id, $format, array('class' => 'inputbox input-small')); // create calendar mannually
			}else {		
				$tmpControl = $this->form->getInput($nameOnly,null,$value); // get the input from the xml				
				echo str_replace("_counter", $i, $tmpControl); // remove the _counter from the control string then echo
				
			} ?>			
		</div>	
		<?php		
		$j = 1 - $j; 
		if($j == 0 ){ ?></div><?php }  
		
	}  if($j = 1){ echo "</div>"; } ?>

	
</fieldset>
<?php 
}
?>		<input type="hidden" name="Itemid" value="<?php echo $Itemid; ?>" />	
		<input type="hidden" name="jform[playertype]" id="jform_playertype" value="junior" />
		<input type="hidden" name="option" value="com_clubreg" />
		<input type="hidden" name="task" value="eoi.sendrequest" />
		<?php echo JHtml::_('form.token'); ?>		
	<div class="form-actions">		
		<button class="btn btn-primary" type="submit">
			<?php echo JText::_('COM_CLUBREG_SENDREQUEST'); ?>
		</button>
		<button class="btn" type="reset"  >
			<?php echo JText::_('JCANCEL'); ?>
		</button>
	</div>
</form>
<?php 
$document = JFactory::getDocument();
$document->addScript('components/com_clubreg/assets/js/eoi.js?'.time());
$document->addStyleSheet('components/com_clubreg/assets/css/eoi.css?'.time());
ClubregHelper::write_footer(); ?>