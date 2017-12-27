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

require_once JPATH_COMPONENT.DS.'helpers'.DS.'clubreg.profilethumbs.php';

$params = JComponentHelper::getParams('com_clubreg');
$folder_path = $params->get("attachment_folder");

$media_params = JComponentHelper::getParams('com_media');
$full_media_path = $media_params->get('file_path').DS.$folder_path.DS;

$thumbrenderer = new ClubRegProfileThumbsHelper($full_media_path);

$defaultImg = "<img src='".JURI::base().CLUBREG_ASSETS."/images/clublogo32.png' >";

if(count($this->alerts)> 0){ $i=1; ?>
	<div class="recent-div"><?php 
	foreach($this->alerts as $a_bday){
		$fkey = $this->uKeyObject->constructKey($a_bday->member_id,$a_bday->member_key);
		$profile_pix = $thumbrenderer->renderMemberThumb($a_bday->member_id,64);
		?>
		<div class="pull-left thumbnail-div">
			<div class="thumbnail">
				<?php echo ($profile_pix)?$profile_pix:$defaultImg; ?>								
			</div>
			<div class="profile-text">
				<span><a href="javascript:void(0);" onclick="Joomla.sbutton('<?php echo $fkey;?>')"><?php echo ucwords(strtolower($a_bday->givenname." ".$a_bday->surname)) ;?></a></span><br />
				
				<small class='text-info'><?php echo $a_bday->config_name; ?> | <?php echo $a_bday->alertDate; ?></small>
			</div>
		</div>
		<?php 
	} ?><div class="clearfix"></div></div><?php 
}else{	
	echo ClubRegUnAuthHelper::noResults(); 
}