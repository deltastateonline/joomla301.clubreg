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

$extraDetails = $this->otherValues;
?>
<div class="row-striped ">
<?php 
foreach($this->extradetails as $d_key => $d_value){
$mtyr = "/monthyear/"?>
		<div class=row-fluid >				
			<div class="pull-left profile-bold reg-label ">	<?php echo $d_value->config_name; ?></div>	
			<div class="pull-left reg-colon"> :&nbsp;&nbsp;</div>					
			<div class="pull-left reg-value">
				<?php  						
						$registry = new JRegistry($d_value->params);
						$paramArray = $registry->toArray();
						
						$ControlRender = new ClubRegControlsReadonlyHelper($paramArray);
						$ControlRender->set('configData', $d_value) ;					
						
						if(isset($extraDetails[$d_value->config_short]))
							$ControlRender->set('memberDetails', $extraDetails[$d_value->config_short]) ; // pass details to the object
						
						$ControlRender->render();
						
						unset($paramArray);	unset($ControlRender);	unset($registry);
				?>
			</div>
		</div>
	<?php 						
		}	
?>
</div>	

		
		
		