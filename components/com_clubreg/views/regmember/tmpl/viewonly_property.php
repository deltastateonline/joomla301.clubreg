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
/**
 * @todo add this to the language file COM_CLUBREG_PROFILE_PROPERTY
 */
defined( '_JEXEC' ) or die( 'Restricted access' ); 
$in_type = "hidden";
global $clubreg_Itemid;
$rel_string_list = array("Itemid"=>$clubreg_Itemid,"member_key"=>$this->member_key,JSession::getFormToken()=>1);
$rel_string_edit = array("Itemid"=>$clubreg_Itemid,"member_key"=>$this->member_key,JSession::getFormToken()=>1,'property_key'=>'0');
?>
<div><a class="btn profile-property-button btn-mini btn-info" href="javascript:void(0)" rel=<?php echo json_encode($rel_string_edit)?>>Add <?php echo JText::_('COM_CLUBREG_PROFILE_PROPERTY')?></a></div>
<div class="clugreg-div-wrapper">
	<div class="clugreg-div form-div" id="propertyFormDiv" rel=<?php echo json_encode($rel_string_edit)?> ></div>
	<div class="clugreg-div loading1" id="profile-propertys" rel=<?php echo json_encode($rel_string_list)?> ></div>	
</div>