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
?>
<div class="text-center">
<div class='profile-img'>
	<img src="<?php echo $this->profiles_pix; ?>" width="150" id="profileimg" title="<?php echo JText::_("COM_CLUBREG_PROFILE_NEW_PHOTO")?>"/>
<?php if(isset($this->uploadfiles) && $this->uploadfiles){ ?>
	<form action="index.php" method="post" name="profilepixForm" id="profile-pix-form" class="" enctype='multipart/form-data' >	
		<?php
		 foreach($this->profilepixForm->getFieldset('memberProfilepix')  as $field){
					echo str_replace("jform_attachment", "uploadimage", $field->input); 
		 }
		foreach($this->profilepixForm->getFieldset('hiddenControls') as $field){
			echo $field->input;
		}
		?>
		<input type="<?php echo $in_type;?>" name="Itemid" value="<?php echo $clubreg_Itemid; ?>" />
		<input type="<?php echo $in_type;?>" name="option" value="com_clubreg" />
		<input type="<?php echo $in_type;?>" name="task" value="ajax.saveattachment" />
		<?php echo JHtml::_('form.token'); ?>
	</form>
<?php } ?>
</div>
<?php if(isset($this->uploadfiles) && $this->uploadfiles){ ?>
	<button id="profilebtn" class="btn profile-pix-button btn-mini btn-info">Change Profile Pix</button>
<?php }else{ ?>
	<button id="profilebtn" class="btn btn-mini btn-danger">Pix Upload Not Available</button>
<?php } ?>
</div>