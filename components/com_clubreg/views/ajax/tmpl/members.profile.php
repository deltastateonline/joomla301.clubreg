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
require_once JPATH_COMPONENT.DS.'helpers'.DS.'clubreg.profilethumbs.php';

$params = JComponentHelper::getParams('com_clubreg');
$folder_path = $params->get("attachment_folder");

$media_params = JComponentHelper::getParams('com_media');
$full_media_path = $media_params->get('file_path').DS.$folder_path.DS;

$thumbrenderer = new ClubRegProfileThumbsHelper($full_media_path);


$group_types = array("senior"=>JText::_( 'COM_CLUBREG_PT_SENIOR' ), "junior"=>JText::_( 'COM_CLUBREG_PT_JUNIOR' ));
$recent = FALSE;

$defaultImg = "<img src='".JURI::base().CLUBREG_ASSETS."/images/clublogo32.png' >";
foreach($this->recent_registrations as $group_type => $recent_reg){	
	if(is_array($recent_reg) && count($recent_reg) > 0 ){ $recent = TRUE; ?>
		<div class="recent-div">
			<div class="recent-playertype">
				<?php echo $group_types[$group_type]; ?>
			</div>
			<div style="padding-left: 10px">
			<?php
			foreach($recent_reg as $a_player){		
				$fkey = $this->uKeyObject->constructKey($a_player->member_id,$a_player->member_key);			
				$profile_pix = $thumbrenderer->renderMemberThumb($a_player->member_id,64);		
				?>
				<div class="pull-left thumbnail-div">
					<div class="thumbnail">
						<?php echo ($profile_pix)?$profile_pix:$defaultImg; ?>								
					</div>
					<div class="profile-text">
						<span><a href="javascript:void(0);" onclick="Joomla.sbutton('<?php echo $fkey;?>')"><?php echo ucwords(strtolower($a_player->surname)) ;?></a></span><br />
						<small class='text-info small-group'><?php echo $a_player->t_created_date; ?></small>
						<br /><span class="small-group"><?php echo $a_player->group ?></span>
						<?php if($a_player->subgroup){?>|&nbsp;<span class='small-group recent-subgroup'><?php echo $a_player->subgroup;?></span>&nbsp;<?php } ?>
						
					</div>
				</div>
				<?php 			
			}?>
				
			</div>	
			<div class="clearfix"></div>
		</div>	
		<?php 		
	}
}
if(!$recent){
	echo ClubRegUnAuthHelper::noResults();
}