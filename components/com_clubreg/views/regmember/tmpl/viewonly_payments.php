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
$in_type = "hidden";
global $clubreg_Itemid;
$rel_string_list = array("Itemid"=>$clubreg_Itemid,"member_key"=>$this->member_key,JSession::getFormToken()=>1);
$rel_string_edit = array("Itemid"=>$clubreg_Itemid,"member_key"=>$this->member_key,JSession::getFormToken()=>1,'payment_key'=>'0');
?>
<div><a class="btn profile-payment-button" href="javascript:void(0)" rel=<?php echo json_encode($rel_string_edit)?>>Add <?php echo JText::_('COM_CLUBREG_PROFILE_PAYMENT')?></a></div>
<div class="clugreg-div-wrapper">
	<div class="clugreg-div form-div" id="paymentFormDiv" rel=<?php echo json_encode($rel_string_edit)?> ></div>
	<div class="clugreg-div loading1" id="profile-payments" rel=<?php echo json_encode($rel_string_list)?> ></div>	
</div>