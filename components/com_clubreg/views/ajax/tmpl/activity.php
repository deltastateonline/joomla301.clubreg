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
$activity = $this->activity;
if(count($activity) > 0){ ?>		
		<div class="row-striped">
			<?php foreach($activity as $an_activity){ 
				if(isset($an_activity->item_key) && strlen($an_activity->item_key) > 2){
					$rel_string_edit = sprintf("rel=%s", json_encode(array('Itemid'=>$clubreg_Itemid,JSession::getFormToken()=>1,'item_key'=>$an_activity->item_key,'which'=>$an_activity->which)));
					$activity_class = "activity-item";
				}else
					$rel_string_edit = $activity_class = "";
				?>
				<div class="row-fluid">
					<div class='span8 activity-label' ><?php echo ucwords(str_replace("_", " ", $an_activity->activity_label)); ?></div><div class='span4'><small class='text-info pull-right'><?php echo $an_activity->activity_created; ?></small></div>
					<div class="clearfix"></div>
					<div class='<?php echo $activity_class; ?>' <?php echo $rel_string_edit; ?>><?php echo ucwords($an_activity->activity_item); ?></div>
				</div>
			<?php } ?>
		</div>
<?php 			
}else{
	echo "";
}