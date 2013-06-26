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
global $clubreg_Itemid;
$hidden = "hidden";
$session = JFactory::getSession();
$back_url = $session->get("com_clubreg.cancel_profile");
?>
<div class="profile <?php echo $this->pageclass_sfx?>">
<form id="member-profile" action="<?php echo JRoute::_('index.php?option=com_clubreg&task=official.save'); ?>" method="post" class="form-validate form-horizontal" enctype="multipart/form-data">
<fieldset id="users-profile-core">
	<legend>
		<?php echo JText::_('CLUBREG_OFFICIALS_PROFILE_DESC'), " - ",$this->official_details->official_name; ?>
	</legend>	
		<?php 
		$extraDetails = $this->official_details->extraDetails;
		foreach($this->extradetails as $d_key => $d_value){
		$mtyr = "/monthyear/"?>
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
									$ControlRender->set('memberDetails', $extraDetails[$d_value->config_short]) ; // pass details to the object
								
								$ControlRender->render();
								
								unset($paramArray);	unset($ControlRender);	unset($registry);
						?>
					</div>
				</div>
				<?php 						
			}	
	?>	
	</fieldset>	
	<div class="form-actions">
		<button type="submit" class="btn btn-primary validate"><span><?php echo JText::_('JSUBMIT'); ?></span></button>
		<a class="btn" href="<?php echo JRoute::_($back_url); ?>" title="<?php echo JText::_('JCANCEL'); ?>"><?php echo JText::_('JCANCEL'); ?></a>

		<input type="<?php echo $hidden ; ?>" name="Itemid" value="<?php echo $clubreg_Itemid; ?>" />
		<input type="<?php echo $hidden ; ?>" name="option" value="com_clubreg" />
		<input type="<?php echo $hidden ; ?>" name="task" value="official.save" />
		<?php echo JHtml::_('form.token'); ?>
	</div>
</form>
</div>
<?php
ClubregHelper::write_footer(); ?>