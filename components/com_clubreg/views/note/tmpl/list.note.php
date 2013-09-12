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
global $clubreg_Itemid;
if(count($this->notes)>0){	
	foreach($this->notes as $a_note){ 
		$fkey = $this->uKeyObject->constructKey($a_note->note_id,$a_note->note_key);
		$rel_string = json_encode(array('Itemid'=>$clubreg_Itemid,'note_key'=>$fkey));?>
	<div class="row-fluid" id='note_div<?php echo $a_note->note_id?>'>
		<div class="pull-left profile-bold"><?php echo $a_note->name; ?></div>
		<div class="pull-left" style="padding-left: 10px;"><p class="text-info small"><?php echo $a_note->created;?></p></div>
		
		<?php if($a_note->note_status == 0) {?>		
		<div class="pull-right"><a href="javascript:void(0);" class='profile-private' rel=<?php echo $rel_string; ?> ><img src="<?php echo CLUBREG_ASSETS; ?>/images/private.png" /></a></div>
		<?php } ?>
		<div class="pull-right" style="padding-left:5px"><a href="javascript:void(0);" class='profile-delete' rel=<?php echo $rel_string; ?> ><img src="<?php echo CLUBREG_ASSETS; ?>/images/delete.png" /></a></div>
		<div class="clearfix"></div>		
		<div><?php echo nl2br($a_note->notes);?></div>	
		<div class="clearfix"></div>		
	</div>
<?php 
	}	
}else{ echo ClubRegUnAuthHelper::noResults('COM_CLUBREG_PROFILE_NOTES');  }