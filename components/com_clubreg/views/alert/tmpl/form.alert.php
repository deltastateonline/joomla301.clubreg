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
//JHtml::_('behavior.formvalidation');
global $clubreg_Itemid;
$in_type = "hidden";?>
<script type="text/javascript">
<!--

    jQuery(document).ready(function($) {
        Calendar.setup({
        // Id of the input field
        inputField: 'jform_alert_date_<?php echo $this->member_key; ?>',
        // Format of the input field
        ifFormat: '%Y-%m-%d',
        // Trigger for the calendar (button ID)
        button: 'jform_alert_date_btn_<?php echo $this->member_key; ?>',
        // Alignment (defaults to "Bl")
        align: 'Tl',
        singleClick: true,
        firstDay: '0'
        });
    });
//-->
</script>
<div class="" id="message_<?php echo $this->member_key; ?>"></div>
<form action="index.php" method="post" name="AlertForm" id="alert-form" class="form-validate form-horizontal form-clubreg">	
		<div class="fieldSetDiv"><?php echo JText::_('COM_CLUBREG_ALERT_DETAILS');?></div>
		<?php foreach($this->alertForm->getFieldset('alertDetails') as $field){	?>
			<div class="control-group">			
				<?php if(strpos($field->id, "clubregPlaceholder")){	
					ob_start() ; ?>		
					<div class="control-label"><?php echo $field->label; ?></div>		
					<div class="controls"><?php echo $field->input; ?></div>				
				<?php 	$dInput  = ob_get_contents(); 
						ob_end_clean();
						echo str_replace("clubregPlaceholder", $this->member_key, $dInput);						
					 }else{?>
					 <div class="control-label"><?php echo $field->label; ?></div>
					<div class="controls"><?php echo $field->input; ?></div>
				<?php } ?>					
			</div>		
		<?php 		 				
		 }		
		 foreach($this->alertForm->getFieldset('hiddenControls') as $field){ 	
					echo $field->input; 				
		 }		
		 ?>
	<input type="<?php echo $in_type;?>" name="Itemid" value="<?php echo $clubreg_Itemid; ?>" />
	<input type="<?php echo $in_type;?>" name="option" value="com_clubreg" />
	<input type="<?php echo $in_type;?>" name="task" value="alert.save" />
	<?php echo JHtml::_('form.token'); ?>		
	<div class="clearfix" ></div>	
		<div class="form-actions">					 
			 <button type="submit" class="btn btn-primary validate"><span><?php echo JText::_('JSUBMIT'); ?></span></button>					
			<button type="button" class="btn toggle-alerts-div" data-memberid='<?php echo $this->member_id; ?>'><?php echo JText::_('JCANCEL'); ?></button>				
		</div>			
</form>