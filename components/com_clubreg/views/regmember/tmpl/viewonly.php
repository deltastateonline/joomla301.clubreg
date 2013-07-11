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
//JHtml::_('formbehavior.chosen', 'select');

$member_data = $this->all_data["member_data"];
$this->pageTitle .= " : ". $member_data->surname;
ClubregHelper::writePageHeader($this->pageTitle);


	/** some preprocessing*/
	$member_data->t_address = "";$t_phone =  array();
	if($member_data->address){
		$member_data->t_address = ucwords($member_data->address)."<br />";
	}
	if($member_data->suburb || $member_data->postcode){
		$member_data->t_address = $member_data->t_address.ucwords($member_data->suburb)." ";
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

	$itemRenderer = $this->itemRenderer;
global $clubreg_Itemid;
$in_type = "hidden";
$session = JFactory::getSession();
$back_url = $session->get("com_clubreg.back_url");// save the back url

$headingConfigs = $this->profileConfigs["headings"];
?>
<script type="text/javascript">
	var deleteMessage = "Are you sure you want to delete this item?";
	var lockMessage ="Are you sure you want to lock this Note?";
	var token = '<?php echo JSession::getFormToken() ;?>';

	var profilediverightedge = <?php echo isset($profilediverightedge)?$profilediverightedge:700 ;?>;
	
</script>
<style>
<!--
.form-div{
	margin-left:-<?php echo isset($profilediverightedge)?$profilediverightedge:700 ;?>px;	
}
-->
</style>

<div class="row-fluid" >
	<div class="span3"  style="border:0px solid black">
	<div class="row-fluid">
		<div class="btn-group">
			<button class="btn btn-small btn-primary" type="button" onclick="return adminForm_back.submit();"><?php echo JText::_('COM_CLUBREG_BACK_LIST'); ?></button>
			<button class="btn btn-small" type="button" onclick="return adminForm_edit.submit();">Edit</button>
		</div>	
		<form action="<?php echo JRoute::_($this->formbackaction); ?>" method="post" name="adminForm_back" id="adminForm_back">			
			<?php if(count($back_url) > 0){
					foreach($back_url as $akey=>$avalue){ ?>
						<input type="<?= $in_type; ?>" name="<?php echo $akey?>" value="<?= $avalue; ?>" />	
				<?php }
			} ?>
			<input type="<?= $in_type; ?>" name="Itemid" value="<?= $clubreg_Itemid; ?>" />	
			<input type="<?= $in_type; ?>" name="option" value="com_clubreg" />
			<input type="<?= $in_type; ?>" name="layout" value="renderregmembers" />
		</form>	
		<form action="<?php echo JRoute::_($this->formeditaction); ?>" method="post" name="adminForm_edit" id="adminForm_edit">			
			
			<input type="<?= $in_type; ?>" name="Itemid" value="<?= $clubreg_Itemid; ?>" />	
			<input type="<?= $in_type; ?>" name="option" value="com_clubreg" />
			<input type="<?= $in_type; ?>" name="layout" value="edit" />
			<input type="<?= $in_type; ?>" name="pk" value="<?php echo $this->member_key; ?>" />
			<?php echo JHtml::_('form.token'); ?>	
			
		</form>		
	</div>	
	<div class='profile-img'><img src="<?php echo CLUBREG_ASSETS; ?>/images/sf.png" width="128" /></div>
	
	<p class="text-info pull-left small"><?php echo JText::_('COM_CLUBREG_REGISTERED_LABEL'), ' :<br />', $member_data->reg_created_by , ' on ', $member_data->reg_created_date ;?></p>
	</div>
	<div class="span9">		
		<div class="row-fluid">
			<div class="span3 h21"><?php echo JText::_('COM_CLUBREG_PROFILE_BIO'); ?> : </div>	
			<div class="span9 row-striped">
				<?php $profile_details = $headingConfigs["bio"]; 
					foreach($profile_details as $akey => $tvalue){ 					
					?>
					<div class="row-fluid">
						<div class="pull-left profile-label"><?php echo $tvalue["label"]?></div>
						<div class="pull-left profile-colon"> :&nbsp;&nbsp;</div>
						<div class="pull-left profile-value"> <?php echo $itemRenderer->render($member_data->$akey,$tvalue); ?></div>
					</div>
				<?php }?>
				
			</div>	
		</div>	
		<?php if(isset($this->profileConfigs["headings"]["club"])){ ?>
		<div class="clearfix">&nbsp;</div>
		<div class="row-fluid">
			<div class="span3">
			<div class="h21"><?php echo JText::_('COM_CLUBREG_PROFILE_DIVISION'); ?> :</div>
				<a class="btn btn-mini profile-div-button" rel='<?php echo $member_data->member_id; ?>' href="javascript:void(0);">+</a><br />
			 </div>	
			<div class="span9 row-striped">
			<div id="profile-division">
				<?php $profile_details = $headingConfigs["club"]; 
					foreach($profile_details as $akey => $tvalue){ 					
					?>
					<div class="row-fluid">
						<div class="pull-left profile-label"><?php echo $tvalue["label"]?></div>
						<div class="pull-left profile-colon"> :&nbsp;&nbsp;</div>
						<div class="pull-left profile-value"><?php echo $itemRenderer->render($member_data->$akey,$tvalue); ?></div>
					</div>
				<?php }?>
				</div>
			</div>	
		</div>
		<?php } ?>		
	</div><?php  // span9 ?>
</div> <?php  // row-fluid ?>
<hr />
<div id='loading-div'></div>

	<div class="tabbable tabs-top">
		<ul class="nav nav-tabs">
		<?php foreach($headingConfigs["tab"] as $akey => $tvalue) { ?>
			<li <?php echo isset($tvalue["css"])?$tvalue["css"]:""; ?>><a href="#tab<?php echo ucwords($akey); ?>" data-toggle="tab"><?php isset($tvalue["img"])?ClubRegHelper::writeImage($tvalue["img"]):""?><?php echo $tvalue["label"] ?></a></li>
			<?php } ?>					
		</ul>
		
		<div class="tab-divs">
			<div class="tab-content" style="min-height:400px;">
				<?php foreach($headingConfigs["tab"] as $akey => $tvalue){					
					$active = isset($tvalue["default"])?"active":"";?>
					<div class="tab-pane <?php echo $active; ?>" id="tab<?php echo ucwords($akey); ?>">
						<?php echo $this->loadTemplate($akey); ?>
					</div>
					<?php }?>
			</div>
		
		</div>
</div>
<p>&nbsp;</p>
<p>&nbsp;</p>
<?php 
$document = JFactory::getDocument();
ClubregHelper::writeTabAssets($document, "common");
ClubregHelper::writeTabAssets($document, "profile");

foreach($headingConfigs["assets"] as $a_key =>$an_asset){		
	if(is_array($an_asset)){
		ClubregHelper::writeTabAssets($document,$a_key, $an_asset);
	}else{
		ClubregHelper::writeTabAssets($document,$an_asset);
	}
}
ClubregHelper::write_footer();