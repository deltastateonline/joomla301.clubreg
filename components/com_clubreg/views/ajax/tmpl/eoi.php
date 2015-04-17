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
$d_url = sprintf("index.php?option=com_clubreg&view=eois&layout=rendereoi&Itemid=%s&playertype=",
		$clubreg_Itemid	);
?>
<div class="eoi-counts-div">
	<div class="eoi-counts pull-left"><div class='eoi-count-head'><a href="<?php echo $d_url ;?>guardian"><?php echo JText::_('CLUBREG_DASH_GUARDIAN'); ?></a></div>
		<div class="eoi-count-body"><?php echo $this->howmany_guardian; ?></div>
	</div>
	<div class="eoi-counts pull-right"><div class='eoi-count-head'><a href="<?php echo $d_url ;?>senior"><?php echo JText::_('CLUBREG_DASH_SENIOR');?></a></div>
		<div class="eoi-count-body"><?php echo $this->howmany_senior; ?></div>
	</div>	
	<div class="clearfix"></div>
</div>
