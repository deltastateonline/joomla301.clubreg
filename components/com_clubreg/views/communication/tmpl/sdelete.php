<?php
/*------------------------------------------------------------------------
# com_clubreg - Manage Club Member Registrations
# ------------------------------------------------------------------------
# author    Omokhoa Agbagbara
# copyright Copyright (C) 2014 applications.deltastateonline.com. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://applications.deltastateonline.com
# Technical Support:  email - joomla@deltastateonline.com
-------------------------------------------------------------------------*/

defined( '_JEXEC' ) or die( 'Restricted access' );
JHtml::_('behavior.formvalidation');
global $clubreg_Itemid;
ClubregHelper::writePageHeader(JText::_('COM_CLUBREG_COMM_DETAILS')."- (".$this->comm_title.")");
$in_type = "hidden";

?>

<div class="clugreg-div">
	<form id="comm-delete-form" method="post" name="comm-delete-form" action="">
		<div class="text-center shadowed-div" style="min-height:150px;">
			<h2 id="comm_action_msg">Are you sure you want to delete this <?php echo $this->comm_type; ?> ?</h2>
		</div>
		<div>
		<div id="comm_action_btn">
			<a href="javascript:void(0)" class="btn btn-primary btn-delete-comm">Delete</a>
			<a href="javascript:void(0)" class="btn pull-right cl" data-dismiss="modal" onclick="window.parent.SqueezeBox.close()">Cancel</a>
		</div>
		</div>
		<?php 
		 foreach($this->communicationForm->getFieldset('hiddenControls') as $field){ 	
						echo $field->input; 				
			}		
		?>	
		<input type="<?php echo $in_type;?>" name="Itemid" value="<?php echo $clubreg_Itemid; ?>" />
		<input type="<?php echo $in_type;?>" name="option" value="com_clubreg" />
		<input type="<?php echo $in_type;?>" name="task" id="clubregTask" value="communication.fdelete" />
		
		<?php echo JHtml::_('form.token'); ?>	
	</form>
</div>
<?php //ClubregHelper::write_footer(); ?>