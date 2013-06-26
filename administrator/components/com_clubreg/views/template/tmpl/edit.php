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
?>
<script type="text/javascript">
	Joomla.submitbutton = function(task)
	{
		if (task == 'template.cancel' || document.formvalidator.isValid(document.id('template-form'))) {
			Joomla.submitform(task, document.getElementById('template-form'));
		}
	}
</script>
<form action="<?php echo JRoute::_('index.php?option=com_clubreg&layout=edit&template_id='.(int) $this->item->template_id); ?>" method="post" name="adminForm" id="template-form" class="form-validate form-horizontal">
	<ul class="nav nav-tabs">
	  <li class="active"><a href="#general" data-toggle="tab"><?php echo empty($this->item->template_id) ? JText::_('New Details') : JText::sprintf('Edit Template', $this->item->template_id);?></a></li>
	</ul>
	
	<div class="tab-content">
		<!-- Begin Tabs -->
		<div class="tab-pane active" id="general">
			<div class="row-fluid">
				<div class="span6">
				
					<?php foreach($this->form->getFieldset('details') as $field): ?>
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
				<input type="hidden" name="task" value="" />
				<?php echo JHtml::_('form.token'); ?>				
				</div>
				
				<div class="span3">								
					<fieldset class="form-vertical">
						<?php foreach($this->form->getFieldset('configs') as $field): ?>
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
		</div> <!--  -->
	</div> <!-- Tab -->

</form>
