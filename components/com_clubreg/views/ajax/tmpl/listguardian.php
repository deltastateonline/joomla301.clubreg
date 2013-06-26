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
JHtml::_('behavior.tooltip');
?>
<div class="row-striped ">
<?php 
global $clubreg_Itemid;
foreach($this->all_guardians as $an_item){
	
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
	if($an_item->phoneno){
		$t_phone[] = $an_item->phoneno;
	}
	if($an_item->mobile){
		$t_phone[] = $an_item->mobile;
	}
	$an_item->t_phone = $t_phone ;
	
	$fkey = $this->uKeyObject->constructKey($an_item->member_id,$an_item->member_key);
	
	$rel_string_edit = array('Itemid'=>$clubreg_Itemid,JSession::getFormToken()=>1,'member_key'=>$this->member_key,'parent_key'=>$fkey);
?>
<div class="row-fluid">	
	<div class="span3 h21"><?php echo $an_item->surname, " ",$an_item->givenname;?></div>
	<div class="span4"><?php echo $an_item->emailaddress,"<br />",implode(" / ",$an_item->t_phone) ;?></div>
	<div class="span4"><?php echo $an_item->t_address;?></div>
	<div class="span1 pull-right" ><input type="button" value="+"  class="btn btn-mini re-assign-guardian" title="<?php echo JText::_('COM_CLUBREG_SETGUARDIAN')?>" rel=<?php echo json_encode($rel_string_edit);?> /></div>
</div>
<?php 	
}
?>
</div>
	
	