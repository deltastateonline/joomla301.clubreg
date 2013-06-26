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

$d_url = sprintf("index.php?option=com_clubreg&view=eoi&layout=loadeoi&c=eoi&task=loadeoi&Itemid=%s&playertype=",
		$clubreg_Itemid	);
?>
<ul>
	<li><a href="<?php echo $d_url ;?>guardian"><?php echo JText::_('CLUBREG_DASH_GUARDIAN'); ?> (<?php echo $this->howmany_guardian; ?>)</a></li>
	<li><a href="<?php echo $d_url ;?>senior"><?php echo JText::_('CLUBREG_DASH_SENIOR');?> (<?php echo $this->howmany_senior; ?>)</a></li>
</ul>