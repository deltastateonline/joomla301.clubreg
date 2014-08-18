<?php $headingConfigs = $this->profileConfigs["headings"]; 
	  $itemRenderer = $this->itemRenderer;
	  
	  $member_data = $this->all_data["member_data"];  
	  
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

	  
?>
	<div class="row-fluid" style="max-width:97%">
	<div class="span4"><?php echo $this->loadTemplate("pixs"); ?></div>
	<div class="frame-div span8">
			<div class="h21"><?php echo JText::_('COM_CLUBREG_PROFILE_BIO'); ?> : </div>
					<?php $profile_details = $headingConfigs["bio"]; 
						foreach($profile_details as $akey => $tvalue){ 					
						?>
						<div class="row-fluid" style="border-bottom:1px solid #EEEFEF">
							<div class="pull-left profile-label1"><?php echo $tvalue["label"]?></div>
							<div class="pull-left" style='padding:0px 5px;'> : </div>
							<div class="pull-left profile-value"> <?php echo $itemRenderer->render($member_data->$akey,$tvalue); ?></div>
						</div>
					<?php }?>		
		</div>	
	</div>	
		<?php if(isset($this->profileConfigs["headings"]["club"])){ ?>
		<div class="clearfix">&nbsp;</div>
		<div class="row-fluid frame-div" style="max-width:97%">
			
			<div class="h21"><?php echo JText::_('COM_CLUBREG_PROFILE_DIVISION'); ?> :&nbsp;&nbsp;
				<a class="btn btn-mini profile-div-button pull-right" rel='<?php echo $member_data->member_id; ?>' href="javascript:void(0);">-</a><br />
			 	
			 </div>	
			<div class="row-striped">
			<div id="profile-division">
				<?php $profile_details =  $headingConfigs["club"]; 
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