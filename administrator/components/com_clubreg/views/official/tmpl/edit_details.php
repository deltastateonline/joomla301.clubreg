<?php
/*------------------------------------------------------------------------
 # com_clubreg - Manage Club Member Registrations
# ------------------------------------------------------------------------
# author    Omokhoa Agbagbara
# copyright Copyright (C) 2013 applications.deltastateonline.com. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://applications.deltastateonline.com
# Technical Support:  email - joomla@deltastateonline.com
-------------------------------------------------------------------------*/

defined('_JEXEC') or die;

if(count($this->extradetails) > 0 ){
	
	$extraDetails = $this->item->extraDetails;
	
foreach($this->extradetails as $d_key => $d_value){	$mtyr = "/monthyear/"?>
		<div class="control-group">						
			<div class="control-label">
				<?php echo $d_value->config_name; ?>
			</div>						
			<div class="controls<?php echo preg_match($mtyr, $d_value->params)?" controls-row":"";?>">
				<?php  						
						$registry = new JRegistry($d_value->params);
						$paramArray = $registry->toArray();
						
						$ControlRender = new ClubRegControlsHelper($paramArray);
						$ControlRender->set('configData', $d_value) ;					
						
						if(isset($extraDetails[$d_value->config_short]))
							$ControlRender->set('memberDetails', $extraDetails[$d_value->config_short]) ;
						
						$ControlRender->render();
						
						unset($paramArray);	unset($ControlRender);	unset($registry);
				?>
			</div>
		</div>
		<?php 						
	}
}