<?php
/*------------------------------------------------------------------------
# com_clubreg - Manage Club Member Registrations
# ------------------------------------------------------------------------
# author    Joomla Deltastateonline
# copyright Copyright (C) 2015 app.deltastateonline.com. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://app.deltastateonline.com
# Technical Support:  email - joomla@deltastateonline.com
-------------------------------------------------------------------------*/
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

global $clubreg_Itemid;
$rel_string_list = array("Itemid"=>$clubreg_Itemid,"member_key"=>$this->member_key,JSession::getFormToken()=>1);
$rel_string_edit = array("Itemid"=>$clubreg_Itemid,"member_key"=>$this->member_key,JSession::getFormToken()=>1,'relationships_key'=>'0');
?>
<div><a class="btn profile-realtionships-button btn-mini btn-info" href="javascript:void(0)" rel=<?php echo json_encode($rel_string_edit)?>>Add <?php echo JText::_('COM_CLUBREG_PROFILE_RELATIONS')?></a></div>
<div class="clugreg-div-wrapper">
	<div class="clugreg-div form-new-div" id="relationshipsFormDiv" rel=<?php echo json_encode($rel_string_edit)?>>
		<div class="row-fluid control-group">
			<div class="span5"><input type="text" class="inputbox input-large" required value="" id="search-relationships-text" placeholder="Enter name"/></div>
			<div class="span3"><button class="btn btn-small btn-primary" type="button" id="search-relationships-btn" rel=<?php echo json_encode($rel_string_edit)?>><?php echo JText::_('CLUBREG_FILTER');?></button></div>
			<div class="span3"><a class="btn profile-realtionships-back btn-mini btn-warning pull-right" href="javascript:void(0)">Back</a></div>
		</div>		
			<div id="relationships-list"></div>			
	</div>	
		<div class="clugreg-div loading1" id="profile-relationships" rel=<?php echo json_encode($rel_string_list)?>></div>	
</div>