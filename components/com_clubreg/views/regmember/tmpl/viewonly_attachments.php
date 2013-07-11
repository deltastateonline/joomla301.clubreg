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
<div><a class="btn profile-attachment-button" href="javascript:void(0)">Add <?php echo JText::_('COM_CLUBREG_PROFILE_ATTACHMENTS')?></a></div>
<div class="well well-small profile-well" id="attachmentFormDiv">
<form action="index.php" method="post" name="attachmentForm" id="attachment-form" class="form-horizontal" enctype='multipart/form-data' >
	<?php foreach($this->attachmentForm->getFieldset('memberAttachment')  as $field){ ?>
			<div class="control-group">					
				<div class="control-label"><?php echo $field->label; ?></div>
				<div class="controls"><?php echo $field->input; ?></div>						
			</div>	
<?php  } foreach($this->attachmentForm->getFieldset('hiddenControls') as $field){
				echo $field->input;
		}
?>
<input type="<?php echo $in_type;?>" name="Itemid" value="<?php echo $clubreg_Itemid; ?>" />
<input type="<?php echo $in_type;?>" name="option" value="com_clubreg" />
<input type="<?php echo $in_type;?>" name="task" value="ajax.saveattachment" />
<?php echo JHtml::_('form.token'); ?>
<div class="form-actions">
<button type="submit" class="btn btn-primary"><span><?php echo JText::_('JATTACHMENT'); ?></span></button>
<button type="button" class="btn profile-attachment-button"><span><?php echo JText::_('JCANCEL'); ?></span></button>
</div>
</form>
</div>
<div class="loading1 row-striped" id="profile-attachments" rel=<?php echo json_encode($rel_string)?>></div>
<?php 
$document = JFactory::getDocument();
ClubregHelper::writeTabAssets($document, "iFrameFormRequest",array("js"));
?>
