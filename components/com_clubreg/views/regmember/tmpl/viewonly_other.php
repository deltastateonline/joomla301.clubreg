<?php
/*------------------------------------------------------------------------
# com_clubreg - Manage Club Member Registrations
# ------------------------------------------------------------------------
# author    Omokhoa Agbagbara
# copyright Copyright (C) 2012 applications.deltastateonline.com. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://applications.deltastateonline.com
# Technical Support:  email - joomla@deltastateonline.com  

style="position: absolute; left: 0px; visibility: visible;"
style="position: absolute; left: -508px; visibility: hidden;"


-------------------------------------------------------------------------*/ 
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' ); 
$in_type = "hidden";
global $clubreg_Itemid;
$rel_string_list = array("Itemid"=>$clubreg_Itemid,"member_key"=>$this->member_key,JSession::getFormToken()=>1);
$rel_string_edit = array("Itemid"=>$clubreg_Itemid,"member_key"=>$this->member_key,JSession::getFormToken()=>1);
?>
<div><a class="btn profile-other-button btn-mini btn-info" href="javascript:void(0)" rel=<?php echo json_encode($rel_string_edit)?>><?php echo JText::_('COM_CLUBREG_EDITDETAILS')?></a></div>

<div class="clugreg-div-wrapper">
	<div class="clugreg-div form-div" id="otherFormDiv" rel=<?php echo json_encode($rel_string_edit)?> ><h1>Form Here</h1></div>
	<div class="clugreg-div loading1" id="profile-other" rel=<?php echo json_encode($rel_string_list)?> > <h1>Details Here</h1></div>	
</div>