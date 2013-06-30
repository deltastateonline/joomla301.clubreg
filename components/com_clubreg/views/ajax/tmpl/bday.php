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


if(count($this->birthdays)> 0){ $i=1; ?>
	<div class="row-striped"><?php 
	foreach($this->birthdays as $a_bday){
		$fkey = $this->uKeyObject->constructKey($a_bday->member_id,$a_bday->member_key);
		?>
		<div class="row-fluid">
			<div class="span1"><?php echo $i++; ?></div>
			<div class="span4"><a href="javascript:void(0);" onclick="Joomla.sbutton('<?php echo $fkey;?>')" class='activity-bday'><?php echo $a_bday->givenname," ",$a_bday->surname; ?></a></div>
			<div class="span4"><?php echo $a_bday->bdays ?></div>
		</div>
	<?php 
	} ?></div><?php 
}else{	
	echo ClubRegUnAuthHelper::noResults(); 
}