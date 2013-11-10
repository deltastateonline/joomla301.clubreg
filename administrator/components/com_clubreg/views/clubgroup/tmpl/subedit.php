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
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
JHtml::_('formbehavior.chosen', 'select'); 
?>
<script type="text/javascript">
	Joomla.submitbutton = function(task)
	{
		if (task == 'clubgroup.cancel' || document.formvalidator.isValid(document.id('subclubgroup-form'))) {
			Joomla.submitform(task, document.getElementById('subclubgroup-form'));
		}
	}

	window.addEvent('domready', function(){
		document.formvalidator.setHandler('select', function (value) { return (value != 0); }	);
	});	
</script>
<style>
<!--
.form-horizontal .control-group {
    margin-bottom: 8px;
}
legend{
	margin-bottom: 2px;
}
-->
</style>
<div class="modal-header">		
		<h3><?php echo JText::_('COM_CLUBREG_SUBGROUPN_LABEL');?></h3>
	</div>
<div class="modal-body">
<form action="<?php echo JRoute::_('index.php?option=com_clubreg&view=clubgroup&tmpl=component&task=clubgroup.subedit&group_parent='.(int)$this->item->group_parent.'&group_id='.(int) $this->item->group_id); ?>&layout=subedit" method="post" name="adminForm" id="subclubgroup-form" class="form-validate form-horizontal">
<fieldset class="form-horizontal">
<?php
	foreach($this->form->getFieldset('subdetails') as $field): ?>
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
		<input type="hidden" name="task" value="" />
		<?php echo JHtml::_('form.token'); ?>	
	</fieldset>	
	<fieldset class="form-horizontal">
		<legend>Parameters</legend>
		<?php foreach($this->form->getFieldset('extradetails') as $field): ?>
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
</form>
</div>
<div class="modal-footer">
		<button class="btn" type="button" data-dismiss="modal" onclick="window.parent.SqueezeBox.close()">
			<?php echo JText::_('JCANCEL'); ?>
		</button>
		<button class="btn btn-primary" type="submit" onclick="Joomla.submitbutton('clubgroup.apply');">
			<?php echo JText::_('Save Details'); ?>
		</button>
	</div>