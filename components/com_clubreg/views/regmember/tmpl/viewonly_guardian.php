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
$rel_string_edit = array("Itemid"=>$clubreg_Itemid,"member_key"=>$this->member_key,JSession::getFormToken()=>1);

?>
<div><a class="btn profile-guardian-button" href="javascript:void(0)" rel=<?php echo json_encode($rel_string_edit)?>><?php echo JText::_('COM_CLUBREG_PROFILE_EDITGUARDIAN')?></a></div>

<div class="clugreg-div-wrapper">	
	<div class="clugreg-div form-div" id="guardianFormDiv" rel=<?php echo json_encode($rel_string_edit)?> >
	<div class="row-fluid">
		<div class="span5"><input type="text" class="inputbox input-large" value="" id="search-guardian-text" placeholder="Enter name"/></div>
		<div class="span3"><button class="btn btn-small btn-primary" type="button" id="search-guardian-btn" rel=<?php echo json_encode($rel_string_edit)?>><?php echo JText::_('CLUBREG_FILTER');?></button></div>
	</div>
		<div id="guardian-list"></div>
	</div>
	<div class="clugreg-div" id="profile-guardian" rel=<?php echo json_encode($rel_string_list)?> ></div>	
</div>