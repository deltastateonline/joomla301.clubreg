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
JHtml::addIncludePath(JPATH_COMPONENT.'/helpers/html');

JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
JHtml::_('formbehavior.chosen', 'select');

$canDo	= ClubregHelper::getActions();

//echo $this->getState('official.activeTab');
$activeTab = $this->state->get('official.activeTab');
if(!isset($activeTab)){
	$activeTab = "general-details";
}

$all_fieldsets = $this->form->getFieldsets();
?>
<script type="text/javascript">
	Joomla.submitbutton = function(task)
	{
		if (task == 'official.cancel' || document.formvalidator.isValid(document.id('official-form'))) {
			Joomla.submitform(task, document.getElementById('official-form'));
		}
	}
</script>
<form action="<?php echo JRoute::_('index.php?option=com_clubreg&layout=edit&joomla_id='.(int) $this->item->joomla_id); ?>" method="post" name="adminForm" id="official-form" class="form-validate form-horizontal">
	<ul class="nav nav-tabs" id="officialDetails">
	  <li <?php echo  ($activeTab == "general-details")?"class=\"active\"":""; ?>><a href="#general-details" data-toggle="tab" class="clubregTab"><?php echo empty($this->item->joomla_id) ? JText::_('New Details') : JText::sprintf('Edit Official', $this->item->joomla_id);?></a></li>
	  <li <?php echo  ($activeTab == "extra-details")?"class=\"active\"":""; ?>><a href="#extra-details" data-toggle="tab" class="clubregTab"><?php echo empty($this->item->joomla_id) ? JText::_('Officials Details') : JText::sprintf('Extra Details', $this->item->joomla_id);?></a></li>
	</ul>
<?php 	echo JHtml::_('bootstrap.startPane', 'officialDetails', array('active' => $activeTab));  
			echo JHtml::_('bootstrap.addPanel', 'officialDetails', 'general-details');
?>		
			<div class="row-fluid">
				<div class="span6">				
					<?php foreach($this->form->getFieldset('details') as $field): ?>
					<div class="control-group"> 
						<?php if (!$field->hidden): ?>
							<div class="control-label">
								<?php echo $field->label; ?>
							</div>
						<?php endif;  ?>
						<div class="controls">
							<?php echo $field->input; ?>
						</div>
					</div>
				<?php endforeach; ?>
				
				<fieldset>
					<legend><?php echo JText::_('COM_CLUBREG_GROUPN_LABEL');?> Details</legend>
					<?php  $group_fields =  $this->form->getFieldset('groupdetails') ;	?>
						<div class="control-group"> 
							<div class="control-label">
							<?php echo $this->form->getLabel('group_leader'); ?>
							</div>
							<div class="controls">
								<?php echo $this->form->getInput('group_leader'); ?>
							</div>
						</div>						
						<div class="control-group"> 
							<div class="control-label">
							<?php echo $this->form->getLabel('group_member'); ?>
							</div>
							<div class="controls">
								<?php echo $this->form->getInput('group_member'); ?>
							</div>
						</div>					
				</fieldset>				
				<input type="hidden" name="task" value="" />
				<?php echo JHtml::_('form.token'); ?>				
				</div>
				
				<div class="span3 pull-right">													
					<fieldset class="form-vertical">
					<legend><?php echo JText::_($all_fieldsets["configItems"]->label) ?></legend>						
						<?php foreach($this->form->getFieldset('configItems') as $field): ?>
					<div class="control-group"> 
						<?php if (!$field->hidden): ?>
							<div class="control-label">
								<?php echo $field->label; ?>
							</div>
						<?php endif; ?>
						<div class="controls">
							<?php echo $field->input; ?>
						</div>
					</div>
			<?php endforeach; ?>					
					</fieldset>	
				</div>
				
				<div class="span3 pull-right">													
					<fieldset class="form-vertical">
					<legend><?php echo JText::_($all_fieldsets["showdashboard"]->label) ?></legend>					
						<?php foreach($this->form->getFieldset('showdashboard') as $field): ?>
					<div class="control-group"> 
						<?php if (!$field->hidden): ?>
							<div class="control-label">
								<?php echo $field->label; ?>
							</div>
						<?php endif; ?>
						<div class="controls">
							<?php echo $field->input; ?>
						</div>
					</div>
			<?php endforeach; ?>					
					</fieldset>	
				</div>				
			</div>
		<?php 
			echo JHtml::_('bootstrap.endPanel');
			echo JHtml::_('bootstrap.addPanel', 'officialDetails', 'extra-details');			
					echo $this->loadTemplate('details');	
			echo JHtml::_('bootstrap.endPanel');
		echo JHtml::_('bootstrap.endPane');
?>
</form>
<?php 
$document = JFactory::getDocument();
$document->addScript('components/com_clubreg/assets/js/clubreg.js?'.time());
?>