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

JHtml::_('behavior.framework',true);
JHtml::_('behavior.keepalive');

jimport('joomla.html.html.bootstrap');
JHtml::_('behavior.formvalidation');
JHTML::_('behavior.calendar');
JHtml::_('behavior.tooltip');


$member_data = $this->all_data["member_data"];
$this->pageTitle .= " : ". ucwords($member_data->surname);
ClubregHelper::writePageHeader($this->pageTitle);


	/** some preprocessing*/
	$member_data->t_address = "";$t_phone =  array();
	if($member_data->address){
		$member_data->t_address = ucwords($member_data->address)."<br />";
	}
	if($member_data->suburb || $member_data->postcode){
		$member_data->t_address = $member_data->t_address.ucwords($member_data->suburb)." ";
	}
	if($member_data->ausstate){
		$member_data->t_address = $member_data->t_address.$member_data->ausstate." ";
	}
	if($member_data->postcode){
		$member_data->t_address = $member_data->t_address.$member_data->postcode;
	}
	if($member_data->phoneno){
		$t_phone[] = $member_data->phoneno;
	}
	if($member_data->mobile){
		$t_phone[] = $member_data->mobile;
	}
	$member_data->t_phone = $t_phone ;
	/** some preprocessing*/
	
	$this->all_data["member_data"] = $member_data;

	$itemRenderer = $this->itemRenderer;
global $clubreg_Itemid;
$in_type = "hidden";
$session = JFactory::getSession();
$back_url = $session->get("com_clubreg.back_url");// save the back url

$headingConfigs = $this->profileConfigs["headings"];

$hasClubProfile = isset($this->profileConfigs["headings"]['club'])?TRUE:FALSE; // ignore the profile tab for guardians

?>
<script type="text/javascript">
	var deleteMessage 	= "<?php echo JText::_("COM_CLUBREG_PROFILE_DELETE_QUESTION")?>";
	var lockMessage 	= "<?php echo JText::_("COM_CLUBREG_PROFILE_PRIVATE_QUESTION")?>";
	var token = '<?php echo JSession::getFormToken() ;?>';

	var profilediverightedge = <?php echo $this->profile_divrightedge;?>;
	
</script>
<style>
<!--
.form-div{
	margin-left:-<?php echo $this->profile_divrightedge ;?>px;	
}
-->
</style>

<div class="row-fluid" >
	
	<div class="row-fluid" style="padding-top:3px;">
		<div class="btn-group pull-left">
			<button class="btn btn-small btn-primary" type="button" onclick="return adminForm_back.submit();"><?php echo JText::_('COM_CLUBREG_BACK_LIST'); ?></button>
			<button class="btn btn-small" type="button" onclick="return adminForm_edit.submit();">Edit</button>
		</div>	
		<div class="text-info pull-right small"><?php echo JText::_('COM_CLUBREG_REGISTERED_LABEL'), ' :', $member_data->reg_created_by , ' on ', $member_data->reg_created_date ;?></div>
		<form action="<?php echo JRoute::_($this->formbackaction); ?>" method="post" name="adminForm_back" id="adminForm_back">			
			<?php if(count($back_url) > 0){
					foreach($back_url as $akey=>$avalue){ ?>
						<input type="<?php echo $in_type; ?>" name="<?php echo $akey?>" value="<?php echo $avalue; ?>" />	
				<?php }
			} ?>
			<input type="<?php echo $in_type; ?>" name="Itemid" value="<?php echo $clubreg_Itemid; ?>" />	
			<input type="<?php echo $in_type; ?>" name="option" value="com_clubreg" />
			<input type="<?php echo $in_type; ?>" name="layout" value="renderregmembers" />
		</form>	
		<form action="<?php echo JRoute::_($this->formeditaction); ?>" method="post" name="adminForm_edit" id="adminForm_edit">			
			
			<input type="<?php echo $in_type; ?>" name="Itemid" value="<?php echo $clubreg_Itemid; ?>" />	
			<input type="<?php echo $in_type; ?>" name="option" value="com_clubreg" />
			<input type="<?php echo $in_type; ?>" name="layout" value="edit" />
			<input type="<?php echo $in_type; ?>" name="pk" value="<?php echo $this->member_key; ?>" />
			<?php echo JHtml::_('form.token'); ?>			
		</form>				
	<div class="clearfix"></div>
	</div>
	<?php echo $this->loadTemplate("newprofile"); ?>
</div> <?php  // row-fluid ?>
<div id='loading-div'></div>
<div class="clearfix">&nbsp;</div>
<?php if(count($headingConfigs["tab"]) > 0 ) { $i=0; ?>
	<div class="tabbable tabs-<?php echo $this->profile_tabposition; ?>">
		<ul class="nav nav-tabs">
			<?php if($hasClubProfile){ $i++; ?>	
			<li class='active'><a href="#tabProfile" data-toggle="tab"><?php $profile_["fname"] = "profile.png"; $profile_['attr'] = " width='16' hspace='1' border='0'"; ClubRegHelper::writeImage($profile_) ?>Profile</a></li>
			<?php } ?>
		<?php ; foreach($headingConfigs["tab"] as $akey => $tvalue) { $tvalue["img"]['title'] = $tvalue["label"];  ?>
			<li <?php echo ($i == 0)?"class='active'":""; ?>><a href="#tab<?php echo ucwords($akey); ?>" data-toggle="tab"><?php isset($tvalue["img"])?ClubRegHelper::writeImage($tvalue["img"]):""?><?php  if($this->profile_icons){ echo $tvalue["label"]; } ?></a></li>
			<?php $i++; } ?>					
		</ul>
		
		<div class="tab-divs">		
			<div class="tab-content" style="min-height:400px;">
				<?php $i=0;
					 if($hasClubProfile){ ?>
						<div class="tab-pane active" id="tabProfile">
							<?php echo $this->loadTemplate('profile'); ?>
						</div>
				<?php $i++;
					 } ?>
			
				<?php  foreach($headingConfigs["tab"] as $akey => $tvalue){					
					$active = $i == 0?"active":"";$i++;	?>
					<div class="tab-pane <?php echo $active; ?>" id="tab<?php echo ucwords($akey); ?>">
						<?php echo $this->loadTemplate($akey); ?>
					</div>
					<?php }?>
			</div>		
		</div>
</div>
<?php } ?>
<p>&nbsp;</p>
<p>&nbsp;</p>
<?php 
$document = JFactory::getDocument();
ClubregHelper::writeTabAssets($document, "common");
ClubregHelper::writeTabAssets($document, "clubreg",array("js"));
ClubregHelper::writeTabAssets($document, "profile");

foreach($headingConfigs["tab"] as $a_key =>$an_asset){
	ClubregHelper::writeTabAssets($document,$a_key);
}

if(isset($headingConfigs["javascript"]) && count($headingConfigs["javascript"]) > 0){
	
	foreach($headingConfigs["javascript"] as $a_key =>$an_asset ){
		ClubregHelper::writeTabAssets($document,$a_key, $an_asset);
	}
}
/*
?>
<div id='loading-div'></div>
<?php */
ClubregHelper::writeTabAssets($document, "iFrameFormRequest",array("js"));
ClubregHelper::write_footer();