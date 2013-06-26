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
JHtml::_('behavior.formvalidation');
JHtml::_('behavior.tooltip');
global $clubreg_Itemid;
$in_type = "hidden";?>
<style>
<!--
.form-horizontal .control-group {
    margin-bottom: 10px;
}
-->
</style>
<form action="index.php" method="post" name="OtherForm" id="other-form" class="form-validate form-horizontal">	
		<?php 
		$extraDetails = $this->otherValues;
		foreach($this->extradetails as $d_key => $d_value){
		$mtyr = "/monthyear/"?>
				<div class="control-group">						
					<div class="control-label">
						<?php echo $d_value->config_name; ?>
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
			}		
			
		 foreach($this->otherForm->getFieldset('hiddenControls') as $field){ 	
				echo $field->input; 				
		 }		
		 ?>
	<input type="<?php echo $in_type;?>" name="Itemid" value="<?php echo $clubreg_Itemid; ?>" />
	<input type="<?php echo $in_type;?>" name="option" value="com_clubreg" />
	<input type="<?php echo $in_type;?>" name="task" value="ajax.saveother" />
	<?php echo JHtml::_('form.token'); ?>		
	<div class="clearfix" ></div>	
		<div class="form-actions">			 
			<button type="submit" class="btn btn-primary validate"><span><?php echo JText::_('JSUBMIT'); ?></span></button>	
			<button type="button" class="btn" id="toggle-other-div"><?php echo JText::_('JCANCEL'); ?></button>				
		</div>			
</form>