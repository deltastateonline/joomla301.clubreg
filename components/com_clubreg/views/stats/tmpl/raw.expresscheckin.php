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

if(count($this->items)> 0){ $i=1; ?>
	<div class="row-fluid"><?php 
	$defaultImg = "<img src='".JURI::base().CLUBREG_ASSETS."/images/clublogo32.png' >";
	foreach($this->items as $an_item){ 
		
		$params = JComponentHelper::getParams('com_clubreg');
		$folder_path = $params->get("attachment_folder");
		
		$media_params = JComponentHelper::getParams('com_media');
		$full_media_path = $media_params->get('file_path').DS.$folder_path.DS;
		
		$thumbrenderer = new ClubRegProfileThumbsHelper($full_media_path);	
		
		$fkey = $this->uKeyObject->constructKey($an_item->member_id,$an_item->member_key);
		
		$an_item->t_address = "";$t_phone =  array();
		
		if($an_item->playertype == "junior"){			
			$an_item->address = $an_item->g_address;
			$an_item->suburb = $an_item->g_suburb;
			$an_item->postcode = $an_item->g_postcode;
			$an_item->ausstate = $an_item->g_ausstate;
		}
		
		if($an_item->address){
			$an_item->t_address = ucwords($an_item->address)."<br />";
		}
		if($an_item->suburb || $an_item->postcode){
			$an_item->t_address = $an_item->t_address.ucwords($an_item->suburb)." ";
		}
		if($an_item->ausstate){
			$an_item->t_address = $an_item->t_address.", ".$an_item->ausstate." ";
		}
		if($an_item->postcode){
			$an_item->t_address = $an_item->t_address.$an_item->postcode;
		}
		if($an_item->phoneno && $an_item->phoneno != "-1"){
			$t_phone[] = $an_item->phoneno;
		}
		if($an_item->mobile && $an_item->mobile != "-1"){
			$t_phone[] = $an_item->mobile;
		}
		$an_item->t_phone = $t_phone ;
		
		$profile_pix = $thumbrenderer->renderMemberThumb($an_item->member_id,FALSE,FALSE);
		
		$an_item->group = "<b class='small-group'>".strtoupper($an_item->playertype)."</b><br/>".$an_item->group;
		//if($an_item->subgroup){ $an_item->group = $an_item->group."|".$an_item->subgroup; }	

		$hiding["checkin"] = "";
		$hiding["checkout"] = "hide";		
					
		if(isset($this->stats_array[$an_item->member_id])){
			$found_stats = $this->stats_array[$an_item->member_id];
			
			$found_stats->stats_value= strtolower($found_stats->stats_value);
			if($found_stats->stats_value == "yes"){
				$hiding["checkin"] = "hide";
				$hiding["checkout"] = "";
			}else if($found_stats->stats_value == "no"){
				$hiding["checkin"] = "";
				$hiding["checkout"] = "hide";
			}
		}
		
		?>	
			<div class="row cgroup-div-expresscheckin" style="margin:7px 5px 7px 10px;" data-member_key='<?php echo $fkey; ?>'>		    
		      <div class="pull-left"><?php echo $i;$i++; ?></div>			    
			  <div class="thumbnail pull-left" style="margin-left:5px;"><?php echo ($profile_pix)?$profile_pix:$defaultImg; ?></div>			  
			  	<div class="p-thumbnail pull-left" >
		  			<a href="javascript:void(0);" onclick="Joomla.sbutton('<?php echo $fkey;?>','<?php echo $an_item->playertype?>')"><?php echo ucwords($an_item->surname); ?></a>
		  			<br /><?php echo $an_item->group; ?>
		  			<?php if($an_item->subgroup){?>|&nbsp;<span class='small-group recent-subgroup'><?php echo $an_item->subgroup;?></span>&nbsp;<?php } ?>
		  			</div>	
		  		<div class="pull-left" >
		  			<?php echo !empty($an_item->t_phone)?implode(", ",$an_item->t_phone):"N/A"; ?><hr style='color:#000;margin:5px 0px'/>
		  			<?php echo $an_item->t_address; ?>
		  		</div>
		  		<div class="pull-right">
		  			<a href="javascript:void(0);" class="<?php echo $hiding["checkin"];?> btn btn-success btn-mini btn-expresscheckin" data-statsvalue='yes'><?php echo JText::_('Checkin'); ?></a>
		  			<a href="javascript:void(0);" class="<?php echo $hiding["checkout"];?> btn btn-danger btn-mini btn-expresscheckin" data-statsvalue='no'><?php echo JText::_('Checkout'); ?></a>
		  			&nbsp;
		  		</div>		  				   	
			   <div class="clearfix"></div>		    	
		    </div>		
	<?php 
	} ?></div><?php 
}else{	
	echo ClubRegUnAuthHelper::noResults(); 
}