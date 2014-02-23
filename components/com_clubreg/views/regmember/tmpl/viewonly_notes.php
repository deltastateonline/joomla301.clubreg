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
$in_type = "hidden";
global $clubreg_Itemid;
$rel_string = array("Itemid"=>$clubreg_Itemid,"member_key"=>$this->member_key,JSession::getFormToken()=>1);?>
<div><a class="btn profile-note-button btn-mini btn-info" href="javascript:void(0)">Add <?php echo JText::_('COM_CLUBREG_PROFILE_NOTES')?></a></div>
<div class="well well-small profile-well" id="noteFormDiv">
<form action="index.php" method="post" name="NoteForm" id="note-form" class="form-validate form-clubreg">	
		 <div class="control-group">
		 	<div class="controls">
		 		<?php $t_string = $this->noteForm->getLabel('note_status');echo str_replace("label", "span", $t_string); ?>
		 		<?php echo $this->noteForm->getInput('note_status'); ?>
			</div>	
		</div>
		 <div class="control-group">
			<div class="control-label"><?php echo $this->noteForm->getLabel('notes'); ?></div>
			<div class="controls"><?php echo $this->noteForm->getInput('notes'); ?></div>						
		</div>				
		<?php foreach($this->noteForm->getFieldset('hiddenControls') as $field){ 	
					echo $field->input; 				
		 }		
		 ?>
	<input type="<?php echo $in_type;?>" name="Itemid" value="<?php echo $clubreg_Itemid; ?>" />
	<input type="<?php echo $in_type;?>" name="option" value="com_clubreg" />
	<input type="<?php echo $in_type;?>" name="task" value="ajax.savenote" />
	<?php echo JHtml::_('form.token'); ?>	
	<div class="form-actions">				
		<button type="submit" class="btn btn-primary validate"><span><?php echo JText::_('JSUBMIT'); ?></span></button>	
		<button type="button" class="btn profile-note-button"><span><?php echo JText::_('JCANCEL'); ?></span></button>			
	</div>
</form>
</div>
<div class="loading1 row-striped" id="profile-notes" rel=<?php echo json_encode($rel_string)?>></div>
	