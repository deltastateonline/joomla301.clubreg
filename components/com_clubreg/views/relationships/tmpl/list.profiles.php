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

if(count($this->items)>0){
	
	foreach($this->items as $an_item){
	
		$an_item->t_address = "";$t_phone =  array();
		if($an_item->address){
			$an_item->t_address = ucwords($an_item->address)."<br />";
		}
		if($an_item->suburb || $an_item->postcode){
			$an_item->t_address = $an_item->t_address.ucwords($an_item->suburb)." ";
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
		
		if(!($an_item->emailaddress && $an_item->emailaddress != "-1")){
			$an_item->emailaddress = "noemail@deltastateonline.com";
		}
		
		
		$an_item->t_phone = $t_phone ;
	
		$fkey = $this->uKeyObject->constructKey($an_item->member_id,$an_item->member_key);
	
		$rel_string_edit = array('Itemid'=>$clubreg_Itemid,JSession::getFormToken()=>1,'member_key'=>$this->member_key,'relationship_key'=>$fkey);
		
		$imageData["fname"] = $an_item->playertype.".png";
		$imageData["attr"] = " align=right  width='24'";
	
		?>
		<div class="profile-new-div" >
		<div class="profile-sub-head-div">			 
			<span><?php echo $an_item->surname, " ",$an_item->givenname;?></span>
			<span class="pull-right"><?php echo $an_item->group_name," - ",$an_item->subgroup_name ;?></span>			
			<?php //ClubRegHelper::writeImage($imageData); ?>
		</div>
			<div class="profile-reg-well">
			<?php if($an_item->playertype != "junior"){ ?>
				<div class="pull-left reg-label1"><?php echo JText::_('COM_CLUBREG_CONTACTDETAILS'); ?></div>				
				<div class="clearfix"></div>				
				
					<div class="pull-left"><?php echo $an_item->emailaddress,"<br />",implode(" / ",$an_item->t_phone) ;?></div>
					
					<div class="pull-left reg-label"></div>
					<div class="pull-left reg-value"><?php echo $an_item->t_address;?></div>
					<div class="clearfix"></div>
				<?php } ?>
				
				<div class="pull-left reg-label1"><?php echo JText::_('COM_CLUBREG_PROFILE_RELATIONS'); ?></div>
				<div class="clearfix"></div>		
				<div class="pull-left control-group">
					<select name="relationship_value" id="relationship_value">
						<option value=" ">- <?php echo JText::_('COM_CLUBREG_PROFILE_RELATIONS'); ?> -</option>
						<option value="child">Child</option>
						<option value="spouse">Spouse</option>
						<option value="parent">Parent</option>
					</select>					
				</div>
				<div class="pull-right"><a class="btn profile-realtionships-save btn-mini btn-info" rel=<?php echo json_encode($rel_string_edit);?>>Save</a></div>
				<div class="clearfix"></div>
			</div>
		</div>
	<?php 	
	}
	?>	
<?php 
}else{ echo ClubRegUnAuthHelper::noResults('COM_CLUBREG_PROFILE'); }

