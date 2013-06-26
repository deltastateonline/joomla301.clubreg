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
?>
<div class="alert alert-success">
 <button type="button" class="close" data-dismiss="alert">&times;</button>
  	<strong><?php echo JText::_('COM_CLUBREG_REQUESTSENT'); ?></strong>
  </div>
 <div class="well">
 <?php  
	 if(isset($this->eoi_template) && ($this->eoi_template->template_id > 0 )){ 
		echo stripslashes($this->eoi_template->template_text);
	 }else{?> 
	
	Thank you for registering your expression of interest,<br />
	
	One of our team leaders will get back to you in due course
	
<?php  } ?>
</div>
<?php ClubregHelper::write_footer(); ?>