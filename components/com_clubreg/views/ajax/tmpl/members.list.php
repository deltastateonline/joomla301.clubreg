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
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

$group_types = array("senior"=>JText::_( 'COM_CLUBREG_PT_SENIOR' ), "junior"=>JText::_( 'COM_CLUBREG_PT_JUNIOR' ));
$recent = FALSE;
foreach($this->recent_registrations as $group_type => $recent_reg){	
	if(is_array($recent_reg) && count($recent_reg) > 0 ){ $recent = TRUE; ?>
			<div class="recent-playertype">
				<?php echo $group_types[$group_type]; ?>
			</div>
		<?php
		foreach($recent_reg as $a_player){		
			$fkey = $this->uKeyObject->constructKey($a_player->member_id,$a_player->member_key);
			?>
			<div class="row recent-div" style="margin:1px 5px 1px 10px;">			
					<div class="pull-left" style="font-size:1em;"><a href="javascript:void(0);" onclick="Joomla.sbutton('<?php echo $fkey;?>')"><?php echo ucwords(strtolower($a_player->surname)) ;?></a></div>	
					<div><small class='text-info pull-right'><?php echo $a_player->t_created_date; ?></small></div>
					<div class="pull-left" style="padding-left:10px;" ><?php echo $a_player->group ?>
						<?php if($a_player->subgroup){?>&nbsp;|&nbsp;<span class='recent-subgroup'><?php echo $a_player->subgroup;?></span><?php } ?>
					</div>			
			</div>	
			<div class="clearfix"></div>
			<?php 			
		} 	
	}
}
if(!$recent){
	echo ClubRegUnAuthHelper::noResults();
}