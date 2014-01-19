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
$itemRenderer = $this->itemRenderer;
global $clubreg_Itemid;
$rel_string_list = array("Itemid"=>$clubreg_Itemid,"parent_key"=>$this->member_key,JSession::getFormToken()=>1,'playertype'=>"junior");
$rel_string_edit = array("Itemid"=>$clubreg_Itemid,"parent_key"=>$this->member_key,JSession::getFormToken()=>1,'playertype'=>"junior");
?>
<div><a class="btn profile-children-button btn-mini btn-info" href="javascript:void(0)" rel=<?php echo json_encode($rel_string_edit)?>><?php echo JText::_('COM_CLUBREG_ADDCHILDREN')?></a></div>
<div class="clugreg-div-wrapper">
<div class="clugreg-div form-div" id="childrenFormDiv" rel=<?php echo json_encode($rel_string_edit)?> ></div>
<div class="clugreg-div loading1" id="profile-children" rel=<?php echo json_encode($rel_string_list)?>></div>
</div>
