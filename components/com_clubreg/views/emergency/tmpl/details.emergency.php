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
defined( '_JEXEC' ) or die( 'Restricted access' ); ?>
	<div class="row-striped ">
	
		<?php foreach($this->emergencyForm->getFieldset('nextofkin') as $field){ ?>
			<div class=row-fluid >
				<div class="pull-left profile-bold reg-label "><?php echo strip_tags($field->label); ?></div>
				<div class="pull-left reg-colon"> :&nbsp;&nbsp;</div>
				<div class="pull-left reg-value"><?php echo nl2br($field->value); ?></div>
				
			</div>		
		<?php } ?>
	</div>
